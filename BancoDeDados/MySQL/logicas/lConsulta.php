<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Persistencia.php";

class lConsulta extends Persistencia
{
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tConsulta");
    }

    public function listaConsultaByCodClinica(string $codClinica = null)
    {
        
        if ($codClinica != null) {
            $this->setFiltroValores("codClinica = '$codClinica'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByCodAtendente(string $codAtendente = null)
    {
        
        if ($codAtendente != null) {
            $this->setFiltroValores("codAtendente = '$codAtendente'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByCodMedico(string $codMedico = null)
    {
        
        if ($codMedico != null) {
            $this->setFiltroValores("codMedico = '$codMedico'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByCodPaciente(string $codPaciente = null)
    {
        
        if ($codPaciente != null) {
            $this->setFiltroValores("codPaciente = '$codPaciente'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByFlagConfirmada(string $flagConfirmada = null)
    {
        
        if ($flagConfirmada != null) {
            $this->setFiltroValores("flagConfirmada = '$flagConfirmada'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByData(string $data = null)
    {
        
        if ($data != null) {
            $this->setFiltroValores("CEP = '$data'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByHora(string $hora = null)
    {
        
        if ($hora != null) {
            $this->setFiltroValores("hora = '$hora'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByObservacao(string $observacao = null)
    {
        
        if ($observacao != null) {
            $this->setFiltroValores("observacao = '$observacao'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByReceita(string $receita = null)
    {
        
        if ($receita != null) {
            $this->setFiltroValores("receita = '$receita'");
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
     * Set the value of nocodClinicame
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

    /**
     * Get the value of flagConfirmada
     */
    public function getFlagConfirmada()
    {
        return $this->getModel()->getValor("flagConfirmada");
    }

    /**
     * Set the value of flagConfirmada
     *
     * @return  self
     */
    public function setFlagConfirmada($flagConfirmada)
    {
        $this->getModel()->setValor("flagConfirmada", $flagConfirmada);
        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->getModel()->getValor("data");
    }

    /**
     * Set the value of data
     *
     * @return  self
     */
    public function setData($data)
    {
        $this->getModel()->setValor("data", $data);
        return $this;
    }

    /**
     * Get the value of hora
     */
    public function getHora()
    {
        return $this->getModel()->getValor("hora");
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */
    public function setHora($hora)
    {
        $this->getModel()->setValor("hora", $hora);
        return $this;
    }

    /**
     * Get the value of observacao
     */
    public function getObservacao()
    {
        return $this->getModel()->getValor("observacao");
    }

    /**
     * Set the value of observacao
     *
     * @return  self
     */
    public function setObservacao($observacao)
    {
        $this->getModel()->setValor("observacao", $observacao);
        return $this;
    }

    /**
     * Get the value of receita
     */
    public function getReceita()
    {
        return $this->getModel()->getValor("receita");
    }

    /**
     * Set the value of receita
     *
     * @return  self
     */
    public function setReceita($receita)
    {
        $this->getModel()->setValor("receita", $receita);
        return $this;
    }

}

$obj = new lConsulta();
//print_r($obj);
