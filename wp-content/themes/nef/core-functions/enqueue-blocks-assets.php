<?php
/**
 * Enqueue assets to ACF Blocks
 */


function enqueue_assets__sidebars($block)
{
    for ($i = 0; $i < 3; ++$i) {
        $widget = $block['data']['sidebar-widgets_' . $i . '_widget'];
        if ($widget) {
            wp_enqueue_style($widget, THEME_URI . '/build/' . $widget . '.min.css', array(), S_VERSION);
        }
    }
}