<?php
$title = get_field('title');
$description = get_field('description');
$faq = get_field('faq');
$sidebar_widgets = get_field('sidebar-widgets');
?>
<section class="section-nef-faq my-5">
    <div class="container px-0">
        <div class="row mx-n2">
            <div class="<?php echo $sidebar_widgets ? 'col-lg-8' : 'col-12'; ?> px-2">
                <div class="pt-3 brd-top">
                    <?php if ($title) { ?>
                        <h2><?php echo $title; ?></h2>
                    <?php } ?>
                    <?php echo $description; ?>
                    <?php if (have_rows('faq')): ?>
                        <div class="block-faq">
                            <?php $i = 1;
                            while (have_rows('faq')): the_row();
                                $question = get_sub_field('question');
                                $answer = get_sub_field('answer');
                                ?>
                                <div class="faq-item py-4 <?php echo $i !== 1 ? 'brd-top' : ''; ?>">
                                    <div class="faq-question position-relative pr-5"><h3 class="h4"><?php echo $question; ?></h3></div>
                                    <div class="faq-answer" style="display: none;"><?php echo $answer; ?></div>
                                </div>
                                <?php $i++; endwhile; ?>
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