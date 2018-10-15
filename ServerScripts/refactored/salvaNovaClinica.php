<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
	include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";

	$nome          = $_REQUEST["nome"];
	$cnpj           = $_REQUEST["cnpj"];
	$cep           = $_REQUEST["CEP"];
	$endereco      = $_REQUEST["endereco"];
	$senha         = $_REQUEST["senha"];
	$email         = $_REQUEST["email"];
	$telefone1     = $_REQUEST["telefone1"];
	$telefone2     = $_REQUEST["telefone2"];
	
	$corPrimaria = "#" . $_REQUEST["corPrimaria"];
	$corSucesso =  "#" . $_REQUEST["corSucesso"];
	$corFalha =    "#" . $_REQUEST["corFalha"];
	$cor1 = 	   "#" . $_REQUEST["cor1"];
	$cor2 = 	   "#" . $_REQUEST["cor2"];
	$cor3 = 	   "#" . $_REQUEST["cor3"];
	$cor4 = 	   "#" . $_REQUEST["cor4"];
	$cor5 = 	   "#" . $_REQUEST["cor5"];
	
    $clinica = new lClinica();
	$clinica -> setNome($nome);
	$clinica -> setCnpj($cnpj);
	$clinica -> setCEP($cep);
	$clinica -> setEndereco($endereco);
	$clinica -> setEmail($email);
	$clinica -> setTelefone1($telefone1);
	$clinica -> setTelefone2($telefone2);
	$clinica -> setCorPrimaria($corPrimaria);
	$clinica -> setCorSucesso($corSucesso);
	$clinica -> setCorFalha($corFalha);
	$clinica -> setCor1($cor1);
	$clinica -> setCor2($cor2);
	$clinica -> setCor3($cor3);
	$clinica -> setCor4($cor4);
	$clinica -> setCor5($cor5);
	$clinica -> executeINSERT();


	$admin = new lAtendente();
	$admin -> setNome($nome . " Admin");
	$admin -> setCpf($cnpj);
	$admin -> setDataNascimento("1950-01-01");
	$admin -> setCEP($cep);
	$admin -> setEndereco($endereco);
	$admin -> setSenha($senha);
	$admin -> setEmail($email);
	$admin -> setTelefone1($telefone1);
	$admin -> setTelefone2($telefone2);
	$admin -> incluir();




	$admin = new lAtendente();
	$admin -> setCpf($cnpj);
	$admin -> identifica();

	$clinica = new lClinica();
	$clinica -> setCnpj($cnpj);
	$clinica -> identifica();
	$codClinica = $clinica -> getCodigo();

	$admin->setCodClinica($codClinica);
	$admin->alterar();
	
	echo 1;
?>
