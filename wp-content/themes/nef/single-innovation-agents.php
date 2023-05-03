<?php
get_header();
$post_id = get_the_ID();
?>
    <main>
        <div class="container pb-5">

            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="py-4">', '</div>');
            }
            ?>

            <div class="row pt-4 pb-5 agent-header">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-auto">
                            <?php the_post_thumbnail(array(148, 148), array('class' => 'circle-elem brd agent-thumbnail')); ?>
                        </div>
                        <div class="col-lg pt-3">
                            <h1 class="mb-3 agent-name"><?php the_title(); ?></h1>
                            <div class="row">
                                <div class="col-xl-8 col-xl-12">
                                    <div class="mb-3 agent-position"><?php the_field('posada'); ?></div>
                                    <div class="agent-excerpt"><?php the_excerpt(); ?></div>
                                    <?php
                                    $facebook = get_field('facebook');
                                    $instagram = get_field('instagram');
                                    $linkedin = get_field('linkedin');
                                    if ($facebook || $instagram || $linkedin) { ?>
                                        <div class="d-flex my-4 agent-social-list">
                                            <?php if ($facebook) { ?>
                                                <a href="<?php echo $facebook; ?>"
                                                   class="icon-facebook brd circle-elem" target="_blank">facebook</a>
                                            <?php } ?>
                                            <?php if ($instagram) { ?>
                                                <a href="<?php echo $instagram; ?>"
                                                   class="icon-instagram brd circle-elem" target="_blank">instagram</a>
                                            <?php } ?>
                                            <?php if ($linkedin) { ?>
                                                <a href="<?php echo $linkedin; ?>"
                                                   class="icon-linkedin brd circle-elem" target="_blank">linkedin</a>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-lg-4 text-lg-right">
                    <div class="mb-3 d-inline-block post-categories">
                        <div class="inner-wrapper">
                            <?php
                            $post_type_archive_link = get_post_type_archive_link('innovation-agents');
                            $categories = wp_get_post_terms($post_id, 'category', array('fields' => 'ids'));
                            foreach ($categories as $category) {
                                $term = get_term($category); ?>
                                <a class="mb-1 post-category"
                                   href="<?php echo $post_type_archive_link . '?category=' . $term->slug; ?>"><?php echo $term->name; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $post_type = 'innovation-cases';
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => $post_type,
                'orderby' => 'date',
                'order' => 'DESC',
                'paged' => $paged,
                'posts_per_page' => 6,
                'meta_query' => array(
                    array(
                        'key'       => 'agenty',
                        'value'     => strval($post_id),
                        'compare'   => 'LIKE',
                    ),
                ),
            );
            wp_localize_script('main-scripts', 'queryArgs', array($args));
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()) { ?>
                <h2 class="h3 pt-2 brd-top"><?php echo __('Кейси де залученний агент', THEME_NAME); ?></h2>
                <div class="row mx-n2 posts-list ajax-pagination pb-5" data-index="0">
                    <?php get_template_part('/template-parts/general/list-of-posts', null, array('the_query' => $the_query, 'fullwidth' => true, 'pagination' => true)); ?>
                </div>
            <?php } else {
                echo __("Записів не знайдено", THEME_NAME);
            }
            wp_reset_postdata(); ?>

        </div>
    </main>
<?php
get_footer();