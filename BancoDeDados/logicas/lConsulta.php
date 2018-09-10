<?php

/**
 * ..:: Logica para manipulacao da tabela de Consultas ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

include_once 'lAtendente.php';
include_once 'lMedico.php';
include_once 'lPaciente.php';

class lConsulta {
/**
 * Classe de lógica para manipulação da tabela tConsulta.xml
 * 
 * @var string $codigo				Codigo de identificacao no formato "C0000"
 * @var string $codAtendente        [FK] Codigo do Atendente no formato "A0000"
 * @var string $codMedico        	[FK] Codigo do Medico no formato "M0000"
 * @var string $codPaciente       	[FK] Codigo do Paciente no formato "P0000"
 * @var string $data				Data da Consulta 1900-01-01
 * @var string $hora       			Horario da Consulta (hh:mm:ss)
 * @var string $observacao       	Observacao da Consulta
 * @var string $receita        		Receita da Consulta
 * @var string $reg_date        	Data e Hora de registro do Consulta do sistema
 * @var boolean $semEspaco			Flag para verificacao se ha espaco vazio no meio da tabela tConsulta.xml
 * @var string $tablePathConsulta	File path da tabela tConsulta.xml
 * 
 */
	public $codigo;
	public $codAtendente;
	public $codMedico;
	public $codPaciente;
	public $data;
	public $hora;
	public $observacao;
	public $receita;
	public $reg_date;
	private $semEspaco;
	private $tablePathConsulta;
	

