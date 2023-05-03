<?php
$number = $args['number'];
$upcoming = array();
$activities = get_field('activities', 'option');
if ($activities) {
    $today = date("Ymd");
    foreach ($activities as $row) {
        if ($row['date'] >= $today) {
            $upcoming[] = $row;
        }
    }
}
?>

<div class="block-activities brd brd-rad-l mb-3 p-4">
    <div class="px-2 inner-wrapper">
        <h3><?php echo __('Активності', THEME_NAME); ?></h3>

        <?php if ($upcoming) {
            foreach ($upcoming as $i => $item) {
                if ($i < $number) {
                    $unixtimestamp = strtotime($item['date']);
                    $person = $item['person'];
                    $link = $item['link'];
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ?: '_self'; ?>
                    <div class="activity-item py-4<?php echo ($i > 0) ? ' brd-top' : ''; ?>">
                        <a class="d-block" href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>">
                            <div class="row mx-n2">
                                <div class="col-auto px-2">
                                    <div class="activity-item-date bg-1 brd-rad-l">
                                        <div class="activity-item-date-day"><?php echo date_i18n("d", $unixtimestamp); ?></div>
                                        <div class="activity-item-date-month"><?php echo date_i18n("M", $unixtimestamp); ?></div>
                                    </div>
                                </div>
                                <div class="col px-2">
                                    <div class="activity-item-person"><?php echo $person; ?></div>
                                    <div class="activity-item-title"><?php echo $link_title; ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }
            }
        } else {
            echo __('Майбутніх активностей не заплановано', THEME_NAME);
        } ?>
    </div>
</div>
