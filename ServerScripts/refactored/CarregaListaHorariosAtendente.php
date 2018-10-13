<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    
    $codMedico = $_REQUEST["codMedico"];
    
    $medico = new lMedico();
    $medico->setCodigo($codMedico);
    $medico->identifica();

    $todosHorarios = $medico->listaHorarios();

    
    $disponiveis = [];
    $disponiveis[0] = "1111111111111111111111";
    $disponiveis[1] = "1111111111111111111111";
    $disponiveis[2] = "1111111111111111111111";
    $disponiveis[3] = "1111111111111111111111";
    $disponiveis[4] = "1111111111111111111111";


    for($i = 0; $i<sizeof($todosHorarios); $i++)
    {
        for($j = 0; $j<strlen($todosHorarios[$i]["seg"]); ++$j)
        {
            if ($todosHorarios[$i]["seg"][$j] == '1')
            {
                $disponiveis[0][$j] = "0";
            }
        }
        for($j = 0; $j<strlen($todosHorarios[$i]["ter"]); ++$j)
        {
            if ($todosHorarios[$i]["ter"][$j] == '1')
            {
                $disponiveis[1][$j] = "0";
            }
        }
        for($j = 0; $j<strlen($todosHorarios[$i]["qua"]); ++$j)
        {
            if ($todosHorarios[$i]["qua"][$j] == '1')
            {
                $disponiveis[2][$j] = "0";
            }
        }
        for($j = 0; $j<strlen($todosHorarios[$i]["qui"]); ++$j)
        {
            if ($todosHorarios[$i]["qui"][$j] == '1')
            {
                $disponiveis[3][$j] = "0";
            }
        }
        for($j = 0; $j<strlen($todosHorarios[$i]["sex"]); ++$j)
        {
            if ($todosHorarios[$i]["sex"][$j] == '1')
            {
                $disponiveis[4][$j] = "0";
            }
        }
    }

    echo json_encode($disponiveis);



?> 