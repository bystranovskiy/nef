<?php
$title = $args['title'];
$links = $args['links'];
?>
<div class="block-links">
    <?php if ($title) { ?>
        <h2 class="h3"><?php echo $title; ?></h2>
    <?php } ?>
    <?php if ($links) { ?>
        <div class="links-list">
            <?php foreach ($links as $item) {
                $image = $item['image'];
                $link = $item['link'];
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ?: '_self';
                ?>
                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"
                   class="post-item post-infrastructure p-2 mb-3 d-flex flex-column brd brd-rad-l">
                    <div class="d-block brd-rad-m post-permalink-img">
                        <?php echo wp_get_attachment_image($image, 'large', '', array('class' => 'cover-img post-thumbnail')); ?>
                    </div>
                    <div class="py-3 mx-2 link"><h3 class="h5 mb-0 text-transform-none"><?php echo $link_title; ?></h3>
                    </div>
                </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>