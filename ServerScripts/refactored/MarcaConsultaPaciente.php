<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    
    $codPaciente = $_REQUEST["codPaciente"];
    $codMedico = $_REQUEST["codMedico"];
    $codClinica = $_REQUEST["codClinica"];
    $data = $_REQUEST["data"];
    $hora = $_REQUEST["hora"];

    $consulta = new lConsulta();

    $consulta->setCodClinica($codClinica);
    $consulta->setCodMedico($codMedico);
    $consulta->setCodPaciente($codPaciente);
    $consulta->setCodAtendente("0");
    $consulta->setFlagConfirmada("0");
    $consulta->setData($data);
    $consulta->setHora((new DateTime($data . " " . $hora))->format('H:i:s'));

    $consulta->incluir();


    $consulta = new lConsulta();

    $consulta->setCodClinica($codClinica);
    $consulta->setCodMedico($codMedico);
    $consulta->setCodPaciente($codPaciente);
    $consulta->setData($data);
    $consulta->setHora($hora);

    if ($consulta->identifica())
    {
        echo "Consulta marcada com sucesso!";
    }
    else
    {
        echo "Falha ao marcar a consulta, tente novamente.";
    }

    
?> 