<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "PessoaFisica.php";
include_once "Filtro.php";
include_once "lClinicaAtendente.php";

class lAtendente extends PessoaFisica
{
    private $codClinica;
    private $codClinicaOld;

    public function __construct()
    {
        parent::__construct();
        $this->setModel("tAtendente");
        $this->addRelacionamento(new lClinicaAtendente());
    }

    public function verificaClinicas()
    {
        print_r("\n>>>>>>> [" . $this->getModel()->getTABELANOME() . "]: Buscando dados do Relacionamento [" . $this->getRelacionamento()[0]->getModel()->getTABELANOME() . "]...");
        $resultado = array();
        $this->getRelacionamento()[0]->setFiltroCampos("codClinica");
        $result = $this->getRelacionamento()[0]->listaClinicaAtendenteByCodAtendente($this->getCodigo());
        if (count($result) == 1) {
            array_push($resultado, $result[0]["codClinica"]);
        }
        if (count($result) > 1) {
            foreach ($result as $codClinica => $valor) {
                array_push($resultado, $valor);
                $this->setCodClinica($valor);
            }
        }
        $this->codClinicaOld = $resultado;
        print_r("\n>>>>>>> [" . $this->getModel()->getTABELANOME() . "]: Dados buscados do Relacionamento [" . $this->getRelacionamento()[0]->getModel()->getTABELANOME() . "]\n");
        return $resultado;
    }

    public function identifica()
    {
        if (parent::identifica()) {
            $this->verificaClinicas();
        }
        return $this->getIdentificou();
    }

    public function alterar()
    {
        if (!$this->getIdentificou()) {
            return ("\nNecessário identificar a classe antes de realizar alterações.");
        }
        if ($this->codClinicaOld != $this->getCodClinica()) {
            // Alterou o codigo da clinica
            print_r("\nSem Alterações no Código da Clinica.");
            $oClinicaAtendente = new lClinicaAtendente();
            $oClinicaAtendente->setCodAtendente($this->getCodigo());
            $oClinicaAtendente->setCodClinica($this->codClinicaOld);
            $oClinicaAtendente->identifica();
            $oClinicaAtendente->setCodClinica($this->getCodClinica());
            print_r($oClinicaAtendente->executeUPDATE());
        }
        return ($this->executeUPDATE());
    }

    public function incluir()
    {
        $msg = parent::incluir();
        if ("Inserção realizada com sucesso!" == $msg) {
            $this->identifica();
            if ($this->getCodClinica() != null and $this->getCodClinica() != "") {
                print_r("\n[" . $this->getModel()->getTABELANOME() . ": Realizando alterações na tabela " . $this->getRelacionamento()[0]->getModel()->getTABELANOME() . "...]");
                $this->getRelacionamento()[0]->setCodAtendente($this->getCodigo());
                $this->getRelacionamento()[0]->setCodClinica($this->getCodClinica());
                print_r($this->getRelacionamento()[0]->incluir());
            }
        }
        return $msg;
    }

    public function excluir()
    {
        $msg = parent::excluir();
        if ("Exclusão efetuada com sucesso!\n" != $msg) {
            return $msg;
        }
        $clinicas = $this->getRelacionamento()[0]->listaClinicaAtendenteByCodAtendente($this->getCodigo());
        if (count($clinicas) > 0) {
            foreach ($clinicas as $clinica => $valor) {
                $this->getRelacionamento()[0]->setCodClinica($valor['codClinica']);
                $this->getRelacionamento()[0]->excluir();
            }
        }
        return $msg;
    }

    /**
     * Get the value of codClinica
     */
    public function getCodClinica()
    {
        return $this->codClinica;
    }

    /**
     * Set the value of codClinica
     *
     * @return  self
     */
    public function setCodClinica($codClinica)
    {
        if ($this->codClinica == null) {
            $this->codClinica = array();
        }
        array_push($this->codClinica, $codClinica);
        return $this;
    }
}

$obj = new lAtendente();
// $obj->setSenha("1234567");
$obj->setCpf("77777777778");
$obj->setNome("TESTE");
// print_r($obj);
// print_r($obj->identifica());
// $obj->setCodigo("1");
// $obj->identifica();
print_r($obj->excluir());
// $obj->setCodClinica("2");
// print_r($obj->incluir());
// print_r($obj);
// print_r("\nCodClinica: " . $obj->getCodClinica());
