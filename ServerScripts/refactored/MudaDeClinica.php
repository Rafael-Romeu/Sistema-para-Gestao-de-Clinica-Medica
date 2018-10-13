<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinicaPaciente.php";

	$codigo = $_REQUEST["codClinica"];

	$clinica = new lClinica();
	$clinica->setCodigo($codigo);
	$clinica->identifica();
	$nome = $clinica->getNome();

	session_start();
	
	$_SESSION['codClinica'] = $codigo;
	$_SESSION['nomeClinica'] = $nome;

?>
