<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";


    $oMedico = new lMedico();
    $oPaciente = new lPaciente();
    $oConsulta = new lConsulta();
    $oClinica = new lClinica();

    $codMedico = $_REQUEST["codigo"];
    $oMedico -> setCodigo($codMedico);

    if($oMedico->identifica())
    {
        $listaConsultas = $oConsulta->listaConsultaByCodMedico($codMedico);

        usort($listaConsultas, "anterioresAntes");

        $oProximaConsulta = proximaConsulta($listaConsultas);

        echo "<div class=\"seu-perfil-widget\">";
        echo "<h1>Seu Perfil</h1>";
        echo "<div class=\"card\">";
        echo "<b>Nome:</b>";
        echo "<br>";
        echo "<span id=\"infoUserNome\">".$oMedico->getNome()."</span>";
        echo "<br><br>";
        echo "<b>Plano de Saúde:</b>";
        echo "<br>";
        echo "<span id=\"infoUserPlano\">".$oMedico->getPlanoDeSaude()."</span>";
        echo "<br><br>";
        echo "<b>Email:</b>";
        echo "<br>";
        echo "<span id=\"infoUserEmail\">".$oMedico->getEmail()."</span>";
        echo "<br><br>";
        echo "<b>Endereço:</b>";
        echo "<br>";
        echo "<span id=\"infoUserEnd\">".$oMedico->getEndereco()."</span>";
        echo "<br>";
        echo "</div>";
        echo "</div>";
        if($oProximaConsulta == NULL)
        {
            echo "<div class=\"prox-consulta-widget\">";
            echo "<h1>Próxima Consulta</h1>";
            echo "<div class=\"card\">";
            echo "<br><br>";
            echo "<b>Você Não Possui Consultas Marcadas</b>";
            echo "<br><br>";
            echo "</div>";
            echo "</div>";
        }
        else
        {
            $oPaciente->setCodigo($oProximaConsulta["codPaciente"]);
            $oClinica->setCodigo($oProximaConsulta["codClinica"]);

            $oPaciente->identifica();
            $oClinica->identifica();

            echo "<div class=\"prox-consulta-widget\">";
            echo "<h1>Próxima Consulta</h1>";
            echo "<div class=\"card\">";
            echo "<b>Paciente:</b>";
            echo "<br>";
            echo "<span id=\"proxConsPacNome\">".$oPaciente->getNome()."</span>";
            echo "<br><br>";
            echo "<b>Clinica:</b>";
            echo "<br>";
            echo "<span id=\"proxConsPacNome\">".$oClinica->getNome()."</span>";
            echo "<br><br>";
            echo "<b>Dia e Hora:</b>";
            echo "<br>";
            echo "<span id=\"proxConsDia\">".$oProximaConsulta["data"]."</span>, às <span id=\"proxConsHora\">".$oProximaConsulta["hora"]."h</span>.";
            echo "</div>";
            echo "</div>";
        }
    }

    function proximaConsulta($lista)
    {
        $dataAtual = date("Y-m-d");
        $horaAtual = date("H:i:s");
        //$dataAtual = "2018-01-03";
        //$horaAtual = "00:00:00";
        
        foreach($lista as $consulta)
        {
            if( (strtotime($dataAtual) < strtotime($consulta["data"])) )
            {
                return $consulta;
            }
            else if ( (strtotime($dataAtual) == strtotime($consulta["data"])) )
            {
                if ( (strtotime($horaAtual) < strtotime($consulta["hora"])) )
                {
                    return $consulta;
                }

            }
        }
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
?> 