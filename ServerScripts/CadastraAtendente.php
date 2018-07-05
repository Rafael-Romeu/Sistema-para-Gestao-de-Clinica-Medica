<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lAtendente.php";

    $name = $_REQUEST["name"];
    $cpf  = $_REQUEST["cpf"];
    $pass = $_REQUEST["pass"];
    $endereco = $_REQUEST["endereco"];
    $email = $_REQUEST["email"];
    $nascimento = $_REQUEST["nascimento"];
    $telefone = $_REQUEST["telefone"];

    $oAtendente = new lAtendente();

    $result = $oAtendente->insertAtendenteCompleto($name, $pass, $cpf, $nascimento, $endereco, $telefone, $email);

    echo $result;
?>