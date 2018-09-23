<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Persistencia.php";
include_once "Filtro.php";

class lHorarioAtendimento extends Persistencia
{
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tHorarioAtendimento");
    }

    public function listaHorarioAtendimentoByCodMedico(string $codMedico = null)
    {
        
        if ($codMedico != null) {
            $this->setFiltroValores("codMedico = '$codMedico'");
        }
        return $this->executeSELECT();
    }

    public function listaHorarioAtendimentoByCodClinica(string $codClinica = null)
    {
        
        if ($codClinica != null) {
            $this->setFiltroValores("codClinica = '$codClinica'");
        }
        return $this->executeSELECT();
    }

    public function listaHorarioAtendimentoBySeg(string $seg = null)
    {
        
        if ($seg != null) {
            $this->setFiltroValores("seg = '$seg'");
        }
        return $this->executeSELECT();
    }

    public function listaHorarioAtendimentoByTer(string $ter = null)
    {
        
        if ($ter != null) {
            $this->setFiltroValores("ter = '$ter'");
        }
        return $this->executeSELECT();
    }

    public function listaHorarioAtendimentoByQua(string $qua = null)
    {
        
        if ($qua != null) {
            $this->setFiltroValores("qua = '$qua'");
        }
        return $this->executeSELECT();
    }

    public function listaHorarioAtendimentoByQui(string $qui = null)
    {
        
        if ($qui != null) {
            $this->setFiltroValores("qui = '$qui'");
        }
        return $this->executeSELECT();
    }

    public function listaHorarioAtendimentoBySex(string $sex = null)
    {
        
        if ($sex != null) {
            $this->setFiltroValores("sex = '$sex'");
        }
        return $this->executeSELECT();
    }

    /**
     * Get the value of codMedico
     */
    public function getCodMedico()
    {
        return $this->getModel()->getValor("codMedico");
    }

    /**
     * Set the value of codMedico
     *
     * @return  self
     */
    public function setCodMedico($codMedico)
    {
        $this->getModel()->setValor("codMedico", $codMedico);
        return $this;
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
     * Get the value of seg
     */
    public function getSeg()
    {
        return $this->getModel()->getValor("seg");
    }

    /**
     * Set the value of seg
     *
     * @return  self
     */
    public function setSeg($seg)
    {
        $this->getModel()->setValor("seg", $seg);
        return $this;
    }

    /**
     * Get the value of ter
     */
    public function getTer()
    {
        return $this->getModel()->getValor("ter");
    }

    /**
     * Set the value of ters
     *
     * @return  self
     */
    public function setTer($ter)
    {
        $this->getModel()->setValor("ter", $ter);
        return $this;
    }

    /**
     * Get the value of qua
     */
    public function getQua()
    {
        return $this->getModel()->getValor("qua");
    }

    /**
     * Set the value of qua
     *
     * @return  self
     */
    public function setQua($qua)
    {
        $this->getModel()->setValor("qua", $qua);
        return $this;
    }

    /**
     * Get the value of qui
     */
    public function getQui()
    {
        return $this->getModel()->getValor("qui");
    }

    /**
     * Set the value of qui
     *
     * @return  self
     */
    public function setQui($qui)
    {
        $this->getModel()->setValor("qui", $qui);
        return $this;
    }

    /**
     * Get the value of sex
     */
    public function getSex()
    {
        return $this->getModel()->getValor("sex");
    }

    /**
     * Set the value of sex
     *
     * @return  self
     */
    public function setSex($sex)
    {
        $this->getModel()->setValor("sex", $sex);
        return $this;
    }

}
