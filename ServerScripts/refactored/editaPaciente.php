<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinicaPaciente.php";

	$codigo = $_REQUEST["codigo"];

	$oPaciente = new lPaciente();
	$oPaciente->setCodigo($codigo);
	$oPaciente->identifica();

	$nome          = $_REQUEST["nome"];
	$cpf           = $_REQUEST["cpf"];
	$nascimento    = $_REQUEST["bday"];
	$genero        = $_REQUEST["genero"];
	$cep           = $_REQUEST["CEP"];
	$endereco      = $_REQUEST["endereco"];
	$senha         = $_REQUEST["senha"];
	$email         = $_REQUEST["email"];
	$telefone1     = $_REQUEST["telefone1"];
	$telefone2     = $_REQUEST["telefone2"];
	$planoDeSaude  = $_REQUEST["planoDeSaude"];
	$tipoSanguineo = $_REQUEST["tipoSanguineo"];

	$oPaciente -> setNome($nome);
	$oPaciente -> setCpf($cpf);
	$oPaciente -> setDataNascimento($nascimento);
	$oPaciente -> setCEP($cep);
	$oPaciente -> setGenero($genero);
	$oPaciente -> setSenha($senha);
	$oPaciente -> setEmail($email);
	$oPaciente -> setTelefone1($telefone1);
	$oPaciente -> setTelefone2($telefone2);
	$oPaciente -> setPlanoDeSaude($planoDeSaude);
	$oPaciente -> setTipoSanguineo($tipoSanguineo);
	
	$oPaciente -> alterar();

	session_start();
	$codClinica = $_SESSION['codClinica'];
	$nomeClinica = $_SESSION['nomeClinica'];

	$_SESSION = array();
	$_SESSION['tipo'] = "lPaciente";
	$_SESSION['cpf'] = $cpf;
	$_SESSION['nome'] = $nome;
	$_SESSION['dtNascimento'] = $nascimento;
	$_SESSION['endereco'] = $endereco;
	$_SESSION['telefone1'] = $telefone1;
	$_SESSION['telefone2'] = $telefone2;
	$_SESSION['email'] = $email;
	$_SESSION['tipoSanguineo'] = $tipoSanguineo;
	$_SESSION['genero'] = $genero;
	$_SESSION['planoDeSaude'] = $planoDeSaude;
	
	$_SESSION['codClinica'] = $codClinica;
	$_SESSION['nomeClinica'] = $nomeClinica;

?>
