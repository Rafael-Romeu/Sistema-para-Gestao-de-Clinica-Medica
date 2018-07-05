<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lPaciente.php";

    $medico = $_REQUEST["medico"];
    $dia = $_REQUEST["dia"];
    $cpf = $_REQUEST["cpf"];
    $horario = $_REQUEST["horario"];
    $atendente = $_REQUEST["atendente"];

    $oPaciente = new lPaciente();
    $paciente = $oPaciente->getPacienteByCpf($cpf);
    $codPaciente = $paciente[0]->codigo;

    $oConsulta = new lConsulta();   

    $result = $oConsulta->insertConsultaCompleto($atendente, $medico, $codPaciente, $dia, $horario, "", "");
    
    echo $result;
?>
    