<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Persistencia.php";

class lEspecialidade extends Persistencia
{
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tEspecialidade");
    }

    public function listaEspecialidadeByNome(string $nome = null)
    {
        
        if ($nome != null) {
            $this->setFiltroValores("nome = '$nome'");
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
//print_r($obj->listaByCodigo());
