<?php

include 'logicas/lAtendente.php';

$oAtendente =  new lAtendente();

print_r($oAtendente->selectAtendente("A0000",null,"777.777.777-77"));



?>