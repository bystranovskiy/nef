<?php
/**
 * Template Name: Пошук
 */

get_header();

$post_types = get_field('post-types');

$categories = get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => true,
    'fields' => 'all',
));

$current_terms = array();
$search_text = $_GET["text"];

if ($_GET["categories"]) {
    $current_terms = explode('-', $_GET["categories"]);
}

?>
    <main>
        <div class="container pb-5">

            <?php
            if (function_exists('yoast_breadcrumb') && !is_front_page()) {
                yoast_breadcrumb('<div id="breadcrumbs" class="py-4">', '</div>');
            }
            ?>

            <div class="row pb-5 mb-5">
                <div class="col-lg-8">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="col-lg-4"><?php the_excerpt(); ?></div>
                <div class="col-lg-8">
                    <?php if ($categories) { ?>
                        <div class="post-categories post-categories-filter mb-4">
                            <div class="inner-wrapper">
                                <?php
                                foreach ($categories as $category) {
                                    $link = get_the_permalink();
                                    $term_id = get_term($category)->term_id;
                                    $arr = $current_terms;
                                    $key = array_search(strval($term_id), $arr, true);
                                    if ($key !== false) {
                                        unset($arr[$key]);
                                    } else {
                                        $arr[] = $term_id;
                                    }
                                    if ($arr) {
                                        $link .= '?categories=' . implode('-', $arr) . ($search_text ? '&text=' . $search_text : '');
                                    } else {
                                        $link .= $search_text ? '?text=' . $search_text : '';
                                    }
                                    ?>
                                    <a href="<?php echo $link; ?>"
                                       class="post-category mt-2<?php echo $key !== false ? ' active' : ''; ?>"
                                       data-cat-id="<?php echo $term_id; ?>"><?php echo get_term($category)->name; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <form class="search-form brd brd-rad-m" action="<?php echo get_site_url() . '/search/'; ?>" method="get">
                        <button class="icon-search" type="submit"></button>
                        <?php if ($current_terms) { ?>
                            <input type="hidden" name="categories" value="<?php echo implode('-', $current_terms); ?>">
                        <?php } ?>
                        <input class="brd-rad-m" name="text" type="text" value="<?php echo $_GET["text"] ?: '' ?>" placeholder="<?php echo __("Пошук", THEME_NAME); ?>">
                        <a href="<?php echo get_the_permalink(); echo $_GET["categories"] ? '?categories=' . $_GET["categories"] : '';?>" class="icon-cancel" style="display: none;"></a>
                    </form>
                </div>
            </div>

            <?php
            $query_args = array();
            foreach ($post_types as $i => $post_type) { ?>
                <div class="my-5">
                    <h2 class="brd-top pt-3"><?php echo get_field('title-' . $post_type, 'options'); ?></h2>
                    <?php
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => $post_type,
                        'posts_per_page' => 3,
                        'paged' => $paged,
                        'order' => 'DESC',
                        'orderby' => 'date',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'terms' => $current_terms,
                                'field' => 'term_id',
                                'operator' => 'AND',
                            )
                        )

                    );
                    if ($_GET["text"]) {
                        $args['s'] = $_GET["text"];
                    }
                    $query_args[] = $args;
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) { ?>
                        <div class="posts-list post-list-<?php echo $post_type; ?> ajax-pagination row mx-n2"
                             data-index="<?php echo $i; ?>">
                            <?php
                            $list = $post_type === 'innovation-agents' ? 'list-of-agents' : 'list-of-posts';
                            get_template_part('/template-parts/general/' . $list, null, array('the_query' => $the_query, 'fullwidth' => true, 'pagination' => true)); ?>
                        </div>
                    <?php } else {
                        echo __("Записів не знайдено", THEME_NAME);
                    }
                    wp_reset_postdata(); ?>
                </div>
            <?php }
            wp_localize_script('main-scripts', 'queryArgs', $query_args); ?>

        </div>
    </main>
<?php
get_footer();