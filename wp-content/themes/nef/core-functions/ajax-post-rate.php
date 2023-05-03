<?php
/**
 * Ajax Post rate
 */

add_action('wp_ajax_nopriv_post_rate', 'wpex_metadata_post_rate');
add_action('wp_ajax_post_rate', 'wpex_metadata_post_rate');

function wpex_metadata_post_rate()
{
    $rate_action = $_POST['rate_action'];
    $post_id = $_POST['post_id'];
    $curr_value = get_field($rate_action, $post_id) ?: 0;
    update_field($rate_action, $curr_value + 1, $post_id);
    get_template_part('/template-parts/general/post-rate', null, array('post_id' => $post_id, 'post_rated' => true));
}