<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinicaPaciente.php";

	$codigo = $_REQUEST["codigo"];

	$oMedico = new lMedico();
	$oMedico->setCodigo($codigo);
	$oMedico->identifica();

	$nome          = $_REQUEST["nome"];
	$cpf           = $_REQUEST["cpf"];
	$nascimento    = $_REQUEST["bday"];
	$cep           = $_REQUEST["CEP"];
	$endereco      = $_REQUEST["endereco"];
	$senha         = $_REQUEST["senha"];
	$email         = $_REQUEST["email"];
	$telefone1     = $_REQUEST["telefone1"];
	$telefone2     = $_REQUEST["telefone2"];
	$planoDeSaude  = $_REQUEST["planoDeSaude"];

	$oMedico -> setNome($nome);
	$oMedico -> setCpf($cpf);
	$oMedico -> setDataNascimento($nascimento);
	$oMedico -> setCEP($cep);
	$oMedico -> setSenha($senha);
	$oMedico -> setEmail($email);
	$oMedico -> setTelefone1($telefone1);
	$oMedico -> setTelefone2($telefone2);
	$oMedico -> setPlanoDeSaude($planoDeSaude);
	
	$oMedico -> alterar();

	session_start();
	$codClinica = $_SESSION['codClinica'];
	$nomeClinica = $_SESSION['nomeClinica'];

	$_SESSION = array();
	$_SESSION['tipo'] = "lMedico";
	$_SESSION['cpf'] = $cpf;
	$_SESSION['nome'] = $nome;
	$_SESSION['dtNascimento'] = $nascimento;
	$_SESSION['endereco'] = $endereco;
	$_SESSION['telefone1'] = $telefone1;
	$_SESSION['telefone2'] = $telefone2;
	$_SESSION['email'] = $email;
	$_SESSION['planoDeSaude'] = $planoDeSaude;
	
	$_SESSION['codClinica'] = $codClinica;
	$_SESSION['nomeClinica'] = $nomeClinica;

?>
