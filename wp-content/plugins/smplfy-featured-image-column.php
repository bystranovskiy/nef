<?php
/**
 * @package Add featured image column to WP admin panel
 * @version 1.0.0
 */
/*
Plugin Name: Featured image column

Description: Add featured image column to WP admin panel
Author: Simplify
Version: 1.0.0
Author URI: https://smplfy.eu/
*/


// Add the posts and pages columns filter. Same function for both.
add_filter('manage_posts_columns', 'smplfy_add_thumbnail_column', 2);
add_filter('manage_pages_columns', 'smplfy_add_thumbnail_column', 2);
function smplfy_add_thumbnail_column($smplfy_columns)
{
    $smplfy_columns['smplfy_thumb'] = __('Image');
    return $smplfy_columns;
}

// Add featured image thumbnail to the WP Admin table.
add_action('manage_posts_custom_column', 'smplfy_show_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'smplfy_show_thumbnail_column', 5, 2);
function smplfy_show_thumbnail_column($smplfy_columns, $smplfy_id)
{
    switch ($smplfy_columns) {
        case 'smplfy_thumb':
            if (function_exists('the_post_thumbnail'))
                the_post_thumbnail('thumbnail');
            break;
    }
}

// Move the new column at the first place.
add_filter('manage_posts_columns', 'smplfy_column_order');
function smplfy_column_order($columns)
{
    $n_columns = array();
    $move = 'smplfy_thumb'; // which column to move
    $before = 'title'; // move before this column

    foreach ($columns as $key => $value) {
        if ($key == $before) {
            $n_columns[$move] = $move;
        }
        $n_columns[$key] = $value;
    }
    return $n_columns;
}

// Format the column width with CSS
add_action('admin_head', 'smplfy_add_admin_styles');
function smplfy_add_admin_styles()
{
    echo '
<style>
    .column-smplfy_thumb {
        width: 82px; 
        text-align: center;
     }
     .column-smplfy_thumb .attachment-thumbnail {
        height:auto;
        max-width: 100%;
     }
</style>';
}
