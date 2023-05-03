<?php
get_header();
$post_type = get_post_type();
$title = get_field('title-' . $post_type, 'options');
$description = get_field('description-' . $post_type, 'options');
$posts_title = get_field('posts-title-' . $post_type, 'options');
$sidebar_widgets = get_field('sidebar-widgets-' . $post_type, 'options');
$category = false;
if ($_GET["category"]) {
    $taxonomy = $post_type === 'communities' ? 'main-topics' : 'category';
    $category = get_term_by('slug', $_GET["category"], $taxonomy);
}
if ($category) {
    $posts_title = $category->name;
    $description = $category->description ?: $description;
}
?>
    <main>
        <div class="container pb-5 ">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="py-4">', '</div>');
            } ?>
            <div class="row pb-5 mb-5">
                <div class="col-lg-8">
                    <h1><?php echo $title; ?></h1>
                </div>
                <div class="col-lg-4"><?php echo $description; ?></div>
            </div>
            <div class="row py-5 mx-n2">
                <div class="col-lg-8 px-2">
                    <div class="pt-3 brd-top">
                        <?php
                        if ($posts_title) { ?>
                            <h2><?php echo $posts_title; ?></h2>
                        <?php } ?>
                    </div>
                    <?php
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => $post_type,
                        'order' => 'DESC',
                        'orderby' => 'date',
                        'paged' => $paged
                    );
                    if ($category) {
                        if ($post_type === 'communities') {
                            $args['tax_query'][] = array(
                                'taxonomy' => 'main-topics',
                                'terms' => array($category->term_id),
                            );
                        } else {
                            $args['category__in'] = array($category->term_id);
                        }

                    }
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) { ?>
                        <div class="row mx-n2 posts-list pb-5 pb-lg-0">
                            <?php
                            if ($post_type === 'innovation-agents') {
                                get_template_part('/template-parts/general/list-of-agents', null, array('the_query' => $the_query, 'pagination' => true));
                            } else if ($post_type === 'communities') {
                                get_template_part('/template-parts/general/list-of-communities', null, array('the_query' => $the_query, 'pagination' => true));
                            } else if ($post_type === 'infrastructure') {
                                get_template_part('/template-parts/general/list-of-infrastructure', null, array('the_query' => $the_query, 'pagination' => true));
                            } else {
                                get_template_part('/template-parts/general/list-of-posts', null, array('the_query' => $the_query, 'pagination' => true));
                            } ?>
                        </div>
                    <?php } else {
                        echo __("Записів не знайдено", THEME_NAME);
                    } ?>
                    <?php wp_reset_postdata(); ?>
                </div>
                <div class="col-lg-4 px-2">

                    <?php if ($post_type !== 'infrastructure') {
                        get_template_part('/template-parts/sidebar-widgets/block-categories-list', null, array('title' => $post_type === 'communities' ? __('Основні теми', THEME_NAME) : __('Категорії', THEME_NAME), 'post_type' => $post_type, 'taxonomy' => $post_type === 'communities' ? 'main-topics' : 'category'));
                    } ?>

                    <?php if (have_rows('sidebar-widgets-' . $post_type, 'options')): ?>
                        <?php while (have_rows('sidebar-widgets-' . $post_type, 'options')): the_row();
                            $widget = get_sub_field('widget');
                            $args = get_sub_field($widget);
                            get_template_part('/template-parts/sidebar-widgets/' . $widget, null, $args);
                        endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
<?php
get_footer();