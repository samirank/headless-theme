<?php
// Add a settings page to configure the frontend URL.
add_action('admin_menu', function() {
    add_options_page(
        'Headless Settings',
        'Headless',
        'manage_options',
        'headless-settings',
        function() {
            if ($_POST['headless_frontend_url']) {
                update_option('headless_frontend_url', esc_url_raw($_POST['headless_frontend_url']));
                echo '<div class="updated"><p>Settings saved.</p></div>';
            }
            $frontend_url = get_option('headless_frontend_url', 'https://samirankakoty.com');
            ?>
            <div class="wrap">
                <h1>Headless Settings</h1>
                <form method="post">
                    <table class="form-table">
                        <tr>
                            <th scope="row"><label for="headless_frontend_url">Frontend URL</label></th>
                            <td><input name="headless_frontend_url" type="url" id="headless_frontend_url" value="<?php echo esc_attr($frontend_url); ?>" class="regular-text"></td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>
            <?php
        }
    );
});