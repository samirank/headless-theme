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

        // GitHub refuses to load inside the "View version details" popup, so point it at a page on this site instead.
        $headless_update_checker->addFilter('request_update_result', function ($update) {
            if ($update) {
                $update->details_url = add_query_arg(
                    array('action' => 'headless_theme_changelog', 'version' => $update->version),
                    admin_url('admin-post.php')
                );
            }
            return $update;
        });
    }
}

// Show the changelog of a release in the "View version details" popup.
add_action('admin_post_headless_theme_changelog', function () {
    if (!current_user_can('update_themes')) {
        wp_die(esc_html__('You do not have permission to view this page.', 'headless-theme'));
    }

    $version = isset($_GET['version']) ? preg_replace('/[^0-9A-Za-z.\-]/', '', wp_unslash($_GET['version'])) : '';
    $release_url = 'https://github.com/samirank/headless-theme/releases' . ($version !== '' ? '/tag/v' . $version : '');
    $html = '';

    if ($version !== '') {
        $response = wp_remote_get('https://raw.githubusercontent.com/samirank/headless-theme/v' . $version . '/CHANGELOG.md', array('timeout' => 10));
        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            if (!class_exists('Parsedown', false)) {
                require_once get_template_directory() . '/vendor/yahnis-elsts/plugin-update-checker/vendor/Parsedown.php';
            }
            $parser = new Parsedown();
            $html = wp_kses_post($parser->text(wp_remote_retrieve_body($response)));
        }
    }

    if ($html === '') {
        $html = '<p>' . esc_html__('The changelog could not be loaded.', 'headless-theme') . '</p>';
    }
    ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo esc_html('Headless Theme ' . $version); ?></title>
<style>
body { font: 14px/1.6 -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; color: #1d2327; margin: 24px 32px; max-width: 760px; }
h1 { font-size: 22px; } h2 { font-size: 18px; margin-top: 28px; border-bottom: 1px solid #dcdcde; padding-bottom: 4px; } h3 { font-size: 15px; }
code { background: #f0f0f1; padding: 1px 4px; } a { color: #2271b1; }
</style>
</head>
<body>
<?php echo $html; // Sanitized with wp_kses_post above. ?>
<p><a href="<?php echo esc_url($release_url); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e('View this release on GitHub', 'headless-theme'); ?></a></p>
</body>
</html>
    <?php
    exit;
});
