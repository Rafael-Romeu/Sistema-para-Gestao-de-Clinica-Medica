<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Sistema-para-Gestao-de/BancoDeDados/MySQL/logicas/lPaciente.php";

$oPaciente = new lPaciente();

$nome          = $_REQUEST["nome"];
$cpf           = $_REQUEST["cpf"];
$nascimento    = $_REQUEST["bday"];
$genero        = $_REQUEST["genero"];
$cep           = $_REQUEST["CEP"];
$endereco      = $_REQUEST["endereco"];
$senha         = $_REQUEST["senha"];
$email         = $_REQUEST["email"];
$telefone1     = $_REQUEST["telefone1"];
$telefone2     = $_REQUEST["telefone2"];
$planoDeSaude  = $_REQUEST["planoDeSaude"];
$tipoSanguineo = $_REQUEST["tipoSanguineo"];
$clinicas      = $_REQUEST["clinicas"];

echo $nome;
echo $cpf;

?>