<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lAtendente.php";


    $oConsulta = new lConsulta();
    $oMedico = new lMedico();
    $oPaciente = new lPaciente();
    $oAtendente = new lAtendente();    


    $dia = $_REQUEST["dia"]; 
    $Medico = $_REQUEST["medico"];
    

        echo "<tr>";
        echo    "<td>Paciente</td>";
        echo    "<td>Atendente</td>";
        echo    "<td>Receita</td>";
        echo    "<td>Observaçao</td>";
        echo    "<td>Data</td>";
        echo    "<td>Hora</td>";
        echo  "</tr>";

        $ListaConsultasXML = $oConsulta->selectConsulta(null,null,$Medico);
        $ListaIConsultas = $oConsulta->traduzSimpleXMLObjectToConsulta($ListaConsultasXML);
        
        foreach ($ListaIConsultas as $Consulta)
        {
            if($dia == $Consulta->data)
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
                echo "<tr>";
                echo    "<td>".$nomePaciente."</td>";
                echo    "<td>".$nomeAtendente."</td>";
                echo    "<td>".$Consulta->receita."</td>";
                echo    "<td>".$Consulta->observacao."</td>";
                echo    "<td>".$Consulta->data."</td>";
                echo    "<td>".$Consulta->hora."</td>";
                echo  "</tr>";
            }
            
        }


?> 