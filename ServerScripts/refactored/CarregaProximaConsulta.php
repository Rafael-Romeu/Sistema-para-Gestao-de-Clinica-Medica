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

    $codPaciente = $_REQUEST["codigo"];
    //$codPaciente = 1;
    $oPaciente -> setCodigo($codPaciente);

    if($oPaciente->identifica())
    {
        $listaConsultas = $oConsulta->listaConsultaByCodPaciente($codPaciente);

        if (count($listaConsultas) == 0)
        {
            echo "Nenhuma consulta marcada.";
        }
        else
        {

            $oConsulta = end($listaConsultas);
            
            $codigoMedico = $oConsulta["codMedico"];
            $oMedico -> setCodigo($codigoMedico);
            
            $codigoClinica = $oConsulta["codClinica"];
            $oClinica ->setCodigo($codigoClinica);
            
            if($oMedico->identifica())
            {
                $listaEspecialidades = $oMedico->listaEspecialidades();
                echo "<b>Médico(a):</b>";
                echo "<br>";
                echo "<span id='proxConsMedNome'>".$oMedico->getNome()."</span>";
                echo "<br><br>";
                echo "<b>Especialidade:</b>";
                echo "<br>";
                foreach ($listaEspecialidades as $value) {
                    echo "<span id='proxConsMedEsp'>".$value["nome"]."</span>";
                }
                echo "<br><br>";
                echo "<b>Clinica:</b>";
                echo "<br>";
                if($oClinica->identifica())
                {
                    echo "<span id='proxConsClinicaNome'>".$oClinica->getNome()."</span>";
                }
                echo "<br><br>";
                echo "<b>Dia e Hora:</b>";
                echo "<br>";
                echo "<span id='proxConsDia'>".$oConsulta['data']."</span>, às <span id='proxConsHora'>".$oConsulta['hora']."h</span>.";
            }
            
        }
    }
?> 
