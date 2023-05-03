<?php
$the_query = $args['the_query'];
$paged = $the_query->query['paged'];
$pagination = $args['pagination'];
?>

<?php while ($the_query->have_posts()) {
    $the_query->the_post();
    $post_id = get_the_ID();
    ?>

    <div class="community-item col-md-6 px-2 mb-3">

        <div class="post-item d-flex flex-column px-2 px-sm-4 py-4 brd-rad-l brd">
            <div class="post-categories mb-3">
                <div class="d-flex inner-wrapper">
                    <?php
                    $post_type_archive_link = get_post_type_archive_link('communities');
                    $categories = wp_get_post_terms($post_id, 'main-topics', array('fields' => 'ids'));
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
            <a class="post-title" href="<?php the_field('link', $post_id); ?>" rel="nofollow" target="_blank"><h3 class="h4"><?php the_title();?></h3></a>
            <div class="post-excerpt mb-4"><?php the_excerpt(); ?></div>
        </div>
    </div>
<?php }
wp_reset_postdata();
if ($pagination) { ?>
    <div class="col-12 px-2">
        <?php pagination($paged, $the_query->max_num_pages); ?>
    </div>
<?php } ?>