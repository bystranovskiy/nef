<?php

/**
 * Definition of global variables
 */
define("THEME_URI", get_template_directory_uri());
define("THEME_DIR", get_template_directory());
const THEME_NAME = 'nef';
const S_VERSION = "1.0.0";

if (is_category() || is_tax()) {
    wp_redirect(home_url(), 301);
}

/**
 * after_setup_theme - add_theme_support, etc
 */
require_once(__DIR__ . '/core-functions/after-setup-theme.php');

/**
 * Enqueue theme global css and js
 */
require_once(__DIR__ . '/core-functions/enqueue-assets.php');

/**
 * Custom category for Gutenberg blocks
 */
require_once(__DIR__ . '/core-functions/filter-block-categories.php');

/**
 * Register sidebars
 */
require_once(__DIR__ . '/core-functions/register-sidebars.php');

/**
 * Disable unnecessary formatting in CF7
 */
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Including styles in the admin dashboard
 */
if (is_admin()) {
    wp_enqueue_style('admin-styles', THEME_URI . '/build/admin-styles.min.css', array());
    wp_enqueue_style('block-activities', THEME_URI . '/build/block-activities.min.css', array(), S_VERSION);
    wp_enqueue_style('block-categories-list', THEME_URI . '/build/block-categories-list.min.css', array(), S_VERSION);
    wp_enqueue_style('block-communities', THEME_URI . '/build/block-communities.min.css', array(), S_VERSION);
    wp_enqueue_style('block-info', THEME_URI . '/build/block-info.min.css', array(), S_VERSION);
    wp_enqueue_style('block-innovation-agents', THEME_URI . '/build/block-innovation-agents.min.css', array(), S_VERSION);
    wp_enqueue_style('block-content-info', THEME_URI . '/build/block-content-info.min.css', array(), S_VERSION);
}

/**
 * Posts pagination
 */
require_once(__DIR__ . '/core-functions/posts-pagination.php');

/**
 * Extend get terms with post type parameter.
 */
require_once(__DIR__ . '/core-functions/terms-clauses.php');

/**
 * Dynamic Table of content
 */
require_once(__DIR__ . '/core-functions/dynamic-table-of-content.php');


/**
 * Ajax Post rate
 */
require_once(__DIR__ . '/core-functions/ajax-post-rate.php');

/**
 * Additional Breadcrumbs Modifications
 */
require_once(__DIR__ . '/core-functions/wpseo-breadcrumb-links.php');

/**
 * Enqueue assets to ACF Blocks
 */
require_once(__DIR__ . '/core-functions/enqueue-blocks-assets.php');

/**
 * Remove default post type "Post"
 */
require_once(__DIR__ . '/core-functions/remove-default-post-type.php');


/**
 * Ajax Posts Pagination
 */
require_once(__DIR__ . '/core-functions/ajax-pagination.php');


/**
 * Sort a repeater field
 */
require_once(__DIR__ . '/core-functions/sort-a-repeater-field.php');