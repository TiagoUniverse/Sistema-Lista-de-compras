<?php
/**
 * Classe: login
 * Descrição: Tela de login
 * Data: 15/11/23
 */

require_once "conexao.php";

// Pessoas Section
require_once "../Model/Pessoas_repositorio.php";

use model\Pessoas_repositorio;

$Pessoas_repositorio = new Pessoas_repositorio();
$Pessoas_repositorio->login("tiagocesar68@gmail.com", "tiago123", $pdo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
</body>
</html>