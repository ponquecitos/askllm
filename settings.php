<?php
/*
 * Plugin Settings Page for AskLLM Buttons
 */

// Add settings page to admin menu
add_action('admin_menu', function() {
    add_options_page(
        'AskLLM Buttons Settings',
        'AskLLM Buttons',
        'manage_options',
        'test_plugin_1_settings',
        'test_plugin_1_settings_page'
    );
});

// Register settings
add_action('admin_init', function() {
    register_setting('test_plugin_1_settings_group', 'tp1_show_single');
    register_setting('test_plugin_1_settings_group', 'tp1_show_feed');
    register_setting('test_plugin_1_settings_group', 'tp1_show_chatgpt');
    register_setting('test_plugin_1_settings_group', 'tp1_show_claude');
    register_setting('test_plugin_1_settings_group', 'tp1_custom_request');
});

// Settings page HTML
function test_plugin_1_settings_page() {
    ?>
    <div class="wrap">
        <h1>AskLLM Buttons Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('test_plugin_1_settings_group'); ?>
            <?php do_settings_sections('test_plugin_1_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Show buttons on single post pages</th>
                    <td><input type="checkbox" name="tp1_show_single" value="1" <?php checked(1, get_option('tp1_show_single'), true); ?> /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Show buttons on feed/archive/home pages</th>
                    <td><input type="checkbox" name="tp1_show_feed" value="1" <?php checked(1, get_option('tp1_show_feed'), true); ?> /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Show ChatGPT button</th>
                    <td><input type="checkbox" name="tp1_show_chatgpt" value="1" <?php checked(1, get_option('tp1_show_chatgpt'), true); ?> /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Show Claude button</th>
                    <td><input type="checkbox" name="tp1_show_claude" value="1" <?php checked(1, get_option('tp1_show_claude'), true); ?> /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Custom request for LLM (default: 'Please explain the following page.'):</th>
                    <td><input type="text" name="tp1_custom_request" value="<?php echo esc_attr(get_option('tp1_custom_request', '')); ?>" style="width: 400px;" placeholder="Please explain the following page." /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
