<?php
$type = $args['type'];
$image = $args['image'];
$title = $args['title'];
$description = $args['description'];
$link = $args['link'];
?>

<div class="block-info block-info-<?php echo $type; ?> mb-3 p-4 brd brd-rad-l">
    <div class="px-2 inner-wrapper">
        <?php if ($image) { ?>
            <?php if ($type === 'type-4') {
                echo wp_get_attachment_image($image, array(), '', array('class'=>'responsive-image mb-4'));
            } else { ?>
                <div class="circle-elem mb-3">
                    <?php echo wp_get_attachment_image($image, array(), '', array()); ?>
                </div>
            <?php }
        } ?>
        <?php if ($title) { ?>
            <h2 class="h3"><?php echo $title; ?></h2>
        <?php } ?>
        <?php echo $description; ?>
        <?php
        if ($link) {
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ?: '_self';
            ?>
            <a class="link pt-2 mt-5 brd-top" href="<?php echo esc_url($link_url); ?>"
               target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
        <?php } ?>
    </div>
</div>