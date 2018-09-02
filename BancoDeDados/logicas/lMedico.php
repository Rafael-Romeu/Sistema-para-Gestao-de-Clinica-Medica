<?php

/**
 * ..:: Logica para manipulacao da tabela de Medicos ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

class lMedico {
/**
 * Classe de lógica para manipulação da tabela tMedico.xml
 * 
 * @var string $codigo				Codigo de identificacao no padrão "M0000"
 * @var string $nome       			Nome do Medico
 * @var string $senha        		Senha
 * @var string $cpf        			CPF no padrão "777.777.777-77"
 * @var string $especialidade		Especialidade do Médico (ex: Clinico Geral, Pediatria, etc.)
 * @var string $planoDeSaude		Plano de Saúde em que o Médico atende
 * @var string $horariosAtendimento	
 * @var string $dtNascimento		Data de nascimento, no padrão 1900-01-01
 * @var string $endereco       		Endereco do Medico
 * @var string $telefone       		Telefone do Medico
 * @var string $email        		E-mail do Medico
 * @var string $reg_date        	Data e Hora de registro do Medico do sistema
 * @var boolean $semEspaco			Flag para verificacao se ha espaco vazio no meio da tabela tMedico.xml
 * @var string $tablePathMedico	File path da tabela tMedico.xml
 * 
 */

	public $codigo;
	public $nome;
	public $senha;
	public $cpf;
	public $especialidade;
	public $planoDeSaude;
	public $horariosAtendimento;
	public $dtNascimento;
	public $endereco;
	public $telefone;
	public $email;
	public $reg_date;
	private $semEspaco;
	private $tablePathMedico;
	
