<?php
$title = get_field('title');
$content_1 = get_field('content-1');
$content_2 = get_field('content-2');
?>
<section class="section-nef-info text-white brd-rad-l my-5">
    <div class="container px-4 py-5">
        <div class="row">
            <?php if ($title) { ?>
                <div class="col-xl-10">
                    <h2 class="mb-5"><?php echo $title; ?></h2>
                </div>
            <?php } ?>
            <?php if ($content_1) { ?>
                <div class="col-xl-5 col-lg-6">
                    <?php echo $content_1; ?>
                </div>
            <?php } ?>
            <?php if ($content_2) { ?>
                <div class="col-xl-5 col-lg-6">
                    <?php echo $content_2; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>