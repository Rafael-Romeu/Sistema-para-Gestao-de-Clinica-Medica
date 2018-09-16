<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Persistencia.php";
include_once "Filtro.php";

class lAtendente extends Persistencia
{
    private $SQLInsert;
    private $SQLSelect;
    private $SQLDelete;
    private $SQLUpdate;
    private $codigo;
    private $nome;
    private $senha;
    private $cpf;
    private $dataNascimento;
    private $endereco;
    private $CEP;
    private $telefone1;
    private $telefone2;
    private $email;
    private $regDate;

    public function __construct()
    {
        parent::__construct();
        $this->setModel("tAtendente");
        // $this->setCodigo("");
        // $this->setNome("");
        // $this->setSenha("");
        // $this->setCpf("");
        // $this->setDataNascimento("");
        // $this->setEndereco("");
        // $this->setCEP("");
        // $this->setTelefone1("");
        // $this->setTelefone2("");
        // $this->setEmail("");
        // $this->setRegDate("");
    }

    public function teste()
    {
        // $this->setNome("Marlon");
        // $this->executeINSERT();
        // $this->setCodigo("7");
        $this->executeINSERT();
        // print_r($this->getModel()->getValor("codigo"));
        // print_r($this->getModel()->getMAPPING());

        // if($this->identifica()){
        //     print_r($this);
        // }
        // print_r($this->getModel()->getTABELACAMPOS());
    }

    public function identifica()
    {
        $sFiltro = "1";
        $sFiltro .= ($this->getCodigo() == "") ? "" : " AND codigo='" . $this->getCodigo() . "'";
        $sFiltro .= ($this->getNome() == "") ? "" : " AND nome='" . $this->getNome() . "'";
        $sFiltro .= ($this->getSenha() == "") ? "" : " AND senha='" . $this->getSenha() . "'";
        $sFiltro .= ($this->getCpf() == "") ? "" : " AND cpf='" . $this->getCpf() . "'";
        $sFiltro .= ($this->getDataNascimento() == "") ? "" : " AND datanascimento='" . $this->getDataNascimento() . "'";
        $sFiltro .= ($this->getEndereco() == "") ? "" : " AND endereco='" . $this->getEndereco() . "'";
        $sFiltro .= ($this->getCEP() == "") ? "" : " AND CEP='" . $this->getCEP() . "'";
        $sFiltro .= ($this->getTelefone1() == "") ? "" : " AND telefone1='" . $this->getTelefone1() . "'";
        $sFiltro .= ($this->getTelefone2() == "") ? "" : " AND telefone2='" . $this->getTelefone2() . "'";
        $sFiltro .= ($this->getEmail() == "") ? "" : " AND email='" . $this->getEmail() . "'";
        $sFiltro .= ($this->getRegDate() == "") ? "" : " AND regDate='" . $this->getRegDate() . "'";
        $this->setFiltroValores($sFiltro);
        $tabela = $this->executeSELECT();
        print_r($tabela);
        if (count($tabela) <= 0 || count($tabela) > 1) {
            print("\n> identifica: false\n");
            return false;
        }
        $this->setCodigo($tabela[0][codigo]);
        $this->setNome($tabela[0][nome]);
        $this->setSenha($tabela[0][senha]);
        $this->setCpf($tabela[0][cpf]);
        $this->setDataNascimento(date($tabela[0][datanascimento]));
        $this->setEndereco($tabela[0][endereco]);
        $this->setCEP($tabela[0][CEP]);
        $this->setTelefone1($tabela[0][telefone2]);
        $this->setTelefone2($tabela[0][telefone1]);
        $this->setEmail($tabela[0][email]);
        $this->setRegDate(time($tabela[0][regDate]));
        print("\n> identifica: true\n");
        return true;
    }

    public function listaAtendenteByCodigo(string $codigo)
    {
        $this->limpaFiltros();
        $this->setFiltroValores("codigo = '$codigo'");
        return $this->executeSELECT();
    }

    public function listaAtendenteByNome(string $nome)
    {
        $this->limpaFiltros();
        $this->setFiltroValores("nome = '$nome'");
        return $this->executeSELECT();
    }

    public function listaAtendenteBySenha(string $senha)
    {
        $this->limpaFiltros();
        $this->setFiltroValores("senha = '$senha'");
        return $this->executeSELECT();
    }

    public function listaAtendenteByCpf(string $cpf)
    {
        $this->limpaFiltros();
        $this->setFiltroValores("cpf = '$cpf'");
        return $this->executeSELECT();
    }

