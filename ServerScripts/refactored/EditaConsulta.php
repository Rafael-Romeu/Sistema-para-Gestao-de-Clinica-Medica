<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    
    $codMedico = $_REQUEST["codMedico"];
    $hora = $_REQUEST["hora"];
    $data = $_REQUEST["data"];
    $obs = $_REQUEST["obs"];
    $rec = $_REQUEST["rec"];

    $consulta = new lConsulta();
    $consulta->setCodMedico($codMedico);
    $consulta->setData($data);
    $consulta->setHora($hora);
    
    $consulta->identifica();

    $consulta->setObservacao($obs);
    $consulta->setReceita($rec);

    $consulta->alterar();
?> 