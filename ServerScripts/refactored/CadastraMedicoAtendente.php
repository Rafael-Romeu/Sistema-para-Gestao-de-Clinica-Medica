<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";


    
    $codMedico = $_REQUEST["codMedico"];
    $codClinica = $_REQUEST["codClinica"];
    
    $medico = new lMedico();
    $medico -> setCodigo($codMedico);
    $medico -> identifica();

    $clinicas = $medico->getCodClinica();

    array_push($clinicas, $codClinica);

    $medico->setCodClinica($clinicas);

    $medico->alterar();
    
?> 