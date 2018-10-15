<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    
    $codClinica = $_REQUEST["codClinica"];
    
    $atendente = new lAtendente();
    $atendente->limpaFiltros();
    $atendentes = $atendente->executeSelect();

    $result = [];
    foreach ($atendentes as $a)
    {
        $nome = utf8_encode($a["nome"]);
        $cod =  utf8_encode($a["codigo"]);

        $atendente = new lAtendente();
        $atendente->setCodigo($cod);
        $atendente->identifica();

        $clinicas = $atendente->getCodClinica();

        if(!in_array($codClinica, $clinicas))
        {
            $new = new temp($nome, $cod);
            array_push($result, $new);
        }
    }

    echo json_encode($result);

    class temp
    {
        public function __construct($n, $c)
        {
            $this->nome = $n;
            $this->cod = $c;
        }
        public $nome;
        public $cod;
    }
?> 