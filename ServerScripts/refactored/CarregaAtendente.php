<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    
    $codAtendente = $_REQUEST["codigo"];
    
    $atendente = new lAtendente();
    $atendente -> setCodigo($codAtendente);

    if($atendente->identifica())
    {
        echo "<b>Nome:</b>";
        echo "<br>";
        echo "<span id=infoUserNome>".$atendente->getNome()."</span>";
        echo "<br><br>";
        echo "<b>Email:</b>";
        echo "<br>";
        echo "<span id=infoUserEmail>".$atendente->getEmail()."</span>";
        echo "<br><br>";
        echo "<b>Endereço:</b>";
        echo "<br>";
        echo "<span id=infoUserEnd>".$atendente->getEndereco()."</span>";
        echo "<br>";
    }
?> 