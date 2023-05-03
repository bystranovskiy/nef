<?php
$the_query = $args['the_query'];
$fullwidth = $args['fullwidth'];
$pagination = $args['pagination'];
$paged = $the_query->query['paged'];
$post_type = $the_query->query['post_type'];
$posts_per_page = $the_query->query['posts_per_page'];
$count_posts = count($the_query->posts);

$j = 1;
while ($the_query->have_posts()) {
    $the_query->the_post();
    $is_lead = $fullwidth && $posts_per_page == 3 && $j === 1 && $count_posts === 3;
    $post_id = get_the_ID();
    $title = get_the_title();
    $permalink = get_the_permalink();
    $excerpt = get_the_excerpt();
    $agenty = get_field('agenty', $post_id);
    ?>


    <div class="<?php echo $is_lead ? 'col-12 lead-post' : 'col-md-6';
    echo $fullwidth ? ' col-lg-4' : ''; ?> px-2 mb-3">
        <div class="post-item px-2 py-3 d-flex flex-column brd brd-rad-l">
            <div class="post-categories mb-3">
                <div class="inner-wrapper d-flex">
                    <?php
                    $post_type_archive_link = get_post_type_archive_link($post_type);
                    $categories = wp_get_post_terms($post_id, 'category', array('fields' => 'ids'));
                    $i = 1;
                    foreach ($categories as $category) {
                        $term = get_term($category); ?>
                        <a class="post-category"
                           href="<?php echo $post_type_archive_link . '?category=' . $term->slug; ?>"><?php echo $term->name; ?></a>
                        <?php
                        if (count($categories) > 3 && $i === 3) { ?>
                            <input type="checkbox" id="<?php echo $post_id; ?>" class="d-none">
                            <label for="<?php echo $post_id; ?>"
                                   class="post-category-toggle"><?php echo count($categories) - 3; ?></label>
                        <?php }
                        $i++;
                    }
                    ?>
                </div>
            </div>

            <a href="<?php echo $permalink; ?>" class="brd-rad-m post-permalink-img">
                <?php the_post_thumbnail('large', array('class' => 'cover-img brd-rad-m post-thumbnail')); ?>
            </a>

            <?php if ($agenty) { ?>
                <div class="d-flex post-agents">
                    <?php foreach (array_slice($agenty, 0, 3) as $agent) { ?>
                        <a href="<?php the_permalink($agent); ?>" class="circle-elem">
                            <?php echo get_the_post_thumbnail($agent, array(52, 52), array('class' => 'post-thumbnail')); ?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="post-info px-2">
                <div class="mb-2 post-date"><?php echo get_the_date('j M Y ') . __("року", THEME_NAME); ?></div>
                <a class="d-inline-block post-title" href="<?php the_permalink(); ?>"><h3
                            class="h4"><?php the_title(); ?></h3></a>
                <div class="post-excerpt mb-4"><?php the_excerpt(); ?></div>
            </div>
            <a href="<?php the_permalink(); ?>"
               class="brd-top pt-2 mx-2 mt-auto link"><?php echo __("Детальніше", THEME_NAME); ?></a>
        </div>
    </div>
    <?php $j++;
}
wp_reset_postdata();
if ($pagination) { ?>
    <div class="col-12 px-2">
        <?php pagination($paged, $the_query->max_num_pages); ?>
    </div>
<?php } ?>