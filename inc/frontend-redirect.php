<?php
// Redirect all frontend requests to the configured frontend URL.
// With no URL configured the theme does nothing, so a fresh install never redirects anywhere.
add_action('template_redirect', function() {
    if (!is_admin()) {
        $frontend_url = get_option('headless_frontend_url', '');
        if ($frontend_url !== '') {
            wp_redirect($frontend_url);
            exit;
        }
    }
});