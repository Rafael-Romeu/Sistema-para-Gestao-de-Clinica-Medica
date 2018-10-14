<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinicaPaciente.php";

    $medico = new lMedico();

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

	$medico -> setNome($nome);
	$medico -> setCpf($cpf);
	$medico -> setDataNascimento($nascimento);
	$medico -> setCEP($cep);
	$medico -> setEndereco($endereco);
	$medico -> setSenha($senha);
	$medico -> setEmail($email);
	$medico -> setTelefone1($telefone1);
	$medico -> setTelefone2($telefone2);
	$medico -> setPlanoDeSaude($planoDeSaude);
	$medico -> incluir();

	echo "1";

?>
