<?php
/*
	Plugin Name: Repo Showcase
	Description: Introducing RepoShowcase, the ultimate plugin for seamlessly showcasing GitHub repositories on your website. With RepoShowcase, effortlessly integrate and display your GitHub projects directly onto your WordPress site. Enhance your online presence and engage your audience by effortlessly embedding GitHub repositories with style and ease.
	Version: 1.0.0
	Author: Abdul Samad
	Author URI: https://getabdulsamad.com
    License: GPL-2.0-or-later
    License URI: https://www.gnu.org/licenses/gpl-2.0.html
	Text Domain: repo-showcase
	Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Include admin settings file
require_once plugin_dir_path(__FILE__) . 'admin/settings.php';

// Enqueue Style and Script for Front-end card listings
function repo_showcase_enqueue_assets() {
    // Enqueue style CSS file
    wp_enqueue_style('repo-showcase-style', plugin_dir_url(__FILE__) . 'assets/css/repo-card-style.css', array(), '1.0');

    // Enqueue local Font Awesome
    wp_enqueue_style('repo-showcase-font-awesome', plugin_dir_url(__FILE__) . 'assets/css/font-awesome.min.css', array(), '4.7.0');

    // Enqueue script JS file
    wp_enqueue_script('repo-showcase-scripts', plugin_dir_url(__FILE__) . 'assets/js/scripts.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'repo_showcase_enqueue_assets');

// Define the shortcode function with a unique prefix
function repo_showcase_display_all_github_repositories($atts) {
    // GitHub username
    $username = get_option('repo_showcase_github_username');
    // GitHub Personal Access Token
    $token = get_option('repo_showcase_github_token');

    if (empty($username) || empty($token)) {
        return "<div class='data-fetching-error'>GitHub username and token are required.</div>";
    }

    // GitHub API URL to retrieve user's repositories
    $url = "https://api.github.com/users/$username/repos?page=1&per_page=100"; // 100 repos max

    // Fetch data from GitHub API with authentication
    $args = array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $token,
            'User-Agent' => 'Repo Showcase'
        )
    );

    $all_repos = array();
    $count = 0;

    while ($url) {
        $response = wp_remote_get($url, $args);
        if (is_wp_error($response)) {
            return "<div class='data-fetching-error'>Error fetching data from GitHub.</div>";
        }

        // Check for 404 Not Found status
        $status_code = wp_remote_retrieve_response_code($response);
        if ($status_code == 404) {
            return "<div class='data-fetching-error'>Error: Username does not exist.</div>";
        }
        
        // Parse JSON response
        $body = wp_remote_retrieve_body($response);
        $repos = json_decode($body);

        if (!$repos) {
            return "<div class='data-fetching-error'>No repositories found for this user.</div>";
        }

        // Append repositories to the array
        $all_repos = array_merge($all_repos, $repos);

        // Increment count
        $count += count($repos);

        // Check if there are more pages or if count is divisible by 6
        if ($count % 6 == 0) {
            $url = null;
        } else {
            $links = wp_remote_retrieve_header($response, 'link');
            if ($links) {
                $matches = array();
                preg_match('/<([^>]+)>;\s*rel="next"/', $links, $matches);
                if ($matches) {
                    $url = $matches[1];
                } else {
                    $url = null;
                }

            } else {
                $url = null;
            }
        }
    }

    // Display repositories as cards
    $output = '<div class="repo-showcase-github-repositories">';

    foreach ($all_repos as $index => $repo) {
        if ($index % 6 == 0) {
            $output .= '<div class="repo-showcase-repository-page" style="' . ($index > 0 ? 'display: none;' : '') . '"><div class="repo-showcase-repository-cards-wrp">'; // Hide subsequent pages
        }

        $output .= '<div class="repo-showcase-repository-card">';

        $output .= '<div class="repo-showcase-user-image"><a href="' . $repo->owner->html_url . '" target="_blank"><img src="' . $repo->owner->avatar_url . '" alt="user profile pic"></a></div>';
        $output .= '<div class="repo-showcase-card-content-wrp">';
        $output .= '<div class="repo-showcase-card-content-header"><h3><a href="' . $repo->html_url . '" target="_blank">' . $repo->name . '</a></h3>';
        $output .= '<p>' . ($repo->description ? $repo->description : 'No description available.') . '</p></div>';
        $output .= '<ul>';
            $output .= '<li><span class="repo-showcase-dashicons fa fa-star"></span> ' . $repo->stargazers_count . '</li>';
            $output .= '<li><i class="repo-showcase-fa fa fa-code-fork"></i> ' . $repo->forks_count . '</li>';
            $output .= '<li><i class="repo-showcase-fa fa fa-code"></i> ' . ($repo->language ? $repo->language : 'Unknown') . '</li>';
            $output .= '<li><i class="repo-showcase-fa fa fa-refresh"></i> ' . gmdate('F j, Y', strtotime($repo->updated_at)) . '</li>';
        $output .= '</ul>';
        $output .= '</div>';

        $output .= '</div>'; // Close repo-showcase-repository-card

        if (($index + 1) % 6 == 0 || $index == count($all_repos) - 1) {
            $output .= '</div></div>'; // Close repo-showcase-repository-page
        }
    }
    $output .= '</div>'; // Close repo-showcase-github-repositories and cards wrapper

    // Pagination
    $output .= '<div class="repo-showcase-pagination">';
    $output .= '<button class="repo-showcase-prev-page" onclick="repoShowcaseChangePage(-1)">Previous</button>';
    $output .= '<button class="repo-showcase-next-page" onclick="repoShowcaseChangePage(1)">Next</button>';
    $output .= '</div>';

    return $output;
}

// Register the shortcode with unique prefix
add_shortcode('showcase_repositories', 'repo_showcase_display_all_github_repositories');