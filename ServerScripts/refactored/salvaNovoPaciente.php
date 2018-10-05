<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinicaPaciente.php";

    $oPaciente = new lPaciente();

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
	$clinicas      = $_REQUEST["clinicas"];

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
	
	$oPaciente -> incluir();

	$oPaciente = new lPaciente();
	
	$oPaciente -> setCpf($cpf);
	if($oPaciente -> identifica())
	{
		for ($i=0; $i < strlen($clinicas); $i++) 
		{ 
			$codClinica = (int)substr($clinicas, $i, 1);
	
			$oClinicaPaciente = new lClinicaPaciente();
			$oClinicaPaciente -> SetCodClinica($codClinica);
			$oClinicaPaciente -> setCodPaciente($oPaciente->getCodigo());
			$oClinicaPaciente -> incluir();
		}
	}
?>
