<?php

//BBDD
function getConn(){
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = 'root1234';
    $dbDataBase = 'blog_videojuegos';
    $dbPort = 3307;

    $connDb = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDataBase, $dbPort);
    $connDb -> set_charset("utf8");

    return $connDb;
}

//CATEGORIES
function getCategories(){
    $connDb = getConn();

    $categories = array();
    if($connDb){
        $stmt = $connDb -> prepare("SELECT * FROM categories ORDER BY name ASC");
        $stmt -> execute();
        $stmt -> bind_result($idCategory, $nameCategory);

        while($stmt -> fetch()){
            $categories[] = $nameCategory;
        }
    }

    return $categories;
}

//ARTICLES
function getArticles(){
    $connDb = getConn();

    $articles = array();

    return $articles;
}