<?php

/**
 * Classe: Lista_repositorio
 * Descrição: Repositorio da classe Lista
 * Data: 15/11/23
 */


namespace Model;

use \PDO;

class Itens_repositorio
{

    // Função para cadastrar
    function cadastro($nome, $quantidade, $descricao, $idlista, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Insert INTO itens (nome , quantidade, descricao, idLista) 
            Values ( :nome , :quantidade, :descricao, :idLista ) ");

            $stmt->execute(array(
                ":nome" => $nome,
                ":quantidade" => $quantidade,
                ":descricao" => $descricao,
                ":idLista" => $idlista
            ));

            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    // Função para verificar se já existe
    function ja_existe($nome, $quantidade, $descricao, $idlista, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from itens where status = 'ATIVO' and nome = :nome and quantidade = :quantidade 
            and descricao = :descricao and idLista = :idLista ");

            $stmt->execute(array(
                ":nome" => $nome,
                ":quantidade" => $quantidade,
                ":descricao" => $descricao,
                ":idLista" => $idlista
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
  
    
    // Função para excluir um item da lista
    function excluir($idItem, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Update itens
            SET
                updated = now(),
                status ='INATIVO'
            Where
                id = :idItem     ");

            $stmt->execute(array(
                ":idItem" => $idItem
            ));

            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
  
    // Função para consultar através do id
    function consultar_ByID($idItem, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from itens where status = 'ATIVO' and id = :idItem  ");

            $stmt->execute(array(
                ":idItem" => $idItem
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
 
    // Função para consultar através do id
    function consultar_ByIdLista($idLista, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from itens where status = 'ATIVO' and idLista = :idLista  ");

            $stmt->execute(array(
                ":idLista" => $idLista
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

      // Função para listar os itens de uma lista
      function listar_itens_lista($idlista, $pdo)
      {
          try {
              $stmt = $pdo->prepare("Select * from itens where status = 'ATIVO' and  idLista = :idlista  ");
  
              $stmt->execute(array(
                  ":idlista" => $idlista
              ));
  
              $Itens = array();
              while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                  $id = $linha['id'];
                  $nome = $linha['nome'];
                  $quantidade = $linha['quantidade'];
                  $descricao = $linha['descricao'];
  
                  $Itens[] = array($id, $nome, $quantidade, $descricao);
              }
              return $Itens;
          } catch (\PDOException $e) {
              echo $e->getMessage();
          }
      }
}
