<?php
get_header();
$post_type = get_post_type();
$post_id = get_the_ID();
$content = get_the_content();
$agenty = get_field('agenty', $post_id);

if (!$_COOKIE['post-viewed'] && !is_user_logged_in()) {
    $views = get_field('views', $post_id) ?: 0;
    update_field('views', intval($views) + 1, $post_id);
}
?>
    <main>
        <div class="container pb-5">

            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="py-4">', '</div>');
            }
            ?>

            <div class="pt-4 pb-5 case-header">
                <div class="row mx-n2 text-brightest">
                    <div class="col px-2 pb-2">
                        <div class="post-date"><?php echo get_the_date('j M Y ') . __("року", THEME_NAME); ?></div>
                    </div>
                    <div class="col-auto pb-2 icon-eye">
                        <?php the_field('views'); ?>
                    </div>
                </div>

                <h1 class="post-title">
                    <?php the_title(); ?>
                </h1>
                <div class="mb-3 post-categories">
                    <div class="d-flex inner-wrapper">
                        <?php
                        $post_type_archive_link = get_post_type_archive_link($post_type);
                        $categories = wp_get_post_terms($post_id, 'category', array('fields' => 'ids'));
                        foreach ($categories as $category) {
                            $term = get_term($category); ?>
                            <a class="post-category"
                               href="<?php echo $post_type_archive_link . '?category=' . $term->slug; ?>"><?php echo $term->name; ?></a>
                        <?php } ?>
                    </div>
                </div>
                <?php the_post_thumbnail('1536x1536', array('class' => 'cover-img brd-rad-m d-block post-thumbnail')); ?>
            </div>

            <div class="row">
                <div class="col-lg-4 pb-5 order-lg-2">
                    <div class="sticky-sidebar">
                        <div class="brd brd-rad-l px-3 py-4 mb-3 table-of-content">
                            <h2 class="h3"><?php echo __("Зміст матеріалу", THEME_NAME); ?></h2>
                            <?php echo print_toc(get_headlines($content,2),'',2);?>
                        </div>
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
                                <?php the_content();?>
                            </div>

                            <?php if ($post_type === 'blog') { ?>
                                <div class="brd-top brd-bottom mb-3 py-3">
                                    <?php $author = get_field('agenty')[0]; ?>
                                    <div class="row align-items-center">
                                        <div class="col-md">
                                            <h4 class="mb-md-0"><?php echo __("Автор блогу", THEME_NAME); ?></h4>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="block-post-author">
                                                <div class="row flex-nowrap align-items-center mx-n2 author-info">
                                                    <div class="col-auto px-2">
                                                        <a href="<?php echo get_the_permalink($author); ?>"
                                                           class="circle-elem">
                                                            <?php echo get_the_post_thumbnail($author, array(64, 64), array('class' => 'cover-img post-thumbnail')); ?>
                                                        </a>
                                                    </div>
                                                    <div class="col px-2">
                                                        <a class="post-title"
                                                           href="<?php echo get_the_permalink($author); ?>"><h3
                                                                    class="h4 mb-1"><?php echo get_the_title($author); ?></h3>
                                                        </a>
                                                        <div class="agent-position"><?php the_field('posada', $author); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="brd-top brd-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col-md">
                                        <h4 class="mb-md-0"><?php echo __("Оцініть матеріал", THEME_NAME); ?></h4>
                                    </div>
                                    <div class="col-md-auto">
                                        <?php get_template_part('/template-parts/general/post-rate', null, array('post_id' => $post_id)); ?>
                                    </div>
                                </div>
                            </div>

                            <?php if ($post_type === 'innovation-cases') { ?>

                                <?php $contact_me = get_field('contact-me', 'options');
                                if ($contact_me) { ?>
                                    <div class="text-white brd-rad-s px-4 py-5 my-5 block-contact-me">
                                        <h3><?php echo $contact_me['title']; ?></h3>
                                        <?php echo $contact_me['description']; ?>
                                        <?php
                                        $link = $contact_me['link'];
                                        if ($link):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ?: '_self';
                                            ?>
                                            <a class="btn mt-4" href="<?php echo esc_url($link_url); ?>"
                                               target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                        <?php endif; ?>
                                    </div>
                                <?php } ?>

                                <div class="py-3 brd-top">
                                    <h4><?php echo __("Агенти, що працювали над цим кейсом", THEME_NAME); ?></h4>
                                    <?php
                                    $args = array(
                                        'post_type' => 'innovation-agents',
                                        'posts_per_page' => -1,
                                        'post__in' => $agenty,
                                        'orderby' => 'date',
                                        'order' => 'DESC',
                                    );
                                    $the_query = new WP_Query($args);
                                    if ($the_query->have_posts()) { ?>
                                        <div class="row mx-n2 pt-2 pb-5 posts-list post-agents-carousel">
                                            <?php get_template_part('/template-parts/general/list-of-agents', null, array('the_query' => $the_query)); ?>
                                        </div>
                                    <?php } else {
                                        echo __("Записів не знайдено", THEME_NAME);
                                    }
                                    wp_reset_postdata(); ?>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>

            <h2 class="h3 pt-3 brd-top"><?php echo __("Публікації, які можуть Вас зацікавити", THEME_NAME); ?></h2>

            <?php
            $args = array(
                'post_type' => $post_type,
                'posts_per_page' => 3,
                'post__not_in' => array($post_id),
                'orderby' => 'date',
                'order' => 'DESC',
            );
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()) { ?>
                <div class="row mx-n2 posts-list pb-5">
                    <?php if ($post_type === 'infrastructure') {
                        get_template_part('/template-parts/general/list-of-infrastructure', null, array('the_query' => $the_query, 'fullwidth' => true));
                    } else {
                        get_template_part('/template-parts/general/list-of-posts', null, array('the_query' => $the_query, 'fullwidth' => true));
                    }
                    ?>
                </div>
            <?php } else {
                echo __("Записів не знайдено", THEME_NAME);
            } ?>
            <?php wp_reset_postdata(); ?>

        </div>
    </main>
<?php
get_footer();