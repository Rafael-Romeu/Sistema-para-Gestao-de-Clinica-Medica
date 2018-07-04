<?php
    include_once "../logicas/lPaciente.php";

    $oPaciente = new lPaciente();

    $cpf = $_REQUEST["cpf"];

    $paciente = $oPaciente->getPacienteByCpf($cpf);

    if (sizeof($paciente) == 1)
    {
        echo "Paciente encontrado: " . $paciente[0]->nome;
    }
    else
    {
        echo "Nenhum paciente cadastrado com esse cpf.";
    }
?> 