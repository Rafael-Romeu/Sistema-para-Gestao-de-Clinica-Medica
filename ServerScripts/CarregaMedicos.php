<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lMedico.php";

    $oMedico = new lMedico();

    //Filtra os medicos a partir da especialidade escolhida
    $especialidade = $_REQUEST["Especialidade"];
    if ($especialidade == "Any" || $especialidade == null)
    {
        $medicos = $oMedico->getTabela();
    }
    else
    {
        $medicos = $oMedico->getMedicoByEspecialidade($especialidade);
    }

    //Cria as opções
    echo "<option value='Any'>Nenhum médico selecionado</option>"; 

    foreach ($medicos as $medico)
    {
        echo "<option value='" . $medico->codigo . "'>" . $medico->nome . "</option>";
    }



?> 