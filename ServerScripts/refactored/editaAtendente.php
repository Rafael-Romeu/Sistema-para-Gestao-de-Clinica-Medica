<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinicaPaciente.php";

	$codigo = $_REQUEST["codigo"];

	$oAtendente = new lAtendente();
	$oAtendente->setCodigo($codigo);
	$oAtendente->identifica();

	$nome          = $_REQUEST["nome"];
	$cpf           = $_REQUEST["cpf"];
	$nascimento    = $_REQUEST["bday"];
	$cep           = $_REQUEST["CEP"];
	$endereco      = $_REQUEST["endereco"];
	$senha         = $_REQUEST["senha"];
	$email         = $_REQUEST["email"];
	$telefone1     = $_REQUEST["telefone1"];
	$telefone2     = $_REQUEST["telefone2"];

	$oAtendente -> setNome($nome);
	$oAtendente -> setCpf($cpf);
	$oAtendente -> setDataNascimento($nascimento);
	$oAtendente -> setCEP($cep);
	$oAtendente -> setSenha($senha);
	$oAtendente -> setEmail($email);
	$oAtendente -> setTelefone1($telefone1);
	$oAtendente -> setTelefone2($telefone2);
	
	$oAtendente -> alterar();

	session_start();
	$codClinica = $_SESSION['codClinica'];
	$nomeClinica = $_SESSION['nomeClinica'];

	$_SESSION = array();
	$_SESSION['tipo'] = "lAtendente";
	$_SESSION['cpf'] = $cpf;
	$_SESSION['nome'] = $nome;
	$_SESSION['dtNascimento'] = $nascimento;
	$_SESSION['endereco'] = $endereco;
	$_SESSION['telefone1'] = $telefone1;
	$_SESSION['telefone2'] = $telefone2;
	$_SESSION['email'] = $email;
	
	$_SESSION['codClinica'] = $codClinica;
	$_SESSION['nomeClinica'] = $nomeClinica;

?>
