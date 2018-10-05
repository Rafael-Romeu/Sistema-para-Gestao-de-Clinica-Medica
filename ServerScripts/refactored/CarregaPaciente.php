<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    
    $oPaciente = new lPaciente();
    $codPaciente = $_REQUEST["codigo"];
    //$codPaciente = 1;
    $oPaciente -> setCodigo($codPaciente);

    if($oPaciente->identifica())
    {
        echo "<b>Nome:</b>";
        echo "<br>";
        echo "<span id=infoUserNome>".$oPaciente->getNome()."</span>";
        echo "<br><br>";
        echo "<b>Plano de Saúde:</b>";
        echo "<br>";
        echo "<span id=infoUserPlano>".$oPaciente->getPlanoDeSaude()."</span>";
        echo "<br><br>";
        echo "<b>Email:</b>";
        echo "<br>";
        echo "<span id=infoUserEmail>".$oPaciente->getEmail()."</span>";
        echo "<br><br>";
        echo "<b>Endereço:</b>";
        echo "<br>";
        echo "<span id=infoUserEnd>".$oPaciente->getEndereco()."</span>";
        echo "<br>";
    }
?> 