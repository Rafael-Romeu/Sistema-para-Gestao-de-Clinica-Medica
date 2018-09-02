<?php

/**
 * ..:: Logica para manipulacao da tabela de Pacientes ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

class lPaciente {
/**
 * Classe de lógica para manipulação da tabela tPaciente.xml
 * 
 * @var string $codigo				Codigo de identificacao no padrão "P0000"
 * @var string $nome       			Nome do Paciente
 * @var string $senha        		Senha
 * @var string $cpf        			CPF no padrão "777.777.777-77"
 * @var string $planoDeSaude		Plano de Saúde em que o Paciente faz parte
 * @var string $genero				Generos possiveis: Masculino (M), Feminino (F) ou Outro (O)
 * @var string $tipoSanguineo		Tipo Sanguineo do Paciente (A+, A-, B+, B-, AB+, AB-, O+, O-)	
 * @var string $dtNascimento		Data de nascimento, no padrão 1900-01-01
 * @var string $endereco       		Endereco do Paciente
 * @var string $telefone       		Telefone do Paciente
 * @var string $email        		E-mail do Paciente
 * @var string $reg_date        	Data e Hora de registro do Paciente do sistema
 * @var boolean $semEspaco			Flag para verificacao se ha espaco vazio no meio da tabela tPaciente.xml
 * @var string $tablePathPaciente	File path da tabela tPaciente.xml
 * 
 */

	public $codigo;
	public $nome;
	public $senha;
	public $cpf;
	public $planoDeSaude;
	public $genero;
	public $tipoSanguineo;
	public $dtNascimento;
	public $endereco;
	public $telefone;
	public $email;
	public $reg_date;
	private $semEspaco;
	private $tablePathPaciente;
	
