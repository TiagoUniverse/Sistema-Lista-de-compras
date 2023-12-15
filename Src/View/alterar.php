<?php

/**
 * Classe: alterar
 * Descrição: Tela de alteração de uma lista
 * Data: 14/12/23
 */

require_once "conexao.php";

require_once "Recursos/ta_logado.php";


// Lista
require_once "../Model/Lista_repositorio.php";

use model\Lista_repositorio;

$Lista_repositorio = new Lista_repositorio();


require_once "Recursos/scripts.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Alteração</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../../Assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../../Assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link rel="icon" type="image/x-icon" href="../../Assets/Img/list-icon.png">
</head>

<body>
  <?php require_once "Recursos/navBar.php"; ?>

  <?php
  // Adicionando itens na lista
  if (isset($_POST['botao_alterar']) && $_POST['botao_alterar'] == "ALTERANDO UMA LISTA") {
    $idLista = $_POST['idLista'];
    $nome = $_POST['nome'];

    $Lista = $Lista_repositorio->consultar_ById($idLista, $pdo);

    if ($nome != $Lista[1]) {
      $Lista_repositorio->alterar($idLista, $nome, $pdo);
  ?>
      <script>
        M.toast({
          html: 'Lista alterada com sucesso!'
        });
      </script>
    <?php
    } else {
    ?>
      <script>
        M.toast({
          html: 'Altere o nome da lista!'
        });
      </script>

  <?php
    }
  }


  // puxando as informações
  if (isset($_POST['idLista'])) {
    $idLista = $_POST['idLista'];
    $Lista = $Lista_repositorio->consultar_ById($idLista, $pdo);
  }

  ?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <a href="home.php">Voltar</a>
      <br><br>
      <?php if (isset($_POST['idLista'])) { ?>
        <h1 class="header center orange-text">Alteração da lista: <u> <?php echo $Lista[1];   ?></u></h1>
      <?php } else { ?>
        <h1 class="header center orange-text">Alteração da lista</h1>
      <?php } ?>

      <div class="row center">
        <h5 class="header col s12 light">Altere as informações logo abaixo:</h5>
      </div>

      <?php
      if (isset($_POST['idLista'])) {
      ?>

        <div class="row">
          <form action="alterar.php" method="POST" class="col s12">
            <input type="hidden" name="idLista" value="<?php echo $Lista[0]; ?>">
            <div class="row">
              <div class="input-field col s12">
                <input id="nome" value="<?php echo $Lista[1]; ?>" required type="text" name="nome" class="validate">
                <label for="nome">Nome da lista:</label>
              </div>
            </div>
            <div class="row center">
              <button name="botao_alterar" value="ALTERANDO UMA LISTA" class="btn-large waves-effect waves-light orange center"> Alterar lista</button>
            </div>
          </form>
        </div>

      <?php
      } else {
      ?>
        <div class="row center">
          <h3 class="header col s12 light">Lista inválida. Por favor, tente novamente.F</h3>
        </div>

      <?php
      }
      ?>




    </div>


    <br><br><br>
    <br><br><br>
    <br>
    <?php require_once "Recursos/footer.php"; ?>

</body>

</html>