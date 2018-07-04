<?php
    include_once "../logicas/lConsulta.php";
    include_once "../logicas/lMedico.php";
    include_once "../logicas/lPaciente.php";
    include_once "../logicas/lAtendente.php";




    $oConsulta = new lConsulta();
    $oMedico = new lMedico();
    $oPaciente = new lPaciente();
    $oAtendente = new lAtendente();    


    //Se Atendente
    //Filtra as Consultas a partir do medico escolhido
    $codigo = $_REQUEST["codigo"]; 
    $Medico = $_REQUEST["Medico"];

    echo "<tr>";
    echo    "<td>Medico</td>";
    echo    "<td>Paciente</td>";
    echo    "<td>Atendente</td>";
    echo    "<td>Data</td>";
    echo    "<td>Hora</td>";
    echo  "</tr>";

    $ListaConsultasXML = $oConsulta->selectConsulta(null,null,$Medico);
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
        echo "<tr>";
        echo    "<td>".$nomeMedico."</td>";
        echo    "<td>".$nomePaciente."</td>";
        echo    "<td>".$nomeAtendente."</td>";
        echo    "<td>".$Consulta->data."</td>";
        echo    "<td>".$Consulta->hora."</td>";
        echo  "</tr>";
    }

?> 