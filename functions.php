<?php

// Enable support for post thumbnails (featured images).
add_theme_support('post-thumbnails');

// Include frontend redirect logic.
require_once get_template_directory() . '/inc/frontend-redirect.php';

// Include admin settings page logic.
require_once get_template_directory() . '/inc/admin-settings.php';

// Include REST API filters.
require_once get_template_directory() . '/inc/rest-filters.php';