<?php

/**
 * Classe: Pessoas_repositorio.php
 * Descrição: Repositorio da classe Pessoas
 * Data: 15/11/23
 */


namespace Model;

use \PDO;

class Pessoas_repositorio
{

    // Função para efetuar o login do usuário
    function login($email, $senha, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from Pessoas where status = 'ATIVO' and email = :email and senha = sha1( :senha )   ");

            $stmt->execute(array(
                ":email" => $email,
                ":senha" => $senha
            ));

            $Pessoa = array();
            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $id = $linha['id'];
                $nome = $linha['nome'];
                $email = $linha['email'];
                $status = $linha['status'];
                $created = $linha['created'];

                $Pessoa = array($id, $nome, $email, $status, $created);
            }
            return $Pessoa;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
