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

function login($login, $password) {
    $password = md5(md5(trim($password)));
    $login = trim($login);
    $query = "SELECT id, login FROM users WHERE login = '". $login . "' AND password = '". $password . "' ";
    $result = select($query);
    if (count($result) !== 0) return $result;
    return false;
}

function generateCode($length = 7) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function updateUser($id, $hash, $ip) {
    if (is_null($ip)) {
        $query = "UPDATE users SET hash = '". $hash . "' WHERE id = '". $id . "'";
    }
    else {
        $query = "UPDATE users SET hash = '". $hash . "' , ip = INET_ATON('".$ip."') WHERE id = '". $id . "'";
    }
    return execQuery($query);
}