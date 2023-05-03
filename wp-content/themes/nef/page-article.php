<?php
/* Template Name: Стаття */
get_header();
$post_id = get_the_ID();
$content = get_the_content();
?>
    <main>
        <div class="container">

            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="py-4">', '</div>');
            }
            ?>

            <div class="pt-4 pb-5 case-header">
                <h1 class="post-title">
                    <?php the_title(); ?>
                </h1>
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
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
<?php
get_footer();