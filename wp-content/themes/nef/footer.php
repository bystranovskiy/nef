<footer class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-xl-4 col-xxl-5">
                <?php echo wp_get_attachment_image(get_field('logo_futera', 'options'), array(220, 70), '', array('class' => 'mb-5 mb-lg-4 mx-auto mx-lg-0 d-block responsive-image')); ?>
                <?php wp_nav_menu(array('theme_location' => 'social-menu', 'menu_class' => 'd-none d-lg-flex menu menu-social')); ?>
            </div>
            <div class="col-lg-9 col-xl-8 col-xxl-7">
                <div class="row">
                    <div class="col-6 col-md-3 pb-4">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                    <div class="col-6 col-md-3 pb-4">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                    <div class="col-6 col-md-3 pb-4">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                    <div class="col-6 col-md-3 pb-4">
                        <?php dynamic_sidebar('footer-4'); ?>
                    </div>
                    <div class="col-md-6 pb-4"><?php the_field('adresa', 'options'); ?></div>
                    <div class="col-md-6 pb-4">
                        <a href="mailto:<?php the_field('email', 'options'); ?>"><?php the_field('email', 'options'); ?></a><br>
                        <a href="tel:+<?php echo preg_replace('/[^\dxX]/', '', get_field('telefon', 'options')); ?>"><?php the_field('telefon', 'options'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $opys = get_field('opys', 'options');
        $zobrazhennya = get_field('zobrazhennya', 'options');
        if ($opys) { ?>
            <div class="py-3 footer-opys">
                <div class="row align-items-center mx-n2">
                    <?php if ($zobrazhennya) {
                        $img_meta = wp_get_attachment_image_src($zobrazhennya, 'full');
                        ?>
                        <div class="col-md-auto px-2">
                            <?php echo wp_get_attachment_image($zobrazhennya, 'medium', '', array('class' => 'd-block mx-auto mx-lg-0 mb-3 mb-md-0 responsive-image')); ?>
                        </div>
                        <div class="col-md px-2"><?php echo $opys; ?></div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if (have_rows('partnery', 'options')): ?>
            <div class="py-3 footer-partnery">
                <h2 class="h4 mt-0 mb-3"><?php echo __("Партнери проєкту:", THEME_NAME); ?></h2>
                <div class="row mx-n1">
                    <?php while (have_rows('partnery', 'options')): the_row(); ?>
                        <div class="col-6 col-lg-4 col-xl px-1 mb-2">
                            <?php
                            $link = get_sub_field('posylannya');
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ?: '_self';
                            if ($link_url!== '#') { ?>
                                <a class="footer-partnery-item" href="<?php echo esc_url($link_url); ?>"
                                   target="<?php echo esc_attr($link_target); ?>" rel="nofollow">
                                    <?php echo wp_get_attachment_image(get_sub_field('logo'), 'medium', '', array('class' => 'mb-2 responsive-image d-block')); ?>
                                    <?php echo esc_html($link_title); ?>
                                </a>
                            <?php } else { ?>
                                <div class="footer-partnery-item">
                                    <?php echo wp_get_attachment_image(get_sub_field('logo'), 'medium', '', array('class' => 'mb-2 responsive-image d-block')); ?>
                                    <?php echo esc_html($link_title); ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php wp_nav_menu(array('theme_location' => 'social-menu', 'menu_class' => 'd-flex justify-content-center mb-3 d-lg-none menu menu-social')); ?>

        <div class="pt-3 footer-copyright">
            <div class="row flex-column flex-md-row justify-content-between align-items-center">
                <div class="col-auto"><?php echo '©NEF. ' . date('Y') . ', ' . __("Усі права захищені", THEME_NAME); ?></div>
                <div class="col-auto">
                    <?php wp_nav_menu(array('theme_location' => 'footer-menu', 'menu_class' => 'd-flex flex-column flex-md-row text-center menu menu-footer')); ?>
                </div>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
