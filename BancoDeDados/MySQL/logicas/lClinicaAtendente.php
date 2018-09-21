<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "iPersistencia.php";
include_once "Persistencia.php";
include_once "Filtro.php";

class lClinicaAtendente extends Persistencia implements iPersistencia
{
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tClinicaAtendente");
    }

    public function alterar()
    {
        if(!$this->identificou){
            return("\nNecessário identificar a classe antes de realizar alterações.");
        }
        if($this->codClinicaOld != $this->getCodClinica()){
            // Alterou o codigo da clinica
            $oClinicaAtendente = new lClinicaAtendente();
            $oClinicaAtendente->setCodAtendente($this->getCodigo());
            $oClinicaAtendente->setCodClinica($this->codClinicaOld);
            $oClinicaAtendente->identifica();
            $oClinicaAtendente->setCodClinica($this->getCodClinica());
            print_r($oClinicaAtendente->executeUPDATE());
        }
        return($this->executeUPDATE());
    }

    public function listaClinicaAtendenteByCodClinica(string $codClinica = null)
    {
        if ($codClinica != null) {
            $this->setFiltroValores("codClinica = '$codClinica'");
        }
        return $this->executeSELECT();
    }

    public function listaClinicaAtendenteByCodAtendente(string $codAtendente = null)
    {
        if ($codAtendente != null) {
            $this->setFiltroValores("codAtendente = '$codAtendente'");
        }
        return $this->executeSELECT();
    }

    /**
     * Get the value of codClinica
     */
    public function getCodClinica()
    {
        return $this->getModel()->getValor("codClinica");
    }

    /**
     * Set the value of codClinica
     *
     * @return  self
     */
    public function setCodClinica($codClinica)
    {
        $this->getModel()->setValor("codClinica", $codClinica);
        return $this;
    }

    /**
     * Get the value of codAtendente
     */
    public function getCodAtendente()
    {
        return $this->getModel()->getValor("codAtendente");
    }

    /**
     * Set the value of codAtendente
     *
     * @return  self
     */
    public function setCodAtendente($codAtendente)
    {
        $this->getModel()->setValor("codAtendente", $codAtendente);
        return $this;
    }
}

// $obj = new lClinicaAtendente();
// print_r($obj);
