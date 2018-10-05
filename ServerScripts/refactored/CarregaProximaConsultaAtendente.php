<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";


    $codClinica = $_REQUEST["codClinica"];
    
    $clinica = new lClinica();
    $clinica -> setCodigo($codClinica);

    if($clinica->identifica())
    {
        $consulta = new lConsulta();
        $todasConsultas = $consulta->listaConsultaByCodClinica($codClinica);

        $agora = new DateTime();
        
        $consultas = [];
        foreach($todasConsultas as $c)
        {
            $horaConsulta = new DateTime($c["data"] . " " . $c["hora"]);
            
            if ($agora < $horaConsulta)
            {
                array_push($consultas, $c);
            }
        }

        if (count($consultas) == 0)
        {
            echo "Nenhuma consulta marcada.";
        }
        else
        {
            usort($consultas, "anterioresAntes");

            $proxConsulta = $consultas[0];
            
            $paciente = new lPaciente();
            $paciente->setCodigo($proxConsulta["codPaciente"]);
            $paciente->identifica();


            $medico = new lMedico();
            $medico->setCodigo($proxConsulta["codMedico"]);
            $medico->identifica();

            $especialidades = $medico->listaEspecialidades();


            echo "<b>Paciente:</b>";
            echo "<br>";
            echo "<span id='proxConsPacNome'>".$paciente->getNome()."</span>";
            echo "<br><br>";
            echo "<b>Médico(a):</b>";
            echo "<br>";
            echo "<span id='proxConsMedNome'>".$medico->getNome()."</span>";
            echo "<br><br>";
            echo "<b>Especialidade:</b>";
            echo "<br><span id='proxConsMedEsp'>" . $especialidades[0]["nome"];
            for ($i=1; $i<count($especialidades); ++$i){
                echo ", " . $especialidades[$i]["nome"];
            }
            echo "</span><br><br>";
            echo "<b>Clinica:</b>";
            echo "<br>";

            echo "<span id='proxConsClinicaNome'>".$clinica->getNome()."</span>";
            
            echo "<br><br>";
            echo "<b>Dia e Hora:</b>";
            echo "<br>";
            echo "<span id='proxConsDia'>".$proxConsulta['data']."</span>, às <span id='proxConsHora'>".$proxConsulta['hora']."h</span>.";
            
            
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
