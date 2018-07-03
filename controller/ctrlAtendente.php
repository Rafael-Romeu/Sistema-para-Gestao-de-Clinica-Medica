<?php

/**
 * ..:: Controle para Atendentes ::..
 * 
 * @author Marlon R C Franco
 * @author Marlon R C Franco <marlonrcfranco@gmail.com>
 * 
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'logicas/lAtendente.php';
include_once 'logicas/lMedico.php';
include_once 'logicas/lPaciente.php';
include_once 'logicas/lConsulta.php';


class ctrlAtendente {



    function __construct(){

    }


    function CadastrarAtendente(string $nome, string $senha, string $cpf, string $dtNascimento=null, string $endereco=null, string $telefone=null, string $email=null){
        $oAtendente = new lAtendente();
        
        $oAtendente->nome = $nome;
        $oAtendente->cpf = $cpf;
        $oAtendente->senha = $senha;
        $oAtendente->dtNascimento = $dtNascimento;
        $oAtendente->endereco = $endereco;
        $oAtendente->telefone = $telefone;
        $oAtendente->email=$email;

        return $oAtendente->insertAtendente();
    }


    function CadastrarMedico(string $nome, string $senha, string $cpf, string $especialidade, string $planoDeSaude, string $dtNascimento=null, string $endereco=null, string $telefone=null, string $email=null){
        $oMedico = new lMedico();
        
        $oMedico->nome = $nome;
        $oMedico->cpf = $cpf;
        $oMedico->senha = $senha;
        $oMedico->especialidade = $especialidade;
        $oMedico->planoDeSaude = $planoDeSaude;
        $oMedico->dtNascimento = $dtNascimento;
        $oMedico->endereco = $endereco;
        $oMedico->telefone = $telefone;
        $oMedico->email=$email;

        return $oMedico->insertMedico();
    }


    function CadastrarPaciente(string $nome, string $senha, string $cpf, string $planoDeSaude, string $genero , string $tipoSanguineo, string $dtNascimento=null, string $endereco=null, string $telefone=null, string $email=null){
        $oPaciente = new lPaciente();
        
        $oPaciente->nome = $nome;
        $oPaciente->cpf = $cpf;
        $oPaciente->senha = $senha;
        $oPaciente->planoDeSaude = $planoDeSaude;
        $oPaciente->genero = $genero;
        $oPaciente->tipoSanguineo = $tipoSanguineo;
        $oPaciente->dtNascimento = $dtNascimento;
        $oPaciente->endereco = $endereco;
        $oPaciente->telefone = $telefone;
        $oPaciente->email=$email;

        return $oPaciente->insertPaciente();
    }


    function AgendarConsulta(string $codAtendente, string $codMedico, string $codPaciente, string $data, string $hora ){
        $oConsulta = new lConsulta();
        
        $oConsulta->codAtendente = $codAtendente;
        $oConsulta->codMedico = $codMedico;
        $oConsulta->codPaciente = $codPaciente;
        $oConsulta->data = $data;
        $oConsulta->hora = $hora;

        return $oConsulta->insertConsulta();
    }
    

    function VerAgenda(lMedico $oMedico){
        $oConsulta = new lConsulta();
        $ConsultasFuturas = array();

        $codMedico = $oMedico->codigo;

        $listaConsultas = $oConsulta->getConsultaByCodMedico($codMedico);

        foreach($listaConsultas as $consulta){
            if($consulta->data > date("Y-m-d H:i:s",time())){
                array_push($ConsultasFuturas, $consulta);
            }
        }

        return $ConsultasFuturas;
    }


    function VerHistoricoByMedico(lMedico $oMedico){

    }


    function VerHistoricoByPaciente(lPaciente $oPaciente){

    }






}




?>