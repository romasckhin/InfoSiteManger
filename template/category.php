<?php

$out = '';
foreach ($result as $item) {
    $out .= '<div>';
    $out .= '<h4>' . $item['title'] . '</h4>';
    $out .= '<p>' . $item['descr_min'] . '</p>';
    $out .= '<p>' . $item['description'] . '</p>';
    $out .= '<img src=/static/images/' . $item['image'] . ' width=200 >'; 
    $out .= '<div><a href=/article/' . $item['url'] . '> Читать полность</a></div>'; 
    $out .= '</div>';
}

echo $out;