# Claude AI Code Review - Documentation

## Description

Automatic code review using Claude AI (Claude 3.5 Sonnet model) on every push and pull request.

## How It Works

### Triggers

Workflow automatically runs:

1. **On push** to branches: `main`, `master`, `staging`, `dev`
2. **On pull request** events: `opened`, `synchronize`, `reopened`

### Workflow Process

1. **Getting Changes**
   - For PR: compares changes between base branch and HEAD
   - For push: compares previous commit and current one
   - Skips merge commits
   - Limits diff size to 50,000 characters

2. **Claude AI Analysis**
   - Sends diff to Claude 3.5 Sonnet API
   - Uses temperature 0.3 for consistency
   - Maximum 4096 tokens for response
   - Analyzes code for:
     - 🐛 Bugs and critical errors
     - 🔒 Security issues
     - ⚡ Performance issues
     - 📐 Architectural problems
     - 📖 Code readability
     - ✨ Improvement suggestions

3. **Publishing Results**
   - **For PR**: adds or updates comment in Pull Request
   - **For push**: creates new Issue with labels `ai-review` and `code-quality`

### Review Structure

Each review contains the following sections:

- 📊 **Overall Assessment** - brief overview of changes
- 🚨 **Critical Issues (MUST FIX)** - issues that must be fixed
- ⚠️ **Important Notes** - important issues that should be fixed
- 💡 **Improvement Suggestions** - non-critical but useful improvements
- ✅ **What's Done Well** - positive aspects of the code
- 📋 **Author Checklist** - list of actions to perform

### Metrics

Each review displays:

- Number of input tokens
- Number of output tokens
- Approximate request cost (in USD)
- Claude model used

## Configuration

### Required Secrets

1. **CLAUDE_API_KEY** - API key from Anthropic
   - Get it at https://console.anthropic.com/
   - Add in Repository Settings → Secrets and variables → Actions

2. **GITHUB_TOKEN** - automatically available in GitHub Actions

### Permissions

Workflow has the following permissions:

```yaml
permissions:
  contents: read # reading code
  pull-requests: write # adding comments to PR
  issues: write # creating Issues
```

## Files

- `.github/workflows/claude-review.yml` - main workflow file
- `.github/workflows/claude_review.py` - Python script for Claude API

## Dependencies

Workflow automatically installs:

- `anthropic` - official Python SDK for Claude API
- `PyGithub` - library for GitHub API

## Limitations

- Maximum diff size: 50,000 characters
- Merge commits are skipped automatically
- Temperature: 0.3 (for more consistent results)
- Max tokens: 4096

## Pricing

Approximate cost of using Claude 3.5 Sonnet (as of January 2025):

- Input: $3.00 per 1M tokens
- Output: $15.00 per 1M tokens

Typical cost per review: $0.01-0.10 depending on change size.

## Usage Examples

### Example PR Comment

```markdown
<!-- claude-ai-review -->

# 🤖 Claude AI Code Review

## 📊 Overall Assessment

Code contains important changes in WordPress theme...

[... detailed analysis ...]

---

**📊 Analysis Metrics:**

- Input tokens: 2,456
- Output tokens: 847
- Approximate cost: $0.0201
- Model: claude-3-5-sonnet-20241022
```

### Example Issue on Push

```markdown
# 🤖 Claude AI Code Review

**Commit:** [a1b2c3d](https://github.com/user/repo/commit/a1b2c3d)
**Author:** John Doe
**Message:** Add new feature

---

[... detailed analysis ...]
```

## Troubleshooting

### Workflow doesn't start

1. Check that push/PR goes to the correct branch
2. Check Actions settings in Repository Settings
3. Check that workflow file is in `.github/workflows/`

### API Key Error

1. Check that `CLAUDE_API_KEY` is added to Secrets
2. Check that key is valid at https://console.anthropic.com/
3. Check account balance on Anthropic

### No comments in PR

1. Check that workflow has permission `pull-requests: write`
2. Check workflow logs in Actions tab
3. Check that diff is not empty

## Support

If you encounter issues:

1. Check workflow logs in GitHub Actions tab
2. Check Claude API status at https://status.anthropic.com/
3. Create an Issue in the repository with problem description and logs
