<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "iPersistencia.php";
include_once "Persistencia.php";
include_once "Filtro.php";

class lEspecialidade extends Persistencia implements iPersistencia
{
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tEspecialidade");
    }

    public function listaEspecialidadeByCodigo(string $codigo = null)
    {
        
        if ($codigo != null) {
            $this->setFiltroValores("codigo = '$codigo'");
        }
        return $this->executeSELECT();
    }

    public function listaEspecialidadeByNome(string $nome = null)
    {
        
        if ($nome != null) {
            $this->setFiltroValores("codnomeMedico = '$nome'");
        }
        return $this->executeSELECT();
    }

    public function listaEspecialidadeByDescricao(string $descricao = null)
    {
        
        if ($descricao != null) {
            $this->setFiltroValores("descricao = '$descricao'");
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
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->getModel()->getValor("nome");
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->getModel()->setValor("nome", $nome);
        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao()
    {
        return $this->getModel()->getValor("descricao");
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */
    public function setDescricao($descricao)
    {
        $this->getModel()->setValor("descricao", $descricao);
        return $this;
    }
    
}

$obj = new lEspecialidade();
print_r($obj->listaEspecialidadeByCodigo());
