<?php

/**
 * Classe: login
 * Descrição: Tela de login
 * Data: 15/11/23
 */

require_once "conexao.php";

require_once "Recursos/ta_logado.php";




?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>consulta</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../../Assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../../Assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>
  <?php require_once "Recursos/navBar.php"; ?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Consulta</h1>
      <div class="row center">
        <h5 class="header col s12 light">Informe o título da lista</h5>
      </div>


      <div class="row">
        <form class="col s12">
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