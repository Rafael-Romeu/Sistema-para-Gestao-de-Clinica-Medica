<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lMedico.php";

    $oMedico = new lMedico();
    $medicos = $oMedico->getTabela();

    echo "<option value='Any'>Qualquer Especialidade</option>";

    $especialidades = array();

    foreach($medicos as $medico)
    {
        if (in_array($medico->especialidade, $especialidades) == false)
        {
            array_push($especialidades, $medico->especialidade);
            echo "<option value='" . $medico->especialidade . "'>" . $medico->especialidade . "</option>";
        }
    }


?> 