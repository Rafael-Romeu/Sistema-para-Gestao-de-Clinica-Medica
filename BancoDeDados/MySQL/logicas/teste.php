<?php

include_once "lAtendente.php";
include_once "lMedico.php";
include_once "lPaciente.php";
include_once "lClinica.php";

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
    $a = new lClinica();
    $a->setNome("Mayo Clinic");
    $a->identifica();
    $a->setCodAtendente("3");
    $a->alterar();

    $a = new lClinica();
    $a->setNome("Mayo Clinic");
    $a->identifica();
    print_r($a->listaAtendentes());

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


// testePaciente();
