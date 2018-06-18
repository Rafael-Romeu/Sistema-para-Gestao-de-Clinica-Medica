<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$GLOBALS['semEspaco'] = false;
$GLOBALS['tablePathAtendente'] = "./db/tAtendente.xml";

class lAtendente {

	
	public function createTableAtendente() {
		$filePathAtendente = $GLOBALS['tablePathAtendente'];

		$file = fopen($filePathAtendente, "w+");
	$template = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<root>
	<atendente>
		<codigo>A0000</codigo>
		<nome>Template</nome>
		<cpf>777.777.777-77</cpf>
		<dtNascimento>1900-01-01</dtNascimento>
		<endereco>(sem endenreço)</endereco>
		<telefone>(sem telefone)</telefone>
		<email>template@marlon.com</email>
		<senha>senha</senha>
		<reg_date>1993-05-31 11:07:47</reg_date>
	</atendente>
</root>
XML;

		fwrite($file,$template);
		fclose($file);
		$file = fopen($filePathAtendente, "r");

		if ((strcmp(fread($file, 7), "") == 0) or (fread($file, 7) == null)) {
			fclose($file);
			return 1; // ERRO ao criar a tabela
		}else {
			fclose($file);
			return 0; // Tabela criada com sucesso
		}
		
	}

	public function buscaEspacoVazio(DOMDocument $domXml) {
		
		$i = 0;
		$domLastNode;

		$domLista = $domXml->getElementsByTagName('codigo');
		foreach($domLista as $domNode) {
			$codigo = $domNode->nodeValue;
			$domLastNode = $domNode;
			$codAnterior = ("A".sprintf('%04d', $i)); $i++;

			if( strcmp($codAnterior,$codigo) != 0) {
				//print_r("retornou:".$domNode->parentNode->nodeName." codigo: ".$codigo."\n");
				$GLOBALS['semEspaco'] = false;
				return $domNode->parentNode;
			}
		}
		$GLOBALS['semEspaco'] = true;
		return $domLastNode->parentNode; // ultimo elemento da lista

	}


	public function insertAtendente($nome, $senha, $cpf, $dtNascimento=null, $endereco=null, $telefone=null, $email=null) {
		$tablePath  = $GLOBALS['tablePathAtendente'];
		
		$domXML = new DOMDocument('1.0');
		$domXML->preserveWhiteSpace = false;
		$domXML->formatOutput = true;

		if ($domXML->load($tablePath)) {
			//echo "segue o baile\n";
		}else {
			echo "\n\nTabela '". $tablePath."' não encontrada.\nCriando tabela.\n\n";
			if( createTableAtendente($tablePath) ) exit("ERRO ao criar a tabela");
			else echo "\nTabela '".$tablePath. "' criada com sucesso.\n";
			$domXML->load($tablePath);
		}

		// find the root tag
		$root = $domXML->getElementsByTagName('root')->item(0);
		// busca o primeiro espaco vazio
		$domPosition = lAtendente::buscaEspacoVazio($domXML);

		//Extrai o codigo e transforma em int
		$strCodigo = $domPosition->firstChild->nodeValue;
		$strCodigo = substr($strCodigo, 1);
		$intCodigo = intval($strCodigo);

		// create the <atendente> tag
		$atendente = $domXML->createElement('atendente');

		// append the <atendente> tag
		if ($GLOBALS['semEspaco']) {
			$codigo = "A".sprintf('%04d', $intCodigo + 1);
			$root->appendChild($atendente);
		}else {
			$codigo = "A".sprintf('%04d', $intCodigo - 1);
			$root->insertBefore($atendente, $domPosition);
		}

		// ******* Inserção do Código *******
		$codigoElement = $domXML->createElement("codigo", $codigo);
		$atendente->appendChild($codigoElement);

		// ******* Inserção do Nome *******
		if($nome == null) {
			return "ERRO: Campo 'nome' é obrigatório.";
		}
		$nomeElement = $domXML->createElement("nome", $nome);
		$atendente->appendChild($nomeElement);

		// ******* Inserção da Senha *******
		if($senha == null) {
			return "ERRO: Campo 'senha' é obrigatório.";
		}
		$senhaElement = $domXML->createElement("senha", $senha);
		$atendente->appendChild($senhaElement);

		// ******* Inserção do CPF *******
		if($cpf == null) {
			return "ERRO: Campo 'cpf' é obrigatório.";
		}
		$cpfElement = $domXML->createElement("cpf", $cpf);
		$atendente->appendChild($cpfElement);

		// ******* Inserção da Data de Nascimento *******
		if($dtNascimento == null) {
			$dtNascimento = "1900-01-01"; // Data default
		}
		$dtNascimentoElement = $domXML->createElement("dtNascimento", $dtNascimento);
		$atendente->appendChild($dtNascimentoElement);

		// ******* Inserção do Endereço *******
		if($endereco == null) {
			$endereco =  "(sem endenreço)";
		}
		$enderecoElement = $domXML->createElement("endereco", $endereco);
		$atendente->appendChild($enderecoElement);

		// ******* Inserção do Telefone *******
		if($telefone == null) {
			$telefone = "(sem telefone)";
		}
		$telefoneElement = $domXML->createElement("telefone", $telefone);
		$atendente->appendChild($telefoneElement);

		// ******* Inserção do E-mail *******
		if($email == null) {
			$email = "(sem E-mail)";
		}
		$emailElement = $domXML->createElement("email", $email);
		$atendente->appendChild($emailElement);

		// ******* Inserção da Data de Registro no Sitema *******
		$reg_dateElement = $domXML->createElement("reg_date", date("Y-m-d h:m:s",time()));
		$atendente->appendChild($reg_dateElement);


		// saves the changes into the file
		if($domXML->save($tablePath)) {
			return "Insercao realizada com sucesso!";
		}else {
			return "Erro ao inserir registro de Atendente.";
		}

	}

