<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Persistencia.php";
include_once "Filtro.php";

class lConsulta extends Persistencia
{
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tConsulta");
    }

    public function listaConsultaByCodigo(string $codigo = null)
    {
        $this->limpaFiltros();
        if ($codigo != null) {
            $this->setFiltroValores("codigo = '$codigo'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByCodClinica(string $codClinica = null)
    {
        $this->limpaFiltros();
        if ($codClinica != null) {
            $this->setFiltroValores("codClinica = '$codClinica'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByCodAtendente(string $codAtendente = null)
    {
        $this->limpaFiltros();
        if ($codAtendente != null) {
            $this->setFiltroValores("codAtendente = '$codAtendente'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByCodMedico(string $codMedico = null)
    {
        $this->limpaFiltros();
        if ($codMedico != null) {
            $this->setFiltroValores("codMedico = '$codMedico'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByCodPaciente(string $codPaciente = null)
    {
        $this->limpaFiltros();
        if ($codPaciente != null) {
            $this->setFiltroValores("codPaciente = '$codPaciente'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByFlagConfirmada(string $flagConfirmada = null)
    {
        $this->limpaFiltros();
        if ($flagConfirmada != null) {
            $this->setFiltroValores("flagConfirmada = '$flagConfirmada'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByData(string $data = null)
    {
        $this->limpaFiltros();
        if ($data != null) {
            $this->setFiltroValores("CEP = '$data'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByHora(string $hora = null)
    {
        $this->limpaFiltros();
        if ($hora != null) {
            $this->setFiltroValores("telefone1 = '$hora'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByObservacao(string $observacao = null)
    {
        $this->limpaFiltros();
        if ($observacao != null) {
            $this->setFiltroValores("observacao = '$observacao'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByReceita(string $receita = null)
    {
        $this->limpaFiltros();
        if ($receita != null) {
            $this->setFiltroValores("receita = '$receita'");
        }
        return $this->executeSELECT();
    }

    public function listaConsultaByRegDate(string $regDate = null)
    {
        $this->limpaFiltros();
        if ($regDate != null) {
            $this->setFiltroValores("regDate = '$regDate'");
        }
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
        $this->getModel()->setValor("regDate", $regDate);
        return $this;
    }

}

$obj = new lConsulta();
print_r($obj);
