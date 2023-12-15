<?php

/**
 * Classe: login
 * Descrição: Tela de login
 * Data: 15/11/23
 */

require_once "conexao.php";

require_once "Recursos/ta_logado.php";


// Lista
require_once "../Model/Lista_repositorio.php";

use model\Lista_repositorio;

$Lista_repositorio = new Lista_repositorio();

$ja_existe = true;
// Cadastro de uma nova lista
if (isset($_POST['status_cadastro']) && $_POST['status_cadastro'] == "CADASTRANDO UMA LISTA") {
  $nome = $_POST['nome'];

  $ja_existe = $Lista_repositorio->ja_existe($nome, $_SESSION['idPessoa'], $pdo);

  if ($ja_existe == false){
    $Lista_repositorio->cadastro($nome, $_SESSION['idPessoa'], $pdo);
    
    $Lista = $Lista_repositorio->consulta_criado($nome, $_SESSION['idPessoa'], $pdo);

    $localizacao = "Location: lista_tela-inicial.php?nome=" . trim($Lista[1]);
    header($localizacao);
  }

}

require_once "Recursos/scripts.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Cadastro</title>

  <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../../Assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../../Assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link rel="icon" type="image/x-icon" href="../../Assets/Img/list-icon.png">
</head>

<body>
  <?php require_once "Recursos/navBar.php"; ?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Cadastro de nova lista</h1>

      <?php
      if ($ja_existe == true){
        ?>
         <div class="row center">
        <h5 class="header col s12 light">Lista já existe!Por favor, crie com outro nome.</h5>
      </div>
        <?php
      }

      ?>

      <div class="row center">
        <h5 class="header col s12 light">Informe o título da lista</h5>
      </div>


      <div class="row">
        <form action="cadastro.php" method="POST" class="col s12">
          <input type="hidden" name="status_cadastro" value="CADASTRANDO UMA LISTA">
          <div class="row">
            <div class="input-field col s12">
              <input id="nome" type="text" name="nome" class="validate">
              <label for="nome">Nome da lista:</label>
            </div>
          </div>
          <div class="row center">
            <button class="btn-large waves-effect waves-light orange center"> Cadastrar</button>
          </div>
        </form>
      </div>


    </div>


    <br><br><br>
    <br><br><br>
    <br>
    <?php require_once "Recursos/footer.php"; ?>

</body>

</html>