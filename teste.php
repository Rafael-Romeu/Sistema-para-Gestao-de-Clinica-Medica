<?php

include_once 'logicas/lAtendente.php';

$oAtendente =  new lAtendente();
/* 
$oAtendente->createTableAtendente();
$oAtendente->insertAtendente("Marlon1", "1234567","364.964.588-77", null, null, null, "marlon@email.com");
$oAtendente->insertAtendente("Marlon2", "1234567","364.964.588-77", null, null, null, "marlon@email.com");
$oAtendente->insertAtendente("Marlon3", "1234567","364.964.588-77", null, null, null, "marlon@email.com");
$oAtendente->insertAtendente("Marlon4", "1234567","364.964.588-77", null, null, null, "marlon@email.com");
 */

//print_r($oAtendente->selectAtendente());
//print_r($oAtendente->selectAtendente(= null;null,"Marlon3","1234567"));
//$oAtendente->insertAtendente("Marlon3", "1234567","364.964.588-77", null, null, null, "marlon@email.com");

//print_r($xml);
//print_r($xml[0]->nome);

//print_r($oAtendente->excluirAtendente("A0005"));

$oAtendente->nome = "Marlon";
$oAtendente->senha = "1234567";
$oAtendente->cpf = "123.456.789-00";
$oAtendente->dtNascimento = "1993-05-31";
$oAtendente->endereco = "Rua 7";
$oAtendente->telefone = "53987452108";
$oAtendente->email = "moc.liame@email.com";


print_r($oAtendente);
$oAtendente->clearAtendente();

//print_r($oAtendente->salvaAtendente());

?>