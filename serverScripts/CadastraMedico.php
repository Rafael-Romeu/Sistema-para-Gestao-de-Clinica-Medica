<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once "../logicas/lMedico.php";

    $name = $_REQUEST["name"];
    $cpf  = $_REQUEST["cpf"];
    $pass = $_REQUEST["pass"];
    $endereco = $_REQUEST["endereco"];
    $email = $_REQUEST["email"];
    $nascimento = $_REQUEST["nascimento"];
    $plano = $_REQUEST["plano"];
    $especialidade = $_REQUEST["especialidade"];
    $telefone = $_REQUEST["telefone"];

    $oMedico = new lMedico();

    $result = $oMedico->insertMedicoCompleto($name, $pass, $cpf, $especialidade, $plano, $nascimento, $endereco, $telefone, $email);

    echo $result;
?>