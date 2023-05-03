<?php
$fullwidth = $args['fullwidth'];
$the_query = $args['the_query'];
$paged = $the_query->query['paged'];
$pagination = $args['pagination'];
?>

<?php while ($the_query->have_posts()) {
    $the_query->the_post();
    $post_id = get_the_ID();
    $title = get_the_title();
    $permalink = get_the_permalink();
    $posada = get_field('posada', $post_id);
    ?>
    <div class="<?php echo $fullwidth ? 'col-md-4' : 'col-md-6'; ?> px-2 mb-3">

        <div class="post-item d-flex flex-column px-2 <?php echo $fullwidth ? 'px-sm-4 px-md-3 px-lg-4' : 'px-sm-4'; ?> py-4 brd-rad-l brd">

            <div class="agent-info row mx-n2 mb-3 <?php echo $fullwidth ? '' : 'flex-nowrap mb-sm-5'; ?>">
                <div class="<?php echo $fullwidth ? 'col-12 col-lg-auto mb-2 mb-lg-0' : 'col-auto'; ?> px-2">
                    <a href="<?php echo $permalink; ?>" class="circle-elem">
                        <?php the_post_thumbnail(array(64, 64), array('class' => 'cover-img post-thumbnail')); ?>
                    </a>
                </div>
                <div class="<?php echo $fullwidth ? 'col-12 col-lg' : 'col'; ?> px-2">
                    <a class="post-title" href="<?php the_permalink(); ?>"><h3 class="h4"><?php the_title(); ?></h3></a>
                    <div class="agent-position"><?php echo $posada; ?></div>
                </div>
            </div>

            <div class="row mx-0 mt-auto flex-nowrap">
                <div class="post-categories col px-0">
                    <div class="d-flex inner-wrapper">
                        <?php
                        $post_type_archive_link = get_post_type_archive_link('innovation-agents');
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
                <div class="col-auto px-0">
                    <a href="<?php the_permalink(); ?>" class="link"></a>
                </div>
            </div>

        </div>
    </div>
<?php }
wp_reset_postdata();
if ($pagination) { ?>
    <div class="col-12 px-2">
        <?php pagination($paged, $the_query->max_num_pages); ?>
    </div>
<?php } ?>