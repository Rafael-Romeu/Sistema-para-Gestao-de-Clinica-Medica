<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lConsulta.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";
    
    $codClinica = $_REQUEST["codClinica"];
    
    $medico = new lMedico();
    $medico->limpaFiltros();
    $medicos = $medico->executeSelect();

    $result = [];
    foreach ($medicos as $m)
    {
        $nome = utf8_encode($m["nome"]);
        $cod =  utf8_encode($m["codigo"]);
        
        $medico = new lMedico();
        $medico->setCodigo($cod);
        $medico->identifica();
        
        
        if (!medicoEstaNaClinica($medico, $codClinica))
        {
            $listaEsp = $medico->listaEspecialidades();
    
            $esp = "";
            foreach($listaEsp as $e)
            {
                $esp .= utf8_encode($e["nome"]) . ", ";
            }
            $esp=rtrim($esp,", ");
    
            $new = new temp($nome, $cod, $esp);
            array_push($result, $new);
        }
    }



    echo json_encode($result);

    class temp
    {
        public function __construct($n, $c, $e)
        {
            $this->nome = $n;
            $this->cod = $c;
            $this->esp = $e;
        }
        public $nome;
        public $cod;
        public $esp;
    }

    function medicoEstaNaClinica($medico, $codClinica)
    {
        $listaClinicas = $medico->listaClinicas();

        foreach($listaClinicas as $c)
        {
            if ($c["codClinica"] == $codClinica)
                return true;
        }
        return false;
    }
?> 