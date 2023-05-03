<?php
/**
 * Template Name: NEFологізми
 */
get_header();
$title = get_field('title');
$description = get_field('description');
$repeater = get_field('nefologism');
$nefologism = [];
if ($repeater) {
    foreach ($repeater as $row) {
        $letter = mb_strtoupper(mb_substr($row['term'], 0, 1));
        $nefologism[$letter][] = $row;
    }
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
            </div>

            <?php if ($nefologism) { ?>
            <div class="pt-3 brd-top">
                <?php if ($title) { ?>
                    <h2><?php echo $title; ?> <span
                                class="ml-2 h3 text-brightest"><?php echo count($repeater); ?></span></h2>
                <?php } ?>
                <?php echo $description; ?>
                <form class="block-nef-search position-relative brd bg-1" id="nef-search-form">
                    <button type="submit" id="nef-submit" disabled="disabled" class="h4 mb-0 icon-search"></button>
                    <input type="text" name="text" id="nef-text" class="py-4"
                           placeholder="<?php echo __('Ключове слово (мінімум 3 символи)', THEME_NAME); ?>">
                    <button type="reset" id="nef-reset" class="h4 icon-cancel mb-0" style="display: none;"></button>
                </form>
                <div class="block-nef mb-5">
                    <?php $i = 1;
                    foreach ($nefologism as $title => $terms) { ?>
                        <div class="nef-group brd">
                            <div class="nef-group-title icon-down-open-big h3 font-weight-bold mb-0 p-3 mb-0"><?php echo $title; ?></div>
                            <div class="nef-items-list" style="display: none;">
                                <?php foreach ($terms as $term) { ?>
                                    <div class="nef-item">
                                        <div class="nef-item-title icon-down-open-big h4 mb-0 p-3 brd-top"><?php echo $term['term']; ?></div>
                                        <div class="nef-item-description" style="display: none;">
                                            <div class="inner-wrapper px-3 pb-4 brd-bottom"><?php echo $term['meaning']; ?></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php $i++;
                    } ?>
                    <p class="mt-4" id="nothing-found"
                       style="display: none;"><?php echo __('Записів не знайдено', THEME_NAME); ?></p>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>
<?php
get_footer();