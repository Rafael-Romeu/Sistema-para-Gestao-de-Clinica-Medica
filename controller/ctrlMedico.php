<?php

/**
 * ..:: Controle para Medicos ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'logicas/lAtendente.php';
include_once 'logicas/lMedico.php';
include_once 'logicas/lPaciente.php';
include_once 'logicas/lConsulta.php';


class ctrlMedico {



    function __construct(){

    }

    function AlterarCadastro(){

    }

    function VerAgenda(){

    }

    function PreencherConsulta(lConsulta $oConsulta, string $receita, string $observacao){

    }

    function VerHistorico(lPaciente $oPaciente){

    }

}




?>