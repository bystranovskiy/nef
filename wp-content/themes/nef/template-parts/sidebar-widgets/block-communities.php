<?php
$title = $args['title'];
$description = $args['description'];
$archive_link = get_post_type_archive_link('communities');
$communities = get_posts(array(
    'post_type' => 'communities',
    'numberposts' => -1,
    'fields' => 'ids',
));
?>

    <div class="mb-3 px-4 pb-4 brd-rad-l position-relative block-communities">
        <div class="px-2 inner-wrapper">
            <?php if ($communities) { ?>
                <div class="d-flex mb-3 mt-n3 communities-list">
                    <?php foreach (array_slice($communities, 0, 3) as $community) { ?>
                        <a href="<?php the_field('link',$community); ?>" target="_blank" rel="nofollow" class="circle-elem">
                            <?php echo get_the_post_thumbnail($community, array(70, 70), array('class' => 'cover-img post-thumbnail')); ?>
                        </a>
                    <?php }
                    if (count($communities) > 3) { ?>
                        <a href="<?php echo $archive_link; ?>" class="circle-elem more-communities">
                            <?php echo '+' . (count($communities) - 3); ?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php if ($title) { ?>
                <h3><?php echo $title; ?></h3>
            <?php } ?>
            <?php echo $description; ?>
            <a href="<?php echo $archive_link; ?>"
               class="mt-5 link"><?php echo __("Переглянути всіх", THEME_NAME); ?></a>
        </div>
    </div>