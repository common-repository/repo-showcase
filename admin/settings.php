<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Enqueue Style and Script for Admin Panel
function repo_showcase_admin_assets() {
    wp_enqueue_style('repo-showcase-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css', array(), '1.0');
}
add_action('admin_enqueue_scripts', 'repo_showcase_admin_assets');

// Admin panel
function github_repo_showcase_settings_page() {
    ?>
    <div class="wrap repo-showcase-admin-wrap">
        <h1 class="wp-heading-inline">Repo Showcase Settings</h1>
        
        <form method="post" action="options.php">
            <?php settings_fields('github_repo_showcase_settings'); ?>
            <?php do_settings_sections('github_repo_showcase_settings'); ?>
            
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">GitHub Username</th>
                    <td>
                        <input type="text" name="repo_showcase_github_username" placeholder="GitHub username" value="<?php echo esc_attr(get_option('repo_showcase_github_username')); ?>" />
                        <p class="description">Enter your GitHub username.</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">GitHub Access Token</th>
                    <td>
                        <input type="text" name="repo_showcase_github_token" size="50" value="<?php echo esc_attr(get_option('repo_showcase_github_token')); ?>" />
                        <p class="description">Enter your GitHub Personal Access Token. <a href="https://docs.github.com/en/enterprise-server@3.9/authentication/keeping-your-account-and-data-secure/managing-your-personal-access-tokens#about-personal-access-tokens" target="_blank">Learn more</a>.</p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>

        <hr />
        <div class="repo-showcase-admin-footer-description">
            <h2>Shortcode Usage</h2>
            <p>Use the following shortcode to display your GitHub repositories:</p>
            <pre>[showcase_repositories]</pre>
        </div>
    </div>
    <?php
}

function github_repo_showcase_register_settings() {
    register_setting('github_repo_showcase_settings', 'repo_showcase_github_username');
    register_setting('github_repo_showcase_settings', 'repo_showcase_github_token');
}

add_action('admin_menu', 'github_repo_showcase_add_admin_menu');
function github_repo_showcase_add_admin_menu() {
    add_options_page(
        'GitHub Repo Showcase Settings',
        'Repo Showcase',
        'manage_options',
        'github-repo-showcase-settings', // Updated slug here
        'github_repo_showcase_settings_page'
    );
}

// Hook registration of settings
add_action('admin_init', 'github_repo_showcase_register_settings');