<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lPaciente.php";

    $oPaciente = new lPaciente();


    $pacientes = $oPaciente->getTabela();


    //Cria as opções
    echo "<option value='Any'>Nenhum paciente selecionado</option>"; 

    foreach ($pacientes as $paciente)
    {
        echo "<option value='" . $paciente->codigo . "'>" . $paciente->nome . "</option>";
    }

    


?> 