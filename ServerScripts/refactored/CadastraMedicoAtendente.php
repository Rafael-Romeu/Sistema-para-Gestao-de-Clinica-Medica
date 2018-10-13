<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lHorarioAtendimento.php";


    
    $codMedico = $_REQUEST["codMedico"];
    $codClinica = $_REQUEST["codClinica"];
    $seg = $_REQUEST["seg"];
    $ter = $_REQUEST["ter"];
    $qua = $_REQUEST["qua"];
    $qui = $_REQUEST["qui"];
    $sex = $_REQUEST["sex"];


    $medico = new lMedico();
    $medico -> setCodigo($codMedico);
    $medico -> identifica();
    $clinicas = $medico->getCodClinica();
    print_r($clinicas);
    
    $medico->setCodClinica($codClinica);
    $medico->alterar();

    

    $horario = new lHorarioAtendimento();
    $horario->setCodMedico($codMedico);
    $horario->setCodClinica($codClinica);

    $horario->setSeg($seg);
    $horario->setTer($ter);
    $horario->setQua($qua);
    $horario->setQui($qui);
    $horario->setSex($sex);

    $horario->incluir();


?> 