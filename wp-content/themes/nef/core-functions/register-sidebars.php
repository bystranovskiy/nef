<?php
/**
 * Register sidebars
 */

function nef_sidebars()
{
    if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'id' => 'footer-1',
            'name' => 'Footer 1',
            'class' => 'widget',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ));
        register_sidebar(array(
            'id' => 'footer-2',
            'name' => 'Footer 2',
            'class' => 'widget',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ));
        register_sidebar(array(
            'id' => 'footer-3',
            'name' => 'Footer 3',
            'class' => 'widget',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ));
        register_sidebar(array(
            'id' => 'footer-4',
            'name' => 'Footer 4',
            'class' => 'widget',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ));
    }
}

add_action('widgets_init', 'nef_sidebars');