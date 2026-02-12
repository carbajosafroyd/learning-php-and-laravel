<?php

require 'functions.php';
// require 'router.php';


//db connection (PDO)

$dsn = "mysql:host=localhost;port=3306;dbname=myapp;user=root;charset=utf8mb4";

$pdo = new PDO($dsn);

$stmt = $pdo->prepare("select * from post");
$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post){
    echo "<li>" . $post['title'] . "</li>";
}
