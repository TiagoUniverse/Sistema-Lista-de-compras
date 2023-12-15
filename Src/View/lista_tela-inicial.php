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
  <title> <?php echo $Lista[1]; ?> </title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../../Assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../../Assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>
  <?php require_once "Recursos/navBar.php"; ?>

  <?php
  // Adicionando itens na lista
  if (isset($_POST['botao_adicionar']) && $_POST['botao_adicionar'] == "ADICIONANDO NA LISTA") {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];

    $ja_existe = $Itens_repositorio->ja_existe($nome, $quantidade, $descricao, $Lista[0], $pdo);

    if ($ja_existe) {
  ?>
      <script>
        M.toast({
          html: 'Este item já existe na lista!'
        });
      </script>

    <?php
    } else {
      $Itens_repositorio->cadastro($nome, $quantidade, $descricao, $Lista[0], $pdo);
    ?>
      <script>
        M.toast({
          html: 'Item adicionado com sucesso!'
        });
      </script>

    <?php
    }
  }

  // Removendo um item da lista
  if (isset($_POST['botao_excluir']) && $_POST['botao_excluir'] == "EXCLUINDO UM ITEM") {
    // $ja_existe = $Itens_repositorio->ja_existe($nome, $quantidade, $descricao, $Lista[0], $pdo);
    $ja_existe = $Itens_repositorio->consultar_ByID($_POST['idItem'], $pdo);

    if ($ja_existe != null) {

      $Itens_repositorio->excluir($_POST['idItem'], $pdo);
    ?>
      <script>
        M.toast({
          html: 'Item excluído da lista com sucesso!'
        });
      </script>

    <?php
    } else {
    ?>
      <script>
        M.toast({
          html: 'Este item já foi excluído!'
        });
      </script>

  <?php
    }
  }

  // Puxando as informações de itens da lista
  $itens = $Itens_repositorio->listar_itens_lista($Lista[0], $pdo);
  ?>


  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <a href="home.php">Voltar</a>
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
              <th>Descrição (opcional)</th>
              <th>Excluir</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($itens as $itens) {
              $modalId = "modal" . $itens[0];
              echo "<tr>";
              echo "<td> " . $itens[1] . " </td>";
              echo "<td> " . $itens[2] . " </td>";
              echo "<td> " . $itens[3] . " </td>";
            ?>
              <td>
                <!-- Modal Trigger -->
                <a class="waves-effect waves-light btn red modal-trigger" href="#<?php echo $modalId; ?>">Excluir</a>

                <!-- Modal Structure -->
                <div id="<?php echo $modalId; ?>" class="modal">
                  <div class="modal-content">
                    <h4>Excluir item da lista</h4>
                    <p><?php echo "Você está prestes a excluir o item <a>" . $itens[1] . "</a> da lista. Você tem certeza?" ?></p>
                  </div>
                  <div class="modal-footer">
                    <a href="#" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                    <form action="lista_tela-inicial.php" method="post" style="display:inline;">
                    <input type="hidden" name="idItem" value="<?php echo $itens[0]; ?>">
                      <button name="botao_excluir" value="EXCLUINDO UM ITEM" class="modal-close waves-effect waves-green red btn-flat">Excluir</button>
                    </form>
                  </div>
                </div>
              </td>
            <?php
              echo "</tr>";
            }
            ?>

            <!-- Adicionar itens -->
            <?php $link = "lista_tela-inicial.php?nome=" . $_GET['nome'] . ""; ?>
            <form action="<?php echo $link; ?>" method="post">
              <td>
                <div class="input-field col s12">
                  <input id="nome" name="nome" type="text" required class="validate">
                  <label for="nome">Nome do produto:</label>
                </div>
              </td>
              <td>
                <div class="input-field col s12">
                  <input id="quantidade" name="quantidade" type="number" min=1 required class="validate">
                  <label for="quantidade">Quantidade:</label>
                </div>
              </td>
              <td>
                <div class="input-field col s12">
                  <input id="descricao" name="descricao" type="text" class="validate">
                  <label for="descricao">Descrição:</label>
                </div>
              </td>
              <td> <button name="botao_adicionar" value="ADICIONANDO NA LISTA" class="waves-effect #ef5350  lighten-1 btn ">Adicionar</button> </td>
            </form>
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