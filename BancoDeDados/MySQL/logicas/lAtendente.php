<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "PessoaFisica.php";

class lAtendente extends PessoaFisica
{
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tAtendente");
    }

    public function listaClinicas()
    {
        $this->setTabelaIntermediaria("tClinicaAtendente");
        $this->setRelacionamento("tClinica");
        return $this->buscaDadosRelacionamento();
    }

    /**
     * Get the value of codClinica
     */
    public function getCodClinica()
    {
        $this->setTabelaIntermediaria("tClinicaAtendente");
        $this->setRelacionamento("tClinica");
        return $this->getModel()->getValor("codClinica");
    }

    /**
     * Set the value of codClinica
     *
     * @return  self
     */
    public function setCodClinica($codClinica)
    {
        $this->setTabelaIntermediaria("tClinicaAtendente");
        $this->setRelacionamento("tClinica");
        $this->getModel()->setValorArray("codClinica", $codClinica);
        return $this;
    }
}

// $obj = new lAtendente();
// $obj->setCpf("77777777777");
// $obj->identifica();
// print_r($obj->listaClinicas());
