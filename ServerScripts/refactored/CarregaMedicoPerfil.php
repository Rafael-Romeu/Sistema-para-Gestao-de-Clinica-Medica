<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";

    $oMedico = new lMedico();
    $codMedico = $_REQUEST["codigo"];
    $oMedico -> setCodigo($codMedico);
    

    if($oMedico->identifica())
    {
        echo "<div class=\"perfil-column-left\">";
        echo "<div class=\"perfil-widget\">";
        echo "<h2>Dados Pessoais</h2>";
        echo "<div class=\"card\">";
        echo "<b>Nome:</b>";
        echo "<br>";
        echo "<span id=\"infoUserNome\">Jacinto Leite</span>";
        echo "<br><br>";
        echo "<b>CPF:</b>";
        echo "<br>";
        echo "<span id=\"infoUserCpf\">123.123.123-12</span>";
        echo "<br><br>";
        echo "<b>Data de Nascimento:</b>";
        echo "<br>";
        echo "<span id=\"infoUserData\">01/01/1990</span>";
        echo "<br><br>";
        echo "<b>Gênero:</b>";
        echo "<br>";
        echo "<span id=\"infoUserEnd\">Masculino</span>";
        echo "<br><br>";
        echo "<b>Endereço:</b>";
        echo "<br>";
        echo "<span id=\"infoUserEnd\">Rua Jussara, 159</span>";
        echo "<br>";
        echo "</div>";
                
        echo "</div>";
                
        echo "</div>";
        echo "<div class=\"perfil-column-right\">";
        echo "<div class=\"perfil-widget\">";
        echo "<h2>Contato</h2>";
        echo "<div class=\"card\">";
        echo "<b>Email:</b>";
        echo "<br>";
        echo "<span id=\"infoUserEmail\">jacinto@leite.com</span>";
        echo "<br><br>";
        echo "<b>Telefone:</b>";
        echo "<br>";
        echo "<span id=\"infoUserTel\">(21)2345678</span>";
        echo "<br>";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"perfil-widget\">";
        echo "<h2>Dados Médicos</h2>";
        echo "<div class=\"card\">";
        echo "<b>Plano de Saúde:</b>";
        echo "<br>";
        echo "<span id=\"infoUserPlano\">Unimed</span>";
        echo "<br><br>";
        echo "<b>Tipo Sanguíneo:</b>";
        echo "<br>";
        echo "<span id=\"infoUserSangue\">O+</span>";
        echo "<br>";
        echo "</div>";
        echo "</div>";     
        echo "</div>";
        echo "</div>";
    }
?> 