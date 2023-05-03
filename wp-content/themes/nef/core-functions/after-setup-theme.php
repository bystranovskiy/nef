<?php
/**
 * after_setup_theme - add_theme_support, etc
 */

function nef_setup()
{
    add_theme_support("menus");
    add_theme_support("post-thumbnails");

    register_nav_menus(
        array(
            "header-menu" => __("Головне", THEME_NAME),
            "footer-menu" => __("Підвал", THEME_NAME),
            "social-menu" => __("Соцмережі", THEME_NAME),
        )
    );

    add_theme_support(
        "html5",
        array(
            "search-form",
            "comment-form",
            "comment-list",
            "gallery",
            "caption",
            "style",
            "script",
        )
    );


    add_post_type_support('page', 'excerpt');


    add_theme_support(
        "custom-logo",
        array(
            "height" => 48,
            "width" => 153,
            "flex-width" => true,
            "flex-height" => true,
            'unlink-homepage-logo' => true,
        )
    );

}

add_action("after_setup_theme", "nef_setup");