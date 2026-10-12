<?php
// Self-hosted updates: check the GitHub Releases of this repository for a newer theme zip.
$headless_autoload = get_template_directory() . '/vendor/autoload.php';

if (file_exists($headless_autoload)) {
    require_once $headless_autoload;

    if (class_exists('YahnisElsts\PluginUpdateChecker\v5\PucFactory')) {
        $headless_update_checker = YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
            'https://github.com/samirank/headless-theme/',
            get_template_directory() . '/style.css',
            'headless-theme'
        );
        // Install the release asset (headless-theme.zip) so the folder name stays correct.
        $headless_update_checker->getVcsApi()->enableReleaseAssets('/headless-theme\.zip($|[?&#])/i');
    }
}
