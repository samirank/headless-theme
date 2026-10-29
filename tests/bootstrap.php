<?php
// Minimal WordPress stubs so the theme's files can be loaded and their callbacks exercised without WordPress.

final class HeadlessRedirected extends Exception {}
final class HeadlessDied extends Exception {}

function hl_reset(): void {
    $GLOBALS['hl'] = [
        'hooks' => $GLOBALS['hl']['hooks'] ?? [],
        'options' => [],
        'is_admin' => false,
        'can' => true,
        'nonce_ok' => true,
        'nonce_checked' => null,
        'updated' => [],
        'remote_urls' => [],
        'page' => null,
    ];
}
hl_reset();

function add_action($hook, $callback) { $GLOBALS['hl']['hooks'][$hook][] = $callback; }
function add_filter($hook, $callback) { $GLOBALS['hl']['hooks'][$hook][] = $callback; }
function hl_hook(string $hook): callable { return $GLOBALS['hl']['hooks'][$hook][0]; }

function get_option($name, $default = false) { return $GLOBALS['hl']['options'][$name] ?? $default; }
function update_option($name, $value) { $GLOBALS['hl']['updated'][$name] = $value; return true; }
function is_admin() { return $GLOBALS['hl']['is_admin']; }
function current_user_can($cap) { return $GLOBALS['hl']['can']; }
function wp_redirect($url) { throw new HeadlessRedirected($url); }
function wp_die($message = '') { throw new HeadlessDied((string) $message); }
function check_admin_referer($action) {
    $GLOBALS['hl']['nonce_checked'] = $action;
    if (!$GLOBALS['hl']['nonce_ok']) {
        throw new HeadlessDied('nonce');
    }
    return 1;
}
function add_options_page($page_title, $menu_title, $cap, $slug, $callback) { $GLOBALS['hl']['page'] = $callback; }
function wp_remote_get($url, $args = []) {
    $GLOBALS['hl']['remote_urls'][] = $url;
    throw new HeadlessDied('remote');
}

function __($text, $domain = 'default') { return $text; }
function esc_html__($text, $domain = 'default') { return htmlspecialchars($text, ENT_QUOTES); }
function esc_html_e($text, $domain = 'default') { echo htmlspecialchars($text, ENT_QUOTES); }
function esc_html($text) { return htmlspecialchars((string) $text, ENT_QUOTES); }
function esc_attr($text) { return htmlspecialchars((string) $text, ENT_QUOTES); }
function esc_url_raw($url) { return filter_var($url, FILTER_VALIDATE_URL) ? $url : ''; }
function esc_url($url) { return $url; }
function wp_unslash($value) { return is_string($value) ? stripslashes($value) : $value; }
function wp_nonce_field($action) { echo '<input type="hidden" name="_wpnonce" value="x">'; }
function submit_button() { echo '<button>Save</button>'; }
// No vendor directory here, so the updater skips Plugin Update Checker and only registers the changelog page.
function get_template_directory() { return sys_get_temp_dir() . '/headless-theme-tests-no-vendor'; }

$root = dirname(__DIR__);
require $root . '/inc/frontend-redirect.php';
require $root . '/inc/admin-settings.php';
require $root . '/inc/updater.php';
