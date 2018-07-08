<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lAtendente.php";


    $oConsulta = new lConsulta();
    $oMedico = new lMedico();
    $oPaciente = new lPaciente();
    $oAtendente = new lAtendente();
    $nomeAtendente;
    $nomeMedico;
    $nomePaciente;    


    $codigo = $_REQUEST["Codigo"]; 

        $ListaConsultasXML = $oConsulta->selectConsulta($codigo);
        $ListaIConsultas = $oConsulta->traduzSimpleXMLObjectToConsulta($ListaConsultasXML);
        
        foreach ($ListaIConsultas as $Consulta)
        {
            $codigoMedico = $Consulta->codMedico;
            $ListaMedicos = $oMedico->getMedicoByCodigo($codigoMedico);
            $codigoPaciente = $Consulta->codPaciente;
            $ListaPacientes = $oPaciente->getPacienteByCodigo($codigoPaciente);
            $codigoAtendente = $Consulta->codAtendente;
            $ListaAtendentes = $oAtendente->getAtendenteByCodigo($codigoAtendente);
                
            foreach ($ListaMedicos as $oMed)
            {
                $nomeMedico = $oMed->nome;
            }
            foreach ($ListaPacientes as $oPac)
            {
                $nomePaciente = $oPac->nome;
            }
            foreach ($ListaAtendentes as $oAtend)
            {
                $nomeAtendente = $oAtend->nome;
            }
        
        echo        "Medico:";
        echo        "<input type='text' name='Medico' value=".$nomeMedico.">";
        echo        "Paciente:";
        echo        "<input type='text' name='Paciente' value=".$nomePaciente.">";
        echo        "Atendente:";
        echo        "<input type='text' name='Atendente' value=".$nomeAtendente.">";
                    
                    
        echo        "Receita:";
        echo        "<br>";
        echo        "<textarea id='novaReceita' class='obs' name='message' rows='10' cols='30'>".$Consulta->receita."";
        echo        "</textarea>"; 

                    
        echo        "Observações:";
        echo        "<br>";
        echo        "<textarea id='novaObservacao' class='obs' name='message' rows='10' cols='30'>".$Consulta->observacao."";
        echo        "</textarea>";
        echo        "<br>";
        echo        "<nav><button id = '".$Consulta->codigo."' onclick='EditaConsulta(".$Consulta->codigo.")'> Submit </button></nav>";
        echo "<p id='retorno'></p>";
             
        }
?> 