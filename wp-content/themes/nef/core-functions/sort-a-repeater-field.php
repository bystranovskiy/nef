<?php
/**
 * Sort a repeater field
 */

function nefologism_alphabetical_sorting($value)
{
    $field = 'field_6436511085504';
    $alphabet = mb_str_split('абвгґдеєжзиіїйклмнопрстуфхцчшщьюя');
    $lat = [];
    $ukr = [];
    $result = [];
    foreach ($value as $row) {
        $letter = mb_strtolower(mb_substr($row[$field], 0, 1));
        if (in_array($letter, $alphabet)) {
            $ukr[] = $row[$field];
        } else {
            $lat[] = $row[$field];
        }
    }
    usort($ukr, 'compareUkraineAlphabet');
    sort($lat);
    foreach ($ukr as $term) {
        foreach ($value as $row) {
            if ($row[$field] === $term) {
                $result[] = $row;
            }
        }
    }
    foreach ($lat as $term) {
        foreach ($value as $row) {
            if ($row[$field] === $term) {
                $result[] = $row;
            }
        }
    }
    return $result;
}

add_filter('acf/load_value/name=nefologism', 'nefologism_alphabetical_sorting', 10, 3);


function compareUkraineAlphabet($a, $b)
{
    $alphabet = 'абвгґдеєжзиіїйклмнопрстуфхцчшщьюя';
    $a = mb_strtolower($a);
    $b = mb_strtolower($b);
    for ($i = 0; $i < mb_strlen($a); $i++) {
        if (mb_substr($a, $i, 1) == mb_substr($b, $i, 1)) {
            continue;
        }
        if ($i > mb_strlen($b)) {
            return 1;
        }
        return mb_strpos($alphabet, mb_substr($a, $i, 1)) > mb_strpos($alphabet, mb_substr($b, $i, 1))
            ? 1
            : -1;
    }
    return false;
}



function activities_date_sorting($value)
{
    $field = 'field_6431646591757';
    $order = array();
    if (empty($value)) {
        return $value;
    }
    foreach ($value as $i => $row) {
        $order[$i] = mb_strtoupper($row[$field]);
    }

    array_multisort($order, SORT_ASC, $value);
    return $value;
}

add_filter('acf/load_value/name=activities', 'activities_date_sorting', 10, 3);