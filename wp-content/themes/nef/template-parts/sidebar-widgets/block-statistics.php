<?php
$statistics = $args['statistics'];
if ($statistics) {
    ?>
    <div class="block-statistics brd brd-rad-l px-4 py-5 mb-3 bg-1 position-relative">
        <?php foreach ($statistics as $statistic) { ?>
            <div class="statistic-item bg-white brd brd-rad-l p-3 mb-2 position-relative">
                <div class="statistic-value h3 mb-3"><?php echo $statistic['value'];?></div>
                <div class="statistic-description h5"><?php echo $statistic['description'];?></div>
            </div>
        <?php } ?>
    </div>
<?php } ?>