<?php
/**
 * Enqueue theme global css and js
 */

function nef_scripts()
{
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_style("main-styles", THEME_URI . "/build/main.min.css", array(), S_VERSION);
    wp_enqueue_script("main-scripts", THEME_URI . "/build/main.min.js", array("jquery"), S_VERSION);


    wp_localize_script('main-scripts', 'ajaxMeta', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));


    if (is_archive()) {
        wp_enqueue_style('post-item', THEME_URI . '/build/post-item.min.css', array(), S_VERSION);
        $post_type = get_post_type();
        $sidebar_widgets = get_field('sidebar-widgets-' . $post_type, 'options');
        $sidebar_widgets[]['widget'] = 'block-categories-list';
        sidebar_assets_page($sidebar_widgets);
    }


    if (is_singular('innovation-agents')) {
        wp_enqueue_style('single-innovation-agents', THEME_URI . '/build/single-innovation-agents.min.css', array(), S_VERSION);
        wp_enqueue_script("ajax-pagination", THEME_URI . "/build/ajax-pagination.min.js", array("jquery"), S_VERSION);
    }


    if (is_singular('innovation-cases')) {
        enqueue_slick();
        wp_enqueue_script("single-innovation-cases", THEME_URI . "/build/single-innovation-cases.min.js", array("jquery"), S_VERSION);
        wp_enqueue_style('single-innovation-cases', THEME_URI . '/build/single-innovation-cases.min.css', array(), S_VERSION);
    }


    if (is_single()) {
        wp_enqueue_style('post-item', THEME_URI . '/build/post-item.min.css', array(), S_VERSION);
    }

    if (is_single() || is_page_template('page-article.php') || is_page_template('page-about-nef.php')) {
        wp_enqueue_script("single-post", THEME_URI . "/build/single-post.min.js", array("jquery"), S_VERSION);
        wp_enqueue_style('single-post', THEME_URI . '/build/single-post.min.css', array(), S_VERSION);
    }

    if (is_page_template('page-search.php')) {
        wp_enqueue_style('post-item', THEME_URI . '/build/post-item.min.css', array(), S_VERSION);
        wp_enqueue_style('page-search', THEME_URI . '/build/page-search.min.css', array(), S_VERSION);
        wp_enqueue_script("ajax-pagination", THEME_URI . "/build/ajax-pagination.min.js", array("jquery"), S_VERSION);
    }

    if (is_page_template('page-nefologism.php')) {
        wp_enqueue_style('page-nefologism', THEME_URI . '/build/page-nefologism.min.css', array(), S_VERSION);
        wp_enqueue_script("page-nefologism", THEME_URI . "/build/page-nefologism.min.js", array("jquery"), S_VERSION);
    }

    if (is_404()) {
        wp_enqueue_style('error404', THEME_URI . '/build/error404.min.css', array(), S_VERSION);
    }

    if (is_page_template('page-about-nef.php')) {
        wp_enqueue_style('page-about-nef', THEME_URI . '/build/page-about-nef.min.css', array(), S_VERSION);
        $sidebar_widgets = get_field('sidebar-widgets');
        sidebar_assets_page($sidebar_widgets);
    }


    remove_action("wp_head", "wp_print_scripts");
    remove_action("wp_head", "wp_print_head_scripts", 9);
    remove_action("wp_head", "wp_enqueue_scripts", 1);
    remove_action("wp_head", "wp_print_styles", 99);
    remove_action("wp_head", "wp_enqueue_style", 99);

    add_action("wp_footer", "wp_print_scripts", 5);
    add_action("wp_footer", "wp_enqueue_scripts", 5);
    add_action("wp_footer", "wp_print_head_scripts", 5);
    add_action("wp_head", "wp_print_styles", 30);
    add_action("wp_head", "wp_enqueue_style", 30);
}

add_action("wp_enqueue_scripts", "nef_scripts");


/**
 * Connecting a slick carousel
 */
function enqueue_slick()
{
    wp_enqueue_style('slick', THEME_URI . '/src/vendors/slick/slick.css', array());
    wp_enqueue_script('slick', THEME_URI . '/src/vendors/slick/slick.min.js', array('jquery'));
}

function sidebar_assets_page($sidebar_widgets)
{
    if ($sidebar_widgets) {
        foreach ($sidebar_widgets as $sidebar_widget) {
            $widget = $sidebar_widget['widget'];
            wp_enqueue_style($widget, THEME_URI . '/build/' . $widget . '.min.css', array(), S_VERSION);
        }
    }
}