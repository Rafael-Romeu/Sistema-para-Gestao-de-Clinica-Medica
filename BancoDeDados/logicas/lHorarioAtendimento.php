<?php

/**
 * ..:: Logica para manipulacao da tabela de HorarioAtendimentos ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

include_once 'lMedico.php';

class lHorarioAtendimento {
/**
 * Classe de lógica para manipulação da tabela tHorarioAtendimento.xml
 * 
 * @var string $codigo				Codigo do Horario no formato "H0000"
 * @var string $codMedico        	[FK] Codigo do Medico no formato "M0000"
 * @var string $seg					Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
 * @var string $ter					Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
 * @var string $qua					Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
 * @var string $qui 				Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
 * @var string $sex					Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
 * @var string $reg_date        	Data e Hora de registro do HorarioAtendimento do sistema
 * @var boolean $semEspaco			Flag para verificacao se ha espaco vazio no meio da tabela tHorarioAtendimento.xml
 * @var string $tablePathHorarioAtendimento	File path da tabela tHorarioAtendimento.xml
 * 
 */

	public $codigo;
	public $codMedico;
	public $seg;
	public $ter;
	public $qua;
	public $qui;
	public $sex;
	public $reg_date;
	private $semEspaco;
	private $tablePathHorarioAtendimento;
	
/**
 * lHorarioAtendimento
 * 
 * Construtor da classe lHorarioAtendimento, que inicializa os parametros como null.
 * 
 * @param void
 * @return void
 * 
 */
	function __construct() {
		$this->codigo = null;
		$this->codMedico = null;
		$this->seg = null;
		$this->ter = null;
		$this->qua = null;
		$this->qui = null;
		$this->sex = null;
		$this->reg_date = null;
		$this->semEspaco = false;
		$this->tablePathHorarioAtendimento = $_SERVER['DOCUMENT_ROOT']."/BancoDeDados/db/tHorarioAtendimento.xml";
    }
	

	/**
	 * createTableHorarioAtendimento
	 *
	 * Metodo para a criacao da tabela HorarioAtendimento.xml, contendo o primeiro registro como Template.
	 * 
	 * @param void
	 * @return int 1|0	Retorna 1 se houve ERRO, ou 0 se a criacao da tabela foi realizada com sucesso.
	 * 
	 */
	public function createTableHorarioAtendimento() {
		$filePathHorarioAtendimento = $this->tablePathHorarioAtendimento;
		// 22 valores de horario por dia da semana
		// codificacao em uma sequencia de 22 caracteres: 
		// 0000000000000000000000
		// onde o '0' representa um horario não utilizado, e '1' representa um horário utilizado
		$file = fopen($filePathHorarioAtendimento, "w+");
	$template = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<root>
	<horarioAtendimento>
		<codigo>H0000</codigo>
		<codMedico>M0000</codMedico>
		<seg>0000000000000000000000</seg>
		<ter>0000000000000000000000</ter>
		<qua>0000000000000000000000</qua>
		<qui>0000000000000000000000</qui>
		<sex>0000000000000000000000</sex>
		<reg_date>1993-05-31 23:59:59</reg_date>
	</horarioAtendimento>
</root>
XML;
		fwrite($file,$template);
		fclose($file);
		$file = fopen($filePathHorarioAtendimento, "r");
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
			$codMedico = $domNode->nodeValue;
			$domLastNode = $domNode;
			$codAnterior = ("H".sprintf('%04d', $i)); $i++;
			if( strcmp($codAnterior,$codMedico) != 0) {
				//print_r("retornou:".$domNode->parentNode->nodeName." codMedico: ".$codMedico."\n");
				$this->semEspaco = false;
				return $domNode->parentNode;
			}
		}
		$this->semEspaco = true;
		return $domLastNode->parentNode; // ultimo elemento da lista
	}


	/**
	 * traduzSimpleXMLObjectToHorarioAtendimento
	 *
	 * Traduz um array de SimpleXMLObject em um array de lHorarioAtendimento
	 * 
	 * @param SimpleXMLElement[] $ListSimpleXMLObject			Array de SimpleXMLObject.
	 * @return lHorarioAtendimento[] $ListaHorarioAtendimento	Array de lHorarioAtendimento.
	 * 
	 */
	public function traduzSimpleXMLObjectToHorarioAtendimento($ListSimpleXMLObject) {
		$ListaHorarioAtendimento = array();
		foreach($ListSimpleXMLObject as $SimpleXMLObject) {
			$oHorarioAtendimento = new lHorarioAtendimento();
			$oHorarioAtendimento->codigo		= (string)$SimpleXMLObject->codigo;
			$oHorarioAtendimento->codMedico	  	= (string)$SimpleXMLObject->codMedico;
			$oHorarioAtendimento->seg			= (string)$SimpleXMLObject->seg;
			$oHorarioAtendimento->ter			= (string)$SimpleXMLObject->ter;
			$oHorarioAtendimento->qua			= (string)$SimpleXMLObject->qua;
			$oHorarioAtendimento->qui			= (string)$SimpleXMLObject->qui;
			$oHorarioAtendimento->sex			= (string)$SimpleXMLObject->sex;
			$oHorarioAtendimento->reg_date    	= (string)$SimpleXMLObject->reg_date;
			array_push($ListaHorarioAtendimento, $oHorarioAtendimento);
		}
		return $ListaHorarioAtendimento;
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
			return true; // "ERRO: Medico nao encontrado.";
		}
		// print_r(count($this->getHorarioAtendimentoByCodMedico($codMedico)));
		if(count($this->getHorarioAtendimentoByCodMedico($codMedico)) != 0){
			return true; // "ERRO: Horario de atendimento ja cadastrado.";
		}
		return false; // Sucesso
	}


	public function verificaFormatoHorario(string $horario){
		// print_r($horario);
		if(strlen($horario) != 22) {
			return true; // "ERRO: Tamanho do horario deve ser 22 caracteres";
		}
		$horario = str_split($horario);
		// print_r($horario);
		for ($i = 0; $i < 22; $i++) {
			$char = $horario[$i];
			if(($char != '0') && ($char != '1')) {
				return true; // "ERRO: Formato do horario inválido.";
			}
		}
		return false; // Sucesso
	}

	/**
	 * insertHorarioAtendimentoCompleto
	 *
	 * Salva na tabela tHorarioAtendimento.xml a nova HorarioAtendimento que possui os parametros informados.
	 * 
	 * @param string $codMedico        	[FK] Codigo do Medico no formato "M0000"
	 * @param string $seg       		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $ter				Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $qua       		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $qui       		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $sex        		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * 
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function insertHorarioAtendimentoCompleto( string $codMedico, string $seg, string $ter, string $qua , string $qui, string $sex ) {
		$tablePath  = $this->tablePathHorarioAtendimento;
		$domXML = new DOMDocument('1.0');
		$domXML->preserveWhiteSpace = false;
		$domXML->formatOutput = true;
		if ($domXML->load($tablePath)) {
			//echo "segue o baile\n";
		}else {
			echo "\n\nTabela '". $tablePath."' não encontrada.\nCriando tabela...\n\n";
			if( createTableHorarioAtendimento($tablePath) ) exit("ERRO ao criar a tabela");
			else echo "\nTabela '".$tablePath. "' criada com sucesso!\n";
			$domXML->load($tablePath);
		}
		$root = $domXML->getElementsByTagName('root')->item(0);
		// busca o primeiro espaco vazio
		$domPosition = lHorarioAtendimento::buscaEspacoVazio($domXML);
		//Extrai o codigo e transforma em int
		$strCodigo = $domPosition->firstChild->nodeValue;
		$strCodigo = substr($strCodigo, 1);
		$intCodigo = intval($strCodigo);
		$HorarioAtendimento = $domXML->createElement('horarioAtendimento');
		if ($this->semEspaco) {
			$codigo = "H".sprintf('%04d', $intCodigo + 1);
			$root->appendChild($HorarioAtendimento);
		}else {
			$codigo = "H".sprintf('%04d', $intCodigo - 1);
			$root->insertBefore($HorarioAtendimento, $domPosition);
		}
		// ******* Inserção do Código *******
		$codigoElement = $domXML->createElement("codigo", $codigo);
		$HorarioAtendimento->appendChild($codigoElement);
		// ******* Inserção da Codigo do Medico *******
		if($codMedico == null) {
			return "ERRO: Campo 'Codigo do Médico' é obrigatório.";
		}
		if($this->verificaCodMedico($codMedico)) {
			return "ERRO: Médico não encontrado ou Horario de atendimento já cadastrado.";
		}
		$codMedicoElement = $domXML->createElement("codMedico", $codMedico);
		$HorarioAtendimento->appendChild($codMedicoElement);
		// ******* Inserção da Segunda-Feira *******
		if($seg == null) {
			return "ERRO: Campo 'seg' é obrigatório.";
		}
		if($this->verificaFormatoHorario($seg)) {
			return "ERRO: Formato de horário invalido (devem ser 22 caracteres '0' ou '1').";
		}
		$segElement = $domXML->createElement("seg", $seg);
		$HorarioAtendimento->appendChild($segElement);
		// ******* Inserção da Terça-Feira *******
		if($ter == null) {
			return "ERRO: Campo 'ter' é obrigatório.";
		}
		if($this->verificaFormatoHorario($ter)) {
			return "ERRO: Formato de horário invalido (devem ser 22 caracteres '0' ou '1').";
		}
		$terElement = $domXML->createElement("ter", $ter);
		$HorarioAtendimento->appendChild($terElement);
		// ******* Inserção da Quarta-Feira *******
		if($qua == null) {
			return "ERRO: Campo 'qua' é obrigatório.";
		}
		if($this->verificaFormatoHorario($qua)) {
			return "ERRO: Formato de horário invalido (devem ser 22 caracteres '0' ou '1').";
		}
		$quaElement = $domXML->createElement("qua", $qua);
		$HorarioAtendimento->appendChild($quaElement);
		// ******* Inserção da Quinta-Feira *******
		if($qui == null) {
			return "ERRO: Campo 'qui' é obrigatório.";
		}
		if($this->verificaFormatoHorario($qui)) {
			return "ERRO: Formato de horário invalido (devem ser 22 caracteres '0' ou '1').";
		}
		$quiElement = $domXML->createElement("qui", $qui);
		$HorarioAtendimento->appendChild($quiElement);
		// ******* Inserção da Sexta-Feira *******
		if($sex == null) {
			return "ERRO: Campo 'sex' é obrigatório.";
		}
		if($this->verificaFormatoHorario($sex)) {
			return "ERRO: Formato de horário invalido (devem ser 22 caracteres '0' ou '1').";
		}
		$sexElement = $domXML->createElement("sex", $sex);
		$HorarioAtendimento->appendChild($sexElement);
		// ******* Inserção da Data de Registro no Sitema *******
		$reg_dateElement = $domXML->createElement("reg_date", date("Y-m-d H:i:s",time()));
		$HorarioAtendimento->appendChild($reg_dateElement);
		if($domXML->save($tablePath)) {
			return "Inserção realizada com sucesso!";
		}else {
			return "Erro ao inserir registro de HorarioAtendimento.";
		}
	}

	
	/**
	 * selectHorarioAtendimento
	 *
	 * Seleciona na tabela tHorarioAtendimento.xml todos os HorarioAtendimentos que possuem os campos informados, retornando um array do tipo SimpleXMLElement.
	 *
	 * @param string $codigo			Codigo do Horario no formato "H0000"
	 * @param string $codMedico        	[FK] Codigo do Medico no formato "M0000"
	 * @param string $seg       		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $ter				Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $qua       		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $qui       		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $sex        		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * 
	 * @return SimpleXMLElement[] $xml	Retorna um array de SimpleXMLObject contendo o resultado da HorarioAtendimento.
	 * 
	 */
	public function selectHorarioAtendimento(string $codigo = null, string $codMedico = null, string $seg = null, string $ter = null, string $qua = null, string $qui=null, string $sex=null, string $reg_date = null) {
		$tablePath = $this->tablePathHorarioAtendimento;
		$xml=simplexml_load_file($tablePath) or die("Error: Cannot create object");
		$maisDeUmParametro = false;
		if (($codigo == null) && 
			($codMedico == null) &&
			($seg == null) &&
			($ter == null) &&
			($qua == null) &&
			($qui == null) &&
			($sex == null) &&
			($reg_date == null)
		)
		{
			$xPathQuery = "horarioAtendimento";
			return $xml->xpath($xPathQuery); // Retorna um Array de SimpleXML Object, contendo os resultados 
		}
		$xPathQuery = "horarioAtendimento[";
		if ($codigo != null) {
			$xPathQuery = $xPathQuery."codigo/text()='".$codigo."'";
			$maisDeUmParametro = true;
		}
		if ($codMedico != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."codMedico/text()='".$codMedico."'";
			$maisDeUmParametro = true;
		}
		if ($seg != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."seg/text()='".$seg."'";
			$maisDeUmParametro = true;
		}
		if ($ter != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."ter/text()='".$ter."'";
			$maisDeUmParametro = true;
		}
		if ($qua != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."qua/text()='".$qua."'";
			$maisDeUmParametro = true;
		}
		if ($qui != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."qui/text()='".$qui."'";
			$maisDeUmParametro = true;
		}
		if ($sex != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."sex/text()='".$sex."'";
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
	 * excluirHorarioAtendimento
	 *
	 * Exclui da tabela tHorarioAtendimento.xml o HorarioAtendimento que possui o codigo informado.
	 * 
	 * @param string $codigo			Codigo do HorarioAtendimento a ser excluido da tabela.
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function excluirHorarioAtendimento(string $codigo) {
		$tablePath = $this->tablePathHorarioAtendimento;
		$HorarioAtendimento = $this->selectHorarioAtendimento($codigo);
		if($HorarioAtendimento == null) {
			return "ERRO: Não há Horario de Atendimento com o código ".$codigo.".";
		}
		$domHorarioAtendimento = dom_import_simplexml($HorarioAtendimento[0]);
		$domXML = $domHorarioAtendimento->parentNode->parentNode; //  documento XML
		$domHorarioAtendimento->parentNode->removeChild($domHorarioAtendimento);
		if($domXML->save($tablePath)) {
			return "Exclusão efetuada com sucesso!";
		}else {
			return "ERRO: Ao salvar modificações na tabela ".$tablePath.".";
		}
	}


	/**
	 * updateHorarioAtendimentoCompleto
	 *
	 * Salva na tabela tHorarioAtendimento.xml as alteracoes no HorarioAtendimento que possui o codigo informado.
	 * 
	 * @param string $codigo			Codigo do Horario no formato "H0000"
	 * @param string $codMedico        	[FK] Codigo do Medico no formato "M0000"
	 * @param string $seg       		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $ter				Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $qua       		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $qui       		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @param string $sex        		Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * 
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function updateHorarioAtendimentoCompleto(string $codigo, string $codMedico = null, string $seg = null, string $ter = null, string $qua = null, string $qui=null, string $sex=null) {
		$tablePath = $this->tablePathHorarioAtendimento;
		$houveAlteracao = false;
		$HorarioAtendimento = $this->selectHorarioAtendimento($codigo);
		if($HorarioAtendimento == null) {
			return "ERRO: Não há Horario de Atendimento com o código ".$codigo.".";
		}
		$HorarioAtendimento = $HorarioAtendimento[0];
		if(($HorarioAtendimento->codigo != $codigo) or ($codigo == null)) {
			return "ERRO: código invalido.";
		}
		if(($HorarioAtendimento->codMedico != $codMedico) and ($codMedico != null)) {
			if($this->verificaCodMedico($codMedico)) {
				return "ERRO: Médico nao encontrado ou Horario de atendimento já cadastrado.";
			}
			$HorarioAtendimento->codMedico = $codMedico;
			$houveAlteracao = true;
		}
		if(($HorarioAtendimento->seg != $seg) and ($seg != null)) {
			if($this->verificaFormatoHorario($seg)) {
				return "ERRO: Formato de horário invalido (devem ser 22 caracteres '0' ou '1').";
			}
			$HorarioAtendimento->seg = $seg;
			$houveAlteracao = true;
		}
		if(($HorarioAtendimento->ter != $ter) and ($ter != null)) {
			if($this->verificaFormatoHorario($ter)) {
				return "ERRO: Formato de horário invalido (devem ser 22 caracteres '0' ou '1').";
			}
			$HorarioAtendimento->ter = $ter;
			$houveAlteracao = true;
		}
		if(($HorarioAtendimento->qua != $qua) and ($qua != null)) {
			if($this->verificaFormatoHorario($qua)) {
				return "ERRO: Formato de horário invalido (devem ser 22 caracteres '0' ou '1').";
			}
			$HorarioAtendimento->qua = $qua;
			$houveAlteracao = true;
		}
		if(($HorarioAtendimento->qui != $qui) and ($qui != null)) {
			if($this->verificaFormatoHorario($qui)) {
				return "ERRO: Formato de horário invalido (devem ser 22 caracteres '0' ou '1').";
			}
			$HorarioAtendimento->qui = $qui;
			$houveAlteracao = true;
		}
		if(($HorarioAtendimento->sex != $sex) and ($sex != null)) {
			if($this->verificaFormatoHorario($sex)) {
				return "ERRO: Formato de horário invalido (devem ser 22 caracteres '0' ou '1').";
			}
			$HorarioAtendimento->sex = $sex;
			$houveAlteracao = true;
		}
		if(!$houveAlteracao) {
			return "Não houve alteração.";
		}
		$domHorarioAtendimento = dom_import_simplexml($HorarioAtendimento);
		$domXML = $domHorarioAtendimento->parentNode->parentNode; //  documento XML
		// Salva as alterações na tabela
		if($domXML->save($tablePath)) {
			return "Alteração efetuada com sucesso!";
		}else {
			return "ERRO: Ao salvar modificações na tabela ".$tablePath.".";
		}
	}


	/**
	 * insertHorarioAtendimento
	 *
	 * Salva na tabela tHorarioAtendimento.xml os atributos do objeto desta classe
	 * 
	 * @param void
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function insertHorarioAtendimento() {
		$msgRetorno = $this->insertHorarioAtendimentoCompleto(	$this->codMedico, 
																$this->seg,
																$this->ter,
																$this->qua,
																$this->qui,
																$this->sex
		);
		if (strcmp($msgRetorno, "Inserção realizada com sucesso!") != 0) {
			return $msgRetorno; // Significa que deu erro.
		}
		$this->codigo = $this->getCodigoByHorarioAtendimento($this);
		$this->reg_date = $this->getHorarioAtendimentoByCodigo($this->codigo)[0]->reg_date;
		return $msgRetorno;
	}


	/**
	 * updateHorarioAtendimento
	 *
	 * Salva na tabela tHorarioAtendimento.xml as alteracoes presentes nos atributos do objeto desta classe.
	 * 
	 * @param void
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function updateHorarioAtendimento() {
		if($this->codigo == null) {
			return "ERRO: Código do Horario de Atendimento inválido.";
		}
		return $this->updateHorarioAtendimentoCompleto(	$this->codigo,
														$this->codMedico,
														$this->seg,
														$this->ter,
														$this->qua,
														$this->qui,
														$this->sex
		);
	}


	/**
	 * clearHorarioAtendimento
	 *
	 * Limpa os atributos do objeto da classe lHorarioAtendimento.
	 * 
	 * @param void
	 * @return void
	 * 
	 */
	public function clearHorarioAtendimento() {
		$this->codigo = null;
		$this->codMedico = null;
		$this->seg = null;
		$this->ter = null;
		$this->qua = null;
		$this->qui = null;
		$this->sex = null;
		$this->reg_date = null;
	}


	/**
	 * getHorarioAtendimentoByCodigo
	 * 
	 * Busca os HorarioAtendimentos que possuem o codigo informado e retorna um array com objetos da classe lHorarioAtendimento.
	 * 
	 * @param string $codigo									Codigo do HorarioAtendimento a ser buscado.
	 * @return lHorarioAtendimento[] $ListaHorarioAtendimento	Retorna um array de objetos da classe lHorarioAtendimento.
	 * 
	 */
	public function getHorarioAtendimentoByCodigo(string $codigo) {
		$ListSimpleXMLObject = $this->selectHorarioAtendimento($codigo);
		$ListaHorarioAtendimentos = $this->traduzSimpleXMLObjectToHorarioAtendimento($ListSimpleXMLObject);
		return $ListaHorarioAtendimentos;
	}


	/**
	 * getHorarioAtendimentoByCodMedico
	 * 
	 * Busca os HorarioAtendimentos que possuem o codMedico informado e retorna um array com objetos da classe lHorarioAtendimento.
	 * 
	 * @param string $codMedico									Codigo do Medico na HorarioAtendimento a ser buscado.
	 * @return lHorarioAtendimento[] $ListaHorarioAtendimento	Retorna um array de objetos da classe lHorarioAtendimento.
	 * 
	 */
	public function getHorarioAtendimentoByCodMedico(string $codMedico) {
		$ListSimpleXMLObject = $this->selectHorarioAtendimento(null, $codMedico);
		$ListaHorarioAtendimentos = $this->traduzSimpleXMLObjectToHorarioAtendimento($ListSimpleXMLObject);
		return $ListaHorarioAtendimentos;
	}


	/**
	 * getHorarioAtendimentoBySegunda
	 * 
	 * Busca os HorarioAtendimentos que possuem o parametro informado e retorna um array com objetos da classe lHorarioAtendimento.
	 * 
	 * @param string $seg										Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @return lHorarioAtendimento[] $ListaHorarioAtendimento	Retorna um array de objetos da classe lHorarioAtendimento.
	 * 
	 */
	public function getHorarioAtendimentoBySegunda(string $seg) {
		$ListSimpleXMLObject = $this->selectHorarioAtendimento(null, null, $seg);
		$ListaHorarioAtendimentos = $this->traduzSimpleXMLObjectToHorarioAtendimento($ListSimpleXMLObject);
		return $ListaHorarioAtendimentos;
	}


	/**
	 * getHorarioAtendimentoByTerca
	 * 
	 * Busca os HorarioAtendimentos que possuem o parametro informado e retorna um array com objetos da classe lHorarioAtendimento.
	 * 
	 * @param string $ter										Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @return lHorarioAtendimento[] $ListaHorarioAtendimento	Retorna um array de objetos da classe lHorarioAtendimento.
	 * 
	 */
	public function getHorarioAtendimentoByTerca(string $ter) {
		$ListSimpleXMLObject = $this->selectHorarioAtendimento(null, null, null, $ter);
		$ListaHorarioAtendimentos = $this->traduzSimpleXMLObjectToHorarioAtendimento($ListSimpleXMLObject);
		return $ListaHorarioAtendimentos;
	}


	/**
	 * getHorarioAtendimentoByQuarta
	 * 
	 * Busca os HorarioAtendimentos que possuem o parametro informado e retorna um array com objetos da classe lHorarioAtendimento.
	 * 
	 * @param string $qua											Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @return lHorarioAtendimento[] $ListaHorarioAtendimento		Retorna um array de objetos da classe lHorarioAtendimento.
	 * 
	 */
	public function getHorarioAtendimentoByQuarta(string $qua) {
		$ListSimpleXMLObject = $this->selectHorarioAtendimento(null, null, null, null, $qua);
		$ListaHorarioAtendimentos = $this->traduzSimpleXMLObjectToHorarioAtendimento($ListSimpleXMLObject);
		return $ListaHorarioAtendimentos;
	}


	/**
	 * getHorarioAtendimentoByQuinta
	 *
	 * Busca os HorarioAtendimentos que possuem o parametro informado e retorna um array com objetos da classe lHorarioAtendimento.
	 * 
	 * @param string $qui										Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @return lHorarioAtendimento[] $ListaHorarioAtendimento	Retorna um array de objetos da classe lHorarioAtendimento.
	 * 
	 */
	public function getHorarioAtendimentoByQuinta($qui) {
		$ListSimpleXMLObject = $this->selectHorarioAtendimento(null, null, null,  null, null, $qui);
		$ListaHorarioAtendimentos = $this->traduzSimpleXMLObjectToHorarioAtendimento($ListSimpleXMLObject);
		return $ListaHorarioAtendimentos;
	}


	/**
	 * getHorarioAtendimentoBySexta
	 *
	 * Busca os HorarioAtendimentos que possuem o parametro informado e retorna um array com objetos da classe lHorarioAtendimento.
	 * 
	 * @param string $sex										Sequencia de 22 caracteres (0 ou 1) que representam os horarios em intervalos de 30min entre 8:00-19:00.
	 * @return lHorarioAtendimento[] $ListaHorarioAtendimento	Retorna um array de objetos da classe lHorarioAtendimento.
	 * 
	 */
	public function getHorarioAtendimentoBySexta($sex) {
		$ListSimpleXMLObject = $this->selectHorarioAtendimento(null, null, null, null, null, null, $sex);
		$ListaHorarioAtendimentos = $this->traduzSimpleXMLObjectToHorarioAtendimento($ListSimpleXMLObject);
		return $ListaHorarioAtendimentos;
	}


	/**
	 * getCodigoByHorarioAtendimento
	 *
	 * Busca a HorarioAtendimento informado e retorna uma string com o seu codigo.
	 * 
	 * @param lHorarioAtendimento $oHorarioAtendimento		Objeto da classe lHorarioAtendimento.
	 * @return string $codigo								Retorna o Codigo da HorarioAtendimento (em string).
	 * 
	 */
	public function getCodigoByHorarioAtendimento(lHorarioAtendimento $oHorarioAtendimento) {
		$temp = $this->selectHorarioAtendimento (null,
										$oHorarioAtendimento->codMedico,
										$oHorarioAtendimento->seg,
										$oHorarioAtendimento->ter,
										$oHorarioAtendimento->qua,
										$oHorarioAtendimento->qui,
										$oHorarioAtendimento->sex
									   );
		$codigo = (string) $temp[0]->codigo;
		return $codigo;
	}


	/**
	 * getTabela
	 *
	 * Retorna toda a tabela tHorarioAtendimento em um array de objetos da classe lHorarioAtendimento.
	 * 
	 * @param void
	 * @return array lHorarioAtendimento 	Array de objetos da classe lHorarioAtendimento
	 * 
	 */
	public function getTabela(){
		return $this->traduzSimpleXMLObjectToHorarioAtendimento($this->selectHorarioAtendimento());
	}
}

?>
