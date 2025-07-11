<?php
/*
Plugin Name: AskLLM Buttons
Plugin URI: https://example.com/
Description: Add customizable LLM buttons to your posts and pages.
Version: 0.1.0
Author: ponquecitos
Author URI: https://github.com/ponquecitos
License: GPL2
*/
// Add buttons under each post
// Include settings page
require_once plugin_dir_path(__FILE__) . 'settings.php';

add_filter('the_content', function($content) {
    $show_single = get_option('tp1_show_single');
    $show_feed = get_option('tp1_show_feed');
    $show_chatgpt = get_option('tp1_show_chatgpt');
    $show_claude = get_option('tp1_show_claude');

    // Determine if we should show buttons on this page
    $is_single = is_single();
    $is_feed = is_home() || is_archive();
    if (($is_single && !$show_single) || ($is_feed && !$show_feed)) {
        return $content;
    }

    $site_name = get_bloginfo('name');
    $site_desc = get_bloginfo('description');
    $author = get_the_author();
    $date = get_the_date();
    $custom_prompt = get_option('tp1_custom_request');
    $prompt = $custom_prompt ? $custom_prompt : "Please explain the following page.";
    $url = get_permalink();
    $full_query = "Request: $prompt\nSite: $site_name\nURL: $url\nDescription: $site_desc\nPost by $author on $date\nContent:\n" . strip_tags($content);
    $query = urlencode($full_query);
    $buttons = '<div style="margin-top:20px; display:flex; gap:10px;">';
    if ($show_chatgpt) {
        $buttons .= '<button class="button ponque-post-button" style="background:#0073aa;color:#fff;border:none;padding:10px 20px;border-radius:5px;cursor:pointer;" onclick="window.open(\'https://chatgpt.com/?q=' . $query . '\', \'_blank\');">Ask ChatGPT</button>';
    }
    if ($show_claude) {
        $buttons .= '<button class="button ponque-post-button" style="background:#46b450;color:#fff;border:none;padding:10px 20px;border-radius:5px;cursor:pointer;" onclick="window.open(\'https://claude.ai/new?q=' . $query . '\', \'_blank\');">Ask Claude</button>';
    }
    // $buttons .= '<button class="button ponque-post-button" style="background:#d54e21;color:#fff;border:none;padding:10px 20px;border-radius:5px;cursor:pointer;" onclick="alert(\'Button 3 clicked!\')">Ask Gemini</button>';
    $buttons .= '</div>';
    return $content . $buttons;
});
// Silence is golden.