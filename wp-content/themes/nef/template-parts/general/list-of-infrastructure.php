<?php
$the_query = $args['the_query'];
$paged = $the_query->query['paged'];
$pagination = $args['pagination'];
$fullwidth = $args['fullwidth'];
?>

<?php while ($the_query->have_posts()) {
    $the_query->the_post();
    $permalink = get_the_permalink();
    ?>
    <div class="col-md-6<?php echo $fullwidth ? ' col-xl-4' : ''; ?> px-2 mb-3">
        <a href="<?php echo $permalink; ?>" class="post-item post-infrastructure p-2 d-flex flex-column brd brd-rad-l">
            <div class="d-block brd-rad-m post-permalink-img">
                <?php the_post_thumbnail('large', array('class' => 'cover-img post-thumbnail')); ?>
            </div>
            <div class="py-3 mx-2 link"><h3 class="h4 mb-0 text-transform-none"><?php the_title(); ?></h3></div>
        </a>
    </div>
<?php }
wp_reset_postdata();
if ($pagination) { ?>
    <div class="col-12 px-2">
        <?php pagination($paged, $the_query->max_num_pages); ?>
    </div>
<?php } ?>