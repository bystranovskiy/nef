<?php
/**
 * Additional Breadcrumbs Modifications
 */

add_filter('wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_link');
function yoast_seo_breadcrumb_append_link($links)
{
    global $post;
    $breadcrumb = false;
    if (
        is_singular('innovation-agents') ||
        is_singular('innovation-cases') ||
        is_post_type_archive('innovation-agents') ||
        is_post_type_archive('innovation-cases') ||
        is_category() && ($_GET["post-type"] === 'innovation-cases' || $_GET["post-type"] === 'innovation-agents')
    ) {
        $breadcrumb = array(
            'url' => site_url('/innovations/'),
            'text' => __("Інновації", THEME_NAME),
        );
    }
    if (
        is_singular('news') ||
        is_singular('blog') ||
        is_post_type_archive('news') ||
        is_post_type_archive('blog') ||
        is_category() && ($_GET["post-type"] === 'news' || $_GET["post-type"] === 'blog')
    ) {
        $breadcrumb = array(
            'url' => site_url('/actual/'),
            'text' => __("Актуальне", THEME_NAME),
        );
    }
    if (
        is_singular('communities') ||
        is_singular('infrastructure') ||
        is_post_type_archive('communities') ||
        is_post_type_archive('infrastructure') ||
        is_tax('main-topics')
    ) {
        $breadcrumb = array(
            'url' => site_url('/ecosystem/'),
            'text' => __("Екосистема", THEME_NAME),
        );
    }
    if ($breadcrumb) {
        $links = array_merge(array_slice($links, 0, 1), array($breadcrumb), array_slice($links, 1));
    }
    return $links;
}