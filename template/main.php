<?php


$out = '';
foreach ($result as $item) {
    $out .= '<div>';
    $out .= '<h4>' . $item['title'] . '</h4>';
    $out .= '<p>' . $item['descr_min'] . '</p>';
    $out .= '<img src=/static/images/' . $item['image'] . ' width=200 >'; 
    $out .= '<div><a href=/article/' . $item['url'] . '> Читать полность</a></div>'; 
    $out .= '</div>';

}

?>

<h1>Main Panel</h1>
<div><a href="/login">login</a></div>
<div><a href="/register">register</a></div>


<h3>Category</h3>
<div><a href="/category/movie">movie</a></div>
<div><a href="/category/cartoon">cartoon</a></div>


<?php
    echo $out;
?>

    
