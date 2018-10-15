<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";


    
    $codAtendente = $_REQUEST["codAtendente"];
    $codClinica = $_REQUEST["codClinica"];
    
    $atendente = new lAtendente();
    $atendente -> setCodigo($codAtendente);
    $atendente -> identifica();
    $clinicas = $atendente->getCodClinica();
    print_r($clinicas);

    $atendente->setCodClinica($codClinica);
    $atendente->alterar();

    $atendente = new lAtendente();
    $atendente -> setCodigo($codAtendente);
    $atendente -> identifica();
    $clinicas = $atendente->getCodClinica();
    print_r($clinicas);
?> 