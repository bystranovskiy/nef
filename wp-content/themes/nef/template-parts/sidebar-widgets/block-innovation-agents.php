<?php
$image = $args['image'];
$title = $args['title'];
$description = $args['description'];
$archive_link = get_post_type_archive_link('innovation-agents');
$innovation_agents = get_posts(
    array(
        'post_type' => 'innovation-agents',
        'numberposts' => -1,
        'fields' => 'ids',
    )
);
wp_reset_postdata();
?>
<div class="mb-3 p-4 brd-rad-l block-innovation-agents">
    <?php if ($image) { ?>
        <?php echo wp_get_attachment_image($image, 'large', '', array('class' => 'responsive-image')); ?>
    <?php } ?>
    <div class="px-2 inner-wrapper">
        <?php if ($innovation_agents) { ?>
            <div class="d-flex mb-3 mt-n3 agents-list">
                <?php foreach (array_slice($innovation_agents, 0, 3) as $agent) { ?>
                    <a href="<?php the_permalink($agent); ?>" class="circle-elem">
                        <?php echo get_the_post_thumbnail($agent, array(70, 70), array('class' => 'cover-img post-thumbnail')); ?>
                    </a>
                <?php }
                if (count($innovation_agents) > 3) { ?>
                    <a href="<?php echo $archive_link; ?>" class="circle-elem more-agents">
                        <?php echo '+' . (count($innovation_agents) - 3); ?>
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