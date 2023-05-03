<?php
/**
 * Sort a repeater field
 */

function my_acf_load_value($value, $post_id, $field)
{
    $order = array();
    if (empty($value)) {
        return $value;
    }
    foreach ($value as $i => $row) {
        $order[$i] = mb_strtoupper($row['field_6436511085504']);
    }

    array_multisort($order, SORT_ASC, $value);
    return $value;
}

add_filter('acf/load_value/name=nefologism', 'my_acf_load_value', 10, 3);