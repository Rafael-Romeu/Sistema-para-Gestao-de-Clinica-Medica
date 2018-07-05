<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once $_SERVER['DOCUMENT_ROOT']."/BancoDeDados/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/BancoDeDados/logicas/lHorarioAtendimento.php";

    

    $name = $_REQUEST["name"];
    $cpf  = $_REQUEST["cpf"];
    $pass = $_REQUEST["pass"];
    $endereco = $_REQUEST["endereco"];
    $email = $_REQUEST["email"];
    $nascimento = $_REQUEST["nascimento"];
    $plano = $_REQUEST["plano"];
    $especialidade = $_REQUEST["especialidade"];
    $telefone = $_REQUEST["telefone"];

    $seg = $_REQUEST["horSeg"];
    $ter = $_REQUEST["horTer"];
    $qua = $_REQUEST["horQua"];
    $qui = $_REQUEST["horQui"];
    $sex = $_REQUEST["horSex"];

    $oMedico = new lMedico();

    $result = $oMedico->insertMedicoCompleto($name, $pass, $cpf, $especialidade, $plano, $nascimento, $endereco, $telefone, $email);
    
    $codMed = ($oMedico->getMedicoByCPF($cpf))[0]->codigo;
    $oHorario = new lHorarioAtendimento();

    $result = $result . "<br>" . $oHorario->insertHorarioAtendimentoCompleto($codMed, $seg, $ter, $qua, $qui, $sex);
    
    echo $result;
?>