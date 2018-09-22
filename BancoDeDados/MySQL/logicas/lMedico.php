<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "PessoaFisica.php";
include_once "Filtro.php";

class lMedico extends PessoaFisica
{
    public function __construct()
    {
        parent::__construct();
        $this->setModel("tMedico");
    }

    public function listaMedicoByPlanoDeSaude(string $planoDeSaude = null)
    {
        if($planoDeSaude!=null){
            $this->setFiltroValores("planoDeSaude = '$planoDeSaude'");
        }
        return $this->executeSELECT();
    }

    /**
     * Get the value of planoDeSaude
     */
    public function getPlanoDeSaude()
    {
        return $this->getModel()->getValor("planoDeSaude");
    }
    
    /**
     * Set the value of planoDeSaude
     *
     * @return  self
     */
    public function setPlanoDeSaude($planoDeSaude)
    {
        $this->getModel()->setValor("planoDeSaude", $planoDeSaude);
        return $this;
    }

}

$obj = new lMedico();
print_r($obj);
