#!/usr/bin/env python3
"""
Claude AI Code Review Script
Analyzes code changes using Claude API with automatic model fallback
Supports both PR comments and Issue creation
"""

import os
import sys
from anthropic import Anthropic
from github import Github
import traceback

# Constants
MAX_TOKENS = 4096
TEMPERATURE = 0.3

# List of models in priority order (will try each in sequence)
MODELS_FALLBACK = [
    "claude-sonnet-4-5-20250929",
    "claude-sonnet-4-5",
    "claude-opus-4-5-20251101",
    "claude-sonnet-4-20250514",
    "claude-opus-4-20250514",
]

# Pricing for different models (approximate, in USD per million tokens)
MODEL_PRICING = {
    "claude-sonnet-4-5-20250929": {"input": 3.0, "output": 15.0},
    "claude-sonnet-4-5": {"input": 3.0, "output": 15.0},
    "claude-opus-4-5-20251101": {"input": 5.0, "output": 25.0},
    "claude-sonnet-4-20250514": {"input": 3.0, "output": 15.0},
    "claude-opus-4-20250514": {"input": 15.0, "output": 75.0},
}

CODE_REVIEW_PROMPT = """You are an experienced Senior Developer performing a code review.

Analyze the following code changes and provide a detailed review in ENGLISH.

Code changes (git diff):
```
{diff}
```

Structure your response as follows:

## Overall Assessment
Brief overview of changes and general impression.

## Critical Issues (MUST FIX)
Issues that MUST be fixed before merge:
- Bugs and critical errors
- Security issues
- Critical performance issues

## Important Notes
Important issues that should be fixed:
- Architectural problems
- Potential bugs
- Performance issues
- Readability concerns

## Improvement Suggestions
Non-critical but useful improvements:
- Optimizations
- Best practices
- Refactoring opportunities

## What's Done Well
Positive aspects of the code (if any).

## Author Checklist
- [ ] Item 1
- [ ] Item 2
...

Be specific, include line numbers when possible.
Be professional yet friendly."""


def read_diff():
    """Reads diff from file"""
    try:
        diff_file = os.environ.get('DIFF_FILE', '/tmp/diff.txt')
        # Validate file path for security
        if not diff_file.startswith('/tmp/'):
            raise ValueError(f"Invalid diff file path: {diff_file}")
        with open(diff_file, 'r', encoding='utf-8') as f:
            return f.read()
    except Exception as e:
        print(f"Error reading diff: {e}")
        sys.exit(1)


def get_claude_review(diff):
    """Gets review from Claude API with automatic model fallback"""
    try:
        api_key = os.environ.get('CLAUDE_API_KEY')
        if not api_key:
            raise ValueError("CLAUDE_API_KEY not found in environment")
        
        client = Anthropic(api_key=api_key)
        prompt = CODE_REVIEW_PROMPT.format(diff=diff)
        
        # Try each model in sequence
        last_error = None
        for model in MODELS_FALLBACK:
            try:
                print(f"Trying model: {model}...")
                
                response = client.messages.create(
                    model=model,
                    max_tokens=MAX_TOKENS,
                    temperature=TEMPERATURE,
                    messages=[
                        {"role": "user", "content": prompt}
                    ]
                )
                
                # If successful - exit loop
                print(f"Successfully used model: {model}")
                
                # Extract metrics
                input_tokens = response.usage.input_tokens
                output_tokens = response.usage.output_tokens
                
                # Get pricing for this model
                pricing = MODEL_PRICING.get(model, {"input": 3.0, "output": 15.0})
                input_cost = (input_tokens / 1_000_000) * pricing["input"]
                output_cost = (output_tokens / 1_000_000) * pricing["output"]
                total_cost = input_cost + output_cost
                
                print(f"Input tokens: {input_tokens}")
                print(f"Output tokens: {output_tokens}")
                print(f"Approximate cost: ${total_cost:.4f}")
                
                review_text = response.content[0].text
                
                # Add metrics to review
                metrics = f"\n\n---\n\n**Analysis Metrics:**\n"
                metrics += f"- Model used: {model}\n"
                metrics += f"- Input tokens: {input_tokens:,}\n"
                metrics += f"- Output tokens: {output_tokens:,}\n"
                metrics += f"- Approximate cost: ${total_cost:.4f}\n"
                
                return review_text + metrics
                
            except Exception as e:
                error_msg = str(e)
                print(f"Model {model} failed: {error_msg}")
                last_error = e
                
                # If 404 error (model not found), try next
                if "404" in error_msg or "not_found" in error_msg:
                    continue
                # If other error - also try next
                continue
        
        # If all models failed
        print(f"All models failed. Last error: {last_error}")
        traceback.print_exc()
        sys.exit(1)
        
    except Exception as e:
        print(f"Error calling Claude API: {e}")
        traceback.print_exc()
        sys.exit(1)


