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

        print_r($oAtendente->insertAtendente());
    }


    function CadastrarMedicostring ($nome, string $senha, string $cpf, string $especialidade, string $planoDeSaude, string $dtNascimento=null, string $endereco=null, string $telefone=null, string $email=null){
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

        print_r($oMedico->insertMedico());
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

        print_r($oPaciente->insertPaciente());
    }


    function AgendarConsulta(){
        
    }
    

    function VerAgenda(lMedico $oMedico){

    }


    function VerHistoricoByMedico(lMedico $oMedico){

    }


    function VerHistoricoByPaciente(lPaciente $oPaciente){

    }






}




?>