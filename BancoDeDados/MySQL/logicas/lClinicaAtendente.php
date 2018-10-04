<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Relacionamento.php";
include_once "Filtro.php";

class lClinicaAtendente extends Relacionamento
{
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tClinicaAtendente");
        $this->setTabela1Nome("tClinica");
        $this->setTabela2Nome("tAtendente");
        $this->setCampoTabela1("codClinica");
        $this->setCampoTabela2("codAtendente");
    }

    public function buscaCodClinicaByCodAtendente($codAtendente){
        return $this->buscaCodigoTabela1($codAtendente);
    }

    public function buscaCodAtendenteByCodClinica($codClincia){
        return $this->buscaCodigoTabela2($codClincia);
    }

    public function listaAtendenteByCodClinica(string $codClinica = null)
    {
        return $this->listaTabela2ByTabela1($codClinica);
    }

    public function listaClinicaByCodAtendente(string $codAtendente = null)
    {
        return $this->listaTabela1ByTabela2($codAtendente);
    }

    /**
     * Get the value of codClinica
     */
    public function getCodClinica()
    {
        return $this->getCodTabela1();
    }

    /**
     * Set the value of codClinica
     *
     * @return  self
     */
    public function setCodClinica($codClinica)
    {
        return $this->setCodTabela1($codClinica);
    }

    /**
     * Get the value of codAtendente
     */
    public function getCodAtendente()
    {
        return $this->getCodTabela2();
    }

    /**
     * Set the value of codAtendente
     *
     * @return  self
     */
    public function setCodAtendente($codAtendente)
    {
        return $this->setCodTabela2($codAtendente);
    }
}

$obj = new lClinicaAtendente();
$obj->setCodClinica("2");
$obj->setCodAtendente("1");
$obj->identifica();
// print_r($obj);
//print_r($obj->getCodigo());
