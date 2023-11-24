<?php

require_once 'config/db.php';
require_once 'core/function_db.php';
require_once 'core/function.php';

$conn = connect();

$route = $_GET['route'];

// main - главная страница
// cat - категории
// article - статьи 

switch($route) {
    case null:
        $query = 'SELECT * FROM info';
        $result = select($query);
        require_once 'template/main.php';
        break;
    default:
        echo "Это default";
}

