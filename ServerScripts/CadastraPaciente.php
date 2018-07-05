<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lPaciente.php";

    $name = $_REQUEST["name"];
    $cpf  = $_REQUEST["cpf"];
    $pass = $_REQUEST["pass"];
    $endereco = $_REQUEST["endereco"];
    $email = $_REQUEST["email"];
    $nascimento = $_REQUEST["nascimento"];
    $plano = $_REQUEST["plano"];
    $sangue = sanitize($_REQUEST["sangue"]);
    $genero = $_REQUEST["genero"];
    $telefone = $_REQUEST["telefone"];

    $oPaciente = new lPaciente();

    $result = $oPaciente->insertPacienteCompleto($name, $pass, $cpf, $plano, $genero, $sangue, $nascimento, $endereco, $telefone, $email);

    echo $result;

    function sanitize($data) {
        $data = urlencode($data);
        return $data;
    }
?>