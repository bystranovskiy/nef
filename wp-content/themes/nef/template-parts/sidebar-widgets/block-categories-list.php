<?php
$title = $args['title'];
$post_type = $args['post_type'];
$taxonomy = $args['taxonomy'] ?: 'category';
$categories = get_terms(array(
    'taxonomy' => $taxonomy,
    'post_type' => array($post_type),
    'hide_empty' => true,
    'fields' => 'all',
));
if ($categories) {
    ?>
    <div class="block-categories-list mb-3 p-4 brd-rad-l bg-1">
        <div class="inner-wrapper px-2">
            <h3><?php echo $title; ?></h3>
            <ul class="menu">
                <?php foreach ($categories as $category) {
                    $name = $category->name;
                    $slug = $category->slug;
                    $id = $category->term_id;
                    // $link = get_category_link($id);
                    $link = get_post_type_archive_link($post_type) . '?category=' . $slug;
                    $emoji = get_field('emoji', 'category_' . $id);
                    $args = [
                        'numberposts' => -1,
                        'post_type' => $post_type,
                    ];
                    if ($taxonomy === 'category') {
                        $args['category__in'] = $id;
                        // $link .= '?post-type=' . $post_type;
                    } else {
                        $args['tax_query'][] = array(
                            'taxonomy' => 'main-topics',
                            'terms' => array($id),
                        );
                    }
                    $posts = get_posts($args);
                    $count = count($posts);
                    /*$current_cat = false;
                    if (is_category() || is_tax()) {
                        $current_cat = get_queried_object()->term_id === $id;
                    }*/
                    $current_cat = $_GET["category"] === $slug;
                    if ($count > 0) {
                        ?>
                        <li class="mb-2"><a <?php if ($current_cat) { ?> class="current-cat"<?php } ?>
                                    href="<?php echo $link; ?>"><?php echo $emoji . ' ' . $name . ' (' . $count . ')'; ?></a>
                        </li>
                    <?php }
                } ?>
            </ul>
        </div>
    </div>
<?php } ?>