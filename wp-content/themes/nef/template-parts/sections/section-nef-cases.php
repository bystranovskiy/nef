<?php
$title = get_field('title');
$description = get_field('description');
$cases_type = get_field('cases-type');
$cases = get_field('cases');
$sidebar_widgets = get_field('sidebar-widgets');
?>
<section class="section-nef-cases my-5">
    <div class="container px-0">
        <div class="row mx-n2">
            <div class="<?php echo $sidebar_widgets ? 'col-lg-8' : 'col-12'; ?> px-2">
                <div class="pt-3 brd-top">
                    <?php if ($title) { ?>
                        <h2><?php echo $title; ?></h2>
                    <?php } ?>
                    <?php echo $description; ?>
                    <?php if (have_rows('cases')): ?>
                        <div class="block-cases block-cases-<?php echo $cases_type; ?> row mt-5 mx-n2">
                            <?php while (have_rows('cases')): the_row();
                                $image = get_sub_field('image');
                                $link = get_sub_field('link');
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ?: '_self'; ?>
                                <div class="<?php echo $sidebar_widgets ? 'col-lg-6' : 'col-md-6 col-lg-4'; ?> px-2 pb-3">
                                    <a href="<?php echo esc_url($link_url); ?>"
                                       target="<?php echo esc_attr($link_target); ?>"
                                       class="case-item d-block h-100 brd-rad-l brd px-4 py-3">
                                        <div class="inner-wrapper d-block">
                                            <?php if ($cases_type === 'type-1') { ?>
                                                <div class="circle-elem brd mb-3">
                                                    <?php echo wp_get_attachment_image($image, array(25, 25), '', array()); ?>
                                                </div>
                                            <?php } else {
                                                echo wp_get_attachment_image($image, array(50, 50), '', array('class' => 'mb-3'));
                                            } ?>
                                            <?php if ($link) { ?>
                                                <div class="link"><?php echo esc_html($link_title); ?></div>
                                            <?php } ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
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