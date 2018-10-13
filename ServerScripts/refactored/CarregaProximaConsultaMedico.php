<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";


    $codMedico = $_REQUEST["codigo"];
    

    $consulta = new lConsulta();
    $todasConsultas = $consulta->listaConsultaByCodMedico($codMedico);

    $agora = new DateTime();
    
    $consultas = [];
    foreach($todasConsultas as $c)
    {
        $horaConsulta = new DateTime($c["data"] . " " . $c["hora"]);
        
        if ($agora < $horaConsulta)
        {
            array_push($consultas, $c);
        }
    }

    if (count($consultas) == 0)
    {
        $array = [];
        echo json_encode($array);
    }
    else
    {
        usort($consultas, "anterioresAntes");

        $proxConsulta = $consultas[0];
        
        $paciente = new lPaciente();
        $paciente->setCodigo($proxConsulta["codPaciente"]);
        $paciente->identifica();


        $medico = new lMedico();
        $medico->setCodigo($proxConsulta["codMedico"]);
        $medico->identifica();

        $especialidades = $medico->listaEspecialidades();

        $result = new stdClass();
        $result->nomePaciente = $paciente->getNome();
        $result->data = $proxConsulta['data'];
        $result->hora = $proxConsulta['hora'];


        echo json_encode($result);        
        
    }


    function anterioresDepois($c1, $c2)
    {
        $t1 = new DateTime($c1["data"] . " " . $c1["hora"]);
        $t2 = new DateTime($c2["data"] . " " . $c2["hora"]);

        if ($t1 < $t2)
            return 1;
        else if ($t1 == $t2)
            return 0;
        else
            return -1;
    }

    function anterioresAntes($c1, $c2)
    {
        $t1 = new DateTime($c1["data"] . " " . $c1["hora"]);
        $t2 = new DateTime($c2["data"] . " " . $c2["hora"]);

        if ($t1 < $t2)
            return -1;
        else if ($t1 == $t2)
            return 0;
        else
            return 1;
    }
?> 
