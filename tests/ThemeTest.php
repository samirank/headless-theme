<?php

use PHPUnit\Framework\TestCase;

final class ThemeTest extends TestCase
{
    protected function setUp(): void
    {
        hl_reset();
        $_POST = [];
        $_GET = [];
    }

    public function testBlankFrontendUrlDoesNotRedirect(): void
    {
        hl_hook('template_redirect')();
        $this->addToAssertionCount(1);
    }

    public function testConfiguredFrontendUrlRedirects(): void
    {
        $GLOBALS['hl']['options']['headless_frontend_url'] = 'https://example.com';
        $this->expectException(HeadlessRedirected::class);
        $this->expectExceptionMessage('https://example.com');
        hl_hook('template_redirect')();
    }

    public function testAdminRequestsAreNotRedirected(): void
    {
        $GLOBALS['hl']['options']['headless_frontend_url'] = 'https://example.com';
        $GLOBALS['hl']['is_admin'] = true;
        hl_hook('template_redirect')();
        $this->addToAssertionCount(1);
    }

    private function renderSettingsPage(): string
    {
        hl_hook('admin_menu')();
        ob_start();
        try {
            ($GLOBALS['hl']['page'])();
        } finally {
            $html = ob_get_clean();
        }
        return $html;
    }

    public function testSettingsPageLoadsWithoutPostAndIncludesNonce(): void
    {
        $html = $this->renderSettingsPage();
        $this->assertStringContainsString('name="_wpnonce"', $html);
        $this->assertNull($GLOBALS['hl']['nonce_checked']);
        $this->assertSame([], $GLOBALS['hl']['updated']);
    }

    public function testSavingChecksTheNonce(): void
    {
        $_POST['headless_frontend_url'] = 'https://example.com';
        $this->renderSettingsPage();
        $this->assertSame('headless_save_settings', $GLOBALS['hl']['nonce_checked']);
        $this->assertSame('https://example.com', $GLOBALS['hl']['updated']['headless_frontend_url']);
    }

    public function testInvalidNonceDoesNotSave(): void
    {
        $_POST['headless_frontend_url'] = 'https://evil.example';
        $GLOBALS['hl']['nonce_ok'] = false;
        try {
            $this->renderSettingsPage();
            $this->fail('Expected the request to be rejected.');
        } catch (HeadlessDied $e) {
            $this->assertSame([], $GLOBALS['hl']['updated']);
        }
    }

    public function testUserWithoutCapabilityIsRejected(): void
    {
        $_POST['headless_frontend_url'] = 'https://example.com';
        $GLOBALS['hl']['can'] = false;
        try {
            $this->renderSettingsPage();
            $this->fail('Expected the request to be rejected.');
        } catch (HeadlessDied $e) {
            $this->assertSame([], $GLOBALS['hl']['updated']);
        }
    }

    public function testBlankUrlCanBeSaved(): void
    {
        $_POST['headless_frontend_url'] = '';
        $this->renderSettingsPage();
        $this->assertSame('', $GLOBALS['hl']['updated']['headless_frontend_url']);
    }

    public function testChangelogPageRequiresCapability(): void
    {
        $GLOBALS['hl']['can'] = false;
        $this->expectException(HeadlessDied::class);
        hl_hook('admin_post_headless_theme_changelog')();
    }

    public function testChangelogPageSanitizesTheVersion(): void
    {
        $_GET['version'] = '1.0.6"/../../evil?x=1';
        try {
            hl_hook('admin_post_headless_theme_changelog')();
        } catch (HeadlessDied $e) {
            // The stubbed HTTP call stops the handler after recording the URL.
        }
        $this->assertSame(
            ['https://raw.githubusercontent.com/samirank/headless-theme/v1.0.6....evilx1/CHANGELOG.md'],
            $GLOBALS['hl']['remote_urls']
        );
    }
}