/**
 * lConsulta
 * 
 * Construtor da classe lConsulta, que inicializa os parametros como null.
 * 
 * @param void
 * @return void
 * 
 */
	function __construct() {
        $this->codigo = null;
		$this->codAtendente = null;
		$this->codMedico = null;
		$this->codPaciente = null;
		$this->data = null;
		$this->hora = null;
		$this->observacao = null;
		$this->receita = null;
		$this->reg_date = null;
		$this->semEspaco = false;
		$this->tablePathConsulta = $_SERVER['DOCUMENT_ROOT']."/BancoDeDados/db/tConsulta.xml";
    }
	

	/**
	 * createTableConsulta
	 *
	 * Metodo para a criacao da tabela Consulta.xml, contendo o primeiro registro como Template.
	 * 
	 * @param void
	 * @return int 1|0	Retorna 1 se houve ERRO, ou 0 se a criacao da tabela foi realizada com sucesso.
	 * 
	 */
	public function createTableConsulta() {
		$filePathConsulta = $this->tablePathConsulta;
		$file = fopen($filePathConsulta, "w+");
	$template = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<root>
	<consulta>
		<codigo>C0000</codigo>
		<codAtendente>A0000</codAtendente>
		<codMedico>M0000</codMedico>
		<codPaciente>P0000</codPaciente>
		<data>1900-01-01</data>
		<hora>59:59:59</hora>
		<observacao>( sem observações )</observacao>
		<receita>( sem receituário )</receita>
		<reg_date>1993-05-31 23:59:59</reg_date>
  </consulta>
</root>
XML;
		fwrite($file,$template);
		fclose($file);
		$file = fopen($filePathConsulta, "r");
		if ((strcmp(fread($file, 7), "") == 0) or (fread($file, 7) == null)) {
			fclose($file);
			return 1; // ERRO ao criar a tabela
		}else {
			fclose($file);
			return 0; // Tabela criada com sucesso
		}
	}


	/**
	 * buscaEspacoVazio
	 * 
	 * Metodo para buscar o espaco vazio na tabela, retornando o nodo anterior ao espaco vazio, ou
	 * o ultimo nodo, caso nao haja espaco vazio.
	 * 
	 * @param DOMDocument $domXml					Objeto DOMDocument contendo o XML.
	 * @return DOMDocument $domNode|$domLastNode	Retorna o Nodo anterior ao espaco vazio OU o ultimo Nodo, caso nao haja espaco vazio.
	 *
	 */
	public function buscaEspacoVazio(DOMDocument $domXml) {
		$i = 0;
		$domLastNode;
		$domLista = $domXml->getElementsByTagName('codigo');
		foreach($domLista as $domNode) {
			$codigo = $domNode->nodeValue;
			$domLastNode = $domNode;
			$codAnterior = ("C".sprintf('%04d', $i)); $i++;
			if( strcmp($codAnterior,$codigo) != 0) {
				//print_r("retornou:".$domNode->parentNode->nodeName." codigo: ".$codigo."\n");
				$this->semEspaco = false;
				return $domNode->parentNode;
			}
		}
		$this->semEspaco = true;
		return $domLastNode->parentNode; // ultimo elemento da lista
	}


	/**
	 * traduzSimpleXMLObjectToConsulta
	 *
	 * Traduz um array de SimpleXMLObject em um array de lConsulta
	 * 
	 * @param SimpleXMLElement[] $ListSimpleXMLObject		Array de SimpleXMLObject.
	 * @return lConsulta[] $ListaConsulta					Array de lConsulta.
	 * 
	 */
	public function traduzSimpleXMLObjectToConsulta($ListSimpleXMLObject) {
		$ListaConsulta = array();
		foreach($ListSimpleXMLObject as $SimpleXMLObject) {
			$oConsulta = new lConsulta();
			$oConsulta->codigo 	  		= (string)$SimpleXMLObject->codigo;
			$oConsulta->codAtendente  	= (string)$SimpleXMLObject->codAtendente;
			$oConsulta->codMedico	  	= (string)$SimpleXMLObject->codMedico;
			$oConsulta->codPaciente	   	= (string)$SimpleXMLObject->codPaciente;
			$oConsulta->data			= (string)$SimpleXMLObject->data;
			$oConsulta->hora			= (string)$SimpleXMLObject->hora;
			$oConsulta->observacao		= (string)$SimpleXMLObject->observacao;
			$oConsulta->receita			= (string)$SimpleXMLObject->receita;
			$oConsulta->reg_date    	= (string)$SimpleXMLObject->reg_date;
			array_push($ListaConsulta, $oConsulta);
		}
		return $ListaConsulta;
	}


	/**
	 * verificaCodAtendente
	 *
	 * Verifica se o codigo informado esta no formato válido e se está presente na tabela tAtendente.xml
	 * 
	 * @param string $codAtendente		Codigo do Atendente a ser verificado.
	 * @return false|true				false Sucesso | true ERRO: Atendente nao encontrado.
	 * 
	 */
	public function verificaCodAtendente(string $codAtendente) {
		$oAtendente = new lAtendente();
		if ($oAtendente->getAtendenteByCodigo($codAtendente) == null) {
			return true; // ERRO: Atendente nao encontrado.
		}
		return false; // Sucesso
	}


	/**
	 * verificaCodMedico
	 *
	 * Verifica se o codigo informado esta no formato válido e se está presente na tabela tMedico.xml
	 * 
	 * @param string $codMedico		Codigo do Medico a ser verificado.
	 * @return false|true			false Sucesso | true ERRO: Medico nao encontrado.
	 * 
	 */
	public function verificaCodMedico(string $codMedico) {
		$oMedico = new lMedico();
		if ($oMedico->getMedicoByCodigo($codMedico) == null) {
			return true; // ERRO: Medico nao encontrado.
		}
		return false; // Sucesso
	}

	
	/**
	 * verificaCodPaciente
	 *
	 * Verifica se o codigo informado esta no formato válido e se está presente na tabela tPaciente.xml
	 * 
	 * @param string $codPaciente	Codigo do Paciente a ser verificado.
	 * @return false|true			false Sucesso | true ERRO: Paciente nao encontrado.
	 * 
	 */
	public function verificaCodPaciente(string $codPaciente) {
		$oPaciente = new lPaciente();
		if ($oPaciente->getPacienteByCodigo($codPaciente) == null) {
			return true; // ERRO: Paciente nao encontrado.
		}
		return false; // Sucesso
	}


	/**
	 * insertConsultaCompleto
	 *
	 * Salva na tabela tConsulta.xml a nova Consulta que possui os parametros informados.
	 * 
	 * @param string $codAtendente       	[FK] Codigo do Atendente no formato "A0000"
	 * @param string $codMedico        		[FK] Codigo do Medico no formato "M0000"
	 * @param string $codPaciente       	[FK] Codigo do Paciente no formato "P0000"
	 * @param string $data					Data da Consulta 1900-01-01
	 * @param string $hora       			Horario da Consulta (hh:mm:ss)
	 * @param string $observacao       		Observacao da Consulta
	 * @param string $receita        		Receita da Consulta
	 * 
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function insertConsultaCompleto(string $codAtendente, string $codMedico, string $codPaciente, string $data, string $hora , string $observacao=null, string $receita=null) {
		$tablePath  = $this->tablePathConsulta;
		$domXML = new DOMDocument('1.0');
		$domXML->preserveWhiteSpace = false;
		$domXML->formatOutput = true;
		if ($domXML->load($tablePath)) {
			//echo "segue o baile\n";
		}else {
			echo "\n\nTabela '". $tablePath."' não encontrada.\nCriando tabela...\n\n";
			if( createTableConsulta($tablePath) ) exit("ERRO ao criar a tabela");
			else echo "\nTabela '".$tablePath. "' criada com sucesso!\n";
			$domXML->load($tablePath);
		}
		$root = $domXML->getElementsByTagName('root')->item(0);
		// busca o primeiro espaco vazio
		$domPosition = lConsulta::buscaEspacoVazio($domXML);
		//Extrai o codigo e transforma em int
		$strCodigo = $domPosition->firstChild->nodeValue;
		$strCodigo = substr($strCodigo, 1);
		$intCodigo = intval($strCodigo);
		$Consulta = $domXML->createElement('consulta');
		if ($this->semEspaco) {
			$codigo = "C".sprintf('%04d', $intCodigo + 1);
			$root->appendChild($Consulta);
		}else {
			$codigo = "C".sprintf('%04d', $intCodigo - 1);
			$root->insertBefore($Consulta, $domPosition);
		}
		// ******* Inserção do Código *******
		$codigoElement = $domXML->createElement("codigo", $codigo);
		$Consulta->appendChild($codigoElement);
		// ******* Inserção do Codigo do Atendente *******
		if($codAtendente == null) {
			return "ERRO: Campo 'Código do Atendente' é obrigatório.";
		}
		if($this->verificaCodAtendente($codAtendente)) {
			return "ERRO: Atendente nao encontrado.";
		}
		$codAtendenteElement = $domXML->createElement("codAtendente", $codAtendente);
		$Consulta->appendChild($codAtendenteElement);
		// ******* Inserção da Codigo do Medico *******
		if($codMedico == null) {
			return "ERRO: Campo 'Código do Medico' é obrigatório.";
		}
		if($this->verificaCodMedico($codMedico)) {
			return "ERRO: Medico nao encontrado.";
		}
		$codMedicoElement = $domXML->createElement("codMedico", $codMedico);
		$Consulta->appendChild($codMedicoElement);
		// ******* Inserção do Codigo do Paciente *******
		if($codPaciente == null) {
			return "ERRO: Campo 'Código do Paciente' é obrigatório.";
		}
		if($this->verificaCodPaciente($codPaciente)) {
			return "ERRO: Paciente nao encontrado.";
		}
		$codPacienteElement = $domXML->createElement("codPaciente", $codPaciente);
		$Consulta->appendChild($codPacienteElement);
		// ******* Inserção da Data *******
		if($data == null) {
			return "ERRO: Campo 'Data' é obrigatório.";
		}
		$dataElement = $domXML->createElement("data", $data);
		$Consulta->appendChild($dataElement);
		// ******* Inserção da Hora *******
		if($hora == null) {
			return "ERRO: Campo 'Hora' é obrigatório.";
		}
		$horaElement = $domXML->createElement("hora", $hora);
		$Consulta->appendChild($horaElement);
		// ******* Inserção da Observação *******
		if($observacao == null) {
			$observacao = "( sem observações )"; // Observacao default
		}
		$observacaoElement = $domXML->createElement("observacao", $observacao);
		$Consulta->appendChild($observacaoElement);
		// ******* Inserção da Receita *******
		if($receita == null) {
			$receita =  "( sem receituário )";
		}
		$receitaElement = $domXML->createElement("receita", $receita);
		$Consulta->appendChild($receitaElement);
		// ******* Inserção da Data de Registro no Sitema *******
		$reg_dateElement = $domXML->createElement("reg_date", date("Y-m-d H:i:s",time()));
		$Consulta->appendChild($reg_dateElement);
		if($domXML->save($tablePath)) {
			return "Inserção realizada com sucesso!";
		}else {
			return "Erro ao inserir registro de Consulta.";
		}
	}


	
	/**
	 * selectConsulta
	 *
	 * Seleciona na tabela tConsulta.xml todos os Consultas que possuem os campos informados, retornando um array do tipo SimpleXMLElement.
	 *
	 * @param string $codigo				[Opcional] Codigo da Consulta no formato "C0000"
	 * @param string $codAtendente       	[Opcional] [FK] Codigo do Atendente no formato "A0000"
	 * @param string $codMedico        		[Opcional] [FK] Codigo do Medico no formato "M0000"
	 * @param string $codPaciente       	[Opcional] [FK] Codigo do Paciente no formato "P0000"
	 * @param string $data					[Opcional] Data da Consulta 1900-01-01
	 * @param string $hora       			[Opcional] Horario da Consulta (HH:mm:ss)
	 * @param string $observacao       		[Opcional] Observacao da Consulta
	 * @param string $receita        		[Opcional] Receita da Consulta
	 * 
	 * @return SimpleXMLElement[] $xml	Retorna um array de SimpleXMLObject contendo o resultado da consulta.
	 * 
	 */
	public function selectConsulta(string $codigo = null, string $codAtendente = null, string $codMedico = null, string $codPaciente = null, string $data = null, string $hora = null, string $observacao=null, string $receita=null, string $reg_date = null) {
		$tablePath = $this->tablePathConsulta;
		$xml=simplexml_load_file($tablePath) or die("Error: Cannot create object");
		$maisDeUmParametro = false;
		if (($codigo == null) && 
			($codAtendente == null) &&
			($codMedico == null) &&
			($codPaciente == null) &&
			($data == null) &&
			($hora == null) &&
			($observacao == null) &&
			($receita == null) &&
			($reg_date == null)
		)
		{
			$xPathQuery = "consulta";
			return $xml->xpath($xPathQuery); // Retorna um Array de SimpleXML Object, contendo os resultados 
		}
		$xPathQuery = "consulta[";
		if ($codigo != null) {
			$xPathQuery = $xPathQuery."codigo/text()='".$codigo."'";
			$maisDeUmParametro = true;
		} 
		if ($codAtendente != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."codAtendente/text()='".$codAtendente."'";
			$maisDeUmParametro = true;
		}
		if ($codMedico != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."codMedico/text()='".$codMedico."'";
			$maisDeUmParametro = true;
		}
		if ($codPaciente != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."codPaciente/text()='".$codPaciente."'";
			$maisDeUmParametro = true;
		}
		if ($data != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."data/text()='".$data."'";
			$maisDeUmParametro = true;
		}
		if ($hora != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."hora/text()='".$hora."'";
			$maisDeUmParametro = true;
		}
		if ($observacao != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."observacao/text()='".$observacao."'";
			$maisDeUmParametro = true;
		}
		if ($receita != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."receita/text()='".$receita."'";
			$maisDeUmParametro = true;
		}
		if ($reg_date != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."reg_date/text()='".$reg_date."'";
			$maisDeUmParametro = true;
		}
		$xPathQuery = $xPathQuery."]";
		$xml = $xml->xpath($xPathQuery);
		return $xml; // Retorna um Array de SimpleXML Object, contendo os resultados
	}


	/**
	 * excluirConsulta
	 *
	 * Exclui da tabela tConsulta.xml o Consulta que possui o codigo informado.
	 * 
	 * @param string $codigo			Codigo do Consulta a ser excluido da tabela.
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function excluirConsulta(string $codigo) {
		$tablePath = $this->tablePathConsulta;
		$Consulta = $this->selectConsulta($codigo);
		if($Consulta == null) {
			return "ERRO: Não há Consulta com o código ".$codigo.".";
		}
		$domConsulta = dom_import_simplexml($Consulta[0]);
		$domXML = $domConsulta->parentNode->parentNode; //  documento XML
		$domConsulta->parentNode->removeChild($domConsulta);
		if($domXML->save($tablePath)) {
			return "Exclusão efetuada com sucesso!";
		}else {
			return "ERRO: Ao salvar modificações na tabela ".$tablePath.".";
		}
	}


	/**
	 * updateConsultaCompleto
	 *
	 * Salva na tabela tConsulta.xml as alteracoes no Consulta que possui o codigo informado.
	 * 
	 * @param string $codigo				[Opcional] Codigo da Consulta no formato "C0000"
	 * @param string $codAtendente       	[Opcional] [FK] Codigo do Atendente no formato "A0000"
	 * @param string $codMedico        		[Opcional] [FK] Codigo do Medico no formato "M0000"
	 * @param string $codPaciente       	[Opcional] [FK] Codigo do Paciente no formato "P0000"
	 * @param string $data					[Opcional] Data da Consulta 1900-01-01
	 * @param string $hora       			[Opcional] Horario da Consulta (HH:mm:ss)
	 * @param string $observacao       		[Opcional] Observacao da Consulta
	 * @param string $receita        		[Opcional] Receita da Consulta
	 * 
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function updateConsultaCompleto(string $codigo, string $codAtendente = null, string $codMedico = null, string $codPaciente = null, string $data = null, string $hora = null, string $observacao=null, string $receita=null) {
		$tablePath = $this->tablePathConsulta;
		$houveAlteracao = false;
		$Consulta = $this->selectConsulta($codigo);
		if($Consulta == null) {
			return "ERRO: Não há Consulta com o código ".$codigo.".";
		}
		$Consulta = $Consulta[0];
		if(($Consulta->codigo != $codigo) or ($codigo == null)) {
			return "ERRO: Código da Consulta invalido.";
		}
		if(($Consulta->codAtendente != $codAtendente) and ($codAtendente != null)) {
			if($this->verificaCodAtendente($codAtendente)) {
				return "ERRO: Atendente nao encontrado.";
			}
			$Consulta->codAtendente = $codAtendente;
			$houveAlteracao = true;
		}
		if(($Consulta->codMedico != $codMedico) and ($codMedico != null)) {
			if($this->verificaCodMedico($codMedico)) {
				return "ERRO: Médico nao encontrado.";
			}
			$Consulta->codMedico = $codMedico;
			$houveAlteracao = true;
		}
		if(($Consulta->codPaciente != $codPaciente) and ($codPaciente != null)) {
			if($this->verificaCodPaciente($codPaciente)) {
				return "ERRO: Paciente nao encontrado.";
			}
			$Consulta->codPaciente = $codPaciente;
			$houveAlteracao = true;
		}
		if(($Consulta->data != $data) and ($data != null)) {
			$Consulta->data = $data;
			$houveAlteracao = true;
		}
		if(($Consulta->hora != $hora) and ($hora != null)) {
			$Consulta->hora = $hora;
			$houveAlteracao = true;
		}
		if(($Consulta->observacao != $observacao) and ($observacao != null)) {
			$Consulta->observacao = $observacao;
			$houveAlteracao = true;
		}
		if(($Consulta->receita != $receita) and ($receita != null)) {
			$Consulta->receita = $receita;
			$houveAlteracao = true;
		}
		if(!$houveAlteracao) {
			return "Não houve alteração";
		}
		$domConsulta = dom_import_simplexml($Consulta);
		$domXML = $domConsulta->parentNode->parentNode; //  documento XML
		// Salva as alterações na tabela
		if($domXML->save($tablePath)) {
			return "Alteração efetuada com sucesso!";
		}else {
			return "ERRO: Ao salvar modificações na tabela ".$tablePath.".";
		}
	}


	/**
	 * insertConsulta
	 *
	 * Salva na tabela tConsulta.xml os atributos do objeto desta classe
	 * 
	 * @param void
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function insertConsulta() {
		$msgRetorno = $this->insertConsultaCompleto($this->codAtendente, 
													$this->codMedico, 
													$this->codPaciente,
													$this->data,
													$this->hora,
													$this->observacao,
													$this->receita
		);
		if (strcmp($msgRetorno, "Insercão realizada com sucesso!") != 0) {
			return $msgRetorno; // Significa que deu erro.
		}
		$this->codigo = $this->getCodigoByConsulta($this);
		$this->reg_date = $this->getConsultaByCodigo($this->codigo)[0]->reg_date;
		return $msgRetorno;
	}


	/**
	 * updateConsulta
	 *
	 * Salva na tabela tConsulta.xml as alteracoes presentes nos atributos do objeto desta classe.
	 * 
	 * @param void
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function updateConsulta() {
		if($this->codigo == null) {
			return "ERRO: Código do Consulta invalido.";
		}
		return $this->updateConsultaCompleto(	$this->codigo,
												$this->codAtendente, 
												$this->codMedico,
												$this->codPaciente,
												$this->data,
												$this->hora,
												$this->observacao,
												$this->receita
			);
	}


	/**
	 * clearConsulta
	 *
	 * Limpa os atributos do objeto da classe lConsulta.
	 * 
	 * @param void
	 * @return void
	 * 
	 */
	public function clearConsulta() {
		$this->codigo = null;
		$this->codAtendente = null;
		$this->codMedico = null;
		$this->codPaciente = null;
		$this->data = null;
		$this->hora = null;
		$this->observacao = null;
		$this->receita = null;
		$this->reg_date = null;
	}


	/**
	 * getConsultaByCodigo
	 * 
	 * Busca os Consultas que possuem o codigo informado e retorna um array com objetos da classe lConsulta.
	 * 
	 * @param string $codigo				Codigo do Consulta a ser buscada.
	 * @return lConsulta[] $ListaConsulta	Retorna um array de objetos da classe lConsulta.
	 * 
	 */
	public function getConsultaByCodigo(string $codigo) {
		$ListSimpleXMLObject = $this->selectConsulta($codigo);
		$ListaConsultas = $this->traduzSimpleXMLObjectToConsulta($ListSimpleXMLObject);
		return $ListaConsultas;
	}


	/**
	 * getConsultaByCodAtendente
	 *
	 * Busca os Consultas que possuem o codAtendente informado e retorna um array com objetos da classe lConsulta.
	 * 
	 * @param string $codAtendente				Codigo do Atendente na Consulta a ser buscada.
	 * @return lConsulta[] $ListaConsulta		Retorna um array de objetos da classe lConsulta.
	 * 
	 */
	public function getConsultaByCodAtendente(string $codAtendente) {
		$ListSimpleXMLObject = $this->selectConsulta(null, $codAtendente);
		$ListaConsultas = $this->traduzSimpleXMLObjectToConsulta($ListSimpleXMLObject);
		return $ListaConsultas;
	}


	/**
	 * getConsultaByCodMedico
	 * 
	 * Busca os Consultas que possuem o codMedico informado e retorna um array com objetos da classe lConsulta.
	 * 
	 * @param string $codMedico				Codigo do Medico na Consulta a ser buscada.
	 * @return lConsulta[] $ListaConsulta	Retorna um array de objetos da classe lConsulta.
	 * 
	 */
	public function getConsultaByCodMedico(string $codMedico) {
		$ListSimpleXMLObject = $this->selectConsulta(null, null, $codMedico);
		$ListaConsultas = $this->traduzSimpleXMLObjectToConsulta($ListSimpleXMLObject);
		return $ListaConsultas;
	}


	/**
	 * getConsultaByCodPaciente
	 * 
	 * Busca os Consultas que possuem o codPaciente informado e retorna um array com objetos da classe lConsulta.
	 * 
	 * @param string $codPaciente			Codigo do Paciente na Consulta a ser buscada.
	 * @return lConsulta[] $ListaConsulta	Retorna um array de objetos da classe lConsulta.
	 * 
	 */
	public function getConsultaByCodPaciente(string $codPaciente) {
		$ListSimpleXMLObject = $this->selectConsulta(null, null, null, $codPaciente);
		$ListaConsultas = $this->traduzSimpleXMLObjectToConsulta($ListSimpleXMLObject);
		return $ListaConsultas;
	}


	/**
	 * getConsultaByData
	 * 
	 * Busca os Consultas que possuem a data informada e retorna um array com objetos da classe lConsulta.
	 * 
	 * @param string $data					Data na Consulta a ser buscada.
	 * @return lConsulta[] $ListaConsulta	Retorna um array de objetos da classe lConsulta.
	 * 
	 */
	public function getConsultaByData(string $data) {
		$ListSimpleXMLObject = $this->selectConsulta(null, null, null, null, $data);
		$ListaConsultas = $this->traduzSimpleXMLObjectToConsulta($ListSimpleXMLObject);
		return $ListaConsultas;
	}


	/**
	 * getConsultaByHora
	 * 
	 * Busca os Consultas que possuem a hora informada e retorna um array com objetos da classe lConsulta.
	 * 
	 * @param string $hora						Hora na Consulta a ser buscada.
	 * @return lConsulta[] $ListaConsulta		Retorna um array de objetos da classe lConsulta.
	 * 
	 */
	public function getConsultaByHora(string $hora) {
		$ListSimpleXMLObject = $this->selectConsulta(null, null, null, null, null, $hora);
		$ListaConsultas = $this->traduzSimpleXMLObjectToConsulta($ListSimpleXMLObject);
		return $ListaConsultas;
	}


	/**
	 * getConsultaByObservacao
	 *
	 * Busca os Consultas que possuem a observacao informada e retorna um array com objetos da classe lConsulta.
	 * 
	 * @param string $observacao			Observacao na Consulta a ser buscada.
	 * @return lConsulta[] $ListaConsulta	Retorna um array de objetos da classe lConsulta.
	 * 
	 */
	public function getConsultaByObservacao($observacao) {
		$ListSimpleXMLObject = $this->selectConsulta(null, null, null,  null, null, null, $observacao);
		$ListaConsultas = $this->traduzSimpleXMLObjectToConsulta($ListSimpleXMLObject);
		return $ListaConsultas;
	}


	/**
	 * getConsultaByReceita
	 *
	 * Busca os Consultas que possuem a receita informada e retorna um array com objetos da classe lConsulta.
	 * 
	 * @param string $receita				Receita na Consulta a ser buscada.
	 * @return lConsulta[] $ListaConsulta	Retorna um array de objetos da classe lConsulta.
	 * 
	 */
	public function getConsultaByReceita($receita) {
		$ListSimpleXMLObject = $this->selectConsulta(null, null, null, null, null, null, null, $receita);
		$ListaConsultas = $this->traduzSimpleXMLObjectToConsulta($ListSimpleXMLObject);
		return $ListaConsultas;
	}


	/**
	 * getCodigoByConsulta
	 *
	 * Busca a Consulta informado e retorna uma string com o seu codigo.
	 * 
	 * @param lConsulta $oConsulta		Objeto da classe lConsulta.
	 * @return string $codigo			Retorna o Codigo da Consulta (em string).
	 * 
	 */
	public function getCodigoByConsulta(lConsulta $oConsulta) {
		$temp = $this->selectConsulta (null,
										$oConsulta->codAtendente,
										$oConsulta->codMedico,
										$oConsulta->codPaciente,
										$oConsulta->data,
										$oConsulta->hora,
										$oConsulta->observacao,
										$oConsulta->receita
									   );
		$codigo = (string) $temp[0]->codigo;
		return $codigo;
	}


	/**
	 * getTabela
	 *
	 * Retorna toda a tabela tConsulta em um array de objetos da classe lConsulta.
	 * 
	 * @param void
	 * @return array lConsulta 	Array de objetos da classe lConsulta
	 * 
	 */
	public function getTabela(){
		return $this->traduzSimpleXMLObjectToConsulta($this->selectConsulta());
	}
}

?>
