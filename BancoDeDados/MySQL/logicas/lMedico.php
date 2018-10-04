<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "PessoaFisica.php";
include_once "lHorarioAtendimento.php";

class lMedico extends PessoaFisica
{
    private $Horarios;
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tMedico");
        $this->setHorarios(new lHorarioAtendimento());
    }

    public function listaClinicas()
    {
        $this->setTabelaIntermediaria("tClinicaMedico");
        $this->setRelacionamento("tClinica");
        return $this->buscaDadosRelacionamento();
    }

    public function listaEspecialidades()
    {
        $this->setTabelaIntermediaria("tMedicoEspecialidade");
        $this->setRelacionamento("tEspecialidade");
        return $this->buscaDadosRelacionamento();
    }

     /**
     * Get the value of codEspecialidade
     */
    public function getCodEspecialidade()
    {
        $this->setTabelaIntermediaria("tMedicoEspecialidade");
        $this->setRelacionamento("tEspecialidade");
        return $this->getModel()->getValor("codEspecialidade");
    }

    /**
     * Set the value of codEspecialidade
     *
     * @return  self
     */
    public function setCodEspecialidade($codEspecialidade)
    {
        $this->setTabelaIntermediaria("tMedicoEspecialidade");
        $this->setRelacionamento("tEspecialidade");
        $this->getModel()->setValorArray("codEspecialidade", $codEspecialidade);
        return $this;
    }


    /**
     * Get the value of codClinica
     */
    public function getCodClinica()
    {
        $this->setTabelaIntermediaria("tClinicaMedico");
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
        $this->setTabelaIntermediaria("tClinicaMedico");
        $this->setRelacionamento("tClinica");
        $this->getModel()->setValorArray("codClinica", $codClinica);
        return $this;
    }

    public function listaMedicoByPlanoDeSaude(string $planoDeSaude = null)
    {
        if($planoDeSaude!=null){
            $this->setFiltroValores("planoDeSaude = '$planoDeSaude'");
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
     * Get the value of Horarios
     */ 
    public function getHorarios()
    {
        return $this->Horarios;
    }

    /**
     * Set the value of Horarios
     *
     * @return  self
     */ 
    public function setHorarios($Horarios)
    {
        $this->Horarios = $Horarios;
        return $this;
    }

    public function listaHorarios($codClinica=null)
    {
        if($codClinica!=null){
            $Filtro = " AND codClinica=$codClinica";
        }else{
            $Filtro = "";
        }
        $Filtro = "codMedico=".$this->getCodigo().$Filtro;
        $this->getHorarios()->setFiltroValores($Filtro);
        return $this->getHorarios()->executeSELECT();
    }
}

// $obj = new lMedico();
// //print_r($obj);
