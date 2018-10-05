<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";
    
    $oPaciente = new lPaciente();
    $codPaciente = $_REQUEST["codigo"];
    $tipoDeDadosASerCarregos = $_REQUEST["tipoDeDadosASerCarregados"];

    $oPaciente -> setCodigo($codPaciente);

    if($oPaciente->identifica())
    {
        if(strcmp($tipoDeDadosASerCarregos,"dadosPessoais") == 0)
        {
            echo "<b>Nome:</b>";
            echo "<br>";
            echo "<span id=\"infoUserNome\">".$oPaciente->getNome()."</span>";
            echo "<br><br>";

            echo "<b>CPF:</b>";
            echo "<br>";
            echo "<span id=\"infoUserCpf\">".$oPaciente->getCPF()."</span>";
            echo "<br><br>";

            echo "<b>Data de Nascimento:</b>";
            echo "<br>";
            echo "<span id=\"infoUserData\">".$oPaciente->getDataNascimento()."</span>";
            echo "<br><br>";
                
            echo "<b>Endereço:</b>";
            echo "<br>";
            echo "<span id=\"infoUserEnd\">".$oPaciente->getEndereco()."</span>";
            echo "<br>";
        }
        else if (strcmp($tipoDeDadosASerCarregos,"contato") == 0)
        {
            echo "<b>Email:</b>";
            echo "<br>";
            echo "<span id=\"infoUserEmail\">".$oPaciente->getEmail()."</span>";
            echo "<br><br>";
            echo "<b>Telefone:</b>";
            echo "<br>";
            echo "<span id=\"infoUserTel\">".$oPaciente->getTelefone1()."</span>";
            echo "<br>";
        }
        else if (strcmp($tipoDeDadosASerCarregos,"dadosMedicos") == 0)
        {
            echo "<b>Plano de Saúde:</b>";
            echo "<br>";
            echo "<span id=\"infoUserPlano\">".$oPaciente->getPlanoDeSaude()."</span>";
            echo "<br><br>";

            echo "<b>Tipo Sanguíneo:</b>";
            echo "<br>";
            echo "<span id=\"infoUserSangue\">".$oPaciente->getTipoSanguineo()."</span>";
            echo "<br>";
        }
    }
?> 