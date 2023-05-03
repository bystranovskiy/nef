<?php
$image = get_field('image');
$description = get_field('description');
$link = get_field('link');
$type = get_field('type');
?>
<div class="block-content-info <?php echo $type;?> brd-rad-m p-4 my-4">
    <div class="inner-wrapper position-relative">
        <?php echo wp_get_attachment_image($image, array(46, 46), '', array('class' => 'd-block mb-2 mx-auto mx-lg-0')); ?>
        <div class="row align-items-center mx-n2">
            <div class="col-xl-6 px-2 pb-3 pb-xl-0">
                <div class="h5 text-white text-center text-lg-left"><?php echo $description; ?></div>
            </div>
            <div class="col-xl-6 text-center text-lg-right px-2">
                <?php
                if ($link):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ?: '_self';
                    ?>
                    <a class="btn link" href="<?php echo esc_url($link_url); ?>"
                       target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>