<?php
get_header(); ?>
    <main>
        <div class="container py-5 mt-5 text-center">
            <?php the_field('404-content', 'options'); ?>
        </div>
    </main>
<?php
get_footer();