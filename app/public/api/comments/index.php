<?php

require 'common.php';

// Step 1: get data base connection
$db = DbConnection::getConnection();

// Step 2: Create & run the query
$sql = ' SELECT * FROM Comments';
$vars = [];

if (isset($_GET['id'])){
    // This is an example of a paramaterized query
    $sql = 'SELECT * FROM Comments Where id= ?';
    $vars = [$_GET['id'] ];
}

$stmt = $db -> prepare($sql);
$stmt->execute($vars);

$comments =$stmt -> fetchALL();

// Step 3: Converyt to JSON
$json = json_encode($comments, JSON_PRETTY_PRINT);

// Step 4: Output
header('Content-Type: application/json');
echo $json;
