<?php

/**
 * ..:: Logica para manipulacao da tabela de Atendentes ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

class lAtendente {
/**
 * Classe de lógica para manipulação da tabela tAtendente.xml
 * 
 * @var string $codigo				Codigo de identificacao no padrão "A0000"
 * @var string $nome       			Nome do atendente
 * @var string $senha        		Senha
 * @var string $cpf        			CPF no padrão "777.777.777-77"
 * @var string $dtNascimento		Data de nascimento, no padrão 1900-01-01
 * @var string $endereco       		Endereco do atendente
 * @var string $telefone       		Telefone do atendente
 * @var string $email        		E-mail do atendente
 * @var string $reg_date        	Data e Hora de registro do atendente do sistema
 * @var boolean $semEspaco			Flag para verificacao se ha espaco vazio no meio da tabela tAtendente.xml
 * @var string $tablePathAtendente	File path da tabela tAtendente.xml
 * 
 */

	public $codigo;
	public $nome;
	public $senha;
	public $cpf;
	public $dtNascimento;
	public $endereco;
	public $telefone;
	public $email;
	public $reg_date;
	private $semEspaco;
	private $tablePathAtendente;
	
/**
 * lAtendente
 * 
 * Construtor da classe lAtendente, que inicializa os parametros como null.
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
		$this->dtNascimento = null;
		$this->endereco = null;
		$this->telefone = null;
		$this->email = null;
		$this->reg_date = null;
		$this->semEspaco = false;
		$this->tablePathAtendente = $_SERVER['DOCUMENT_ROOT']."/BancoDeDados/db/tAtendente.xml";
    }
	

	/**
	 * createTableAtendente
	 *
	 * Metodo para a criacao da tabela Atendente.xml, contendo o primeiro registro como Template.
	 * 
	 * @param void
	 * @return int 1|0	Retorna 1 se houve ERRO, ou 0 se a criacao da tabela foi realizada com sucesso.
	 * 
	 */
	public function createTableAtendente() {
		$filePathAtendente = $this->tablePathAtendente;
		$file = fopen($filePathAtendente, "w+");
	$template = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<root>
	<atendente>
		<codigo>A0000</codigo>
		<nome>Template</nome>
		<senha>admin</senha>
		<cpf>admin</cpf>
		<dtNascimento>1900-01-01</dtNascimento>
		<endereco>(sem endereço)</endereco>
		<telefone>(sem telefone)</telefone>
		<email>(sem E-mail)</email>
		<reg_date>1993-05-31 23:59:59</reg_date>
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
			$codAnterior = ("A".sprintf('%04d', $i)); $i++;
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
	 * traduzSimpleXMLObjectToAtendente
	 *
	 * Traduz um array de SimpleXMLObject em um array de lAtendente
	 * 
	 * @param SimpleXMLElement[] $ListSimpleXMLObject		Array de SimpleXMLObject.
	 * @return lAtendente[] $ListaAtendente					Array de lAtendente.
	 * 
	 */
	public function traduzSimpleXMLObjectToAtendente($ListSimpleXMLObject) {
		$ListaAtendente = array();
		foreach($ListSimpleXMLObject as $SimpleXMLObject) {
			$oAtendente = new lAtendente();
			$oAtendente->codigo 	  =	(string)$SimpleXMLObject->codigo;
			$oAtendente->nome 		  = (string)$SimpleXMLObject->nome;
			$oAtendente->senha		  = (string)$SimpleXMLObject->senha;
			$oAtendente->cpf 		  = (string)$SimpleXMLObject->cpf;
			$oAtendente->dtNascimento = (string)$SimpleXMLObject->dtNascimento;
			$oAtendente->endereco     =	(string)$SimpleXMLObject->endereco;
			$oAtendente->telefone     = (string)$SimpleXMLObject->telefone;
			$oAtendente->email        = (string)$SimpleXMLObject->email;
			$oAtendente->reg_date     = (string)$SimpleXMLObject->reg_date;
			array_push($ListaAtendente, $oAtendente);
		}
		return $ListaAtendente;
	}


	/**
	 * verificaCPFAtendente
	 *
	 * Verifica se o CPF informado já está presente na tabela tAtendente.xml
	 * 
	 * @param string $cpf		CPF do Atendente a ser verificado.
	 * @return false|true		'false' se Sucesso | 'true' se ERRO: Atendente já cadastrado.
	 * 
	 */
	public function verificaCPFAtendente(string $cpf) {
		if ($this->getAtendenteByCPF($cpf) == null) {
			return false; // Sucesso
		}
		return true; // ERRO: Atendente já cadastrado.
	}


	/**
	 * insertAtendenteCompleto
	 *
	 * Salva na tabela tAtendente.xml o novo atendente que possui os parametros informados.
	 * 
	 * @param string $nome			Nome do atendente.
	 * @param string $senha			Senha do atendente.
	 * @param string $cpf			CPF do atendente.
	 * @param string $dtNascimento	[Opcional] Data de Nascimento do atendente.
	 * @param string $endereco		[Opcional] Endereco do atendente.
	 * @param string $telefone		[Opcional] Telefone do atendente.
	 * @param string $email			[Opcional] E-mail do atendente.
	 * 
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function insertAtendenteCompleto(string $nome, string $senha, string $cpf, string $dtNascimento=null, string $endereco=null, string $telefone=null, string $email=null) {
		$tablePath  = $this->tablePathAtendente;
		$domXML = new DOMDocument('1.0');
		$domXML->preserveWhiteSpace = false;
		$domXML->formatOutput = true;
		if ($domXML->load($tablePath)) {
			//echo "segue o baile\n";
		}else {
			echo "\n\nTabela '". $tablePath."' não encontrada.\nCriando tabela...\n\n";
			if( createTableAtendente($tablePath) ) exit("ERRO ao criar a tabela");
			else echo "\nTabela '".$tablePath. "' criada com sucesso!\n";
			$domXML->load($tablePath);
		}
		$root = $domXML->getElementsByTagName('root')->item(0);
		// busca o primeiro espaco vazio
		$domPosition = lAtendente::buscaEspacoVazio($domXML);
		//Extrai o codigo e transforma em int
		$strCodigo = $domPosition->firstChild->nodeValue;
		$strCodigo = substr($strCodigo, 1);
		$intCodigo = intval($strCodigo);
		$atendente = $domXML->createElement('atendente');
		if ($this->semEspaco) {
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
			return "ERRO: Campo 'Nome' é obrigatório.";
		}
		$nomeElement = $domXML->createElement("nome", $nome);
		$atendente->appendChild($nomeElement);
		// ******* Inserção da Senha *******
		if($senha == null) {
			return "ERRO: Campo 'Senha' é obrigatório.";
		}
		$senhaElement = $domXML->createElement("senha", $senha);
		$atendente->appendChild($senhaElement);
		// ******* Inserção do CPF *******
		if($cpf == null) {
			return "ERRO: Campo 'CPF' é obrigatório.";
		}
		if($this->verificaCPFAtendente($cpf)){
			return "ERRO: Este CPF já está cadastrado.";
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
			$endereco =  "(sem endereço)";
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
		$reg_dateElement = $domXML->createElement("reg_date", date("Y-m-d H:i:s",time()));
		$atendente->appendChild($reg_dateElement);
		if($domXML->save($tablePath)) {
			return "Inserção realizada com sucesso!";
		}else {
			return "Erro ao inserir registro de Atendente.";
		}
	}


	/**
	 * selectAtendente
	 *
	 * Seleciona na tabela tAtendente.xml todos os atendentes que possuem os campos informados, retornando um array do tipo SimpleXMLElement.
	 *
	 * @param string $codigo			[Opcional] Codigo do atendente.
	 * @param string $nome				[Opcional] Nome do atendente.
	 * @param string $senha				[Opcional] Senha do atendente.
	 * @param string $cpf				[Opcional] CPF do atendente.
	 * @param string $dtNascimento		[Opcional] Data de Nascimento do atendente.
	 * @param string $endereco			[Opcional] Endereco do atendente.
	 * @param string $telefone			[Opcional] Telefone do atendente.
	 * @param string $email				[Opcional] E-mail do atendente.
	 * @param string $reg_date			[Opcional] Data de registro no sistema
	 * 
	 * @return SimpleXMLElement[] $xml	Retorna um array de SimpleXMLObject contendo o resultado da consulta.
	 * 
	 */
	public function selectAtendente(string $codigo = null, string $nome = null, string $senha = null, string $cpf = null, string $dtNascimento = null, string $endereco = null, string $telefone = null, string $email = null, string $reg_date = null) {
		$tablePath = $this->tablePathAtendente;
		$xml=simplexml_load_file($tablePath) or die("Error: Cannot create object");
		$maisDeUmParametro = false;
		if (($codigo == null) && 
			($nome == null) &&
			($senha == null) &&
			($cpf == null) &&
			($dtNascimento == null) && 
			($endereco == null) && 
			($telefone == null) &&
			($email == null) &&
			($reg_date == null))
		{
			$xPathQuery = "atendente";
			return $xml->xpath($xPathQuery); // Retorna um Array de SimpleXML Object, contendo os resultados 
		}
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
			$xPathQuery = $xPathQuery."senha/text()='".$senha."'";
			$maisDeUmParametro = true;
		}
		if ($cpf != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."cpf/text()='".$cpf."'";
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
	 * excluirAtendente
	 *
	 * Exclui da tabela tAtendente.xml o atendente que possui o codigo informado.
	 * 
	 * @param string $codigo			Codigo do atendente a ser excluido da tabela.
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function excluirAtendente(string $codigo) {
		$tablePath = $this->tablePathAtendente;
		$atendente = $this->selectAtendente($codigo);
		if($atendente == null) {
			return "ERRO: Não há atendente com o código ".$codigo.".";
		}
		$domAtendente = dom_import_simplexml($atendente[0]);
		$domXML = $domAtendente->parentNode->parentNode; //  documento XML
		$domAtendente->parentNode->removeChild($domAtendente);
		if($domXML->save($tablePath)) {
			return "Exclusão efetuada com sucesso!";
		}else {
			return "ERRO: Ao salvar modificações na tabela ".$tablePath.".";
		}
	}


	/**
	 * updateAtendenteCompleto
	 *
	 * Salva na tabela tAtendente.xml as alteracoes no atendente que possui o codigo informado.
	 * 
	 * @param string $codigo		Codigo do atendente a ser atualizado.
	 * @param string $nome			[Opcional] Nome do atendente.
	 * @param string $senha			[Opcional] Senha do atendente.
	 * @param string $cpf			[Opcional] CPF do atendente.
	 * @param string $dtNascimento	[Opcional] Data de Nascimento do atendente.
	 * @param string $endereco		[Opcional] Endereco do atendente.
	 * @param string $telefone		[Opcional] Telefone do atendente.
	 * @param string $email			[Opcional] E-mail do atendente.
	 * 
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function updateAtendenteCompleto(string $codigo, string $nome = null, string $senha = null, string $cpf = null, string $dtNascimento = null, string $endereco = null, string $telefone = null, string $email=null) {
		$tablePath = $this->tablePathAtendente;
		$houveAlteracao = false;
		$atendente = $this->selectAtendente($codigo);
		if($atendente == null) {
			return "ERRO: Não há atendente com o código ".$codigo.".";
		}
		$atendente = $atendente[0];
		if(($atendente->codigo != $codigo) or ($codigo == null)) {
			return "ERRO: código invalido.";
		}
		if(($atendente->nome != $nome) and ($nome != null)) {
			$atendente->nome = $nome;
			$houveAlteracao = true;
		}
		if(($atendente->senha != $senha) and ($senha != null)) {
			$atendente->senha = $senha;
			$houveAlteracao = true;
		}
		if(($atendente->cpf != $cpf) and ($cpf != null)) {
			if($this->verificaCPFAtendente($cpf)){
				return "ERRO: Este CPF já está cadastrado para outro usuário.";
			}
			$atendente->cpf = $cpf;
			$houveAlteracao = true;
		}
		if(($atendente->dtNascimento != $dtNascimento) and ($dtNascimento != null)) {
			$atendente->dtNascimento = $dtNascimento;
			$houveAlteracao = true;
		}
		if(($atendente->endereco != $endereco) and ($endereco != null)) {
			$atendente->endereco = $endereco;
			$houveAlteracao = true;
		}
		if(($atendente->telefone != $telefone) and ($telefone != null)) {
			$atendente->telefone = $telefone;
			$houveAlteracao = true;
		}
		if(($atendente->email != $email) and ($email != null)) {
			$atendente->email = $email;
			$houveAlteracao = true;
		}
		if(!$houveAlteracao) {
			return "Não houve alteração.";
		}
		$domAtendente = dom_import_simplexml($atendente);
		$domXML = $domAtendente->parentNode->parentNode; //  documento XML
		// Salva as alterações na tabela
		if($domXML->save($tablePath)) {
			return "Alteração efetuada com sucesso!";
		}else {
			return "ERRO: Ao salvar modificações na tabela ".$tablePath.".";
		}
	}


	/**
	 * insertAtendente
	 *
	 * Salva na tabela tAtendente.xml os atributos do objeto desta classe
	 * 
	 * @param void
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function insertAtendente() {
		$msgRetorno = $this->insertAtendenteCompleto($this->nome, 
													$this->senha, 
													$this->cpf,
													$this->dtNascimento,
													$this->endereco,
													$this->telefone,
													$this->email
		);
		if (strcmp($msgRetorno, "Inserção realizada com sucesso!") != 0) {
			return $msgRetorno; // Significa que deu erro.
		}
		$this->codigo = $this->getCodigoByAtendente($this);
		$this->reg_date = $this->getAtendenteByCodigo($this->codigo)[0]->reg_date;
		return $msgRetorno;
	}


	/**
	 * updateAtendente
	 *
	 * Salva na tabela tAtendente.xml as alteracoes presentes nos atributos do objeto desta classe.
	 * 
	 * @param void
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function updateAtendente() {
		if($this->codigo == null) {
			return "ERRO: Código do atendente invalido.";
		}
		return $this->updateAtendenteCompleto(	$this->codigo,
												$this->nome, 
												$this->senha, 
												$this->cpf,
												$this->dtNascimento,
												$this->endereco,
												$this->telefone,
												$this->email
		);
	}


	/**
	 * clearAtendente
	 *
	 * Limpa os atributos do objeto da classe lAtendente.
	 * 
	 * @param void
	 * @return void
	 * 
	 */
	public function clearAtendente() {
		$this->codigo = null;
		$this->nome = null;
		$this->senha = null;
		$this->cpf = null;
		$this->dtNascimento = null;
		$this->endereco = null;
		$this->telefone = null;
		$this->email = null;
		$this->reg_date = null;
	}


	/**
	 * getAtendenteByCodigo
	 * 
	 * Busca os Atendentes que possuem o codigo informado e retorna um array com objetos da classe lAtendente.
	 * 
	 * @param string $codigo				Codigo do atendente a ser buscado.
	 * @return lAtendente[] $ListaAtendente	Retorna um array de objetos da classe lAtendente.
	 * 
	 */
	public function getAtendenteByCodigo(string $codigo) {
		$ListSimpleXMLObject = $this->selectAtendente($codigo);
		$ListaAtendentes = $this->traduzSimpleXMLObjectToAtendente($ListSimpleXMLObject);
		return $ListaAtendentes;
	}


	/**
	 * getAtendenteByNome
	 *
	 * Busca os Atendentes que possuem o nome informado e retorna um array com objetos da classe lAtendente.
	 * 
	 * @param string $nome					Nome do atendente a ser buscado.
	 * @return lAtendente[] $ListaAtendente	Retorna um array de objetos da classe lAtendente.
	 * 
	 */
	public function getAtendenteByNome(string $nome) {
		$ListSimpleXMLObject = $this->selectAtendente(null, $nome);
		$ListaAtendentes = $this->traduzSimpleXMLObjectToAtendente($ListSimpleXMLObject);
		return $ListaAtendentes;
	}


	/**
	 * getAtendenteByCPF
	 * 
	 * Busca os Atendentes que possuem o CPF informado e retorna um array com objetos da classe lAtendente.
	 * 
	 * @param string $cpf					CPF do atendente a ser buscado.
	 * @return lAtendente[] $ListaAtendente	Retorna um array de objetos da classe lAtendente.
	 * 
	 */
	public function getAtendenteByCPF(string $cpf) {
		$ListSimpleXMLObject = $this->selectAtendente(null, null, null, $cpf);
		$ListaAtendentes = $this->traduzSimpleXMLObjectToAtendente($ListSimpleXMLObject);
		return $ListaAtendentes;
	}


	/**
	 * getAtendenteByDtNascimento
	 *
	 * Busca os Atendentes que possuem a Data de Nascimento informada e retorna um array com objetos da classe lAtendente.
	 * 
	 * @param string $dtNascimento			Data de Nascimento do atendente a ser buscado.
	 * @return lAtendente[] $ListaAtendente	Retorna um array de objetos da classe lAtendente.
	 * 
	 */
	public function getAtendenteByDtNascimento($dtNascimento) {
		$ListSimpleXMLObject = $this->selectAtendente(null, null, null,  null, $dtNascimento);
		$ListaAtendentes = $this->traduzSimpleXMLObjectToAtendente($ListSimpleXMLObject);
		return $ListaAtendentes;
	}


	/**
	 * getAtendenteByEndereco
	 *
	 * Busca os Atendentes que possuem o Endereco informado e retorna um array com objetos da classe lAtendente.
	 * 
	 * @param string $endereco				Endereco do atendente a ser buscado.
	 * @return lAtendente[] $ListaAtendente	Retorna um array de objetos da classe lAtendente.
	 * 
	 */
	public function getAtendenteByEndereco($endereco) {
		$ListSimpleXMLObject = $this->selectAtendente(null, null, null, null, null, $endereco);
		$ListaAtendentes = $this->traduzSimpleXMLObjectToAtendente($ListSimpleXMLObject);
		return $ListaAtendentes;
	}


	/**
	 * getAtendenteByTelefone
	 *
	 * Busca os Atendentes que possuem o Telefone informado e retorna um array com objetos da classe lAtendente.
	 * 
	 * @param string $telefone				Telefone do tendente a ser buscado.
	 * @return lAtendente[] $ListaAtendente	Retorna um array de objetos da classe lAtendente.
	 * 
	 */
	public function getAtendenteByTelefone($telefone) {
		$ListSimpleXMLObject = $this->selectAtendente(null, null, null, null, null, null, $telefone);
		$ListaAtendentes = $this->traduzSimpleXMLObjectToAtendente($ListSimpleXMLObject);
		return $ListaAtendentes;
	}


	/**
	 * getAtendenteByEmail
	 *
	 * Busca os Atendentes que possuem o E-mail informado e retorna um array com objetos da classe lAtendente.
	 * 
	 * @param string $email					E-mail d atendente a ser buscado.
	 * @return lAtendente[] $ListaAtendente	Retorna um array de objetos da classe lAtendente.
	 * 
	 */
	public function getAtendenteByEmail($email) {
		$ListSimpleXMLObject = $this->selectAtendente(null, null, null, null, null, null, null, $email);
		$ListaAtendentes = $this->traduzSimpleXMLObjectToAtendente($ListSimpleXMLObject);
		return $ListaAtendentes;
	}


	/**
	 * getCodigoByAtendente
	 *
	 * Busca o Atendente informado e retorna uma string com o seu codigo.
	 * 
	 * @param lAtendente $oAtendente	Objeto da classe lAtendente.
	 * @return string $codigo			Retorna o Codigo do Atendente (em string).
	 * 
	 */
	public function getCodigoByAtendente(lAtendente $oAtendente) {
		$temp = $this->selectAtendente (null,
										$oAtendente->nome,
										$oAtendente->senha,
										$oAtendente->cpf,
										$oAtendente->dtNascimento,
										$oAtendente->endereco,
										$oAtendente->telefone,
										$oAtendente->email
									   );
		$codigo = (string) $temp[0]->codigo;
		return $codigo;
	}

	/**
	 * getTabela
	 *
	 * Retorna toda a tabela tAtendente em um array de objetos da classe lAtendente.
	 * 
	 * @param void
	 * @return array lAtendente 	Array de objetos da classe lAtendente
	 * 
	 */
	public function getTabela(){
		return $this->traduzSimpleXMLObjectToAtendente($this->selectAtendente());
	}
}

?>
