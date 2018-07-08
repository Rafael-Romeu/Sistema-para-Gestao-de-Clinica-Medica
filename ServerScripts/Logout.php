<?php

    session_start();

    $_SESSION = array();
    session_destroy();
    header('location: /Paginas/Login.php');

    exit;

?>