/**
 * lPaciente
 * 
 * Construtor da classe lPaciente, que inicializa os parametros como null.
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
		$this->planoDeSaude = null;
		$this->genero = null;
		$this->tipoSanguineo = null;
		$this->dtNascimento = null;
		$this->endereco = null;
		$this->telefone = null;
		$this->email = null;
		$this->reg_date = null;
		$this->semEspaco = false;
		$this->tablePathPaciente = $_SERVER['DOCUMENT_ROOT']."/BancoDeDados/db/tPaciente.xml";
    }
	
	/**
	 * createTablePaciente
	 *
	 * Metodo para a criacao da tabela Paciente.xml, contendo o primeiro registro como Template.
	 * 
	 * @param void
	 * @return int 1|0	Retorna 1 se houve ERRO, ou 0 se a criacao da tabela foi realizada com sucesso.
	 * 
	 */
	public function createTablePaciente() {
		$filePathPaciente = $this->tablePathPaciente;
		$file = fopen($filePathPaciente, "w+");
	$template = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<root>
	<paciente>
		<codigo>P0000</codigo>
		<nome>Template</nome>
		<senha>admin</senha>
		<cpf>admin</cpf>
		<planoDeSaude>(Plano de Saude)</planoDeSaude>
		<genero>( M || F || O )</genero>
		<tipoSanguineo>( A+ || A- || B+ || B- || AB+ || AB- || O+ || O- )</tipoSanguineo>
		<dtNascimento>1900-01-01</dtNascimento>
		<endereco>(sem endereço)</endereco>
		<telefone>(sem telefone)</telefone>
		<email>(sem E-mail)</email>
		<reg_date>1993-05-31 23:59:59</reg_date>
  </paciente>
</root>
XML;
		fwrite($file,$template);
		fclose($file);
		$file = fopen($filePathPaciente, "r");
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
			$codAnterior = ("P".sprintf('%04d', $i)); $i++;
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
	 * traduzSimpleXMLObjectToPaciente
	 *
	 * Traduz um array de SimpleXMLObject em um array de lPaciente
	 * 
	 * @param SimpleXMLElement[] $ListSimpleXMLObject		Array de SimpleXMLObject.
	 * @return lPaciente[] $ListaPaciente					Array de lPaciente.
	 * 
	 */
	public function traduzSimpleXMLObjectToPaciente($ListSimpleXMLObject) {
		$ListaPaciente = array();
		foreach($ListSimpleXMLObject as $SimpleXMLObject) {
			$oPaciente = new lPaciente();
			$oPaciente->codigo 	  		= (string)$SimpleXMLObject->codigo;
			$oPaciente->nome 		  	= (string)$SimpleXMLObject->nome;
			$oPaciente->senha		  	= (string)$SimpleXMLObject->senha;
			$oPaciente->cpf 		   	= (string)$SimpleXMLObject->cpf;
			$oPaciente->planoDeSaude	= (string)$SimpleXMLObject->planoDeSaude;
			$oPaciente->genero			= (string)$SimpleXMLObject->genero;
			$oPaciente->tipoSanguineo	= (string)$SimpleXMLObject->tipoSanguineo;
			$oPaciente->dtNascimento	= (string)$SimpleXMLObject->dtNascimento;
			$oPaciente->endereco    	= (string)$SimpleXMLObject->endereco;
			$oPaciente->telefone    	= (string)$SimpleXMLObject->telefone;
			$oPaciente->email       	= (string)$SimpleXMLObject->email;
			$oPaciente->reg_date    	= (string)$SimpleXMLObject->reg_date;
			array_push($ListaPaciente, $oPaciente);
		}
		return $ListaPaciente;
	}

	/**
	 * verificaCPFPaciente
	 *
	 * Verifica se o CPF informado já está presente na tabela tPaciente.xml
	 * 
	 * @param string $cpf		CPF do Paciente a ser verificado.
	 * @return false|true		'false' se Sucesso | 'true' se ERRO: Paciente já cadastrado.
	 * 
	 */
	public function verificaCPFPaciente(string $cpf) {
		if ($this->getPacienteByCPF($cpf) == null) {
			return false; // Sucesso
		}
		return true; // ERRO: Paciente já cadastrado. 
	}

	/**
	 * insertPacienteCompleto
	 *
	 * Salva na tabela tPaciente.xml o novo Paciente que possui os parametros informados.
	 * 
	 * @param string $nome			Nome do Paciente.
	 * @param string $senha			Senha do Paciente.
	 * @param string $cpf			CPF do Paciente.
	 * @param string $planoDeSaude	Plano de Saude o qual o Paciente faz parte.
	 * @param string $genero		Genero do Paciente ( M || F || O )
	 * @param string $tipoSanguineo	Tipo Sanguineo do Paciente ( A+ || A- || B+ || B- || AB+ || AB- || O+ || O- )
	 * @param string $dtNascimento	[Opcional] Data de Nascimento do Paciente.
	 * @param string $endereco		[Opcional] Endereco do Paciente.
	 * @param string $telefone		[Opcional] Telefone do Paciente.
	 * @param string $email			[Opcional] E-mail do Paciente.
	 * 
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function insertPacienteCompleto(string $nome, string $senha, string $cpf, string $planoDeSaude, string $genero , string $tipoSanguineo, string $dtNascimento=null, string $endereco=null, string $telefone=null, string $email=null) {
		$tablePath  = $this->tablePathPaciente;
		$domXML = new DOMDocument('1.0');
		$domXML->preserveWhiteSpace = false;
		$domXML->formatOutput = true;
		if ($domXML->load($tablePath)) {
			//echo "segue o baile\n";
		}else {
			echo "\n\nTabela '". $tablePath."' não encontrada.\nCriando tabela...\n\n";
			if( createTablePaciente($tablePath) ) exit("ERRO ao criar a tabela");
			else echo "\nTabela '".$tablePath. "' criada com sucesso!\n";
			$domXML->load($tablePath);
		}
		$root = $domXML->getElementsByTagName('root')->item(0);
		// busca o primeiro espaco vazio
		$domPosition = lPaciente::buscaEspacoVazio($domXML);
		//Extrai o codigo e transforma em int
		$strCodigo = $domPosition->firstChild->nodeValue;
		$strCodigo = substr($strCodigo, 1);
		$intCodigo = intval($strCodigo);
		$Paciente = $domXML->createElement('paciente');
		if ($this->semEspaco) {
			$codigo = "P".sprintf('%04d', $intCodigo + 1);
			$root->appendChild($Paciente);
		}else {
			$codigo = "P".sprintf('%04d', $intCodigo - 1);
			$root->insertBefore($Paciente, $domPosition);
		}
		// ******* Inserção do Código *******
		$codigoElement = $domXML->createElement("codigo", $codigo);
		$Paciente->appendChild($codigoElement);
		// ******* Inserção do Nome *******
		if($nome == null) {
			return "ERRO: Campo 'Nome' é obrigatório.";
		}
		$nomeElement = $domXML->createElement("nome", $nome);
		$Paciente->appendChild($nomeElement);
		// ******* Inserção da Senha *******
		if($senha == null) {
			return "ERRO: Campo 'Senha' é obrigatório.";
		}
		$senhaElement = $domXML->createElement("senha", $senha);
		$Paciente->appendChild($senhaElement);
		// ******* Inserção do CPF *******
		if($cpf == null) {
			return "ERRO: Campo 'CPF' é obrigatório.";
		}
		if($this->verificaCPFPaciente($cpf)){
			return "ERRO: Este CPF já está cadastrado.";
		}
		$cpfElement = $domXML->createElement("cpf", $cpf);
		$Paciente->appendChild($cpfElement);
		// ******* Inserção do Plano de Saude *******
		if($planoDeSaude == null) {
			return "ERRO: Campo 'Plano de Saúde' é obrigatório.";
		}
		$planoDeSaudeElement = $domXML->createElement("planoDeSaude", $planoDeSaude);
		$Paciente->appendChild($planoDeSaudeElement);
		// ******* Inserção do Genero *******
		if($genero == null) {
			return "ERRO: Campo 'Gênero' é obrigatório.";
		}
		$generoElement = $domXML->createElement("genero", $genero);
		$Paciente->appendChild($generoElement);
		// ******* Inserção do Tipo Sanguineo *******
		if($tipoSanguineo == null) {
			return "ERRO: Campo 'Tipo Sanguíneo' é obrigatório.";
		}
		$tipoSanguineoElement = $domXML->createElement("tipoSanguineo", $tipoSanguineo);
		$Paciente->appendChild($tipoSanguineoElement);
		// ******* Inserção da Data de Nascimento *******
		if($dtNascimento == null) {
			$dtNascimento = "1900-01-01"; // Data default
		}
		$dtNascimentoElement = $domXML->createElement("dtNascimento", $dtNascimento);
		$Paciente->appendChild($dtNascimentoElement);
		// ******* Inserção do Endereço *******
		if($endereco == null) {
			$endereco =  "(sem endereço)";
		}
		$enderecoElement = $domXML->createElement("endereco", $endereco);
		$Paciente->appendChild($enderecoElement);
		// ******* Inserção do Telefone *******
		if($telefone == null) {
			$telefone = "(sem telefone)";
		}
		$telefoneElement = $domXML->createElement("telefone", $telefone);
		$Paciente->appendChild($telefoneElement);
		// ******* Inserção do E-mail *******
		if($email == null) {
			$email = "(sem E-mail)";
		}
		$emailElement = $domXML->createElement("email", $email);
		$Paciente->appendChild($emailElement);
		// ******* Inserção da Data de Registro no Sitema *******
		$reg_dateElement = $domXML->createElement("reg_date", date("Y-m-d H:i:s",time()));
		$Paciente->appendChild($reg_dateElement);
		if($domXML->save($tablePath)) {
			return "Inserção realizada com sucesso!";
		}else {
			return "Erro ao inserir registro de Paciente.";
		}
	}


	/**
	 * selectPaciente
	 *
	 * Seleciona na tabela tPaciente.xml todos os Pacientes que possuem os campos informados, retornando um array do tipo SimpleXMLElement.
	 *
	 * @param string $codigo			[Opcional] Codigo do Paciente.
	 * @param string $nome				[Opcional] Nome do Paciente.
	 * @param string $senha				[Opcional] Senha do Paciente.
	 * @param string $cpf				[Opcional] CPF do Paciente.
	 * @param string $planoDeSaude		[Opcional] Plano de Saude o qual o Paciente faz parte.
	 * @param string $genero			[Opcional] Genero do Paciente ( M || F || O ).
	 * @param string $tipoSanguineo		[Opcional] Tipo Sanguineo do Paciente ( A+ || A- || B+ || B- || AB+ || AB- || O+ || O- )
	 * @param string $dtNascimento		[Opcional] Data de Nascimento do Paciente.
	 * @param string $endereco			[Opcional] Endereco do Paciente.
	 * @param string $telefone			[Opcional] Telefone do Paciente.
	 * @param string $email				[Opcional] E-mail do Paciente.
	 * @param string $reg_date			[Opcional] Data de registro no sistema.
	 * 
	 * @return SimpleXMLElement[] $xml	Retorna um array de SimpleXMLObject contendo o resultado da consulta.
	 * 
	 */
	public function selectPaciente(string $codigo = null, string $nome = null, string $senha = null, string $cpf = null, string $planoDeSaude = null, string $genero = null, string $tipoSanguineo = null, string $dtNascimento = null, string $endereco = null, string $telefone = null, string $email = null, string $reg_date = null) {
		$tablePath = $this->tablePathPaciente;
		$xml=simplexml_load_file($tablePath) or die("Error: Cannot create object");
		$maisDeUmParametro = false;
		if (($codigo == null) && 
			($nome == null) &&
			($senha == null) &&
			($cpf == null) &&
			($planoDeSaude == null) &&
			($genero == null) &&
			($tipoSanguineo == null) &&
			($dtNascimento == null) && 
			($endereco == null) && 
			($telefone == null) &&
			($email == null) &&
			($reg_date == null))
		{
			$xPathQuery = "paciente";
			return $xml->xpath($xPathQuery); // Retorna um Array de SimpleXML Object, contendo os resultados 
		}
		$xPathQuery = "paciente[";
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
		if ($planoDeSaude != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."planoDeSaude/text()='".$planoDeSaude."'";
			$maisDeUmParametro = true;
		}
		if ($genero != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."genero/text()='".$genero."'";
			$maisDeUmParametro = true;
		}
		if ($tipoSanguineo != null) {
			if ($maisDeUmParametro) $xPathQuery = $xPathQuery." and ";
			$xPathQuery = $xPathQuery."tipoSanguineo/text()='".$tipoSanguineo."'";
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
	 * excluirPaciente
	 *
	 * Exclui da tabela tPaciente.xml o Paciente que possui o codigo informado.
	 * 
	 * @param string $codigo			Codigo do Paciente a ser excluido da tabela.
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function excluirPaciente(string $codigo) {
		$tablePath = $this->tablePathPaciente;
		$Paciente = $this->selectPaciente($codigo);
		if($Paciente == null) {
			return "ERRO: Não há Paciente com o código ".$codigo.".";
		}
		$domPaciente = dom_import_simplexml($Paciente[0]);
		$domXML = $domPaciente->parentNode->parentNode; //  documento XML
		$domPaciente->parentNode->removeChild($domPaciente);
		if($domXML->save($tablePath)) {
			return "Exclusão efetuada com sucesso!";
		}else {
			return "ERRO: Ao salvar modificações na tabela ".$tablePath.".";
		}
	}


	/**
	 * updatePacienteCompleto
	 *
	 * Salva na tabela tPaciente.xml as alteracoes no Paciente que possui o codigo informado.
	 * 
	 * @param string $codigo		Codigo do Paciente a ser atualizado.
	 * @param string $nome			[Opcional] Nome do Paciente.
	 * @param string $senha			[Opcional] Senha do Paciente.
	 * @param string $cpf			[Opcional] CPF do Paciente.
	 * @param string $planoDeSaude	[Opcional] Plano de Saude o qual o Paciente faz parte.
	 * @param string $genero		[Opcional] Genero do Paciente ( M || F || O ).
	 * @param string $tipoSanguineo	[Opcional] Tipo Sanguineo do Paciente ( A+ || A- || B+ || B- || AB+ || AB- || O+ || O- )
	 * @param string $dtNascimento	[Opcional] Data de Nascimento do Paciente.
	 * @param string $endereco		[Opcional] Endereco do Paciente.
	 * @param string $telefone		[Opcional] Telefone do Paciente.
	 * @param string $email			[Opcional] E-mail do Paciente.
	 * 
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function updatePacienteCompleto(string $codigo, string $nome = null, string $senha = null, string $cpf = null, string $planoDeSaude = null, string $genero = null, string $tipoSanguineo = null, string $dtNascimento = null, string $endereco = null, string $telefone = null, string $email=null) {
		$tablePath = $this->tablePathPaciente;
		$houveAlteracao = false;
		$Paciente = $this->selectPaciente($codigo);
		if($Paciente == null) {
			return "ERRO: Não há Paciente com o código ".$codigo.".";
		}
		$Paciente = $Paciente[0];
		if(($Paciente->codigo != $codigo) or ($codigo == null)) {
			return "ERRO: código inválido.";
		}
		if(($Paciente->nome != $nome) and ($nome != null)) {
			$Paciente->nome = $nome;
			$houveAlteracao = true;
		}
		if(($Paciente->senha != $senha) and ($senha != null)) {
			$Paciente->senha = $senha;
			$houveAlteracao = true;
		}
		if(($Paciente->cpf != $cpf) and ($cpf != null)) {
			if($this->verificaCPFPaciente($cpf)){
				return "ERRO: Este CPF já está cadastrado para outro usuário.";
			}
			$Paciente->cpf = $cpf;
			$houveAlteracao = true;
		}
		if(($Paciente->planoDeSaude != $planoDeSaude) and ($planoDeSaude != null)) {
			$Paciente->planoDeSaude = $planoDeSaude;
			$houveAlteracao = true;
		}
		if(($Paciente->genero != $genero) and ($genero != null)) {
			$Paciente->genero = $genero;
			$houveAlteracao = true;
		}
		if(($Paciente->tipoSanguineo != $tipoSanguineo) and ($tipoSanguineo != null)) {
			$Paciente->tipoSanguineo = $tipoSanguineo;
			$houveAlteracao = true;
		}
		if(($Paciente->dtNascimento != $dtNascimento) and ($dtNascimento != null)) {
			$Paciente->dtNascimento = $dtNascimento;
			$houveAlteracao = true;
		}
		if(($Paciente->endereco != $endereco) and ($endereco != null)) {
			$Paciente->endereco = $endereco;
			$houveAlteracao = true;
		}
		if(($Paciente->telefone != $telefone) and ($telefone != null)) {
			$Paciente->telefone = $telefone;
			$houveAlteracao = true;
		}
		if(($Paciente->email != $email) and ($email != null)) {
			$Paciente->email = $email;
			$houveAlteracao = true;
		}
		if(!$houveAlteracao) {
			return "Não houve alteração.";
		}
		$domPaciente = dom_import_simplexml($Paciente);
		$domXML = $domPaciente->parentNode->parentNode; //  documento XML
		// Salva as alterações na tabela
		if($domXML->save($tablePath)) {
			return "Alteração efetuada com sucesso!";
		}else {
			return "ERRO: Ao salvar modificações na tabela ".$tablePath.".";
		}
	}


	/**
	 * insertPaciente
	 *
	 * Salva na tabela tPaciente.xml os atributos do objeto desta classe
	 * 
	 * @param void
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function insertPaciente() {
		$msgRetorno = $this->insertPacienteCompleto($this->nome, 
													$this->senha, 
													$this->cpf,
													$this->planoDeSaude,
													$this->genero,
													$this->tipoSanguineo,
													$this->dtNascimento,
													$this->endereco,
													$this->telefone,
													$this->email
		);
		if (strcmp($msgRetorno, "Insercao realizada com sucesso!") != 0) {
			return $msgRetorno; // Significa que deu erro.
		}
		$this->codigo = $this->getCodigoByPaciente($this);
		$this->reg_date = $this->getPacienteByCodigo($this->codigo)[0]->reg_date;
		return $msgRetorno;
	}


	/**
	 * updatePaciente
	 *
	 * Salva na tabela tPaciente.xml as alteracoes presentes nos atributos do objeto desta classe.
	 * 
	 * @param void
	 * @return string "Sucesso"|"ERRO"
	 * 
	 */
	public function updatePaciente() {
		if($this->codigo == null) {
			return "ERRO: Código do Paciente invalido.";
		}
		return $this->updatePacienteCompleto(	$this->codigo,
												$this->nome, 
												$this->senha, 
												$this->cpf,
												$this->planoDeSaude,
												$this->genero,
												$this->tipoSanguineo,
												$this->dtNascimento,
												$this->endereco,
												$this->telefone,
												$this->email
		);
	}


	/**
	 * clearPaciente
	 *
	 * Limpa os atributos do objeto da classe lPaciente.
	 * 
	 * @param void
	 * @return void
	 * 
	 */
	public function clearPaciente() {
		$this->codigo = null;
		$this->nome = null;
		$this->senha = null;
		$this->cpf = null;
		$this->planoDeSaude = null;
		$this->genero = null;
		$this->tipoSanguineo = null;
		$this->dtNascimento = null;
		$this->endereco = null;
		$this->telefone = null;
		$this->email = null;
		$this->reg_date = null;
	}


	/**
	 * getPacienteByCodigo
	 * 
	 * Busca os Pacientes que possuem o codigo informado e retorna um array com objetos da classe lPaciente.
	 * 
	 * @param string $codigo				Codigo do Paciente a ser buscado.
	 * @return lPaciente[] $ListaPaciente	Retorna um array de objetos da classe lPaciente.
	 * 
	 */
	public function getPacienteByCodigo(string $codigo) {
		$ListSimpleXMLObject = $this->selectPaciente($codigo);
		$ListaPacientes = $this->traduzSimpleXMLObjectToPaciente($ListSimpleXMLObject);
		return $ListaPacientes;
	}


	/**
	 * getPacienteByNome
	 *
	 * Busca os Pacientes que possuem o nome informado e retorna um array com objetos da classe lPaciente.
	 * 
	 * @param string $nome				Nome do Paciente a ser buscado.
	 * @return lPaciente[] $ListaPaciente	Retorna um array de objetos da classe lPaciente.
	 * 
	 */
	public function getPacienteByNome(string $nome) {
		$ListSimpleXMLObject = $this->selectPaciente(null, $nome);
		$ListaPacientes = $this->traduzSimpleXMLObjectToPaciente($ListSimpleXMLObject);
		return $ListaPacientes;
	}


	/**
	 * getPacienteByCPF
	 * 
	 * Busca os Pacientes que possuem o CPF informado e retorna um array com objetos da classe lPaciente.
	 * 
	 * @param string $cpf				CPF do Paciente a ser buscado.
	 * @return lPaciente[] $ListaPaciente	Retorna um array de objetos da classe lPaciente.
	 * 
	 */
	public function getPacienteByCPF(string $cpf) {
		$ListSimpleXMLObject = $this->selectPaciente(null, null, null, $cpf);
		$ListaPacientes = $this->traduzSimpleXMLObjectToPaciente($ListSimpleXMLObject);
		return $ListaPacientes;
	}


	/**
	 * getPacienteByPlanoDeSaude
	 * 
	 * Busca os Pacientes que possuem o Plano de Saude informado e retorna um array com objetos da classe lPaciente.
	 * 
	 * @param string $planoDeSaude		Especialidade do Paciente a ser buscado.
	 * @return lPaciente[] $ListaPaciente	Retorna um array de objetos da classe lPaciente.
	 * 
	 */
	public function getPacienteByPlanoDeSaude(string $planoDeSaude) {
		$ListSimpleXMLObject = $this->selectPaciente(null, null, null, null, $planoDeSaude);
		$ListaPacientes = $this->traduzSimpleXMLObjectToPaciente($ListSimpleXMLObject);
		return $ListaPacientes;
	}


	/**
	 * getPacienteByGenero
	 * 
	 * Busca os Pacientes que possuem o Genero informado e retorna um array com objetos da classe lPaciente.
	 * 
	 * @param string $genero				Genero do Paciente a ser buscado.
	 * @return lPaciente[] $ListaPaciente	Retorna um array de objetos da classe lPaciente.
	 * 
	 */
	public function getPacienteByGenero(string $genero) {
		$ListSimpleXMLObject = $this->selectPaciente(null, null, null, null, null, $genero);
		$ListaPacientes = $this->traduzSimpleXMLObjectToPaciente($ListSimpleXMLObject);
		return $ListaPacientes;
	}


	/**
	 * getPacienteByTipoSanguineo
	 * 
	 * Busca os Pacientes que possuem o Tipo Sanguineo informado e retorna um array com objetos da classe lPaciente.
	 * 
	 * @param string $tipoSanguineo				Tipo Sanguineo do Paciente a ser buscado.
	 * @return lPaciente[] $ListaPaciente		Retorna um array de objetos da classe lPaciente.
	 * 
	 */
	public function getPacienteByTipoSanguineo(string $tipoSanguineo) {
		$ListSimpleXMLObject = $this->selectPaciente(null, null, null, null, null, null, $tipoSanguineo);
		$ListaPacientes = $this->traduzSimpleXMLObjectToPaciente($ListSimpleXMLObject);
		return $ListaPacientes;
	}


	/**
	 * getPacienteByDtNascimento
	 *
	 * Busca os Pacientes que possuem a Data de Nascimento informada e retorna um array com objetos da classe lPaciente.
	 * 
	 * @param string $dtNascimento			Data de Nascimento do Paciente a ser buscado.
	 * @return lPaciente[] $ListaPaciente	Retorna um array de objetos da classe lPaciente.
	 * 
	 */
	public function getPacienteByDtNascimento($dtNascimento) {
		$ListSimpleXMLObject = $this->selectPaciente(null, null, null,  null, null, null, null, $dtNascimento);
		$ListaPacientes = $this->traduzSimpleXMLObjectToPaciente($ListSimpleXMLObject);
		return $ListaPacientes;
	}


	/**
	 * getPacienteByEndereco
	 *
	 * Busca os Pacientes que possuem o Endereco informado e retorna um array com objetos da classe lPaciente.
	 * 
	 * @param string $endereco				Endereco do Paciente a ser buscado.
	 * @return lPaciente[] $ListaPaciente	Retorna um array de objetos da classe lPaciente.
	 * 
	 */
	public function getPacienteByEndereco($endereco) {
		$ListSimpleXMLObject = $this->selectPaciente(null, null, null, null, null, null, null, null, $endereco);
		$ListaPacientes = $this->traduzSimpleXMLObjectToPaciente($ListSimpleXMLObject);
		return $ListaPacientes;
	}


	/**
	 * getPacienteByTelefone
	 *
	 * Busca os Pacientes que possuem o Telefone informado e retorna um array com objetos da classe lPaciente.
	 * 
	 * @param string $telefone				Telefone do tendente a ser buscado.
	 * @return lPaciente[] $ListaPaciente	Retorna um array de objetos da classe lPaciente.
	 * 
	 */
	public function getPacienteByTelefone($telefone) {
		$ListSimpleXMLObject = $this->selectPaciente(null, null, null, null, null, null, null, null, null, $telefone);
		$ListaPacientes = $this->traduzSimpleXMLObjectToPaciente($ListSimpleXMLObject);
		return $ListaPacientes;
	}


	/**
	 * getPacienteByEmail
	 *
	 * Busca os Pacientes que possuem o E-mail informado e retorna um array com objetos da classe lPaciente.
	 * 
	 * @param string $email					E-mail d Paciente a ser buscado.
	 * @return lPaciente[] $ListaPaciente	Retorna um array de objetos da classe lPaciente.
	 * 
	 */
	public function getPacienteByEmail($email) {
		$ListSimpleXMLObject = $this->selectPaciente(null, null, null, null, null, null, null, null, null, null, $email);
		$ListaPacientes = $this->traduzSimpleXMLObjectToPaciente($ListSimpleXMLObject);
		return $ListaPacientes;
	}


	/**
	 * getCodigoByPaciente
	 *
	 * Busca o Paciente informado e retorna uma string com o seu codigo.
	 * 
	 * @param lPaciente $oPaciente	Objeto da classe lPaciente.
	 * @return string $codigo			Retorna o Codigo do Paciente (em string).
	 * 
	 */
	public function getCodigoByPaciente(lPaciente $oPaciente) {
		$temp = $this->selectPaciente (null,
										$oPaciente->nome,
										$oPaciente->senha,
										$oPaciente->cpf,
										$oPaciente->planoDeSaude,
										$oPaciente->genero,
										$oPaciente->tipoSanguineo,
										$oPaciente->dtNascimento,
										$oPaciente->endereco,
										$oPaciente->telefone,
										$oPaciente->email
									   );
		$codigo = (string) $temp[0]->codigo;
		return $codigo;
	}

	/**
	 * getTabela
	 *
	 * Retorna toda a tabela tPaciente em um array de objetos da classe lPaciente.
	 * 
	 * @param void
	 * @return array lPaciente 	Array de objetos da classe lPaciente
	 * 
	 */
	public function getTabela(){
		return $this->traduzSimpleXMLObjectToPaciente($this->selectPaciente());
	}
}

?>
