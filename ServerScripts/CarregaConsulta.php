<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lAtendente.php";


    $oConsulta = new lConsulta();
    $oMedico = new lMedico();
    $oPaciente = new lPaciente();
    $oAtendente = new lAtendente();    


    $codigo = $_REQUEST["Codigo"]; 
    $Medico = $_REQUEST["medico"];
    

    //Se Atendente
    if (substr($codigo, 0, 1) == "A")
    {
        //Filtra as Consultas a partir do medico escolhido
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
    }
    //Se Medico
    elseif(substr($codigo, 0, 1) == "M")
    {
        echo "<tr>";
        echo    "<td>Paciente</td>";
        echo    "<td>Atendente</td>";
        echo    "<td>Receita</>";
        echo    "<td>Observações</>";
        echo    "<td>Data</td>";
        echo    "<td>Hora</td>";
        echo  "</tr>";

        $ListaConsultasXML = $oConsulta->selectConsulta(null,null,$codigo);
        $ListaIConsultas = $oConsulta->traduzSimpleXMLObjectToConsulta($ListaConsultasXML);
        
        foreach ($ListaIConsultas as $Consulta)
        {
            $codigoPaciente = $Consulta->codPaciente;
            $ListaPacientes = $oPaciente->getPacienteByCodigo($codigoPaciente);
            $codigoAtendente = $Consulta->codAtendente;
            $ListaAtendentes = $oAtendente->getAtendenteByCodigo($codigoAtendente);
                
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
            echo    "<td class='editar'><button class='BotaoEditar' id = '".$Consulta->codigo."' onclick='ShowPopup(".$Consulta->codigo.")'> Editar </button></td>";
            echo  "</tr>";
        }
    }
    //Se Paciente
    elseif(substr($codigo, 0, 1) == "P")
    {
        echo "<tr>";
        echo    "<td>Medico</td>";
        echo    "<td>Atendente</td>";
        echo    "<td>Receita</>";
        echo    "<td>Observações</>";
        echo    "<td>Data</td>";
        echo    "<td>Hora</td>";
        echo  "</tr>";

        $ListaConsultasXML = $oConsulta->selectConsulta(null,null,null,$codigo);
        $ListaIConsultas = $oConsulta->traduzSimpleXMLObjectToConsulta($ListaConsultasXML);
        
        foreach ($ListaIConsultas as $Consulta)
        {
            $codigoMedico = $Consulta->codMedico;
            $ListaMedicos = $oMedico->getMedicoByCodigo($codigoMedico);

            $codigoAtendente = $Consulta->codAtendente;
            $ListaAtendentes = $oAtendente->getAtendenteByCodigo($codigoAtendente);
            foreach ($ListaMedicos as $oMed)
            {
                $nomeMedico = $oMed->nome;
            }
            foreach ($ListaAtendentes as $oAtend)
            {
                $nomeAtendente = $oAtend->nome;
            }
            echo "<tr>";
            echo    "<td>".$nomeMedico."</td>";
            echo    "<td>".$nomeAtendente."</td>";
            echo    "<td>".$Consulta->receita."</td>";
            echo    "<td>".$Consulta->observacao."</td>";
            echo    "<td>".$Consulta->data."</td>";
            echo    "<td>".$Consulta->hora."</td>";
            echo    "<td class='editar'><button class='BotaoEditar' id = '".$Consulta->codigo."' onclick='ShowPopup(".$Consulta->codigo.")'> Editar </button></td>";
            echo  "</tr>";
        }
    }

?> 