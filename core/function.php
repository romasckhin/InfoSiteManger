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


function getUser() {
    if (isset($_COOKIE['hash'])) {

        $hash = intval($_COOKIE['hash']);
        $query = "SELECT hash, INET_NTOA(ip) as ip FROM users WHERE hash = $hash";
        $user = select($query);

        if (count($user) == 0) {
            return false;
        }
        else {
            $user = $user[0];
            if ($user['hash'] !== $_COOKIE['hash']) {
                clearCookies();
                return false;
            }
            if (!is_null($user['ip'])) {
                if ($user['ip'] !== $_SERVER['REMOTE_ADDR']) {
                    clearCookies();
                    return false;
                }
            }
            return true;
        }
    }
    else {
        clearCookies();
        return false;
    }
}

function clearCookies() {
    setcookie('hash', '', time()-60*60*24*30, '/');
    unset($_GET['login']);
}