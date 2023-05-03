<?php
/**
 * Custom category for Gutenberg blocks
 */

function filter_block_categories_when_post_provided($block_categories, $editor_context)
{
    if (!empty($editor_context->post)) {
        $block_categories[] = array(
            'slug' => 'nef',
            'title' => __("NEF Blocks", THEME_NAME),
            'icon' => 'admin-home',
        );
    }
    return $block_categories;
}

add_filter('block_categories_all', 'filter_block_categories_when_post_provided', 10, 2);