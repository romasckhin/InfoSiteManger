<?php


$out = '';

$out .= '<div>';
$out .= '<h4>' . $result['title'] . '</h4>';
$out .= '<p>' . $result['descr_min'] . '</p>';
$out .= '<p>' . $result['description'] . '</p>';
$out .= '<img src=/static/images/' . $result['image'] . ' width=200 >'; 
$out .= '</div>';

echo $out;