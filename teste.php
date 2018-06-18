<?php

include 'logicas/lAtendente.php';

$oAtendente =  new lAtendente();

$oAtendente->createTableAtendente();
$oAtendente->insertAtendente("Marlon", "364.964.588-77","marlon@email.com");
$xml=$oAtendente->selectAtendente(null,"Marlon");

print_r($xml);
//print_r($xml[0]->nome);

?>