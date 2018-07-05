<?php

    session_start();

    if(!isset($_SESSION['cpf']) || empty($_SESSION['cpf'])){
        header("location: Login.php");
        exit;
    }
    if($_SESSION['tipo'] != "lMedico"){
        shell_exec('php serverScripts/Logout.php');
        header("location: Login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="css/Home.css">
    <title> Medico </title> <!-- Titulo da pagina --> 
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
    <div class = "barra">
        <div class="Identificacao">
            Olá, <?php echo htmlspecialchars($_SESSION['nome']);?>.
        </div>
        <nav>
            <button id = "Consultas" onclick="CarregaConsultas()"> Consultas </button>
            <button id = "Agendamentos"> Agendamentos </button>
        
            <button id = "Logout" onclick="Logout()"> Logout </button>
        </nav>
    </div>
    
    <div class="Corpo">
        <!-- Medico --> 
        <div class = "Medico">
            <div class = "Consultas">
                <h3 class="Forms" >Consultas</h3>
                <div class="popup">
                    <span class="popuptext" id="myPopup">
                    </span>
                </div>
                <table id="Tabela" >
                </table>
            </div>
            <div class = "Agendamentos">
                <h3 class="Forms">Agendamentos</h3>

                <label class="Forms"for="date">Dia: </label>
                <input type="date" name="date" id="AgendamentosDia" onchange="CarregaAgendamentos()">
                <div class="Forms">
                <table id="TabelaAgendamentos" >
                </table>
                </div>
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

    $(document).ready(function(){
            $(".Consultas, .Agendamentos").hide();
    });
    //-----Medico 
    $(document).ready(function(){
        $("#Consultas").click(function(){
            $(".Consultas").show();
            $(".Agendamentos").hide();
        });
        $("#Agendamentos").click(function(){
            $(".Consultas").hide();
            $(".Agendamentos").show();
        });
    });

    function Logout() {
        window.location.replace("<?php $_SERVER['DOCUMENT_ROOT']?>/serverScripts/Logout.php");
    }

    function CarregaConsultas() {
        var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";
        var medico = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Tabela").innerHTML = this.responseText;
            }
        };

        envio = "Codigo=" + codigo + "&medico=" + medico;
        
        console.log(envio);
        xmlhttp.open("GET", "serverScripts/CarregaConsulta.php?" + envio, true);
        xmlhttp.send();
    }
    function ShowPopup(consultaCodigo) {
        
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");

        var consultaCodigo = consultaCodigo.id;

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("myPopup").innerHTML = this.responseText;
            }
        };

        envio = "Codigo=" + consultaCodigo;
        
        console.log(consultaCodigo);
        xmlhttp.open("GET", "serverScripts/ShowPopup.php?" + envio, true);
        xmlhttp.send();
    }
    function EditaConsulta(consultaCodigo) {
        var novaReceita = document.getElementById("novaReceita").value;
        var novaObservacao = document.getElementById("novaObservacao").value;
        var consultaCodigo = consultaCodigo.id;

        
        var envio = "consultaCodigo=" + consultaCodigo + "&receita=" + novaReceita + "&observacao=" + novaObservacao;
        
        console.log(envio);

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("retorno").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "serverScripts/EditaConsulta.php?"+envio, true);
        xmlhttp.send();
    }
    function CarregaAgendamentos() {
        var dia = document.getElementById("AgendamentosDia").value;
        var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("TabelaAgendamentos").innerHTML = this.responseText;
            }
        };

        envio = "dia=" + dia + "&medico=" + codigo;
        
        console.log(envio);
        xmlhttp.open("GET", "serverScripts/CarregaAgendamentos.php?" + envio, true);
        xmlhttp.send();
    }
    

</script>


</html>