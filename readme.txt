=== Repo Showcase ===
Contributors: abdulsamadshk
Tags: github, repositories, shortcode, API, portfolio
Requires at least: 5.0
Tested up to: 6.5.4
Requires PHP: 5.6
Stable tag: 1.0.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display GitHub repositories on Website using Repo Showcase's shortcodes.

== Description ==

Repo Showcase allows you to effortlessly display your GitHub repositories on your WordPress site using simple shortcodes. Perfect for developers wanting to showcase their work in an elegant and functional way.

**Try it out on your free dummy site: Click here => [https://tastewp.org/plugins/repo-showcase](https://tastewp.org/plugins/repo-showcase)**

= Features =

* Display GitHub repositories with a simple shortcode.
* Pagination support for large numbers of repositories.
* Easy setup with a user-friendly settings page.
* Responsive design to look great on all devices.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/repo-showcase` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Navigate to Settings > Repo Showcase to configure the plugin.
4. Enter your GitHub access token and username, then save the settings.
5. Use the `[showcase_repositories]` shortcode in any post or page where you want to display your GitHub repositories.

## Shortcodes

- `[showcase_repositories]`: Displays GitHub repositories.

## External Service Usage

Repo Showcase relies on the GitHub API to fetch and display GitHub repositories on your WordPress site. This API integration allows the plugin to retrieve repository data based on the provided GitHub username.

### GitHub API Integration

The plugin uses the GitHub API to fetch repository information. This includes repository names, descriptions, star counts, fork counts, programming languages, and last update timestamps.

- **Service Used:** GitHub API
- **API Endpoint:** `https://api.github.com/users/$username/repos`
- **Purpose:** Display GitHub repositories on your WordPress site.
- **Service URL:** [GitHub API Documentation](https://developer.github.com/v3/)
- **Terms of Use:** [GitHub Terms of Service](https://docs.github.com/en/github/site-policy/github-terms-of-service)
- **Privacy Policy:** [GitHub Privacy Statement](https://docs.github.com/en/github/site-policy/github-privacy-statement)

By using this plugin, you acknowledge and agree to the GitHub API's terms of use and privacy policy.

### Legal Considerations

Make sure to review and comply with GitHub's terms of service and privacy policy to ensure data transmissions are handled appropriately and legally.

== Frequently Asked Questions ==

= How do I get a GitHub access token? =

1. Log in to your GitHub account.
2. Navigate to Settings > Developer settings > Personal access tokens.
3. Generate a new token with the necessary permissions.
4. Copy the token and paste it into the plugin settings page in your WordPress admin panel.

= How do I use this plugin? =

After setting up the plugin, use the `[showcase_repositories]` shortcode in any post or page where you want to display your GitHub repositories.

= Can I customize the display of the repositories? =

The plugin does not currently offer shortcode attributes for customization. However, you can modify the CSS files included in the plugin to change the appearance of the repositories.

= Is there a limit to the number of repositories I can display? =

The plugin supports pagination, so you can display any number of repositories by navigating through the pages.

== Changelog ==

= 1.0.0 =

* Initial release

== Upgrade Notice ==

= 1.0.0 =

This is the first version of the plugin.

== Screenshots ==

1. **GitHub Repositories Cards** - A preview of the GitHub repositories displayed as cards.
2. **GitHub Repositories Cards with Pagination** - View of repositories with pagination controls.
3. **Shortcode Usage** - Example of the shortcode used in a post or page.
4. **Admin Settings Page** - Settings page where you configure your GitHub access token and username.

== Support ==

For support or questions, please visit the [plugin support forum](https://wordpress.org/support/plugin/repo-showcase).

== License ==

Repo Showcase is released under the GPL-2.0-or-later. See LICENSE file for details.