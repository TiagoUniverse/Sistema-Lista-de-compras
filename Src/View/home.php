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

// Itens
require_once "../Model/Itens_repositorio.php";

use model\Itens_repositorio;

$Itens_repositorio = new Itens_repositorio();


require_once "Recursos/scripts.php";
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
  <link rel="icon" type="image/x-icon" href="../../Assets/Img/list-icon.png">
</head>

<body>
  <?php require_once "Recursos/navBar.php"; ?>

  <?php
  // Adicionando itens na lista
  if (isset($_POST['botao_exclusao']) && $_POST['botao_exclusao'] == "EXCLUINDO UMA LISTA") {
    $ja_existe = $Lista_repositorio->consultar_ById($_POST['idLista'], $pdo);

    if ($ja_existe != null) {

      $Lista_repositorio->excluir($_POST['idLista'], $pdo);

  ?>
      <script>
        M.toast({
          html: 'Lista deletada com sucesso!'
        });
      </script>

    <?php
    } else {
    ?>
      <script>
        M.toast({
          html: 'Esta lista já foi excluída!'
        });
      </script>

  <?php
    }
  }

  // Informações das listas
  $Listas_array = $Lista_repositorio->listar($_SESSION['idPessoa'], $pdo);

  ?>

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
            <th>Alterar</th>
            <th>Excluir</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($Listas_array as $lista) {
            $itens = $Itens_repositorio->consultar_ByIdLista($lista[0], $pdo);

            var_dump($itens);

            $link = "lista_tela-inicial.pHp?nome=" . $lista[1];
            $modalId = 'modal-' . $lista[0]; // Unique ID for each modal
          ?>

            <tr>
              <td><a href="<?php echo $link; ?>"> <?php echo $lista[1]; ?> </a> </td>
              <td><?php echo count($itens); ?></td>
              
              <td>
                <form action="alterar.php" method="post">
                  <input type="hidden" name="idLista" value="<?php echo $lista[0]; ?>"> 
                  <button class="waves-effect #ef5350  lighten-1 btn">Alterar</button>
                </form>
              </td>
              <td>
                <!-- Modal Trigger -->
                <a class='waves-effect #ef5350 red lighten-1 btn modal-trigger' href='#<?php echo $modalId; ?>'>Excluir</a>

                <!-- Modal Structure -->
                <div id='<?php echo $modalId; ?>' class='modal'>
                  <div class='modal-content'>
                    <h4>Exclusão de Lista</h4>
                    <p>Você está prestes a deletar esta lista. Você tem certeza?</p>
                  </div>

                  <div class='modal-footer'>
                    <a href='#!' class='modal-close waves-effect waves-green btn-flat' style="display:inline;">Cancelar</a>
                    <form action='home.php' method='post' class='exclusao-form' style="display:inline;">
                      <input type='hidden' name='idLista' value="<?php echo $lista[0]; ?>">
                      <button type='submit' name="botao_exclusao" value="EXCLUINDO UMA LISTA" class='modal-close #ef5350 red lighten-1 btn-flat'>Deletar</button>
                    </form>
                  </div>
                </div>
              </td>

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