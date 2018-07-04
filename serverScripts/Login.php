<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once "../logicas/lAtendente.php";
    include_once "../logicas/lPaciente.php";
    include_once "../logicas/lMedico.php";

    $cpf  = $_REQUEST["cpf"];
    $pass = $_REQUEST["pass"];

    $oAtendente = new lAtendente();
    $atendente = $oAtendente->getAtendenteByCPF($cpf);

    if(sizeof($atendente) > 0)
    {
        if (checaSenha($pass, $atendente[0]))
        {
            echo "Login feito";
        }
        else
        {
            echo "Erro no login";
        }
        return;
    }


    $oMedico = new lMedico();
    $medico = $oMedico->getMedicoByCpf($cpf);

    if(sizeof($medico) > 0)
    {
        if (checaSenha($pass, $medico[0]))
        {
            echo "Login feito";
        }
        else
        {
            echo "Erro no login";
        }
        return;
    }


    $oPaciente = new lPaciente();
    $paciente = $oPaciente->getPacienteByCpf($cpf);

    if(sizeof($paciente) > 0)
    {
        if (checaSenha($pass, $paciente[0]))
        {
            echo "Login feito";
        }
        else
        {
            echo "Erro no login";
        }
        return;
    }

    echo "Erro no login";
    return;

    function checaSenha($senha, $objeto)
    {
        if ($senha == $objeto->senha)
        {
            return true;
        }
        return false;
    }

?>