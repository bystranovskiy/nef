<?php
/**
 * Ajax Post Pagination
 */

add_action('wp_ajax_nopriv_ajax_pagination', 'wpex_metadata_ajax_pagination');
add_action('wp_ajax_ajax_pagination', 'wpex_metadata_ajax_pagination');

function wpex_metadata_ajax_pagination()
{
    $args = $_POST['query_args'];
    $args['paged'] = intval($_POST['paged']);
    $the_query = new WP_Query($args);
    $list = $args['post_type'] === 'innovation-agents' ? 'list-of-agents' : 'list-of-posts';
    get_template_part('/template-parts/general/'.$list, null, array('the_query' => $the_query, 'fullwidth' => true, 'pagination' => true));
}
