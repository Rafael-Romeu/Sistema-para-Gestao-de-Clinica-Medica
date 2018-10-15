<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
        
    $clinica = new lClinica();
    $clinica->limpaFiltros();
    $clinicas = $clinica->executeSelect();

    $result = [];
    foreach ($clinicas as $c)
    {
        $nome = utf8_encode($c["nome"]);
        $cod =  utf8_encode($c["codigo"]);

        $new = new temp($nome, $cod);
        array_push($result, $new);
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