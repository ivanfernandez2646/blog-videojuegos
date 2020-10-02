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
function getArticles($categoryFilter = null){
    $connDb = getConn();

    $articles = array();
    if($connDb){

        if($categoryFilter == null){
            $sql = "SELECT a.id, a.title, a.description, DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory' FROM articles a 
                    INNER JOIN categories c on a.category_id = c.id 
                    ORDER BY a.datePublication DESC";
        }else{
            $sql = "SELECT a.id, a.title, a.description, DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory' FROM articles a 
                    INNER JOIN categories c on a.category_id = c.id 
                    WHERE c.id = ?
                    ORDER BY a.datePublication DESC";
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