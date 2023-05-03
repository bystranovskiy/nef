<?php
$title = get_field('title');
$description = get_field('description');
$display = get_field('display');
$display_next = get_field('display-next');
$grants = get_field('grants');
$sidebar_widgets = get_field('sidebar-widgets');
?>
<section class="section-nef-grants py-5">
    <div class="container px-0">
        <div class="row mx-n2">
            <div class="<?php echo $sidebar_widgets ? 'col-lg-8' : 'col-12'; ?> px-2">
                <div class="pt-3 brd-top">
                    <?php if ($title) { ?>
                        <h2><?php echo $title; ?></h2>
                    <?php } ?>
                    <?php echo $description;?>
                </div>
                <?php if (have_rows('grants')):?>
                <div class="show-more-container">
                    <?php $i=1; while (have_rows('grants')): the_row();
                        $link = get_sub_field('link');
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ?: '_self';
                        $date = get_sub_field('date');
                        $budget = get_sub_field('budget') ?: __('Бюджет відсутній', THEME_NAME);
                        ?>
                        <a class="grant-item show-more-item d-block brd brd-rad-l mb-3 p-4" href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>" rel="nofollow"<?php if ($i > $display) { ?> style="display: none!important;"<?php } ?>>
                            <h2 class="h4 mb-3"><?php echo esc_html($link_title); ?></h2>
                            <div class="row mx-n1 text-lighter">
                                <div class="col-auto px-1">
                                    <?php echo __('Заявка до ', THEME_NAME) . $date; ?>
                                </div>
                                <div class="col-auto px-1">|</div>
                                <div class="col-auto px-1">
                                    <?php echo $budget; ?>
                                </div>
                            </div>
                        </a>
                    <?php $i++; endwhile; ?>
                </div>
                    <?php if (count($grants) > $display) { ?>
                        <button class="btn show-more-btn cursor-pointer mt-4"
                                data-next="<?php echo $display_next; ?>"><?php echo __('Показати ще', THEME_NAME); ?></button>
                    <?php } ?>
                <?php endif; ?>
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
