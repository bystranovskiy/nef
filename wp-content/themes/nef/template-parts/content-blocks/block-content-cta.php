<?php
$title = get_field('title');
$description = get_field('description');
$link = get_field('link');
?>
<div class="block-content-cta position-relative brd-rad-l text-center my-4">
    <div class="inner-wrapper position-relative">
        <?php if ($title) { ?><h2><?php echo $title; ?></h2><?php } ?>
        <?php echo $description; ?>
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