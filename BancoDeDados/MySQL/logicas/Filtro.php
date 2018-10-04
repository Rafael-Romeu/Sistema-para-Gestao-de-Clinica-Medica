<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

class Filtro
{
    private $sFiltro;

    public function __construct()
    {
        $this->setsFiltro("1");
    }

    public function equals($campo, $valor, $type)
    {
        if (strpos($type, 'varchar') !== false) {
            $valor = "'$valor'";
        }
        if (strpos($type, 'date') !== false) {
            $valor = "'$valor'";
        }
        if (strpos($type, 'int') !== false) {
            // $valor 
        }
        if (strpos($type, 'time') !== false) {
            $valor = "'$valor'";
        }
        $this->setsFiltro($this->getsFiltro() . " AND $campo = $valor");
        return $this;
    }

    public function addFiltro($campo, $operador, $valor)
    {
        $this->setsFiltro($this->getsFiltro() . "AND $campo $operador '$valor'");
        return $this;
    }

    /**
     * Get the value of sFiltro
     */
    public function getsFiltro()
    {
        return $this->sFiltro;
    }

    /**
     * Set the value of sFiltro
     *
     * @return  self
     */
    public function setsFiltro($sFiltro)
    {
        $this->sFiltro = $sFiltro;

        return $this;
    }

    public function toString()
    {
        return $this->getsFiltro();
    }
}
