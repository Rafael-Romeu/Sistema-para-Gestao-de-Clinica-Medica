<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    
    $clinica = new lClinica();
    $codClinica = $_REQUEST["codigo"];
    
    $clinica -> setCodigo($codClinica);

    $clinica -> identifica();

    $medicos = $clinica->listaMedicos();

    $result = [];
    foreach ($medicos as $m)
    {
        $nome = utf8_encode($m["nome"]);
        $cpf =  utf8_encode($m["cpf"]);
        $medico = new lMedico();
        $medico->setCpf($cpf);
        $medico->identifica();
        $listaEsp = $medico->listaEspecialidades();

        $esp = "";
        foreach($listaEsp as $e)
        {
            $esp .= utf8_encode($e["nome"]) . ", ";
        }
        $esp=rtrim($esp,", ");

        $new = new temp($nome, $cpf, $esp);
        array_push($result, $new);
    }



    echo json_encode($result);

    class temp
    {
        public function __construct($n, $c, $e)
        {
            $this->nome = $n;
            $this->cpf = $c;
            $this->esp = $e;
        }
        public $nome;
        public $cpf;
        public $esp;
    }
?> 