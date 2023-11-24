<?php

require_once 'config/db.php';
require_once 'core/function_db.php';
require_once 'core/function.php';

$conn = connect();

$route = isset($_GET['route']) ? $_GET['route'] : null;
$route = explodeUrl($route);


// main - главная страница
// cat - категории
// article - статьи 

switch($route) {
    case $route[0] == '':
        $query = 'SELECT * FROM info';
        $result = select($query);
        require_once 'template/main.php';
        break;
    case ($route[0] == 'article' AND isset($route[1])):
        $result = getArticle($route[1]);
        require_once 'template/article.php';
        break;
    default:
        echo "Это default";
}

