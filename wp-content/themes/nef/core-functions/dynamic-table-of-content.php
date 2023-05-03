<?php
/**
 * Dynamic Table of content
 */

function get_headlines($html, $depth = 1)
{
    if ($depth > 7)
        return [];

    $headlines = explode('<h' . $depth, $html);

    unset($headlines[0]);       // contains only text before the first headline

    if (count($headlines) == 0)
        return [];

    $toc = [];      // will contain the (sub-) toc

    foreach ($headlines as $headline) {
        list($hl_info, $temp) = explode('>', $headline, 2);
        // $hl_info contains attributes of <hi ... > like the id.
        list($hl_text, $sub_content) = explode('</h' . $depth . '>', $temp, 2);
        // $hl contains the headline
        // $sub_content contains maybe other <hi>-tags
        $id = '';
        if (strlen($hl_info) > 0) {
            $pattern = '/' . preg_quote('id') . '=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is';
            if (preg_match($pattern, $hl_info, $match)) {
                $id = $match[2];
            }
        }

        $toc[] = [
            'id' => $id,
            'text' => $hl_text,
            'sub_toc' => get_headlines($sub_content, $depth + 1)
        ];

    }
    return $toc;
}

function print_toc($toc, $link_to_htmlpage = '', $depth = 1)
{
    if(count($toc) == 0)
        return '';

    $toc_str = '<ul class="menu">';

    foreach($toc as $headline)
    {
        $toc_str .= '<li class="mb-2">';
        if($headline['id'] != '')
            $toc_str .= '<a class="d-flex px-3 py-2 brd-rad-l" href="' . $link_to_htmlpage . '#' . $headline['id'] . '">';
        $toc_str .= $headline['text'];
        $toc_str .= ($headline['id'] != '') ? '</a>' : '';
        $toc_str .= print_toc($headline['sub_toc'], $link_to_htmlpage, $depth+1);
        $toc_str .= '</li>';
    }
    $toc_str .= '</ul>';

    return $toc_str;
}