<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";

    $paciente = new lPaciente();
    $consulta = new lConsulta();
    $medico = new lMedico();
    $clinica = new lClinica();

    $codClinica = $_REQUEST["codClinica"];
    //$codPaciente = 1;
    $clinica -> setCodigo($codClinica);

    if($clinica->identifica())
    {
        $listaConsultas = $consulta->listaConsultaByCodClinica($codClinica);

        if (count($listaConsultas) == 0)
        {
            echo "<div class='consultas-widget__list-row accordion'>Não há consultas passadas.</div>";
            return;
        }

        usort($listaConsultas, "anterioresDepois");

        foreach ($listaConsultas as $consulta) {
            
            $medico = new lMedico();
            $codigmedico = $consulta["codMedico"];
            $medico -> setCodigo($codigmedico);
            $medico->identifica();

            $codPaciente = $consulta["codPaciente"];
            $paciente = new lPaciente();
            $paciente->setCodigo($codPaciente);
            $paciente->identifica();

            $codigoClinica = $consulta["codClinica"];
            $clinica ->setCodigo($codigoClinica);

            $agora = new DateTime();
            $horaConsulta = new DateTime($consulta["data"] . " " . $consulta["hora"]);

            if($agora < $horaConsulta and $consulta["flagConfirmada"] == "1")
            {
                echo "<div class='consultas-widget__list-row accordion'>";

                echo    "<span>".$consulta["data"]."</span>";
                echo    "<span>".$consulta["hora"]."</span>";
                echo    "<span>".$medico->getNome()."</span>";
                echo "<span>".$paciente->getNome()."</span>";
                echo "</div>";
            }
        }
        
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

