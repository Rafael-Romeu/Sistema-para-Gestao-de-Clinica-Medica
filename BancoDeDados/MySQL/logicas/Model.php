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
    private $TABELACAMPOSNOME;

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
        // print_r($SCHEMA);
        $this->setMAPPING($SCHEMA);
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
    public function setMAPPING($SCHEMA)
    {
        $this->MAPPING = array();
        // print_r($SCHEMA);
        // print("\nPassou aqui!! Marlon");
        $v = false;
        foreach ($SCHEMA as $campo) {
            $a = array($campo["Field"] => ["valor" => $this->parseData($campo["Type"], ""), "tipo" => $campo["Type"]]);
            $this->MAPPING += $a;
            if ($v) {
                $this->setTABELACAMPOSNOME($this->getTABELACAMPOSNOME() . "," . $campo["Field"]);
            } else {
                $this->setTABELACAMPOSNOME($campo["Field"]);
                $v = true;
            }
        }
        return $this;
    }

    public function getValor($campo)
    {
        return $this->getMAPPING()[$campo]["valor"];
    }

    public function setValor($campo, $valor)
    {
        $valor = $this->parseValor($campo, $valor);
        $this->MAPPING[$campo]["valor"] = $valor;
        return $this;
    }

    public function parseValor($campo, $valor)
    {
        return $this->parseData($this->getMAPPING()[$campo]['tipo'], $valor);
    }

    private function parseData($type, $data)
    {
        // print("\nParseDATA> $type - $data");
        if (strpos($type, 'varchar') !== false) {
            $data = (string) $data;
        }
        if (strpos($type, 'date') !== false) {
            if ($data == "") {
                $data = "1900/01/01";
            }
            $data = date("Y-m-d", strtotime($data));
        }
        if (strpos($type, 'int') !== false) {
            if ($data == "") {
                $data = null;
            } else {
                $data = intval($data);
            }
        }
        if (strpos($type, 'time') !== false) {
            $data = strtotime($data);
        }
        // print_r($data);
        return $data;
    }

    /**
     * Get the value of TABELACAMPOSNOME
     */
    public function getTABELACAMPOSNOME()
    {
        return $this->TABELACAMPOSNOME;
    }

    /**
     * Set the value of TABELACAMPOSNOME
     *
     * @return  self
     */
    public function setTABELACAMPOSNOME($TABELACAMPOSNOME)
    {
        $this->TABELACAMPOSNOME = $TABELACAMPOSNOME;
        return $this;
    }
}
