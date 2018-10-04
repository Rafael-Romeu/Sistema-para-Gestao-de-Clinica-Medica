<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Persistencia.php";
include_once "Filtro.php";

class lClinicaPaciente extends Persistencia
{
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tClinicaPaciente");
    }

    public function listaClinicaPacienteByCodClinica(string $codClinica = null)
    {
        
        if ($codClinica != null) {
            $this->setFiltroValores("codClinica = '$codClinica'");
        }
        return $this->executeSELECT();
    }

    public function listaClinicaPacienteByCodPaciente(string $codPaciente = null)
    {
        
        if ($codPaciente != null) {
            $this->setFiltroValores("codPaciente = '$codPaciente'");
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
     * Get the value of codPaciente
     */
    public function getCodPaciente()
    {
        return $this->getModel()->getValor("codPaciente");
    }

    /**
     * Set the value of codPaciente
     *
     * @return  self
     */
    public function setCodPaciente($codPaciente)
    {
        $this->getModel()->setValor("codPaciente", $codPaciente);
        return $this;
    }
}

$obj = new lClinicaPaciente();
//print_r($obj);
