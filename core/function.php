<?php

function explodeUrl($url) {
    return explode('/', (string)$url); // указываем (string) т.к без неё будет ошибка "explode устарел"
}

function getArticle($url) {
    $query = "SELECT * FROM info WHERE url = '" . $url . "' ";
    return select($query)[0];
}

function getCategory($url) {
    $query = "SELECT * FROM category WHERE url = '" . $url . "' ";
    return select($query)[0];
}

function getCategoryAtricle($cid) {
    $query = "SELECT * FROM info WHERE cid = '" . $cid . "' ";
    return select($query);
}

function isLoginExit($login) {
    $query = "SELECT id FROM users WHERE login = '". $login . "'";
    return select($query);
    if (count($result) === 0) return false;
    return true;
}

function createUser($login, $password) {
    $password = md5(md5(trim($password)));
    $login = trim($login);
    $query = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
    return execQuery($query);
}