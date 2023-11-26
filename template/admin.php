<?php
    
if (!getUser()) {
    header('Location: /login');
}


$out = '';
foreach ($result as $item) {
    $out .= '<div>';
    $out .= '<h4>' . $item['title'] . '</h4>';
    $out .= '<p>' . $item['descr_min'] . '</p>';
    $out .= '<img src=/static/images/' . $item['image'] . ' width=200 >'; 
    $out .= '<div><a href=/admin/delete/' . $item['id'] . ' onclick="return confirm(\'Точно?\')" > delete </a></div>';
    $out .= '<div><a href=/admin/update/' . $item['id'] . ' onclick="return confirm(\'Точно?\')" > update </a></div>'; 
    $out .= '</div>';
}

?>

<h1>Admin Panel</h1>
<div><a href="/admin/create">create</a></div>
<div><a href="/logout">logout</a></div>
<?php

echo $out;

?>
