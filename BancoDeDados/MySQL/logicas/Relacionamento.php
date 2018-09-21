<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Persistencia.php";

class Relacionamento extends Persistencia
{
    private $codTabela1;
    private $codTabela2;

    public function __construct()
    {
        parent::__construct();
    }

    

    

    /**
     * Get the value of codTabela1
     */ 
    public function getCodTabela1()
    {
        return $this->codTabela1;
    }

    /**
     * Set the value of codTabela1
     *
     * @return  self
     */ 
    public function setCodTabela1($codTabela1)
    {
        $this->codTabela1 = $codTabela1;
        return $this;
    }

    /**
     * Get the value of codTabela2
     */ 
    public function getCodTabela2()
    {
        return $this->codTabela2;
    }

    /**
     * Set the value of codTabela2
     *
     * @return  self
     */ 
    public function setCodTabela2($codTabela2)
    {
        $this->codTabela2 = $codTabela2;
        return $this;
    }
}
