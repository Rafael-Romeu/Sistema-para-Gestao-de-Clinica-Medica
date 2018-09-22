<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Persistencia.php";

class Relacionamento extends Persistencia
{
    private $RelacionamentoNome;
    private $Tabela1Nome;
    private $Tabela2Nome;
    private $campoTabela1;
    private $campoTabela2;

    public function __construct()
    {
        parent::__construct();
    }

    public function FunctionName(Type $valor = null)
    {
        $obj->executeSQL("SELECT * FROM tClinicaAtendente AS tr INNER JOIN tClinica AS t2 ON (tr.codClinica=t2.codigo) WHERE tr.codAtendente=11;");
        $obj->executeSQL("SELECT * FROM ".$this->getRelacionamentoNome()." AS tr INNER JOIN ".$this->getTabela1Nome()." AS t1 ON (tr.".$this->getCampoTabela1()."=t1.codigo) WHERE tr.".$this->getCampoTabela2()."=".$valor.";");

    }

    public function listaByCodTabela1(string $codTabela1 = null)
    {
        if ($codTabela1 != null) {
            $this->setFiltroValores($this->getCampoTabela1() . " = '$codTabela1'");
        }
        return $this->executeSELECT();
    }

    public function listaByCodTabela2(string $codTabela2 = null)
    {
        if ($codTabela2 != null) {
            $this->setFiltroValores($this->getCampoTabela2() . " = '$codTabela2'");
        }
        return $this->executeSELECT();
    }

    /**
     * Get the value of campoTabela1
     */
    public function getCampoTabela1()
    {
        return $this->campoTabela1;
    }

    /**
     * Set the value of campoTabela1
     *
     * @return  self
     */
    public function setCampoTabela1($campoTabela1)
    {
        $this->campoTabela1 = $campoTabela1;
        return $this;
    }

    /**
     * Get the value of campoTabela2
     */
    public function getCampoTabela2()
    {
        return $this->campoTabela2;
    }

    /**
     * Set the value of campoTabela2
     *
     * @return  self
     */
    public function setCampoTabela2($campoTabela2)
    {
        $this->campoTabela2 = $campoTabela2;
        return $this;
    }

    /**
     * Get the value of CodTabela1
     */
    public function getCodTabela1()
    {
        return $this->getModel()->getValor($this->getCampoTabela1());
    }

    /**
     * Set the value of CodTabela1
     *
     * @return  self
     */
    public function setCodTabela1($codTabela1)
    {
        $this->getModel()->setValor($this->getCampoTabela1(), $codTabela1);
        return $this;
    }

    /**
     * Get the value of CodTabela2
     */
    public function getCodTabela2()
    {
        return $this->getModel()->getValor($this->getCampoTabela2());
    }

    /**
     * Set the value of CodTabela2
     *
     * @return  self
     */
    public function setCodTabela2($codTabela2)
    {
        $this->getModel()->setValor($this->getCampoTabela2(), $codTabela2);
        return $this;
    }

    /**
     * Get the value of Tabela1Nome
     */
    public function getTabela1Nome()
    {
        return $this->Tabela1Nome;
    }

    /**
     * Set the value of Tabela1Nome
     *
     * @return  self
     */
    public function setTabela1Nome($Tabela1Nome)
    {
        $this->Tabela1Nome = $Tabela1Nome;
        return $this;
    }

    /**
     * Get the value of Tabela2Nome
     */
    public function getTabela2Nome()
    {
        return $this->Tabela2Nome;
    }

    /**
     * Set the value of Tabela2Nome
     *
     * @return  self
     */
    public function setTabela2Nome($Tabela2Nome)
    {
        $this->Tabela2Nome = $Tabela2Nome;
        return $this;
    }

    /**
     * Get the value of RelacionamentoNome
     */ 
    public function getRelacionamentoNome()
    {
        return $this->RelacionamentoNome;
    }

    /**
     * Set the value of RelacionamentoNome
     *
     * @return  self
     */ 
    public function setRelacionamentoNome($RelacionamentoNome)
    {
        $this->RelacionamentoNome = $RelacionamentoNome;
        return $this;
    }
}
