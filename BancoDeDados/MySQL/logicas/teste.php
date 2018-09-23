<?php

include_once "lAtendente.php";
include_once "lClinica.php";

// $a = new lAtendente();
// $a->setCpf("77777777777");
// $a->identifica();
// $a->setCodClinica("1");
// print_r($a->getModel()->getMAPPING());
// $a->alterar();

// $a = new lAtendente();
// $a->setCpf("77777777777");
// $a->identifica();
// print_r($a->listaClinicas());

$a = new lClinica();
$a->setNome("Mayo Clinic");
$a->identifica();
$a->setCodAtendente("3");
$a->alterar();

$a = new lClinica();
$a->setNome("Mayo Clinic");
$a->identifica();
print_r($a->listaAtendentes());


