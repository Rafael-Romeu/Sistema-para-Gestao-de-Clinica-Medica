<?php

    session_start();

    if(!isset($_SESSION['cpf']) || empty($_SESSION['cpf'])){
        header("location: Login.php");
    exit;
    }

?>


<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="css/Home.css">
    <title> Paciente </title> <!-- Titulo da pagina --> 
    <meta charset = "UTF-8">
</head>


<body>
    
    <div class="Background">
       <img src = "Imagens/Medica-Transparencia.png">
    </div>
    
    <header>
        <!-- Header --> 
        <img src="Imagens/Capa/Logo.png" style="flex-shrink: 0">
        <img src="Imagens/Capa/Linha.png" style="flex-grow: 1; min-width: 0px">
        <img src="Imagens/Capa/Detalhe.png" style="flex-shrink: 0;">
    </header>
    
    
    <!-- Menu de navegação --> 
    <nav>
        <div class = "Paciente">
            <button id = "VisualizarConsulta"      class="Botao-Menu"> Visualizar Consulta </button>
        </div>
    </nav>
    
    <div class="Corpo">
        <!-- Paciente --> 
        <div class = "Paciente">

            <div class = "VisualizarConsulta">
                <h3> Visualizar Consulta</h3>
            </div>

        </div>

    </div>


    <!-- rodape -->
    <footer> 
        <h4>Unidades</h4> 
        <h5> -> Rio Grande do Sul - Rio Grande FURG</h5>
        <br>
        <h4>Siga-nos</h4> 
        <img src="Imagens/redesSociais.png" alt="">
        <br>
        <h4>Certificações</h4>
        <img src = "Imagens/certificados.png" alt="">
        <hr>
        <h6 style="text-align: right">&copy; 2018 Clínica Vida Saudável. Todos os Direitos Reservados</h6>     
    </footer>
    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script>
    //-----Paciente 
        $(document).ready(function(){
            $(".VisualizarConsulta, .AgendarConsultaPaciente").hide();

            $("#VisualizarConsulta").click(function(){
                $(".AgendarConsultaPaciente").hide();
                $(".VisualizarConsulta").show();
            });
            $("#AgendarConsultaPaciente").click(function(){
                $(".AgendarConsultaPaciente").show();
                $(".VisualizarConsulta").hide();
            });
        });

</script>


</html>