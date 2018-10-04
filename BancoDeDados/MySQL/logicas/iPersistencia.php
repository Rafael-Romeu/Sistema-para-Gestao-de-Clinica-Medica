<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

interface iPersistencia{
    public function DBConnect();
    public function DBDisconnect();
    // public function incluir();
    public function alterar();
    // public function excluir();
    public function identifica();
}

?>