<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lAtendente.php";


    $oConsulta = new lConsulta();
    $oMedico = new lMedico();
    $oPaciente = new lPaciente();
    $oAtendente = new lAtendente();    


    $codigo = $_REQUEST["consultaCodigo"]; 
    $receita = $_REQUEST["receita"];
    $observacao = $_REQUEST["observacao"];


        $ListaConsultasXML = $oConsulta->selectConsulta($codigo);
        $ListaIConsultas = $oConsulta->traduzSimpleXMLObjectToConsulta($ListaConsultasXML);
        
        foreach ($ListaIConsultas as $Consulta)
        {
            $string = $Consulta->updateConsultaCompleto($codigo,null,null,null,null,null,$observacao,$receita);
            echo $string;
        }
   

?> 