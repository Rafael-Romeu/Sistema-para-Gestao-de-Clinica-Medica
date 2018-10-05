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
            if ($campo["Key"] == 'UNI' || $campo["Key"] == 'PRI') {
                $ehChave = "S";
            } else {
                $ehChave = "N";
            }
            $a = array($campo["Field"] => ["valor" => $this->parseData($campo["Type"], ""), "tipo" => $campo["Type"], "chave" => $ehChave, "modificado" => "N"]);
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

    public function addCampoMAPPING($campo, $tipo, $valor, $chave=null)
    {
        // print("\nPassou aqui!! Marlon");
        $a = array($campo => ["valor" => $valor, "tipo" => $tipo, "chave" => $chave==null? "N":$chave, "modificado" => 'N']);
        $this->MAPPING += $a;
        return $this;
    }

    public function removeCampoMAPPING($campo)
    {
        unset($this->MAPPING[$campo]);
        return $this;
    }

    public function temCampoMAPPING(string $campo)
    {
        return array_key_exists($campo, $this->MAPPING);
    }

    public function getValor($campo)
    {
        return $this->getMAPPING()[$campo]["valor"];
    }

    public function setValor($campo, $valor, $modificado = null)
    {
        $valor = $this->parseValor($campo, $valor);
        $this->MAPPING[$campo]["valor"] = $valor;
        $this->MAPPING[$campo]["modificado"] = $modificado == null ? "S" : $modificado;
        return $this;
    }

    public function setValorArray($campo, $valor, $modificado = null)
    {
        if ($this->MAPPING[$campo]["valor"] == null || $this->MAPPING[$campo]["valor"] == "") {
            $this->MAPPING[$campo]["valor"] = array();
        }
        array_push($this->MAPPING[$campo]["valor"], $valor);
        $this->MAPPING[$campo]["modificado"] = $modificado == null ? "S" : $modificado;
        return $this;
    }

    public function limpaValor($campo)
    {
        $this->MAPPING[$campo]["valor"] = "";
        return $this;
    }

    public function zeraModificacoesTodosCamposMAPPING()
    {
        foreach ($this->MAPPING as $campo => $valor) {
            // print("\n\nMODEL:\tcampo: $campo\tmodificado: ".$this->MAPPING[$campo]["modificado"]);
            $this->MAPPING[$campo]["modificado"] = "N";
        }
        // print_r($this->MAPPING);
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
            // $data = strtotime($data);
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
