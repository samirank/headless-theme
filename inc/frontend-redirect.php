<?php
// Redirect all frontend requests to the configured frontend URL.
add_action('template_redirect', function() {
    if (!is_admin()) {
        $frontend_url = get_option('headless_frontend_url', 'https://samirankakoty.com');
        wp_redirect($frontend_url);
        exit;
    }
});