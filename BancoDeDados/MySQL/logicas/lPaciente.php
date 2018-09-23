<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "PessoaFisica.php";

class lPaciente extends PessoaFisica
{
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tPaciente");
    }

    public function listaClinicas()
    {
        $this->setTabelaIntermediaria("tClinicaPaciente");
        $this->setRelacionamento("tClinica");
        return $this->buscaDadosRelacionamento();
    }

    /**
     * Get the value of codClinica
     */
    public function getCodClinica()
    {
        $this->setTabelaIntermediaria("tClinicaPaciente");
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
        $this->setTabelaIntermediaria("tClinicaPaciente");
        $this->setRelacionamento("tClinica");
        $this->getModel()->setValorArray("codClinica", $codClinica);
        return $this;
    }

    public function listaPacienteByPlanoDeSaude(string $planoDeSaude = null)
    {
        
        if ($planoDeSaude != null) {
            $this->setFiltroValores("planoDeSaude = '$planoDeSaude'");
        }
        return $this->executeSELECT();
    }

    public function listaPacienteByGenero(string $genero = null)
    {
        
        if ($genero != null) {
            $this->setFiltroValores("genero = '$genero'");
        }
        return $this->executeSELECT();
    }

    public function listaPacienteByTipoSanguineo(string $tipoSanguineo = null)
    {
        
        if ($tipoSanguineo != null) {
            $this->setFiltroValores("tipoSanguineo = '$tipoSanguineo'");
        }
        return $this->executeSELECT();
    }

    /**
     * Get the value of planoDeSaude
     */
    public function getPlanoDeSaude()
    {
        return $this->getModel()->getValor("planoDeSaude");
    }

    /**
     * Set the value of planoDeSaude
     *
     * @return  self
     */
    public function setPlanoDeSaude($planoDeSaude)
    {
        $this->getModel()->setValor("planoDeSaude", $planoDeSaude);
        return $this;
    }

    /**
     * Get the value of genero
     */
    public function getGenero()
    {
        return $this->getModel()->getValor("genero");
    }

    /**
     * Set the value of genero
     *
     * @return  self
     */
    public function setGenero($genero)
    {
        $this->getModel()->setValor("genero", $genero);
        return $this;
    }

    /**
     * Get the value of tipoSanguineo
     */
    public function getTipoSanguineo()
    {
        return $this->getModel()->getValor("tipoSanguineo");
    }

    /**
     * Set the value of tipoSanguineo
     *
     * @return  self
     */
    public function setTipoSanguineo($tipoSanguineo)
    {
        $this->getModel()->setValor("tipoSanguineo", $tipoSanguineo);
        return $this;
    }

}
