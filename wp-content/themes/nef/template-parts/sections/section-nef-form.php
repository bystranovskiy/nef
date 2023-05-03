<?php
$title = get_field('title');
$description = get_field('description');
$form = get_field('form');
$sidebar_widgets = get_field('sidebar-widgets');
?>
<section class="section-nef-form my-5">
    <div class="container px-0">
        <div class="row mx-n2">
            <div class="<?php echo $sidebar_widgets ? 'col-lg-8 pb-5 pb-lg-0' : 'col-12'; ?> px-2">
                <div class="pt-3 brd-top">
                    <?php if ($title) { ?>
                        <h2><?php echo $title; ?></h2>
                    <?php } ?>
                    <?php echo $description; ?>
                    <?php if ($form) { ?>
                    <div class="brd-rad-l brd bg-1 py-4 px-3 p-xl-5">
                        <?php echo is_admin() ? do_shortcode('[contact-form-7 id="'.$form.'"]') : $form;?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (have_rows('sidebar-widgets')): ?>
                <div class="col-lg-4 px-2">
                    <?php while (have_rows('sidebar-widgets')): the_row();
                        $widget = get_sub_field('widget');
                        $args = get_sub_field($widget);
                        get_template_part('/template-parts/sidebar-widgets/' . $widget, null, $args);
                    endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