def get_pr_number():
    """Gets PR number from environment or GitHub event"""
    # First try direct PR_NUMBER
    pr_number = os.environ.get('PR_NUMBER')
    if pr_number:
        print(f"Found PR number from PR_NUMBER env: {pr_number}")
        return pr_number
    
    # Try to get from GitHub event context
    event_name = os.environ.get('GITHUB_EVENT_NAME')
    print(f"Event name: {event_name}")
    
    if event_name == 'pull_request':
        # For pull_request events, PR number is in GITHUB_REF
        github_ref = os.environ.get('GITHUB_REF', '')
        print(f"GITHUB_REF: {github_ref}")
        if '/pull/' in github_ref:
            try:
                pr_number = github_ref.split('/pull/')[1].split('/')[0]
                print(f"Extracted PR number from GITHUB_REF: {pr_number}")
                return pr_number
            except (IndexError, AttributeError) as e:
                print(f"Failed to parse PR number from GITHUB_REF: {e}")
                print(f"GITHUB_REF format was: {github_ref}")
    
    print("No PR number found")
    return None


def post_pr_comment(review):
    """Posts or updates PR comment"""
    try:
        github_token = os.environ.get('GITHUB_TOKEN')
        repo_name = os.environ.get('GITHUB_REPOSITORY')
        pr_number = get_pr_number()
        
        if not all([github_token, repo_name]):
            raise ValueError("Missing GITHUB_TOKEN or GITHUB_REPOSITORY")
        
        if not pr_number:
            raise ValueError("Could not determine PR number")
        
        print(f"Posting comment to PR #{pr_number}...")
        
        g = Github(github_token)
        repo = g.get_repo(repo_name)
        
        try:
            pr_num = int(pr_number)
        except (ValueError, TypeError):
            raise ValueError(f"Invalid PR number: {pr_number}")
        
        pr = repo.get_pull(pr_num)
        
        # Check if bot comment already exists
        comment_marker = "<!-- claude-ai-review -->"
        review_with_marker = f"{comment_marker}\n\n# Claude AI Code Review\n\n{review}"
        
        existing_comment = None
        for comment in pr.get_issue_comments():
            if comment_marker in comment.body:
                existing_comment = comment
                break
        
        if existing_comment:
            print("Updating existing comment...")
            existing_comment.edit(review_with_marker)
        else:
            print("Creating new comment...")
            pr.create_issue_comment(review_with_marker)
        
        print("Comment posted successfully")
        
    except Exception as e:
        print(f"Error posting PR comment: {e}")
        traceback.print_exc()
        sys.exit(1)


def create_issue(review):
    """Creates Issue with review results"""
    try:
        github_token = os.environ.get('GITHUB_TOKEN')
        repo_name = os.environ.get('GITHUB_REPOSITORY')
        commit_sha = os.environ.get('GITHUB_SHA')
        
        if not all([github_token, repo_name, commit_sha]):
            raise ValueError("Missing required environment variables for Issue creation")
        
        print("Creating Issue with review results...")
        
        g = Github(github_token)
        repo = g.get_repo(repo_name)
        
        # Get commit information
        commit = repo.get_commit(commit_sha)
        commit_message = commit.commit.message.split('\n')[0]
        commit_url = commit.html_url
        commit_author = commit.commit.author.name
        
        # Format Issue title and body
        title = f"AI Code Review: {commit_message[:60]}"
        body = f"# Claude AI Code Review\n\n"
        body += f"**Commit:** [{commit_sha[:7]}]({commit_url})\n"
        body += f"**Author:** {commit_author}\n"
        body += f"**Message:** {commit_message}\n\n"
        body += "---\n\n"
        body += review
        
        # Create Issue with labels
        issue = repo.create_issue(
            title=title,
            body=body,
            labels=['ai-review', 'code-quality']
        )
        
        print(f"Issue created: {issue.html_url}")
        
    except Exception as e:
        print(f"Error creating Issue: {e}")
        traceback.print_exc()
        sys.exit(1)


def main():
    """Main function"""
    print("Starting Claude AI Code Review...")
    print(f"Available fallback models: {', '.join(MODELS_FALLBACK)}")
    
    # Read diff (bash already validated existence and size)
    diff = read_diff()
    print(f"Diff size: {len(diff)} characters")
    
    # Get review from Claude (with automatic fallback)
    review = get_claude_review(diff)
    
    # Determine where to post the review
    event_name = os.environ.get('GITHUB_EVENT_NAME')
    pr_number = get_pr_number()
    
    print(f"Event name: {event_name}")
    print(f"PR number: {pr_number}")
    
    # If it's a pull_request event OR we have a PR number, post to PR
    if event_name == 'pull_request' or pr_number:
        try:
            post_pr_comment(review)
            print("::notice::Claude AI review completed successfully")
        except Exception as e:
            print(f"::warning::Failed to post PR comment: {e}")
            print("Falling back to creating an Issue...")
            try:
                create_issue(review)
                print("::notice::Claude AI review posted as Issue")
            except Exception as issue_error:
                print(f"::error::Failed to create Issue: {issue_error}")
                sys.exit(1)
    else:
        # Otherwise create an Issue
        try:
            create_issue(review)
            print("::notice::Claude AI review posted as Issue")
        except Exception as e:
            print(f"::error::Failed to create Issue: {e}")
            sys.exit(1)
    
    print("Done!")


if __name__ == "__main__":
    main()