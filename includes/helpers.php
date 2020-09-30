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
        $result = $stmt -> get_result();

        while($row = $result -> fetch_assoc()){
            $categories[] = $row;
        }
    }

    return $categories;
}

//ARTICLES
function getArticles(){
    $connDb = getConn();

    $articles = array();
    if($connDb){
        $stmt = $connDb -> prepare("SELECT * FROM articles ORDER BY datePublication DESC");
        $stmt -> execute();
        $result = $stmt -> get_result();

        while($row = $result -> fetch_assoc()){
            $articles[] = $row;
        }
    }

    return $articles;
}