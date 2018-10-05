<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    
    $medico = new lMedico();
    $codMedico = $_REQUEST["codMedico"];
    $codClinica = $_REQUEST["codClinica"];
    $date = $_REQUEST["date"];

    $clinica = new lClinica();
    $clinica->setCodigo($codClinica);
    $clinica->identifica();

    $todosHorarios = $clinica->listaHorariosMedicos();

    $horarios = [];
    $horarios[0] = $todosHorarios["seg"][$codMedico];
    $horarios[1] = $todosHorarios["ter"][$codMedico];
    $horarios[2] = $todosHorarios["qua"][$codMedico];
    $horarios[3] = $todosHorarios["qui"][$codMedico];
    $horarios[4] = $todosHorarios["sex"][$codMedico];

    $dias = getDias($date);

    $horas = array("08:00:00", "08:30:00", 
                   "09:00:00", "09:30:00", 
                   "10:00:00", "10:30:00", 
                   "11:00:00", "11:30:00", 
                   "12:00:00", "12:30:00", 
                   "13:00:00", "13:30:00", 
                   "14:00:00", "14:30:00", 
                   "15:00:00", "15:30:00", 
                   "16:00:00", "16:30:00", 
                   "17:00:00", "17:30:00", 
                   "18:00:00", "18:30:00");
    
    $agora = new DateTime();
    for ($i=0; $i<count($dias); $i++)
    {
        for ($j=0; $j<count($horas); ++$j)
        {
            $dia = new DateTime($dias[$i] . " " . $horas[$j]);


            $consulta = new lConsulta();
            $consulta->setCodMedico($codMedico);
            $consulta->setData($dias[$i]);
            $consulta->setHora($horas[$j]);
            
            if ($consulta->identifica() || $dia < $agora)
            { 
                $horarios[$i] = substr_replace($horarios[$i], "0", $j, 1);
            }
            
        }
    }

    echo json_encode($horarios);

    function getDias($date)
    {
        $dias = [];

        for($i=0; $i<5; $i++)
        {
            $temp = new DateTime($date);
            $temp->modify('+'.$i.' day');

            array_push($dias, $temp->format('Y-m-d'));
        }

        return $dias;
    }


?> 