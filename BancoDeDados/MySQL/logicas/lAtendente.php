<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "PessoaFisica.php";
include_once "Filtro.php";
include_once "lClinica.php";

class lAtendente extends PessoaFisica
{

    public function __construct()
    {
        parent::__construct();
        $this->setModel("tAtendente");        
    }

    /**
     * Get the value of codClinica
     */
    public function getCodClinica()
    {
        $this->setTabelaIntermediaria("tClinicaAtendente");
        $this->setRelacionamento("tClinica");
        return $this->getModel()->getValor("codClinica");
    }

    /**
     * Set the value of codClinica
     *
     * @return  self
     */
    public function setCodClinica($codClinica)
    {
        $this->setTabelaIntermediaria("tClinicaAtendente");
        $this->setRelacionamento("tClinica");
        $this->getModel()->setValorArray("codClinica", $codClinica);
        return $this;
    }
}

// $obj = new lAtendente();
// // print("oooooooooooooooooooooooooooooooooooooooooooi");
// // $obj->setSenha("1234567");
// $obj->setCpf("77777777777");
// // // $obj->setNome("Marlon Franco");
// // // print_r($obj);

// // // print_r($obj->getModel()->getMAPPING());
// $obj->identifica();
// // print_r($obj->buscaDadosRelacionamento());
// print_r($obj->getCodClinica());
// // print_r($obj->getModel()->getMAPPING()["codClinica"]);


// // $obj->setNome("TESTE");
// // $obj->setCodClinica("1");
// // print_r($obj->getModel()->getMAPPING()["codClinica"]);
// $obj->setCodClinica("2");
// print_r($obj->getModel()->getMAPPING()["codClinica"]);
// // $obj->setCodClinica("3");
// // print_r($obj->getModel()->getMAPPING()["codClinica"]);

// // // $obj->setCodigo(16);
// // // $obj->identifica();
// // print_r($obj->getModel()->getMAPPING());
// // // print_r($obj->identifica());
// // // print_r($obj->getModel()->getMAPPING());
// // $obj->setCodClinica("1");
// // print_r($obj->incluir());
// print_r($obj->alterar());
// // // print_r($obj->excluir());
// // // print_r($obj);
// // // print_r("\nCodClinica: " . $obj->getCodClinica());
// // // print_r($obj->getRelacionamento()->listaTabela1ByTabela2($obj->getCodigo()));
// // // print_r($obj->executeSQL("SELECT * FROM tClinicaAtendente AS tr INNER JOIN tClinica AS t2 ON (tr.codClinica=t2.codigo) WHERE tr.codAtendente=11;"));
// // print_r($obj->getModel()->getMAPPING());