/**
 * lMedico
 * 
 * Construtor da classe lMedico, que inicializa os parametros como null.
 * 
 * @param void
 * @return void
 * 
 */
	function __construct() {
        $this->codigo = null;
		$this->nome = null;
		$this->senha = null;
		$this->cpf = null;
		$this->especialidade = null;
		$this->planoDeSaude = null;
		$this->horariosAtendimento = null;
		$this->dtNascimento = null;
		$this->endereco = null;
		$this->telefone = null;
		$this->email = null;
		$this->reg_date = null;
		$this->semEspaco = false;
		$this->tablePathMedico = $_SERVER['DOCUMENT_ROOT']."/BancoDeDados/db/tMedico.xml";
    }
	
	/**
	 * createTableMedico
	 *
	 * Metodo para a criacao da tabela Medico.xml, contendo o primeiro registro como Template.
	 * 
	 * @param void
	 * @return int 1|0	Retorna 1 se houve ERRO, ou 0 se a criacao da tabela foi realizada com sucesso.
	 * 
	 */
	public function createTableMedico() {
		$filePathMedico = $this->tablePathMedico;
		$file = fopen($filePathMedico, "w+");
	$template = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<root>
	<medico>
		<codigo>M0000</codigo>
		<nome>Template</nome>
		<senha>admin</senha>
		<cpf>admin</cpf>
		<especialidade>(Especialidade)</especialidade>
		<planoDeSaude>(Plano de Saude)</planoDeSaude>
		<dtNascimento>1900-01-01</dtNascimento>
		<endereco>(sem endereço)</endereco>
		<telefone>(sem telefone)</telefone>
		<email>(sem E-mail)</email>
		<reg_date>1993-05-31 23:59:59</reg_date>
  </medico>
</root>
XML;
		fwrite($file,$template);
		fclose($file);
		$file = fopen($filePathMedico, "r");
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
			$codAnterior = ("M".sprintf('%04d', $i)); $i++;
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
	 * traduzSimpleXMLObjectToMedico
	 *
	 * Traduz um array de SimpleXMLObject em um array de lMedico
	 * 
	 * @param SimpleXMLElement[] $ListSimpleXMLObject		Array de SimpleXMLObject.
	 * @return lMedico[] $ListaMedico					Array de lMedico.
	 * 
	 */
	public function traduzSimpleXMLObjectToMedico($ListSimpleXMLObject) {
		$ListaMedico = array();
		foreach($ListSimpleXMLObject as $SimpleXMLObject) {
			$oMedico = new lMedico();
			$oMedico->codigo 	  	= (string)$SimpleXMLObject->codigo;
			$oMedico->nome 		  	= (string)$SimpleXMLObject->nome;
			$oMedico->senha		  	= (string)$SimpleXMLObject->senha;
			$oMedico->cpf 		   	= (string)$SimpleXMLObject->cpf;
			$oMedico->especialidade	= (string)$SimpleXMLObject->especialidade;
			$oMedico->planoDeSaude	= (string)$SimpleXMLObject->planoDeSaude;
			$oMedico->dtNascimento	= (string)$SimpleXMLObject->dtNascimento;
			$oMedico->endereco    	= (string)$SimpleXMLObject->endereco;
			$oMedico->telefone    	= (string)$SimpleXMLObject->telefone;
			$oMedico->email       	= (string)$SimpleXMLObject->email;
			$oMedico->reg_date    	= (string)$SimpleXMLObject->reg_date;
			array_push($ListaMedico, $oMedico);
		}
		return $ListaMedico;
	}


	/**
	 * verificaCPFMedico
	 *
	 * Verifica se o CPF informado já está presente na tabela tMedico.xml
	 * 
	 * @param string $cpf		CPF do Medico a ser verificado.
	 * @return false|true		'false' se Sucesso | 'true' se ERRO: Medico já cadastrado.
	 * 
	 */
	public function verificaCPFMedico(string $cpf) {
		if ($this->getMedicoByCPF($cpf) == null) {
			return false; // Sucesso
		}
		return true; // ERRO: Medico já cadastrado.
	}


	/**
	 * insertMedicoCompleto
	 *
	 * Salva na tabela tMedico.xml o novo Medico que possui os parametros informados.
	 * 
	 * @param string $nome			Nome do Medico.
	 * @param string $senha			Senha do Medico.
	 * @param string $cpf			CPF do Medico.
	 * @param string $especialidade	Especialidade do Medico.
	 * @param string $planoDeSaude	Plano de Saude o qual o Medico atua.
	 * @param string $dtNascimento	[Opcional] Data de Nascimento do Medico.
	 * @param string $endereco		[Opcional] Endereco do Medico.
	 * @param string $telefone		[Opcional] Telefone do Medico.
	 * @param string $email			[Opcional] E-mail do Medico.
	 * 
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function insertMedicoCompleto(string $nome, string $senha, string $cpf, string $especialidade, string $planoDeSaude, string $dtNascimento=null, string $endereco=null, string $telefone=null, string $email=null) {
		$tablePath  = $this->tablePathMedico;
		$domXML = new DOMDocument('1.0');
		$domXML->preserveWhiteSpace = false;
		$domXML->formatOutput = true;
		if ($domXML->load($tablePath)) {
			//echo "segue o baile\n";
		}else {
			echo "\n\nTabela '". $tablePath."' não encontrada.\nCriando tabela...\n\n";
			if( createTableMedico($tablePath) ) exit("ERRO ao criar a tabela");
			else echo "\nTabela '".$tablePath. "' criada com sucesso!\n";
			$domXML->load($tablePath);
		}
		$root = $domXML->getElementsByTagName('root')->item(0);
		// busca o primeiro espaco vazio
		$domPosition = lMedico::buscaEspacoVazio($domXML);
		//Extrai o codigo e transforma em int
		$strCodigo = $domPosition->firstChild->nodeValue;
		$strCodigo = substr($strCodigo, 1);
		$intCodigo = intval($strCodigo);
		$Medico = $domXML->createElement('medico');
		if ($this->semEspaco) {
			$codigo = "M".sprintf('%04d', $intCodigo + 1);
			$root->appendChild($Medico);
		}else {
			$codigo = "M".sprintf('%04d', $intCodigo - 1);
			$root->insertBefore($Medico, $domPosition);
		}
		// ******* Inserção do Código *******
		$codigoElement = $domXML->createElement("codigo", $codigo);
		$Medico->appendChild($codigoElement);
		// ******* Inserção do Nome *******
		if($nome == null) {
			return "ERRO: Campo 'Nome' é obrigatório.";
		}
		$nomeElement = $domXML->createElement("nome", $nome);
		$Medico->appendChild($nomeElement);
		// ******* Inserção da Senha *******
		if($senha == null) {
			return "ERRO: Campo 'Senha' é obrigatório.";
		}
		$senhaElement = $domXML->createElement("senha", $senha);
		$Medico->appendChild($senhaElement);
		// ******* Inserção do CPF *******
		if($cpf == null) {
			return "ERRO: Campo 'CPF' é obrigatório.";
		}
		if($this->verificaCPFMedico($cpf)){
			return "ERRO: Este CPF já está cadastrado.";
		}
		$cpfElement = $domXML->createElement("cpf", $cpf);
		$Medico->appendChild($cpfElement);
		// ******* Inserção da Especialidade *******
		if($especialidade == null) {
			return "ERRO: Campo 'Especialidade' é obrigatório.";
		}
		$especialidadeElement = $domXML->createElement("especialidade", $especialidade);
		$Medico->appendChild($especialidadeElement);
		// ******* Inserção do Plano de Saude *******
		if($planoDeSaude == null) {
			return "ERRO: Campo 'Plano de Saúde' é obrigatório.";
		}
		$planoDeSaudeElement = $domXML->createElement("planoDeSaude", $planoDeSaude);
		$Medico->appendChild($planoDeSaudeElement);
		// ******* Inserção da Data de Nascimento *******
		if($dtNascimento == null) {
			$dtNascimento = "1900-01-01"; // Data default
		}
		$dtNascimentoElement = $domXML->createElement("dtNascimento", $dtNascimento);
		$Medico->appendChild($dtNascimentoElement);
		// ******* Inserção do Endereço *******
		if($endereco == null) {
			$endereco =  "(sem endereço)";
		}
		$enderecoElement = $domXML->createElement("endereco", $endereco);
		$Medico->appendChild($enderecoElement);
		// ******* Inserção do Telefone *******
		if($telefone == null) {
			$telefone = "(sem telefone)";
		}
		$telefoneElement = $domXML->createElement("telefone", $telefone);
		$Medico->appendChild($telefoneElement);
		// ******* Inserção do E-mail *******
		if($email == null) {
			$email = "(sem E-mail)";
		}
		$emailElement = $domXML->createElement("email", $email);
		$Medico->appendChild($emailElement);
		// ******* Inserção da Data de Registro no Sitema *******
		$reg_dateElement = $domXML->createElement("reg_date", date("Y-m-d H:i:s",time()));
		$Medico->appendChild($reg_dateElement);
		if($domXML->save($tablePath)) {
			return "Inserção realizada com sucesso!";
		}else {
			return "Erro ao inserir registro de Medico.";
		}
	}


	/**
	 * selectMedico
	 *
	 * Seleciona na tabela tMedico.xml todos os Medicos que possuem os campos informados, retornando um array do tipo SimpleXMLElement.
	 *
	 * @param string $codigo			[Opcional] Codigo do Medico.
	 * @param string $nome				[Opcional] Nome do Medico.
	 * @param string $senha				[Opcional] Senha do Medico.
	 * @param string $cpf				[Opcional] CPF do Medico.
	 * @param string $especialidade		[Opcional] Especialidade do Medico.
	 * @param string $planoDeSaude		[Opcional] Plano de Saude o qual o Medico atua.
	 * @param string $dtNascimento		[Opcional] Data de Nascimento do Medico.
	 * @param string $endereco			[Opcional] Endereco do Medico.
	 * @param string $telefone			[Opcional] Telefone do Medico.
	 * @param string $email				[Opcional] E-mail do Medico.
	 * @param string $reg_date			[Opcional] Data de registro no sistema.
	 * 
	 * @return SimpleXMLElement[] $xml	Retorna um array de SimpleXMLObject contendo o resultado da consulta.
	 * 
	 */
	public function selectMedico(string $codigo = null, string $nome = null, string $senha = null, string $cpf = null, string $especialidade = null, string $planoDeSaude = null, string $dtNascimento = null, string $endereco = null, string $telefone = null, string $email = null, string $reg_date = null) {
		$tablePath = $this->tablePathMedico;
		$xml=simplexml_load_file($tablePath) or die("Error: Cannot create object");
		$maisDeUmParametro = false;
		if (($codigo == null) && 
			($nome == null) &&
			($senha == null) &&
			($cpf == null) &&
			($especialidade == null) &&
			($planoDeSaude == null) &&
			($dtNascimento == null) && 
			($endereco == null) && 
			($telefone == null) &&
			($email == null) &&
			($reg_date == null))
		{
			$xPathQuery = "medico";
			return $xml->xpath($xPathQuery); // Retorna um Array de SimpleXML Object, contendo os resultados 
		}
		$xPathQuery = "medico[";
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
			$xPathQuery = $xPathQuery."senha/text()='".$senha."'";
			$maisDeUmParametro = true;
		}
		if ($cpf != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."cpf/text()='".$cpf."'";
			$maisDeUmParametro = true;
		}
		if ($especialidade != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."especialidade/text()='".$especialidade."'";
			$maisDeUmParametro = true;
		}
		if ($planoDeSaude != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."planoDeSaude/text()='".$planoDeSaude."'";
			$maisDeUmParametro = true;
		}
		if ($dtNascimento != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."dtNascimento/text()='".$dtNascimento."'";
			$maisDeUmParametro = true;
		}
		if ($endereco != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."endereco/text()='".$endereco."'";
			$maisDeUmParametro = true;
		}
		if ($telefone != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."telefone/text()='".$telefone."'";
			$maisDeUmParametro = true;
		}
		if ($email != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."email/text()='".$email."'";
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
	 * excluirMedico
	 *
	 * Exclui da tabela tMedico.xml o Medico que possui o codigo informado.
	 * 
	 * @param string $codigo			Codigo do Medico a ser excluido da tabela.
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function excluirMedico(string $codigo) {
		$tablePath = $this->tablePathMedico;
		$Medico = $this->selectMedico($codigo);
		if($Medico == null) {
			return "ERRO: Não há Médico com o código ".$codigo.".";
		}
		$domMedico = dom_import_simplexml($Medico[0]);
		$domXML = $domMedico->parentNode->parentNode; //  documento XML
		$domMedico->parentNode->removeChild($domMedico);
		if($domXML->save($tablePath)) {
			return "Exclusão efetuada com sucesso!";
		}else {
			return "ERRO: Ao salvar modificações na tabela ".$tablePath.".";
		}
	}


	/**
	 * updateMedicoCompleto
	 *
	 * Salva na tabela tMedico.xml as alteracoes no Medico que possui o codigo informado.
	 * 
	 * @param string $codigo		Codigo do Medico a ser atualizado.
	 * @param string $nome			[Opcional] Nome do Medico.
	 * @param string $senha			[Opcional] Senha do Medico.
	 * @param string $cpf			[Opcional] CPF do Medico.
	 * @param string $especialidade	[Opcional] Especialidade do Medico.
	 * @param string $planoDeSaude	[Opcional] Plano de Saude o qual o Medico atua.
	 * @param string $dtNascimento	[Opcional] Data de Nascimento do Medico.
	 * @param string $endereco		[Opcional] Endereco do Medico.
	 * @param string $telefone		[Opcional] Telefone do Medico.
	 * @param string $email			[Opcional] E-mail do Medico.
	 * 
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function updateMedicoCompleto(string $codigo, string $nome = null, string $senha = null, string $cpf = null, string $especialidade = null, string $planoDeSaude = null, string $dtNascimento = null, string $endereco = null, string $telefone = null, string $email=null) {
		$tablePath = $this->tablePathMedico;
		$houveAlteracao = false;
		$Medico = $this->selectMedico($codigo);
		if($Medico == null) {
			return "ERRO: Não há Médico com o código ".$codigo.".";
		}
		$Medico = $Medico[0];
		if(($Medico->codigo != $codigo) or ($codigo == null)) {
			return "ERRO: código invalido.";
		}
		if(($Medico->nome != $nome) and ($nome != null)) {
			$Medico->nome = $nome;
			$houveAlteracao = true;
		}
		if(($Medico->senha != $senha) and ($senha != null)) {
			$Medico->senha = $senha;
			$houveAlteracao = true;
		}
		if(($Medico->cpf != $cpf) and ($cpf != null)) {
			if($this->verificaCPFMedico($cpf)){
				return "ERRO: Este CPF já está cadastrado para outro usuário.";
			}
			$Medico->cpf = $cpf;
			$houveAlteracao = true;
		}
		if(($Medico->especialidade != $especialidade) and ($especialidade != null)) {
			$Medico->especialidade = $especialidade;
			$houveAlteracao = true;
		}
		if(($Medico->planoDeSaude != $planoDeSaude) and ($planoDeSaude != null)) {
			$Medico->planoDeSaude = $planoDeSaude;
			$houveAlteracao = true;
		}
		if(($Medico->dtNascimento != $dtNascimento) and ($dtNascimento != null)) {
			$Medico->dtNascimento = $dtNascimento;
			$houveAlteracao = true;
		}
		if(($Medico->endereco != $endereco) and ($endereco != null)) {
			$Medico->endereco = $endereco;
			$houveAlteracao = true;
		}
		if(($Medico->telefone != $telefone) and ($telefone != null)) {
			$Medico->telefone = $telefone;
			$houveAlteracao = true;
		}
		if(($Medico->email != $email) and ($email != null)) {
			$Medico->email = $email;
			$houveAlteracao = true;
		}
		if(!$houveAlteracao) {
			return "Não houve alteração.";
		}
		$domMedico = dom_import_simplexml($Medico);
		$domXML = $domMedico->parentNode->parentNode; //  documento XML
		// Salva as alterações na tabela
		if($domXML->save($tablePath)) {
			return "Alteração efetuada com sucesso.";
		}else {
			return "ERRO: Ao salvar modificações na tabela ".$tablePath.".";
		}
	}


	/**
	 * insertMedico
	 *
	 * Salva na tabela tMedico.xml os atributos do objeto desta classe
	 * 
	 * @param void
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function insertMedico() {
		$msgRetorno = $this->insertMedicoCompleto(	$this->nome, 
													$this->senha, 
													$this->cpf,
													$this->especialidade,
													$this->planoDeSaude,
													$this->dtNascimento,
													$this->endereco,
													$this->telefone,
													$this->email
		);
		if (strcmp($msgRetorno, "Inserção realizada com sucesso!") != 0) {
			return $msgRetorno; // Significa que deu erro.
		}
		$this->codigo = $this->getCodigoByMedico($this);
		$this->reg_date = $this->getMedicoByCodigo($this->codigo)[0]->reg_date;
		return $msgRetorno;
	}


	/**
	 * updateMedico
	 *
	 * Salva na tabela tMedico.xml as alteracoes presentes nos atributos do objeto desta classe.
	 * 
	 * @param void
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function updateMedico() {
		if($this->codigo == null) {
			return "ERRO: Código do Médico inválido.";
		}
		return $this->updateMedicoCompleto(	$this->codigo,
											$this->nome, 
											$this->senha, 
											$this->cpf,
											$this->especialidade,
											$this->planoDeSaude,
											$this->dtNascimento,
											$this->endereco,
											$this->telefone,
											$this->email
		);
	}


	/**
	 * clearMedico
	 *
	 * Limpa os atributos do objeto da classe lMedico.
	 * 
	 * @param void
	 * @return void
	 * 
	 */
	public function clearMedico() {
		$this->codigo = null;
		$this->nome = null;
		$this->senha = null;
		$this->cpf = null;
		$this->especialidade = null;
		$this->planoDeSaude = null;
		$this->dtNascimento = null;
		$this->endereco = null;
		$this->telefone = null;
		$this->email = null;
		$this->reg_date = null;
	}


	/**
	 * getMedicoByCodigo
	 * 
	 * Busca os Medicos que possuem o codigo informado e retorna um array com objetos da classe lMedico.
	 * 
	 * @param string $codigo			Codigo do Medico a ser buscado.
	 * @return lMedico[] $ListaMedico	Retorna um array de objetos da classe lMedico.
	 * 
	 */
	public function getMedicoByCodigo(string $codigo) {
		$ListSimpleXMLObject = $this->selectMedico($codigo);
		$ListaMedicos = $this->traduzSimpleXMLObjectToMedico($ListSimpleXMLObject);
		return $ListaMedicos;
	}


	/**
	 * getMedicoByNome
	 *
	 * Busca os Medicos que possuem o nome informado e retorna um array com objetos da classe lMedico.
	 * 
	 * @param string $nome				Nome do Medico a ser buscado.
	 * @return lMedico[] $ListaMedico	Retorna um array de objetos da classe lMedico.
	 * 
	 */
	public function getMedicoByNome(string $nome) {
		$ListSimpleXMLObject = $this->selectMedico(null, $nome);
		$ListaMedicos = $this->traduzSimpleXMLObjectToMedico($ListSimpleXMLObject);
		return $ListaMedicos;
	}


	/**
	 * getMedicoByCPF
	 * 
	 * Busca os Medicos que possuem o CPF informado e retorna um array com objetos da classe lMedico.
	 * 
	 * @param string $cpf				CPF do Medico a ser buscado.
	 * @return lMedico[] $ListaMedico	Retorna um array de objetos da classe lMedico.
	 * 
	 */
	public function getMedicoByCPF(string $cpf) {
		$ListSimpleXMLObject = $this->selectMedico(null, null, null, $cpf);
		$ListaMedicos = $this->traduzSimpleXMLObjectToMedico($ListSimpleXMLObject);
		return $ListaMedicos;
	}


	/**
	 * getMedicoByEspecialidade
	 * 
	 * Busca os Medicos que possuem a Especialidade informada e retorna um array com objetos da classe lMedico.
	 * 
	 * @param string $especialidade		Especialidade do Medico a ser buscado.
	 * @return lMedico[] $ListaMedico	Retorna um array de objetos da classe lMedico.
	 * 
	 */
	public function getMedicoByEspecialidade(string $especialidade) {
		$ListSimpleXMLObject = $this->selectMedico(null, null, null, null, $especialidade);
		$ListaMedicos = $this->traduzSimpleXMLObjectToMedico($ListSimpleXMLObject);
		return $ListaMedicos;
	}


	/**
	 * getMedicoByPlanoDeSaude
	 * 
	 * Busca os Medicos que possuem o Plano de Saude informado e retorna um array com objetos da classe lMedico.
	 * 
	 * @param string $planoDeSaude		Especialidade do Medico a ser buscado.
	 * @return lMedico[] $ListaMedico	Retorna um array de objetos da classe lMedico.
	 * 
	 */
	public function getMedicoByPlanoDeSaude(string $planoDeSaude) {
		$ListSimpleXMLObject = $this->selectMedico(null, null, null, null, null, $planoDeSaude);
		$ListaMedicos = $this->traduzSimpleXMLObjectToMedico($ListSimpleXMLObject);
		return $ListaMedicos;
	}


	/**
	 * getMedicoByDtNascimento
	 *
	 * Busca os Medicos que possuem a Data de Nascimento informada e retorna um array com objetos da classe lMedico.
	 * 
	 * @param string $dtNascimento			Data de Nascimento do Medico a ser buscado.
	 * @return lMedico[] $ListaMedico	Retorna um array de objetos da classe lMedico.
	 * 
	 */
	public function getMedicoByDtNascimento($dtNascimento) {
		$ListSimpleXMLObject = $this->selectMedico(null, null, null,  null, null, null, $dtNascimento);
		$ListaMedicos = $this->traduzSimpleXMLObjectToMedico($ListSimpleXMLObject);
		return $ListaMedicos;
	}


	/**
	 * getMedicoByEndereco
	 *
	 * Busca os Medicos que possuem o Endereco informado e retorna um array com objetos da classe lMedico.
	 * 
	 * @param string $endereco				Endereco do Medico a ser buscado.
	 * @return lMedico[] $ListaMedico	Retorna um array de objetos da classe lMedico.
	 * 
	 */
	public function getMedicoByEndereco($endereco) {
		$ListSimpleXMLObject = $this->selectMedico(null, null, null, null, null, null, null, $endereco);
		$ListaMedicos = $this->traduzSimpleXMLObjectToMedico($ListSimpleXMLObject);
		return $ListaMedicos;
	}


	/**
	 * getMedicoByTelefone
	 *
	 * Busca os Medicos que possuem o Telefone informado e retorna um array com objetos da classe lMedico.
	 * 
	 * @param string $telefone				Telefone do tendente a ser buscado.
	 * @return lMedico[] $ListaMedico	Retorna um array de objetos da classe lMedico.
	 * 
	 */
	public function getMedicoByTelefone($telefone) {
		$ListSimpleXMLObject = $this->selectMedico(null, null, null, null, null, null, null, null, $telefone);
		$ListaMedicos = $this->traduzSimpleXMLObjectToMedico($ListSimpleXMLObject);
		return $ListaMedicos;
	}


	/**
	 * getMedicoByEmail
	 *
	 * Busca os Medicos que possuem o E-mail informado e retorna um array com objetos da classe lMedico.
	 * 
	 * @param string $email					E-mail d Medico a ser buscado.
	 * @return lMedico[] $ListaMedico	Retorna um array de objetos da classe lMedico.
	 * 
	 */
	public function getMedicoByEmail($email) {
		$ListSimpleXMLObject = $this->selectMedico(null, null, null, null, null, null, null, null, null, $email);
		$ListaMedicos = $this->traduzSimpleXMLObjectToMedico($ListSimpleXMLObject);
		return $ListaMedicos;
	}


	/**
	 * getCodigoByMedico
	 *
	 * Busca o Medico informado e retorna uma string com o seu codigo.
	 * 
	 * @param lMedico $oMedico	Objeto da classe lMedico.
	 * @return string $codigo			Retorna o Codigo do Medico (em string).
	 * 
	 */
	public function getCodigoByMedico(lMedico $oMedico) {
		$temp = $this->selectMedico (null,
										$oMedico->nome,
										$oMedico->senha,
										$oMedico->cpf,
										$oMedico->especialidade,
										$oMedico->planoDeSaude,
										$oMedico->dtNascimento,
										$oMedico->endereco,
										$oMedico->telefone,
										$oMedico->email
									   );
		$codigo = (string) $temp[0]->codigo;
		return $codigo;
	}

	/**
	 * getTabela
	 *
	 * Retorna toda a tabela tMedico em um array de objetos da classe lMedico.
	 * 
	 * @param void
	 * @return array lMedico 	Array de objetos da classe lMedico
	 * 
	 */
	public function getTabela(){
		return $this->traduzSimpleXMLObjectToMedico($this->selectMedico());
	}
}

?>
