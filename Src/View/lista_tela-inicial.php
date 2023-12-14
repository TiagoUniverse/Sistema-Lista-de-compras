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

    $ja_existe = $Itens_repositorio->ja_existe($nome, $quantidade, $descricao, $pdo);

    if ($ja_existe) {
    } else {
    }
  ?>
    <script>
      M.toast({
        html: 'Cadastro de grupo de projeto com sucesso!'
      });
    </script>

  <?php
  }


  ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      M.toast({
        html: 'Cadastro de grupo de projeto com sucesso!'
      });
    });
  </script>




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
              <th>Descrição (opcional)</th>
              <th>Excluir</th>
            </tr>
          </thead>
          <tbody>
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