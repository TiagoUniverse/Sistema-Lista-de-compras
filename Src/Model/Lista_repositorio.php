<?php

/**
 * Classe: Lista_repositorio
 * Descrição: Repositorio da classe Lista
 * Data: 15/11/23
 */


namespace Model;

use \PDO;

class Lista_repositorio
{

    // Função para cadastrar
    function cadastro($nome, $idPessoa, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Insert INTO Lista (nome , idPessoa) Values ( :nome , :idPessoa ) ");

            $stmt->execute(array(
                ":nome" => $nome,
                ":idPessoa" => $idPessoa
            ));

            var_dump($stmt);

            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Função para verificar se já existe
    function ja_existe($nome, $idPessoa, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from Lista where status = 'ATIVO' and nome = :nome and idPessoa = :idPessoa  ");

            $stmt->execute(array(
                ":nome" => $nome,
                ":idPessoa" => $idPessoa
            ));

            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                // existe
                return true;
            }
            return false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Função para consultar
    function consulta_criado($nome, $idPessoa, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from Lista where status = 'ATIVO' and nome = :nome and idPessoa = :idPessoa  ");

            $stmt->execute(array(
                ":nome" => $nome,
                ":idPessoa" => $idPessoa
            ));

            $Lista = array();
            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $id = $linha['id'];
                $nome = $linha['nome'];

                $Lista = array($id, $nome);
            }
            return $Lista;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Função para consultar
    function consultar_ById($idLista, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from Lista where status = 'ATIVO' and id = :idLista  ");

            $stmt->execute(array(
                ":idLista" => $idLista
            ));

            $Lista = array();
            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $id = $linha['id'];
                $nome = $linha['nome'];

                $Lista = array($id, $nome);
            }
            return $Lista;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Função para excluir uma lista
    function excluir($idLista, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Update Lista
            SET
                updated = now(),
                status = 'INATIVO'
            Where
                id = :idLista ");

            $stmt->execute(array(
                ":idLista" => $idLista
            ));

            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Função para listar
    function listar($idPessoa, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from Lista where status = 'ATIVO' and  idPessoa = :idPessoa  ");

            $stmt->execute(array(
                ":idPessoa" => $idPessoa
            ));

            $Lista = array();
            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $id = $linha['id'];
                $nome = $linha['nome'];

                $Lista[] = array($id, $nome);
            }
            return $Lista;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
