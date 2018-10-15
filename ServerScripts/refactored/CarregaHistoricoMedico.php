<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";

    $oPaciente = new lPaciente();
    $oConsulta = new lConsulta();
    $oMedico = new lMedico();
    $oClinica = new lClinica();

    $codMedico = $_REQUEST["codigo"];
    $codClinica = $_REQUEST["codClinica"];
    
    $oMedico -> setCodigo($codMedico);

    if($oMedico->identifica())
    {
        $listaConsultas = $oConsulta->listaConsultaByCodMedico($codMedico);

        if (count($listaConsultas) == 0)
        {
            echo "<div class='consultas-widget__list-row accordion'>Não há consultas marcadas.</div>";
            return;
        }

        usort($listaConsultas, "anterioresAntes");

        foreach ($listaConsultas as $oConsulta) {
            $oPaciente = new lPaciente();
            $codigoPaciente = $oConsulta["codPaciente"];
            $oPaciente -> setCodigo($codigoPaciente);
            $oPaciente->identifica();

            $codigoClinica = $oConsulta["codClinica"];
            $oClinica ->setCodigo($codigoClinica);
            $oClinica->identifica();

            $agora = new DateTime();
            $horaConsulta = new DateTime($oConsulta["data"] . " " . $oConsulta["hora"]);

            if($agora > $horaConsulta  && $oConsulta["flagConfirmada"] == "1" && $codClinica == $codigoClinica)
            {
                echo "<div class='consultas-widget__list-row accordion'>";

                echo "<span>".$oConsulta["data"]."</span>";
                echo "<span>".$oConsulta["hora"]."</span>";
                echo "<span>".$oPaciente->getNome()."</span>";

                echo "<div class='consultas-widget__accordion-panel'>";
                echo    "<div class='consultas-widget__accordion-content'>";
                
                echo        "<div class='consultas-widget__receita'>";
                echo            "<div><h3>Receita</h3></div>";
                echo            "<div>".$oConsulta["receita"]."</div>";
                echo        "</div>";

                echo        "<div class='consultas-widget__observacoes'>";
                echo            "<div><h3>Observações</h3></div>";
                echo            "<div>".$oConsulta["observacao"]."</div>";
                echo        "</div>";

                echo      "<div class=\"consultas-widget__edit-btn\">";
                echo        "<a href=\"#\">";
                echo            "Editar";
                echo        "</a>";
                echo      "</div>";

                echo    "</div>";
                echo  "</div>";
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

