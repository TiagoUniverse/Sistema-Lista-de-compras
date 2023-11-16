<?php

if (isset($_SESSION['logado']) && $_SESSION['logado'] != "LOGADO"){
    header("Location: login.php");
 }