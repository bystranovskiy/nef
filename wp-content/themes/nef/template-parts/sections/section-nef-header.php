<?php
$title = get_field('title');
$description = get_field('description');
?>
<section class="section-nef-header mb-5">
    <div class="container px-0">
        <div class="row pb-5 mb-5">
            <div class="col-lg-8">
                <h1><?php echo $title;?></h1>
            </div>
            <div class="col-lg-4"><?php echo $description; ?></div>
        </div>
    </div>
</section>