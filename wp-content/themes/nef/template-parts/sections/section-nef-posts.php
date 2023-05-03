<?php
$title = get_field('title');
$description = get_field('description');
$post_type = get_field('post-type');
$orderby = get_field('orderby');
$number = get_field('number');
$posts = get_field($post_type);
$sidebar_widgets = get_field('sidebar-widgets');
$posts_per_page = $sidebar_widgets ? $number * 2 : $number * 3;
if ($post_type === 'infrastructure') {
    $posts_per_page = $number * 2;
}

$args = array(
    'post_type' => $post_type,
    'posts_per_page' => $posts_per_page,
);
if ($orderby === 'meta_value') {
    $args['orderby'] = 'meta_value';
    $args['meta_key'] = 'views';
} else if ($orderby === 'post__in') {
    $args['post__in'] = $posts;
    $args['orderby'] = 'post__in';
} else {
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
}
?>

<section class="section-nef-posts my-5">
    <div class="container px-0">
        <div class="row mx-n2">
            <div class="<?php echo $sidebar_widgets ? 'col-lg-8' : 'col-12'; ?> px-2">
                <div class="pt-3 brd-top">
                    <?php if ($title) { ?>
                        <h2><?php echo $title; ?></h2>
                    <?php } ?>
                    <?php echo $description;?>
                    <?php
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) { ?>
                        <div class="row mx-n2 pb-5 pb-lg-0 posts-list">
                            <?php
                            if ($post_type === 'communities') {
                                get_template_part('/template-parts/general/list-of-communities', null, array('the_query' => $the_query));
                            } else if ($post_type === 'infrastructure') {
                                get_template_part('/template-parts/general/list-of-infrastructure', null, array('the_query' => $the_query));
                            } else {
                                get_template_part('/template-parts/general/list-of-posts', null, array('the_query' => $the_query, 'fullwidth' => !$sidebar_widgets));
                            } ?>

                            <div class="col-12 pt-3 text-center">
                                <a href="<?php echo get_post_type_archive_link($post_type); ?>"
                                   class="btn"><?php echo __("Переглянути всі", THEME_NAME); ?></a>
                            </div>
                        </div>
                    <?php }
                    wp_reset_postdata();?>
                </div>
            </div>
            <?php if (have_rows('sidebar-widgets')): ?>
                <div class="col-lg-4 px-2">
                    <?php while (have_rows('sidebar-widgets')): the_row();
                        $widget = get_sub_field('widget');
                        $args = get_sub_field($widget);
                        if ($widget === 'block-categories-list') {
                            $args['post_type'] = $post_type;
                            $args['taxonomy'] = $post_type === 'communities' ? 'main-topics' : 'category';
                        }
                        get_template_part('/template-parts/sidebar-widgets/' . $widget, null, $args);
                    endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>