    public function listaAtendenteByDataNascimento(string $dataNascimento)
    {
        $this->limpaFiltros();
        $this->setFiltroValores("dataNascimento = '$dataNascimento'");
        return $this->executeSELECT();
    }

    public function listaAtendenteByEndereco(string $endereco)
    {
        $this->limpaFiltros();
        $this->setFiltroValores("endereco = '$endereco'");
        return $this->executeSELECT();
    }

    public function listaAtendenteByCEP(string $CEP)
    {
        $this->limpaFiltros();
        $this->setFiltroValores("CEP = '$CEP'");
        return $this->executeSELECT();
    }

    public function listaAtendenteByTelefone1(string $telefone1)
    {
        $this->limpaFiltros();
        $this->setFiltroValores("telefone1 = '$telefone1'");
        return $this->executeSELECT();
    }

    public function listaAtendenteByTelefone2(string $telefone2)
    {
        $this->limpaFiltros();
        $this->setFiltroValores("telefone2 = '$telefone2'");
        return $this->executeSELECT();
    }

    public function listaAtendenteByEmail(string $email)
    {
        $this->limpaFiltros();
        $this->setFiltroValores("email = '$email'");
        return $this->executeSELECT();
    }

    public function listaAtendenteByRegDate(string $regDate)
    {
        $this->limpaFiltros();
        $this->setFiltroValores("regDate = '$regDate'");
        return $this->executeSELECT();
    }

    /**
     * Get the value of codigo
     */
    public function getCodigo()
    {
        return $this->getModel()->getValor("codigo");
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */
    public function setCodigo($codigo)
    {
        $this->getModel()->setValor("codigo", $codigo);
        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->getModel()->getValor("nome");
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->getModel()->setValor("nome", $nome);
        return $this;
    }

    /**
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->getModel()->getValor("senha");
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */
    public function setSenha($senha)
    {
        $this->getModel()->setValor("senha", $senha);

        return $this;
    }

    /**
     * Get the value of cpf
     */
    public function getCpf()
    {
        return $this->getModel()->getValor("cpf");
    }

    /**
     * Set the value of cpf
     *
     * @return  self
     */
    public function setCpf($cpf)
    {
        $this->getModel()->setValor("cpf", $cpf);
        return $this;
    }

    /**
     * Get the value of dataNascimento
     */
    public function getDataNascimento()
    {
        return $this->getModel()->getValor("dataNascimento");
    }

    /**
     * Set the value of dataNascimento
     *
     * @return  self
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->getModel()->setValor("dataNascimento", $dataNascimento);
        return $this;
    }

    /**
     * Get the value of endereco
     */
    public function getEndereco()
    {
        return $this->getModel()->getValor("endereco");
    }

    /**
     * Set the value of endereco
     *
     * @return  self
     */
    public function setEndereco($endereco)
    {
        $this->getModel()->setValor("endereco", $endereco);
        return $this;
    }

    /**
     * Get the value of CEP
     */
    public function getCEP()
    {
        return $this->getModel()->getValor("CEP");
    }

    /**
     * Set the value of CEP
     *
     * @return  self
     */
    public function setCEP($CEP)
    {
        $this->getModel()->setValor("CEP",$CEP);
        return $this;
    }

    /**
     * Get the value of telefone1
     */
    public function getTelefone1()
    {
        return $this->getModel()->getValor("telefone1");
    }

    /**
     * Set the value of telefone1
     *
     * @return  self
     */
    public function setTelefone1($telefone1)
    {
        $this->getModel()->setValor("telefone1",$telefone1);
        return $this;
    }

    /**
     * Get the value of telefone2
     */
    public function getTelefone2()
    {
        return $this->getModel()->getValor("telefone2");
    }

    /**
     * Set the value of telefone2
     *
     * @return  self
     */
    public function setTelefone2($telefone2)
    {
        $this->getModel()->setValor("telefone2",$telefone2);
        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->getModel()->getValor("email");
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->getModel()->setValor("email", $email);
        return $this;
    }

    /**
     * Get the value of regDate
     */
    public function getRegDate()
    {
        return $this->getModel()->getValor("regDate");
    }

    /**
     * Set the value of regDate
     *
     * @return  self
     */
    public function setRegDate($regDate)
    {
        $this->getModel()->setValor("regDate",$regDate);
        return $this;
    }

}

$obj = new lAtendente();
$obj->teste();
