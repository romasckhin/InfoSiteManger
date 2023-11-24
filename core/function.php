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