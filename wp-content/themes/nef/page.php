<?php
get_header(); ?>
    <main>
        <div class="container pb-5">
            <?php
            if (function_exists('yoast_breadcrumb') && !is_front_page()) {
                yoast_breadcrumb('<div id="breadcrumbs" class="py-4">', '</div>');
            }
            ?>
            <?php the_content();?>
        </div>
    </main>
<?php
get_footer();