	public function selectAtendente($codigo = null,
									$nome = null, 
									$senha = null,
									$cpf = null,
									$dtNascimento = null,
									$endereco = null,
									$telefone = null,
									$email=null) 
	{
		$tablePath = $GLOBALS['tablePathAtendente'];

		$maisDeUmParametro = false;
		if (($codigo == null) && 
			($nome == null) &&
			($senha == null) &&
			($cpf == null) &&
			($dtNascimento == null) && 
			($endereco == null) && 
			($telefone == null) &&
			($email == null))
		{
			return "Informe ao menos um parametro para consulta.";
		}

		
		$xml=simplexml_load_file($tablePath) or die("Error: Cannot create object");
		$xPathQuery = "atendente[";
		
		if ($codigo != null) {
			$xPathQuery = $xPathQuery."codigo/text()='".$codigo."'";
			$maisDeUmParametro = true;
		} 
		if ($nome != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."nome/text()='".$nome."'";
			$maisDeUmParametro = true;
		}
		if ($senha != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."cpf/text()='".$nome."'";
			$maisDeUmParametro = true;
		}
		if ($cpf != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."cpf/text()='".$cpf."'";
			$maisDeUmParametro = true;
		}
		if ($dtNascimento != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."cpf/text()='".$dtNascimento."'";
			$maisDeUmParametro = true;
		}
		if ($endereco != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."cpf/text()='".$endereco."'";
			$maisDeUmParametro = true;
		}
		if ($telefone != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."cpf/text()='".$telefone."'";
			$maisDeUmParametro = true;
		}
		if ($email != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."email/text()='".$email."'";
			$maisDeUmParametro = true;
		}
		
		$xPathQuery = $xPathQuery."]";
		//echo $xPathQuery;

		$xml = $xml->xpath($xPathQuery);

		return $xml;
		
	}

	public function excluirAtendente($codigo) {

		$tablePath = $GLOBALS['tablePathAtendente'];
		$atendente = lAtendente::selectAtendente($codigo);

		if($atendente == null) {
			return "ERRO: Não há atendente com o código ".$codigo.".";
		}
		$domAtendente = dom_import_simplexml($atendente[0]);
		$domXML = $domAtendente->parentNode->parentNode; //  documento XML
		$domAtendente->parentNode->removeChild($domAtendente);

		if($domXML->save($tablePath)) {
			return "Exclusão efetuada com sucesso.";
		}else {
			return "ERRO: Ao salvar modificações na tabela ".$tablePath.".";
		}
	}
 

}




//$tablePathAtendente = "./db/tAtendente.xml";
//insertAtendente("MariaX","777.777.777-77" ,"123@gmail.com");

//$xml=simplexml_load_file($tablePath) or die("Error: Cannot create object");

//print_r(selectAtendente("A0000",null,"777.777.777-77"));

// SELECT * FROM tAtendente WHERE 'nome = varNome';

/*
senha
dtNascimento
end
telefone


*/

?>
