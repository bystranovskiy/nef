<?php
$title = get_field('title');
$description = get_field('description');
$display = get_field('display');
$display_next = get_field('display-next');
$analytics = get_field('analytics');
?>
<section class="section-nef-analytics my-5">
    <div class="container px-0">
        <div class="pt-3 brd-top">
            <?php if ($title) { ?>
                <h2><?php echo $title; ?></h2>
            <?php } ?>
            <?php echo $description; ?>
        </div>
        <?php if (have_rows('analytics')): ?>
            <div class="analytics-list">
                <div class="show-more-container row mx-n2">
                    <?php $i = 1;
                    while (have_rows('analytics')): the_row();
                        $document = get_sub_field('document');
                        $document_pdf = get_sub_field('pdf');
                        $document_link = get_sub_field('link');
                        $link = $document === 'pdf' ? $document_pdf : $document_link;
                        $title = get_sub_field('title');
                        $description = get_sub_field('description');
                        ?>
                        <div class="analytics-item show-more-item col-md-6 col-xl-4 px-2 pb-3"<?php if ($i > $display) { ?> style="display: none;"<?php } ?>>
                            <a href="<?php echo $link; ?>" target="_blank"
                               <?php if ($document === 'link'){ ?>rel="nofollow" <?php } ?>
                               class="post-item d-flex flex-column brd brd-rad-l h-100 p-4">
                                <div class="mb-3">
                                    <img class="d-block" alt="document icon"
                                         src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTQ4LjE4NzUgMTcuNDM3NkwzNS4wNjI1IDQuMzEyNTVDMzQuODk3NSA0LjEyOTM1IDM0LjY5NDcgMy45ODQxNyAzNC40NjgxIDMuODg3MDVDMzQuMjQxNSAzLjc4OTkyIDMzLjk5NjUgMy43NDMxOCAzMy43NSAzLjc1MDA1SDE1QzE0LjAwNjQgMy43NTMwMiAxMy4wNTQyIDQuMTQ5MDYgMTIuMzUxNiA0Ljg1MTY4QzExLjY0OSA1LjU1NDMgMTEuMjUzIDYuNTA2NCAxMS4yNSA3LjUwMDA1VjUyLjVDMTEuMjUzIDUzLjQ5MzcgMTEuNjQ5IDU0LjQ0NTggMTIuMzUxNiA1NS4xNDg0QzEzLjA1NDIgNTUuODUxIDE0LjAwNjQgNTYuMjQ3MSAxNSA1Ni4yNUg0NUM0NS45OTM2IDU2LjI0NzEgNDYuOTQ1OCA1NS44NTEgNDcuNjQ4NCA1NS4xNDg0QzQ4LjM1MSA1NC40NDU4IDQ4Ljc0NyA1My40OTM3IDQ4Ljc1IDUyLjVWMTguNzUwMUM0OC43NTY5IDE4LjUwMzYgNDguNzEwMSAxOC4yNTg2IDQ4LjYxMyAxOC4wMzJDNDguNTE1OSAxNy44MDU0IDQ4LjM3MDcgMTcuNjAyNSA0OC4xODc1IDE3LjQzNzZaTTMzLjc1IDguMjUwMDVMNDQuMjUgMTguNzUwMUgzMy43NVY4LjI1MDA1Wk00NSA1Mi41SDE1VjcuNTAwMDVIMzBWMTguNzUwMUMzMC4wMDMgMTkuNzQzNyAzMC4zOTkgMjAuNjk1OCAzMS4xMDE2IDIxLjM5ODRDMzEuODA0MiAyMi4xMDEgMzIuNzU2MyAyMi40OTcxIDMzLjc1IDIyLjUwMDFINDVWNTIuNVoiIGZpbGw9IiM5MDkwOTAiLz4KPC9zdmc+Cg=="/>
                                </div>
                                <h3 class="post-title h4 mb-4"><?php echo $title; ?></h3>
                                <?php echo $description; ?>
                                <div class="link brd-top pt-2 mt-auto"><?php echo __('Переглянути', THEME_NAME); ?></div>
                            </a>
                        </div>
                        <?php $i++; endwhile; ?>
                </div>
                <?php if (count($analytics) > $display) { ?>
                    <button class="btn show-more-btn cursor-pointer mt-4"
                            data-next="<?php echo $display_next; ?>"><?php echo __('Показати ще', THEME_NAME); ?></button>
                <?php } ?>
            </div>
        <?php endif; ?>
    </div>
</section>
