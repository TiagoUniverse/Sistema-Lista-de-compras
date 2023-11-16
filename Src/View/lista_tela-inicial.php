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

$Lista = $Lista_repositorio->consulta_criado($_GET['nome'], $_SESSION['idPessoa'], $pdo);



?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title> <?php echo $Lista[1]; ?> </title>

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
      <h1 class="header center orange-text"><?php echo $Lista[1]; ?></h1>
      <div class="row center">
        <h5 class="header col s12 light">Informe os itens da lista logo abaixo</h5>
      </div>


      <div class="row">
        <br>
        <table>
          <thead>
            <tr>
              <th>Nome</th>
              <th>Quantidade de itens</th>
              <th>Excluir</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>


    </div>
  </div>


  <br><br><br>
  <br><br><br>
  <br>
  <?php require_once "Recursos/footer.php"; ?>

</body>

</html>