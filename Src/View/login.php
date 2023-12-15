<?php

/**
 * Classe: login
 * Descrição: Tela de login
 * Data: 15/11/23
 */

require_once "conexao.php";

if (isset($_SESSION['logado']) && $_SESSION['logado'] == "LOGADO"){
    header("Location: home.php");
 }

// Pessoas Section
require_once "../Model/Pessoas_repositorio.php";

use model\Pessoas_repositorio;

$Pessoas_repositorio = new Pessoas_repositorio();


$login_sucesso = true;
if (isset($_POST['status_login']) && $_POST['status_login'] == "ACESSANDO A CONTA") {
    $email = $_POST['email'];
    $senha = $_POST['pass'];

    $Pessoa = $Pessoas_repositorio->login($email, $senha, $pdo);

    if ($Pessoa == null) {
        $login_sucesso = false;
    } else {
        $_SESSION['idPessoa'] = $Pessoa[0];
        $_SESSION['nomePessoa'] = $Pessoa[1];
        $_SESSION['emailPessoa'] = $Pessoa[2];
        $_SESSION['logado'] = "LOGADO";

        header("Location:home.php");

    }
}


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../../Assets/Img/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../Assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../Assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../Assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../Assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../Assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../Assets/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../Assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../Assets/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../Assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="../../Assets/css/main.css">
    <!--===============================================================================================-->
    <link rel="icon" type="image/x-icon" href="../../Assets/Img/list-icon.png">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('../../Assets/Img/bg-01.jpg');">
            <div class="wrap-login100">
                <form action="login.php" method="POST" class="login100-form validate-form">
                    <input type="hidden" name="status_login" value="ACESSANDO A CONTA">
                    <span class="login100-form-logo">
                        <i class="zmdi zmdi-landscape"></i>
                    </span>

                    <span class="login100-form-title p-b-34 p-t-27">
                        Sistema de Lista de Compras
                    </span>

                    <?php
                    if ($login_sucesso == false) {
                    ?>
                        <span class="login100-form-title p-b-34 p-t-27">
                            Falha no login! Tente novamente.
                        </span>
                    <?php
                    }
                    ?>

                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input class="input100" type="email" name="email" placeholder="Email">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <!-- <div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div> -->

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Acessar
                        </button>
                    </div>

                    <div class="text-center p-t-90">
                        <a class="txt1" href="#">
                            Esqueceu a senha?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="../../Assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="../../Assets/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="../../Assets/vendor/bootstrap/js/popper.js"></script>
    <script src="../../Assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="../../Assets/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="../../Assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="../../Assets/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="../../Assets/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="../../Assets/js/main.js"></script>

</body>

</html>