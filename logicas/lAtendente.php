<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$GLOBALS['semEspaco'] = false;
$GLOBALS['tablePath'] = "./db/tAtendente.xml";

class lAtendente {

	
	public function createTableAtendente() {
		$filePathAtendente = $GLOBALS['tablePath'];

		$file = fopen($filePathAtendente, "w+");
	$template = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<root>
	<atendente>
		<codigo>A0000</codigo>
		<nome>Template</nome>
		<cpf>777.777.777-77</cpf>
		<email>template@marlon.com</email>
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


	public function insertAtendente($name, $cpf, $email=none) {
		$tablePath  = $GLOBALS['tablePath'];
		
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

		// create other elements and add it to the <atendente> tag.
		$codigoElement = $domXML->createElement("codigo", $codigo);
		$atendente->appendChild($codigoElement);
		$nomeElement = $domXML->createElement("nome", $name);
		$atendente->appendChild($nomeElement);
		$cpfElement = $domXML->createElement("cpf", $cpf);
		$atendente->appendChild($cpfElement);
		$emailElement = $domXML->createElement("email", $email);
		$atendente->appendChild($emailElement);
		$dateElement = $domXML->createElement("reg_date", date("Y-m-d h:m:s",time()));
		$atendente->appendChild($dateElement);

		// saves the changes into the file
		if($domXML->save($tablePath)) {
			return "Insercao realizada com sucesso!";
		}else {
			return "Erro ao inserir registro de Atendente.";
		}

	}

	public function selectAtendente( $codigo = null, $nome = null, $cpf = null, $email = null) {
		$tablePath = $GLOBALS['tablePath'];

		$maisDeUmParametro = false;
		if (($codigo == null) && ($nome == null) && ($cpf == null) && ($email == null)) {
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
		if ($cpf != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."cpf/text()='".$cpf."'";
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


}




//$tablePath = "./db/tAtendente.xml";
//insertAtendente("MariaX","777.777.777-77" ,"123@gmail.com");

//$xml=simplexml_load_file($tablePath) or die("Error: Cannot create object");

//print_r(selectAtendente("A0000",null,"777.777.777-77"));

// SELECT * FROM tAtendente WHERE 'nome = varNome';

?>
