<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$GLOBALS['filePathAtendente'] = "./db/tAtendente.xml";
$GLOBALS['semEspaco'] = false;

function buscaEspacoVazio(DOMDocument $domXml) {
	
	$i = 0;
	$domLastNode;

	$domLista = $domXml->getElementsByTagName('codigo');
	foreach($domLista as $domNode) {
		$codigo = $domNode->nodeValue;
		$domLastNode = $domNode;
		$codAnterior = ("A".sprintf('%04d', $i)); $i++;

		if( strcmp($codAnterior,$codigo) != 0) {
			print_r("retornou:".$domNode->parentNode->nodeName." codigo: ".$codigo."\n");
			return $domNode->parentNode;
		}
	}
	$GLOBALS['semEspaco'] = true;
	return $domLastNode->parentNode; // ultimo elemento da lista

}


function insertAtendente($name, $email) {
	$domXML = new DOMDocument('1.0');
	$domXML->preserveWhiteSpace = false;
	$domXML->formatOutput = true;

	$domXML->load($GLOBALS['filePathAtendente']);

	// find the root tag
	$root = $domXML->getElementsByTagName('root')->item(0);
	// busca o primeiro espaco vazio
	$domPosition = buscaEspacoVazio($domXML);

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
	$emailElement = $domXML->createElement("email", $email);
	$atendente->appendChild($emailElement);
	$dateElement = $domXML->createElement("reg_date", date("Y-m-d h:m:s",time()));
	$atendente->appendChild($dateElement);

	// saves the changes into the file
	$domXML->save($GLOBALS['filePathAtendente']);

};

insertAtendente("MariaX", "123@gmail.com");

$xml=simplexml_load_file($GLOBALS['filePathAtendente']) or die("Error: Cannot create object");
print_r($xml);

?>