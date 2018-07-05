<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/logicas/lPaciente.php";
    $codigo = $_REQUEST["codigo"];
    $name = $_REQUEST["name"];
    $cpf  = $_REQUEST["cpf"];
    $senhaNova = $_REQUEST["senhaNova"];
    $senhaAntiga = $_REQUEST["senhaAntiga"];
    $endereco = $_REQUEST["endereco"];
    $email = $_REQUEST["email"];
    $nascimento = $_REQUEST["nascimento"];
    $plano = $_REQUEST["plano"];
    $sangue = sanitize($_REQUEST["sangue"]);
    $genero = $_REQUEST["genero"];
    $telefone = $_REQUEST["telefone"];

    $oPaciente = new lPaciente();
    $paciente = $oPaciente->getPacienteByCodigo($codigo)[0];

    if ($senhaAntiga == $paciente->senha)
    {

        if ($senhaNova != ""){
            $senha = $senhaNova;
        }
        else{
            $senha = $senhaAntiga;
        }

        session_start();
        $_SESSION['cpf'] = $cpf;
        $_SESSION['nome'] = $name;
        $_SESSION['codigo'] = $codigo;
        $_SESSION['planoDeSaude'] = $plano;
        $_SESSION['genero'] = $genero;
        $_SESSION['tipoSanguineo'] = $sangue;
        $_SESSION['dtNascimento'] = $nascimento;
        $_SESSION['endereco'] = $endereco;
        $_SESSION['telefone'] = $telefone;
        $_SESSION['email'] = $email;

        $oPaciente = new lPaciente();

        $result = $oPaciente->updatePacienteCompleto($codigo, $name, $senha, $cpf, $plano, $genero, $sangue, $nascimento, $endereco, $telefone, $email);

        echo "Cadastro alterado com sucesso.";
    }
    else
    {
        echo "Senha incorreta.";
    }

    function sanitize($data) {
        $data = urlencode($data);
        return $data;
    }


    
?>