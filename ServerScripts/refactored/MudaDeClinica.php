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

	$_SESSION['corPrimaria'] = $clinica->getCorPrimaria();
	$_SESSION['corSucesso'] = $clinica->getCorSucesso();
	$_SESSION['corFalha'] = $clinica->getCorFalha();
	$_SESSION['cor1'] = $clinica->getCor1();
	$_SESSION['cor2'] = $clinica->getCor2();
	$_SESSION['cor3'] = $clinica->getCor3();
	$_SESSION['cor4'] = $clinica->getCor4();
	$_SESSION['cor5'] = $clinica->getCor5();

?>
