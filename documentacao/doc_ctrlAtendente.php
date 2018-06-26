<?php

/**
 * ..:: Teste e documentacao da utilizacao da classe ctrlAtendente ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 * 
 */


include_once 'controller/ctrlAtendente.php';

function testeGerarXMLMedicoEspecialidade(){
    $octrlAtendente = new ctrlAtendente();

    print_r($octrlAtendente->GerarXMLMedicosEspecialidades());
}



function main(){

    testeGerarXMLMedicoEspecialidade();
  

}

main();
?>