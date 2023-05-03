<?php
/**
 * Template Name: Про NEF
 */

get_header();

$content = get_the_content();
$sidebar_widgets = get_field('sidebar-widgets');
?>
    <main class="pb-5">
        <div class="container pb-5">

            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="py-4">', '</div>');
            }
            ?>


            <div class="row mx-n2">
                <div class="col-lg-8 px-2 pt-4 pb-5 page-header">
                    <h1 class="post-title"><?php the_title(); ?></h1>
                </div>
            </div>

            <?php if (have_rows('partnery', 'options')): ?>
                <div class="py-3 partnery">
                    <div class="row mx-n2">
                        <?php while (have_rows('partnery', 'options')): the_row(); ?>
                            <div class="col-6 col-lg-4 col-xl px-2 mb-2">
                                <?php
                                $link = get_sub_field('posylannya');
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ?: '_self';
                                if ($link_url!== '#') { ?>
                                    <a class="partnery-item" href="<?php echo esc_url($link_url); ?>"
                                       target="<?php echo esc_attr($link_target); ?>" rel="nofollow">
                                        <?php echo wp_get_attachment_image(get_sub_field('logo'), 'medium', '', array('class' => 'mb-2 responsive-image d-block')); ?>
                                        <?php echo esc_html($link_title); ?>
                                    </a>
                                <?php } else { ?>
                                    <div class="partnery-item">
                                        <?php echo wp_get_attachment_image(get_sub_field('logo'), 'medium', '', array('class' => 'mb-2 responsive-image d-block')); ?>
                                        <?php echo esc_html($link_title); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php the_post_thumbnail('1536x1536', array('class' => 'cover-img brd-rad-m d-block mb-5 post-thumbnail')); ?>

            <div class="row">
                <div class="col-lg-4 pb-5 order-lg-2">
                    <div class="sticky-sidebar">
                        <div class="brd brd-rad-l px-3 py-4 mb-3 table-of-content">
                            <h2 class="h3"><?php echo __("Зміст матеріалу", THEME_NAME); ?></h2>
                            <?php echo print_toc(get_headlines($content, 2), '', 2); ?>
                        </div>
                        <?php while (have_rows('sidebar-widgets')): the_row();
                            $widget = get_sub_field('widget');
                            $args = get_sub_field($widget);
                            get_template_part('/template-parts/sidebar-widgets/' . $widget, null, $args);
                        endwhile; ?>
                    </div>
                </div>
                <div class="col-lg-8 pb-5 order-lg-1">
                    <div class="row mx-n2 mx-md-n3 flex-nowrap">
                        <div class="col-auto px-2 px-md-3">
                            <div class=" mb-3 share-links">
                                <span class="mb-2 brd circle-elem icon-share share-link" id="clipboard-copy">
                                    <span class="tooltip"
                                          data-completed="<?php echo __("Copied", THEME_NAME); ?>"><?php echo __("Copy to clipboard", THEME_NAME); ?></span>
                                </span>
                                <a class="mb-2 brd circle-elem icon-facebook share-link"
                                   href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                                   target="_blank" rel="noopener">
                                    <span class="tooltip"><?php echo __("Share on Facebook", THEME_NAME); ?></span>
                                </a>
                                <a class="mb-2 brd circle-elem icon-linkedin share-link"
                                   href="https://linkedin.com/shareArticle?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"
                                   target="_blank" rel="noopener">
                                    <span class="tooltip"><?php echo __("Share on LinkedIn", THEME_NAME); ?></span>
                                </a>
                                <a class="mb-2 brd circle-elem icon-telegram share-link"
                                   href="https://telegram.me/share/url?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>"
                                   target="_blank" rel="noopener">
                                    <span class="tooltip"><?php echo __("Share on Telegram", THEME_NAME); ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="col px-2 px-md-3 col-content">
                            <div class="brd-top py-3 post-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (have_rows('our-team')): ?>
                <section class="section-our-team">
                    <h2><?php echo __('Наша команда', THEME_NAME); ?></h2>
                    <div class="row mx-n2 mt-4 mt-md-0">
                        <?php while (have_rows('our-team')): the_row(); ?>
                            <div class="col-sm-6 col-lg-3 px-2 mb-4">
                                <div class="team-member h-100 brd brd-rad-m p-2 mx-auto">
                                    <?php echo wp_get_attachment_image(get_sub_field('image'),'medium','', array('class' => 'brd-rad-m responsive-image w-100'));?>
                                    <h3 class="h5 mt-2 mb-0"><?php the_sub_field('name'); ?></h3>
                                    <p class="text-lighter mb-0"><?php the_sub_field('position'); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </section>
            <?php endif; ?>
        </div>
    </main>
<?php
get_footer();