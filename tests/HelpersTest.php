<?php

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    // clsx()

    public function test_clsx_strings(): void
    {
        $this->assertSame('foo bar', clsx('foo', 'bar'));
    }

    public function test_clsx_conditional_array(): void
    {
        $this->assertSame('foo', clsx(['foo' => true, 'bar' => false]));
    }

    public function test_clsx_mixed(): void
    {
        $this->assertSame('base active', clsx('base', ['active' => true, 'hidden' => false]));
    }

    public function test_clsx_falsy_values_ignored(): void
    {
        $this->assertSame('foo', clsx('foo', null, false, '', 0));
    }

    public function test_clsx_empty(): void
    {
        $this->assertSame('', clsx());
    }

    // cleanContent()

    public function test_clean_removes_vc_shortcodes(): void
    {
        $input = '[vc_row][vc_column]Hello[/vc_column][/vc_row]';
        $this->assertStringNotContainsString('[vc_', cleanContent($input));
        $this->assertStringContainsString('Hello', cleanContent($input));
    }

    public function test_clean_removes_inline_styles(): void
    {
        $input = '<p style="color:red">Text</p>';
        $this->assertStringNotContainsString('style=', cleanContent($input));
    }

    public function test_clean_removes_empty_paragraphs(): void
    {
        $input = '<p>Content</p><p>&nbsp;</p><p>  </p>';
        $result = cleanContent($input);
        $this->assertStringContainsString('<p>Content</p>', $result);
        $this->assertStringNotContainsString('<p>&nbsp;</p>', $result);
    }

    public function test_clean_strips_spans(): void
    {
        $input = '<p><span class="vc_custom">Hello</span></p>';
        $result = cleanContent($input);
        $this->assertStringNotContainsString('<span', $result);
        $this->assertStringContainsString('Hello', $result);
    }

    public function test_clean_downgrades_h1_to_h2(): void
    {
        $input = '<h1>Title</h1>';
        $result = cleanContent($input);
        $this->assertStringNotContainsString('<h1', $result);
        $this->assertStringContainsString('<h2>', $result);
    }

    public function test_clean_replaces_hr_with_div(): void
    {
        $input = '<p>A</p><hr/><p>B</p>';
        $result = cleanContent($input);
        $this->assertStringContainsString('<div class="line">', $result);
        $this->assertStringNotContainsString('<hr', $result);
    }
}
