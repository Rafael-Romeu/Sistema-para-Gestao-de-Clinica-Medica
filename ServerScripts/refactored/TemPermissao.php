<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    function TemPermissao($tipo, $codigo, $clinica)
    {
        if ($tipo == "lAtendente")
        {
            $user = new lAtendente();
        }
        else if ($tipo == "lMedico")
        {
            $user = new lMedico();
        }

        $user->setCodigo($codigo);
        $user->identifica();

        $clinicas = $user->getCodClinica();

        if (in_array($clinica, $clinicas))
        {
            return true;
        }
        else
        {
            return false;
        }

    }
?> 