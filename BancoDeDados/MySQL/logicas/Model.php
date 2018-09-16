<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

class Model
{
    private $SCHEMA;
    private $MAPPING;
    private $TABELANOME;
    private $TABELACAMPOS;

    public function __construct()
    {

    }

    /**
     * Get the value of TABELANOME
     */
    public function getTABELANOME()
    {
        return $this->TABELANOME;
    }

    /**
     * Set the value of TABELANOME
     *
     * @return  self
     */
    public function setTABELANOME($TABELANOME)
    {
        $this->TABELANOME = $TABELANOME;
        return $this;
    }

    /**
     * Get the value of TABELACAMPOS
     */
    public function getTABELACAMPOS()
    {
        return $this->TABELACAMPOS;
    }

    /**
     * Set the value of TABELACAMPOS
     *
     * @return  self
     */
    public function setTABELACAMPOS($SCHEMA)
    {
        $this->TABELACAMPOS = array();
        print_r($this->getSCHEMA());
        foreach ($SCHEMA as $campo) {
            // $a = array($campo["Field"] => $campo["Type"]);
            // $this->TABELACAMPOS += $a;
            //  if (strpos($campo[1], 'varchar') !== false) {
            //     $nullValue = "";
            // }
            // if (strpos($campo[1], 'date') !== false) {
            //     $nullValue = date;
            // }
            array_push($this->TABELACAMPOS, [$campo["Field"], $campo["Type"]]);
        }
        return $this;
    }

    /**
     * Get the value of SCHEMA
     */
    public function getSCHEMA()
    {
        return $this->SCHEMA;
    }

    /**
     * Set the value of SCHEMA
     *
     * @return  self
     */
    public function setSCHEMA($SCHEMA)
    {
        $this->setTABELACAMPOS($SCHEMA);
        $this->setMAPPING($this->getTABELACAMPOS());
        $this->SCHEMA = $SCHEMA;

        return $this;
    }

    /**
     * Get the value of MAPPING
     */
    public function getMAPPING()
    {
        return $this->MAPPING;
    }

    /**
     * Set the value of MAPPING
     *
     * @return  self
     */
    public function setMAPPING($TABELACAMPOS)
    {
        $this->MAPPING = array();
        print_r($this->getSCHEMA());
        foreach ($TABELACAMPOS as $campo) {
            $a = array($campo[0] => ["valor"=>$this->parseData($campo[1], ""),"tipo"=>$campo[1]]);
            $this->MAPPING += $a;
        }
        return $this;
    }

    public function getValor($campo)
    {
        return $this->getMAPPING()[$campo];
    }

    public function setValor($campo, $valor)
    {
        $this->parseValor($campo, $valor);
        $this->MAPPING[$campo] = $valor;
        return $this;
    }

    public function parseValor($campo, $valor)
    {
        return $this->parseData($this->getMAPPING()[$campo]['tipo'],$valor);
    }

    private function parseData($type, $data)
    {
        if (strpos($type, 'varchar') !== false) {
            $data = (string)$data;
        }
        if (strpos($type, 'date') !== false) {
            $data = date("DD-MM-YYYY",strtotime($data));
        }
        if (strpos($type, 'int') !== false) {
            $data = intval($data);
        }
        if (strpos($type, 'time') !== false) {
            $data = strtotime($data);
        }
        print_r($data);
        return $data;
    }
}
