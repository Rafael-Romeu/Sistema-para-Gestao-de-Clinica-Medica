<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Persistencia.php";

class lAtendente extends Persistencia
{
    private $SQLInsert;
    private $SQLSelect;
    private $SQLDelete;
    private $SQLUpdate;
    public $codigo;
    public $nome;
    public $senha;
    public $cpf;
    public $dataNascimento;
    public $endereco;
    public $CEP;
    public $telefone1;
    public $telefone2;
    public $email;
    public $regDate;

    public function __construct()
    {
        parent::__construct();
        parent::setTABELA("tAtendente");
        parent::setTABELACAMPOS("codigo,nome,senha,cpf,dataNascimento,endereco,CEP,telefone1,telefone2,email,regDate");

        $this->setCodigo("");
        $this->setNome("");
        $this->setSenha("");
        $this->setCpf("");
        $this->setDataNascimento(date("YYYY-MM-DD", time()));
        $this->setEndereco("");
        $this->setCEP("");
        $this->setTelefone1("");
        $this->setTelefone2("");
        $this->setEmail("");
        $this->setRegDate(time());
    }

    public function teste()
    {
        // $this->setTABELA("tAtendente");
        // print_r(parent::getTABELA());
        // $this->setDistinct();
        // print_r(parent::DISTINCT());
        // $this->setJOIN("INNER JOIN "."tClinicaAtendente"." ON "."tAtendente"."."."codigo"."="."tClinicaAtendente"."."."codAtendente");
        $this->FullJOIN("tClinicaAtendente","codigo","codAtendente");
        $this->setFiltroCampos("nome");
        print_r($this->executeSELECT());

    }

    public function identifica()
    {

    }


    /**
     * Get the value of codigo
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of cpf
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set the value of cpf
     *
     * @return  self
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get the value of dataNascimento
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set the value of dataNascimento
     *
     * @return  self
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get the value of endereco
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set the value of endereco
     *
     * @return  self
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get the value of CEP
     */
    public function getCEP()
    {
        return $this->CEP;
    }

    /**
     * Set the value of CEP
     *
     * @return  self
     */
    public function setCEP($CEP)
    {
        $this->CEP = $CEP;

        return $this;
    }

    /**
     * Get the value of telefone1
     */
    public function getTelefone1()
    {
        return $this->telefone1;
    }

    /**
     * Set the value of telefone1
     *
     * @return  self
     */
    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;

        return $this;
    }

    /**
     * Get the value of telefone2
     */
    public function getTelefone2()
    {
        return $this->telefone2;
    }

    /**
     * Set the value of telefone2
     *
     * @return  self
     */
    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of regDate
     */
    public function getRegDate()
    {
        return $this->regDate;
    }

    /**
     * Set the value of regDate
     *
     * @return  self
     */
    public function setRegDate($regDate)
    {
        $this->regDate = $regDate;

        return $this;
    }

    /**
     * Get the value of SQLInsert
     */
    public function getSQLInsert()
    {
        return $this->SQLInsert;
    }

    /**
     * Set the value of SQLInsert
     *
     * @return  self
     */
    public function setSQLInsert($SQLInsert)
    {
        $this->SQLInsert = $SQLInsert;

        return $this;
    }
}

$obj = new lAtendente();
$obj->teste();
