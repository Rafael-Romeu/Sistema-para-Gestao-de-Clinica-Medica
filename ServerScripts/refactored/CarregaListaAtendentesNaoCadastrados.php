<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    
    $clinica = new lClinica();
    $codClinica = $_REQUEST["codClinica"];
    
    $clinica -> setCodigo($codClinica);

    $clinica -> identifica();

    $atendentes = $clinica->listaAtendentes();


    $result = [];
    foreach ($atendentes as $a)
    {
        $nome = utf8_encode($a["nome"]);
        $cod =  utf8_encode($a["codigo"]);

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