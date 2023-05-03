<section class="section-nef-intro position-relative section-fullwidth">
    <?php if(get_field('fonove_zobrazhennya')){
        echo wp_get_attachment_image(get_field('fonove_zobrazhennya'), '1536x1536', '', array('class' => 'home-intro-bg'));
    }?>
    <div class="container px-0 position-relative">
        <div class="intro-subtitle text-uppercase text-brightest font-weight-medium"><?php the_field('pidzagolovok'); ?></div>
        <h1 class="intro-title"><?php the_field('zagolovok'); ?></h1>
        <div class="intro-description">
            <?php the_field('opys'); ?>
        </div>
        <?php
        $link = get_field('posylannya');
        if ($link):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ?: '_self';
            ?>
            <a class="btn mt-3" href="<?php echo esc_url($link_url); ?>"
               target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
        <?php endif; ?>
    </div>
</section>
