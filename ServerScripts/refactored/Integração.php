<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Sistema-para-Gestao-de-Clinica-Medica/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Sistema-para-Gestao-de-Clinica-Medica/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Sistema-para-Gestao-de-Clinica-Medica/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Sistema-para-Gestao-de-Clinica-Medica/BancoDeDados/MySQL/logicas/lAtendente.php";


    $oConsulta = new lConsulta();
    $oMedico = new lMedico();
    $oPaciente = new lPaciente();
    $oAtendente = new lAtendente();

	//$codAtendente = $_REQUEST["atendente"];
	$codAtendente = "1";
	$codMedico = "1";
	$codPaciente = "1";	
	$codClinica = "1";

	$oConsulta -> setFlagConfirmada(1);//0 OU 1
	$oConsulta -> setCodAtendente($codAtendente);
	$oConsulta -> setCodClinica($codClinica);
	$oConsulta -> setCodMedico($codMedico);
	$oConsulta -> setCodPaciente($codPaciente);
	$oConsulta -> setData("2018-01-01");
	$oConsulta -> setHora("09-03-00");

	echo $oConsulta -> incluir();

	
	
?>
