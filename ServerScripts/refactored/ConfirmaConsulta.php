<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    
    $codMedico = $_REQUEST["codMedico"];
    $codAtendente = $_REQUEST["codAtendente"];
    $hora = $_REQUEST["hora"];
    $data = $_REQUEST["data"];

    $consulta = new lConsulta();
    $consulta->setCodMedico($codMedico);
    $consulta->setData($data);
    $consulta->setHora($hora);
    
    $consulta->identifica();

    $consulta->setFlagConfirmada("1");
    $consulta->setCodAtendente($codAtendente);

    $consulta->alterar();
?> 