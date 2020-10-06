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
function getArticles($categoryFilter = null, $allUsers = true){
    $connDb = getConn();

    $articles = array();
    if($connDb){

        if($categoryFilter == null){
            if($allUsers){
                $sql = "SELECT a.id, a.title, CONCAT(SUBSTRING(description, 1, 500),'...') as 'shortDescription', DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory', CONCAT(u.name,' ',u.surname) as 'fullNameUser' 
                    FROM articles a 
                    INNER JOIN categories c on a.category_id = c.id
                    INNER JOIN users u on u.id = a.user_id
                    ORDER BY a.datePublication DESC";
            }else{
                $sql = "SELECT a.id, a.title, CONCAT(SUBSTRING(description, 1, 500),'...') as 'shortDescription', DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory', CONCAT(u.name,' ',u.surname) as 'fullNameUser' 
                    FROM articles a 
                    INNER JOIN categories c on a.category_id = c.id
                    INNER JOIN users u on u.id = a.user_id
                    WHERE a.user_id = ".$_SESSION['idUser']."
                    ORDER BY a.datePublication DESC";
            }
        }else{
            if($allUsers){
                $sql = "SELECT a.id, a.title, CONCAT(SUBSTRING(description, 1, 500),'...') as 'shortDescription', DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory', CONCAT(u.name,' ',u.surname) as 'fullNameUser' 
                    FROM articles a 
                    INNER JOIN categories c on a.category_id = c.id
                    INNER JOIN users u on u.id = a.user_id
                    WHERE c.id = ?
                    ORDER BY a.datePublication DESC";
            }else{
                $sql = "SELECT a.id, a.title, CONCAT(SUBSTRING(description, 1, 500),'...') as 'shortDescription', DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory', CONCAT(u.name,' ',u.surname) as 'fullNameUser' 
                    FROM articles a 
                    INNER JOIN categories c on a.category_id = c.id             
                    INNER JOIN users u on u.id = a.user_id
                    WHERE c.id = ? AND a.user_id = ".$_SESSION['idUser']."
                    ORDER BY a.datePublication DESC";
            }
        }

        $stmt = $connDb -> prepare($sql);

        if($categoryFilter != null){
            $stmt -> bind_param('i', $categoryFilter);
        }

        $stmt -> execute();
        $result = $stmt -> get_result();

        while($row = $result -> fetch_assoc()){
            $articles[] = $row;
        }
    }

    return $articles;
}

function getArticle($articleId){
    $connDb = getConn();

    $article = null;
    if($connDb){

        $sql = "SELECT a.id, a.title, a.description, DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory', CONCAT(u.name,' ',u.surname) as 'fullNameUser' 
            FROM articles a 
            INNER JOIN categories c on a.category_id = c.id
            INNER JOIN users u on u.id = a.user_id
            WHERE a.id = ?";

        $stmt = $connDb -> prepare($sql);
        $stmt -> bind_param('i', $articleId);
        $stmt -> execute();
        $result = $stmt -> get_result();
        $article = $result -> fetch_assoc();
    }

    return $article;
}