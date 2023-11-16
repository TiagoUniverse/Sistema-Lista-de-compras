<?php
/**
 * Classe: Pessoas_repositorio.php
 * Descrição: Repositorio da classe Pessoas
 * Data: 15/11/23
 */


 namespace Model;

use \PDO;

class Pessoas_repositorio{

    // Função para efetuar o login do usuário
    function login ($email, $senha, $pdo){
        $stmt = $pdo->prepare("Select * from Pessoas where status = 'ATIVO' and email = :email and senha = sha1( :senha )   ");

        $stmt->execute(array(
            ":email" => $email,
            ":senha" => $senha
        ));
        var_dump($stmt);

        while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)){
            echo $linha['email'];
        }
    }


 }

