<?php

include_once "lAtendente.php";
include_once "lMedico.php";
include_once "lPaciente.php";
include_once "lClinica.php";
include_once "lConsulta.php";

function testeAtendente()
{
    $a = new lAtendente();
    $a->setCpf("77777777777");
    $a->identifica();
    $a->setCodClinica("1");
    print_r($a->getModel()->getMAPPING());
    $a->alterar();

    $a = new lAtendente();
    $a->setCpf("77777777777");
    $a->identifica();
    print_r($a->listaClinicas());

}

function testeClinica()
{
    // $a = new lClinica();
    // $a->setNome("Mayo Clinic");
    // $a->identifica();
    // $a->setCodAtendente("3");
    // $a->alterar();

    // ******* Horarios dos medicos ***************

    // $a = new lClinica();
    // $a->setNome("Mayo Clinic");
    // $a->identifica();
    // print_r($a->listaHorariosMedicos());

    // OU 
    
    $a = new lClinica();
    print_r($a->listaHorariosMedicos("1"));
}

function testeMedico()
{
    // $a = new lMedico();
    // $a->setNome("LISA CUDDY");
    // $a->identifica();
    // $a->setCodEspecialidade("17");
    // $a->alterar();

    $a = new lMedico();
    $a->setNome("LISA CUDDY");
    $a->identifica();
    // print_r($a->listaEspecialidades());
    print_r($a->listaHorarios()[0]["seg"]);

}

function testePaciente()
{
    $a = new lPaciente();
    $a->setCpf("06812029392");
    $a->identifica();
    $a->setCodClinica("2");
    print_r($a->getModel()->getMAPPING());
    $a->alterar();

    $a = new lPaciente();
    $a->setCpf("06812029392");
    $a->identifica();
    print_r($a->listaClinicas());

}

function testeConsulta()
{
    // $a = new lConsulta();
    // // $a->setCodClinica("1");
    // $a->setCodMedico("1");
    // // $a->setCodAtendente("1");
    // $a->setCodPaciente("1");
    // // $a->setFlagConfirmada(1);
    // // $a->setData("2018-05-31");
    // $a->setHora("07:07");
    // // // print_r($a->getModel()->getMAPPING());
    // // $a->incluir();

    // // $a = new lConsulta();
    // print_r($a->identifica());
    // print_r($a);

    $oConsulta = new lConsulta();
    $oConsulta->setCodClinica("1");
    $oConsulta->setCodMedico("1");
    $oConsulta->setCodPaciente("7");
    $oConsulta->setCodAtendente("0");
    $oConsulta->setFlagConfirmada("0");
    $oConsulta->setData("2018-05-31");
    $oConsulta->setHora("17:07:07");
    $oConsulta->incluir();


}

// testePaciente();
testeConsulta();
// testeClinica();
