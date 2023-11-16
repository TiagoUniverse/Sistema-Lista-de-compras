<?php

$host = "localhost";
$dbname = "lista_compras";
$user = "root";
$password = "";


try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);    
    echo "Conectado ao banco de dados com sucesso!";
} catch(PDOException $e){
    echo $e->getMessage();
}
