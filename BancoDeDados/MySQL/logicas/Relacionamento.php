<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once "Persistencia.php";

class Relacionamento extends Persistencia
{
    private $codTabela1;
    private $codTabela2;

    public function __construct()
    {
        parent::__construct();
    }

    

    
}
