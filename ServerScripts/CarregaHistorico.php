<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lAtendente.php";


    $oConsulta = new lConsulta();
    $oMedico = new lMedico();
    $oPaciente = new lPaciente();
    $oAtendente = new lAtendente();    

    $codigo = $tipo = $selecionado = "";

    $codigo = $_REQUEST["codigo"]; 
    $tipo = $_REQUEST["tipo"];
    $selecionado = $_REQUEST["selecionado"];
    $ordem = $_REQUEST["ordem"];
    

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

        if ($selecionado == "Any"){
            $ListaIConsultas = $oConsulta->getTabela();
        }
        else if ($tipo == "Medico"){
            $ListaConsultasXML = $oConsulta->selectConsulta(null,null,$selecionado);
            $ListaIConsultas = $oConsulta->traduzSimpleXMLObjectToConsulta($ListaConsultasXML);
        }
        else if ($tipo == "Paciente"){
            $ListaConsultasXML = $oConsulta->selectConsulta(null,null,null,$selecionado);
            $ListaIConsultas = $oConsulta->traduzSimpleXMLObjectToConsulta($ListaConsultasXML);
        }
                
        if ($ordem == "comum")
            usort($ListaIConsultas, "velhasPrimeiro");
        else if ($ordem == "reversa")
            usort($ListaIConsultas, "novasPrimeiro");

        foreach ($ListaIConsultas as $consulta)
        {
            $agora = new DateTime();
            $horaConsulta = new DateTime($consulta->data . " " . $consulta->hora);

            if ($horaConsulta < $agora)
            {
                $codigoMedico = $consulta->codMedico;
                $medico = $oMedico->getMedicoByCodigo($codigoMedico)[0];
                $codigoPaciente = $consulta->codPaciente;
                $paciente = $oPaciente->getPacienteByCodigo($codigoPaciente)[0];
                $codigoAtendente = $consulta->codAtendente;
                $atendente = $oAtendente->getAtendenteByCodigo($codigoAtendente)[0];
                    
                echo "<tr>";
                echo    "<td>".$medico->nome."</td>";
                echo    "<td>".$paciente->nome."</td>";
                echo    "<td>".$atendente->nome."</td>";
                echo    "<td>".$consulta->data."</td>";
                echo    "<td>".$consulta->hora."</td>";
                echo  "</tr>";
            }

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

        if ($selecionado == "Any"){
            $ListaConsultasXML = $oConsulta->selectConsulta(null,null,$codigo);
            $ListaIConsultas = $oConsulta->traduzSimpleXMLObjectToConsulta($ListaConsultasXML);
        }
        else {
            $ListaConsultasXML = $oConsulta->selectConsulta(null,null,$codigo,$selecionado);
            $ListaIConsultas = $oConsulta->traduzSimpleXMLObjectToConsulta($ListaConsultasXML);
        }
        
        if ($ordem == "comum")
            usort($ListaIConsultas, "velhasPrimeiro");
        else if ($ordem == "reversa")
            usort($ListaIConsultas, "novasPrimeiro");

        foreach ($ListaIConsultas as $consulta)
        {
            $agora = new DateTime();
            $horaConsulta = new DateTime($consulta->data . " " . $consulta->hora);

            if ($horaConsulta < $agora)
            {
                $codigoPaciente = $consulta->codPaciente;
                $paciente = $oPaciente->getPacienteByCodigo($codigoPaciente)[0];
                $codigoAtendente = $consulta->codAtendente;
                $atendente = $oAtendente->getAtendenteByCodigo($codigoAtendente)[0];

                echo "<tr>";
                echo    "<td>".$paciente->nome."</td>";
                echo    "<td>".$atendente->nome."</td>";
                echo    "<td>".$consulta->receita."</td>";
                echo    "<td>".$consulta->observacao."</td>";
                echo    "<td>".$consulta->data."</td>";
                echo    "<td>".$consulta->hora."</td>";
                echo    "<td class='editar'><button class='BotaoEditar' id = '".$consulta->codigo."' onclick='ShowPopup(".$consulta->codigo.")'> Editar </button></td>";
                echo  "</tr>";
            }
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

        if ($selecionado == "Any"){
            $ListaConsultasXML = $oConsulta->selectConsulta(null,null,null,$codigo);
            $ListaIConsultas = $oConsulta->traduzSimpleXMLObjectToConsulta($ListaConsultasXML);
        }
        else if ($tipo == "Medico"){
            $ListaConsultasXML = $oConsulta->selectConsulta(null,null,$selecionado,$codigo);
            $ListaIConsultas = $oConsulta->traduzSimpleXMLObjectToConsulta($ListaConsultasXML);
        }
        
        if ($ordem == "comum")
            usort($ListaIConsultas, "velhasPrimeiro");
        else if ($ordem == "reversa")
            usort($ListaIConsultas, "novasPrimeiro");

        foreach ($ListaIConsultas as $consulta)
        {
            $agora = new DateTime();
            $horaConsulta = new DateTime($consulta->data . " " . $consulta->hora);

            if ($horaConsulta < $agora)
            {
                $codigoMedico = $consulta->codMedico;
                $medico = $oMedico->getMedicoByCodigo($codigoMedico)[0];
                $codigoAtendente = $consulta->codAtendente;
                $atendente = $oAtendente->getAtendenteByCodigo($codigoAtendente)[0];

                echo "<tr>";
                echo    "<td>".$medico->nome."</td>";
                echo    "<td>".$atendente->nome."</td>";
                echo    "<td>".$consulta->receita."</td>";
                echo    "<td>".$consulta->observacao."</td>";
                echo    "<td>".$consulta->data."</td>";
                echo    "<td>".$consulta->hora."</td>";
                echo    "<td class='editar'><button class='BotaoEditar' id = '".$consulta->codigo."' onclick='ShowPopup(".$consulta->codigo.")'> Editar </button></td>";
                echo  "</tr>";
            }
        }
    }

    function novasPrimeiro($c1, $c2)
    {
        $t1 = new DateTime($c1->data . " " . $c1->hora);
        $t2 = new DateTime($c2->data . " " . $c2->hora);

        if ($t1 < $t2)
            return 1;
        else if ($t1 == $t2)
            return 0;
        else
            return -1;
    }

    function velhasPrimeiro($c1, $c2)
    {
        $t1 = new DateTime($c1->data . " " . $c1->hora);
        $t2 = new DateTime($c2->data . " " . $c2->hora);

        if ($t1 < $t2)
            return -1;
        else if ($t1 == $t2)
            return 0;
        else
            return 1;
    }


?> 