<?php

const LIMIT_ARTICLES = 5;

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
function getArticles($allArticles, &$isMaxArticlesReached = true, $categoryFilter = null, $allUsers = true){
    $connDb = getConn();

    $articles = array();
    if($connDb){

        if($categoryFilter == null){
            if($allUsers){
                $sql = "SELECT a.id, a.title, CASE
                        WHEN LENGTH(description) > 500 
                            THEN CONCAT(SUBSTRING(description, 1, 500),'...')
                            ELSE description
                            END AS shortDescription, 
                        DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory', CONCAT(u.name,' ',u.surname) as 'fullNameUser' 
                        FROM articles a 
                        INNER JOIN categories c on a.category_id = c.id
                        INNER JOIN users u on u.id = a.user_id
                        ORDER BY a.datePublication DESC";
            }else{
                $sql = "SELECT a.id, a.title, CASE
                        WHEN LENGTH(description) > 500
                            THEN CONCAT(SUBSTRING(description, 1, 500),'...')
                            ELSE description
                            END AS shortDescription, 
                        DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory', CONCAT(u.name,' ',u.surname) as 'fullNameUser' 
                        FROM articles a 
                        INNER JOIN categories c on a.category_id = c.id
                        INNER JOIN users u on u.id = a.user_id
                        WHERE a.user_id = ".$_SESSION['idUser']."
                        ORDER BY a.datePublication DESC";
            }
        }else{
            if($allUsers){
                $sql = "SELECT a.id, a.title, CASE
                        WHEN LENGTH(description) > 500
                            THEN CONCAT(SUBSTRING(description, 1, 500),'...')
                            ELSE description
                            END AS shortDescription, 
                        DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory', CONCAT(u.name,' ',u.surname) as 'fullNameUser' 
                        FROM articles a 
                        INNER JOIN categories c on a.category_id = c.id
                        INNER JOIN users u on u.id = a.user_id
                        WHERE c.id = ?
                        ORDER BY a.datePublication DESC";
            }else{
                $sql = "SELECT a.id, a.title, CASE
                        WHEN LENGTH(description) > 500
                            THEN CONCAT(SUBSTRING(description, 1, 500),'...')
                            ELSE description
                            END AS shortDescription, 
                        DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory', CONCAT(u.name,' ',u.surname) as 'fullNameUser' 
                        FROM articles a 
                        INNER JOIN categories c on a.category_id = c.id             
                        INNER JOIN users u on u.id = a.user_id
                        WHERE c.id = ? AND a.user_id = ".$_SESSION['idUser']."
                        ORDER BY a.datePublication DESC";
            }
        }

        if(!$allArticles){
            //We split the original sql from the word "FROM" and execute the same query with a COUNT(*)
            //We use this for set the &$isMaxArticlesReached to know if is necessary to include button "Ver más entradas" or all are already been retrieved.
            //ONLY FOR OPTIMIZATION AND USABILITY.
            $maxArticles = getMaxArticles($sql, $categoryFilter);
            $sql = $sql." LIMIT ".LIMIT_ARTICLES;
        }

        $stmt = $connDb -> prepare($sql);

        if($categoryFilter != null){
            $stmt -> bind_param('i', $categoryFilter);
        }

        $stmt -> execute();
        $result = $stmt -> get_result();

        if(!$allArticles && ($result -> num_rows < $maxArticles)){
            $isMaxArticlesReached = false;
        }

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

        $sql = "SELECT a.id, a.title, a.description, DATE_FORMAT(a.datePublication,'%d/%m/%Y') as 'datePublication', c.name as 'nameCategory', CONCAT(u.name,' ',u.surname) as 'fullNameUser', u.id as 'userId'
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

function getMaxArticles($sql, $categoryFilter){
    $connDb = getConn();

    $sqlIsMaxArticlesReached = "SELECT COUNT(*) as MaxArticles FROM".explode("FROM", $sql)[1];

    $stmt = $connDb -> prepare($sqlIsMaxArticlesReached);

    if($categoryFilter != null){
        $stmt -> bind_param('i', $categoryFilter);
    }

    $stmt -> execute();
    $result = $stmt -> get_result();

    return $result->fetch_row()[0];
}