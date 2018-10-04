<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";


    $oConsulta = new lConsulta();
    $oMedico = new lMedico();
    $oPaciente = new lPaciente();
    $oAtendente = new lAtendente();    


    //$codigo = $_REQUEST["Codigo"];
    $Paciente = $_REQUEST["paciente"];
    
	//foreach
	echo "<span>".'01/01/2019'."</span>";
    echo        "<span>".'18:00h'."</span>";
    echo        "<span>.Paula Dentro.</span>";
    echo    "<span>.Ginecologista.</span>";
    echo    "<div class='consultas-widget__accordion-panel'>";
    echo      "<div class='consultas-widget__accordion-content'>";
    echo        "<div class='consultas-widget__receita'>";
    echo            "<h3>Receita</h3>";
    echo            "Conteudo da receita";
    echo        "</div>";
    echo        "<div class='consultas-widget__observacoes'>";
    echo            "<h3>Observações</h3>";
    echo            "Conteudo das observações";
    echo        "</div>";
    echo      "</div>";
    echo    "</div>";
    echo  "</div>";

    
?> 
