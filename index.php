<?php

require_once 'config/db.php';
require_once 'core/function_db.php';
require_once 'core/function.php';

$conn = connect();

$route = isset($_GET['route']) ? $_GET['route'] : null;
$route = explodeUrl($route);


// main - главная страница
// category - категории
// article - статьи 

switch($route) {
    case $route[0] == '':
        $query = 'SELECT * FROM info';
        $result = select($query);
        require_once 'template/main.php';
        break;
    case ($route[0] == 'article' && isset($route[1])):
        $result = getArticle($route[1]);
        require_once 'template/article.php';
        break;
    case ($route[0] == 'category' && isset($route[1])):
        $category = getCategory($route[1]);
        $result = getCategoryAtricle($category['id']);
        require_once 'template/category.php';
        break;
    case ($route[0] == 'register'):
        require_once 'template/register.php';
        break;  
    case ($route[0] == 'login'):
        require_once 'template/login.php';
        break; 
    case (isset($route[0]) && $route[0] == 'admin' && isset($route[1]) && $route[1] == 'delete' && isset($route[2])):
        //Проверка если user имеет право удалять
        if (getUser()) {
            $query = "DELETE FROM info WHERE id = $route[2]";
            execQuery($query);
            header('Location: /admin');
            exit();
        }
        header('Location: /login');
        break;     
    case (isset($route[0]) && $route[0] == 'admin' && isset($route[1]) && $route[1] == 'create'):
        //Проверка если user имеет право удалять
        if (getUser()) {
            $query = "SELECT * FROM category";
            $category = select($query);
            require_once 'template/create.php';
            exit();
        }
        header('Location: /login');
        break;     
    case (isset($route[0]) && $route[0] == 'admin' && isset($route[1]) && $route[1] == 'update' && isset($route[2])):
        //Проверка если user имеет право удалять
        if (getUser()) {
            $query = "SELECT * FROM category";
            $category = select($query);
            $query = "SELECT * FROM info WHERE id = " . $route[2];
            $result = select($query)[0];
            require_once 'template/update.php';
            exit();
        }  
        header('Location: /login');
        break;     
    case ($route[0] == 'admin'):
        $query = 'SELECT * FROM info';
        $result = select($query);
        require_once 'template/admin.php';
        break;
     case ($route[0] == 'logout'):
        require_once 'template/logout.php';
        break;          
    default:
        require_once 'template/404.php';
}

