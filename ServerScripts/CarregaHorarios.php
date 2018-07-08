<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lHorarioAtendimento.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lConsulta.php";

    $codigo = $_REQUEST["Medico"];
    $dia = $_REQUEST["Dia"];
    
    $nomeHorario = array("08:00h", "08:30h", 
                         "09:00h", "09:30h", 
                         "10:00h", "10:30h", 
                         "11:00h", "11:30h", 
                         "12:00h", "12:30h", 
                         "13:00h", "13:30h", 
                         "14:00h", "14:30h", 
                         "15:00h", "15:30h", 
                         "16:00h", "16:30h", 
                         "17:00h", "17:30h", 
                         "18:00h", "18:30h");
                         
    $oHorario = new lHorarioAtendimento();
    $horarios = $oHorario->getHorarioAtendimentoByCodMedico($codigo);

    switch(getDiaDaSemana($dia))
    {
        case 0:
            $horario = $horarios[0]->dom;
            break;
        case 1:
            $horario = $horarios[0]->seg;
            break;
        case 2:
            $horario = $horarios[0]->ter;
            break;
        case 3:
            $horario = $horarios[0]->qua;
            break;
        case 4:
            $horario = $horarios[0]->qui;
            break;
        case 5:
            $horario = $horarios[0]->sex;
            break;
        case 6:
            $horario = $horarios[0]->sab;
            break;
    }

    $nenhumHorario = true;
    
    for ($i = 0; $i < strlen($horario); $i++){
        if ($horario[$i] == "1" && !medicoTemConsultaMarcada($codigo, $dia, $nomeHorario[$i]))
        {
            echo "<option value='" . formataHora($nomeHorario[$i]) . "'>" . $nomeHorario[$i] . "</option>";
            $nenhumHorario = false;
        }
    }

    if ($nenhumHorario == true)
    {
        echo "<option value='null'> Nenhum Horario Disponivel </option>";
    }



    function getDiaDaSemana($data) {
        return date('w', strtotime($data));
    }

    function formataHora($hora){
        $hora[5] = ":";
        $hora = $hora . "00";
        return $hora;
    }

    function medicoTemConsultaMarcada($medico, $data, $hora){
        $hora = formataHora($hora);
        
        $oConsulta = new lConsulta();
       
        $consultas = $oConsulta->selectConsulta(null, null, $medico, null, $data, $hora);

        if (sizeof($consultas) > 0)
            return true;
        return false;
    }
?>