<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinicaPaciente.php";

    $atendente = new lAtendente();

	$nome          = $_REQUEST["nome"];
	$cpf           = $_REQUEST["cpf"];
	$nascimento    = $_REQUEST["bday"];
	$cep           = $_REQUEST["CEP"];
	$endereco      = $_REQUEST["endereco"];
	$senha         = $_REQUEST["senha"];
	$email         = $_REQUEST["email"];
	$telefone1     = $_REQUEST["telefone1"];
	$telefone2     = $_REQUEST["telefone2"];

	$atendente -> setNome($nome);
	$atendente -> setCpf($cpf);
	$atendente -> setDataNascimento($nascimento);
	$atendente -> setCEP($cep);
	$atendente -> setEndereco($endereco);
	$atendente -> setSenha($senha);
	$atendente -> setEmail($email);
	$atendente -> setTelefone1($telefone1);
	$atendente -> setTelefone2($telefone2);
	$atendente -> incluir();

	echo "1";

?>
