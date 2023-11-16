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

$Listas_array = $Lista_repositorio->listar($_SESSION['idPessoa'], $pdo);


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Tela inicial</title>

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
      <h1 class="header center orange-text">Minhas listas de compras</h1>
      <div class="row center">
        <h5 class="header col s12 light">Comece criando uma nova lista no botão abaixo</h5>
      </div>
      <div class="row center">
        <a href="cadastro.php" id="download-button" class="btn-large waves-effect waves-light orange">Criar uma nova lista</a>
      </div>
      <br><br>



      <br>
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Quantidade de itens</th>
            <th>Opções</th>
            <th>Excluir</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($Listas_array as $lista) {
            $link = "lista_tela-inicial.pHp?nome=" . $lista[1];
            ?>

            <tr>
              <th><a href="<?php echo $link; ?>">  <?php echo $lista[1]; ?> </a> </th> 
              <th>0</th>
            </tr>

            <?php
          }
          ?>
        </tbody>
      </table>
    </div>


  </div>


  <br><br><br>
  <br><br><br>
  <br>
  <?php require_once "Recursos/footer.php"; ?>

</body>

</html>