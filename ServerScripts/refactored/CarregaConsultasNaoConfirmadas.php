<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";

    $consulta = new lConsulta();

    $codClinica = $_REQUEST["codClinica"];

    $listaConsultas = $consulta->listaConsultaByCodClinica($codClinica);

    $agora = new DateTime();
    $consultas = [];
    foreach($listaConsultas as $c)
    {
        $horaConsulta = new DateTime($c["data"] . " " . $c["hora"]);
        
        if ($agora < $horaConsulta && $c["flagConfirmada"] == "0")
        {
            array_push($consultas, $c);
        }
    }

    if (count($consultas) == 0)
    {
        echo "<br>Não há consultas não confirmadas.";
        return;
    }

    usort($consultas, "anterioresAntes");

    foreach ($consultas as $consulta) {
    
        $codMedico = $consulta["codMedico"];
        $medico = new lMedico();
        $medico -> setCodigo($codMedico);
        $medico->identifica();

        $codPaciente = $consulta["codPaciente"];
        $paciente = new lPaciente();
        $paciente->setCodigo($codPaciente);
        $paciente->identifica();

        $clinica = new lClinica();
        $clinica ->setCodigo($codClinica);
        $clinica->identifica();


        echo "<div class='consultas-widget__list-row accordion'>";

        echo "<span>".$consulta["data"]."</span>";
        echo "<span>".$consulta["hora"]."</span>";
        echo "<span>".$medico->getNome()."</span>";
        echo "<span>".$paciente->getNome()."</span>";

        echo "<div class='consultas-widget__accordion-panel'>";
        echo    "<div class='consultas-widget__accordion-content'>";
        echo        '<button class="consultas-widget__confirmar-btn" id=';
        
        echo "'data=" . $consulta["data"] . "&hora=" . $consulta["hora"] . "&codMedico=" . $codMedico . "'";

        echo' onclick="ConfirmaConsulta(this.id);">Confirmar Consulta</button>';
        echo      "</div>";
        echo    "</div>";
        echo  "</div>";
        echo "</div>";
        
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

