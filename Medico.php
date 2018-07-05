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

            <button id = "AlterarCadastro"> Alterar Cadastro </button>
        
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

            <div class = "AlterarCadastro">

                <h3 class = "Forms">Alterar Cadastro</h3>
               
                <form>
                    <label class = "Forms" for="name">Nome: </label>
                    <input type="text" id="CadMedName" name="name" value="<?php echo htmlspecialchars($_SESSION['nome']);?>" required>

                    <label class = "Forms" for="Cpf">Cpf: </label>
                    <input type="text" id="CadMedCpf" name="Cpf" value="<?php echo htmlspecialchars($_SESSION['cpf']);?>" required>

                    <label class = "Forms" for="DataNascimento">Data de Nascimento: </label>
                    <input type="date" id="CadMedDataNascimento" name="DataNascimento" value="<?php echo htmlspecialchars($_SESSION['dtNascimento']);?>" required>

                    <label class = "Forms" for="Endereco">Endereço: </label>
                    <input type="text" id="CadMedEndereco" name="Endereco" value="<?php echo htmlspecialchars($_SESSION['endereco']);?>">

                    <label class = "Forms" for="Email">Email: </label>
                    <input type="email" id="CadMedEmail" name="Email" value="<?php echo htmlspecialchars($_SESSION['email']);?>">

                    <label class = "Forms" for="Telefone">Telefone: </label>
                    <input type="text" id="CadMedTel" name="Telefone" value="<?php echo htmlspecialchars($_SESSION['telefone']);?>">

                    <label class = "Forms" for="Especialidade">Especialidade: </label>
                    <input type="text" id="CadMedEspecialidade" name="Especialidade" value= "<?php echo htmlspecialchars($_SESSION['especialidade']);?>">

                    <label class = "Forms" for="PlanoDeSaude">Plano de Saude: </label>
                    <input type="text" id="CadMedPlanoDeSaude" name="PlanoDeSaude" value="<?php echo htmlspecialchars($_SESSION['planoDeSaude']);?>">
                
                    <label class = "Forms" for="passwordAntiga">Senha Atual: </label>
                    <input type="password" id="CadMedPasswordAntiga" name="passwordAntiga" required>

                    <label class = "Forms" for="passwordNova">Senha Nova: </label>
                    <input type="password" id="CadMedPasswordNova" name="passwordNova" placeholder="Deixe em branco para não alterar">
                </form>

                <input type="submit" value="Enviar" onclick="AlterarCadastro()">

                <div id="CadMedResultado"></div>
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
            $(".Consultas, .Agendamentos, .AlterarCadastro").hide();
    });
    //-----Medico 
    $(document).ready(function(){
        $("#Consultas").click(function(){
            $(".Consultas").show();
            $(".Agendamentos").hide();
            $(".AlterarCadastro").hide();
        });
        $("#Agendamentos").click(function(){
            $(".Consultas").hide();
            $(".Agendamentos").show();
            $(".AlterarCadastro").hide();
        });
        $("#AlterarCadastro").click(function(){
            $(".Consultas").hide();
            $(".Agendamentos").hide();
            $(".AlterarCadastro").show();
        });
    });

    function Logout() {
        window.location.replace("<?php $_SERVER['DOCUMENT_ROOT']?>/serverScripts/Logout.php");
    }

    function AlterarCadastro(){
        var variaveis = {"name" : document.getElementById("CadMedName").value,
                         "cpf"  : document.getElementById("CadMedCpf").value,
                         "senhaNova" : document.getElementById("CadMedPasswordNova").value,
                         "senhaAntiga" : document.getElementById("CadMedPasswordAntiga").value,
                         "endereco" : document.getElementById("CadMedEndereco").value,
                         "email" : document.getElementById("CadMedEmail").value,
                         "nascimento" : document.getElementById("CadMedDataNascimento").value,
                         "plano" : document.getElementById("CadMedPlanoDeSaude").value,
                         "especialidade" : document.getElementById("CadMedEspecialidade").value,
                         "telefone" : document.getElementById("CadMedTel").value,
                         "codigo" : "<?php echo htmlspecialchars($_SESSION["codigo"]); ?>"};
                

        var envio = "";

        for (var variavel in variaveis){
            envio += variavel + "=" + variaveis[variavel] + "&";
        }
        console.log(envio);
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("CadMedResultado").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "serverScripts/AlteraCadastroMedico.php?" + envio, true);
        xmlhttp.send();  
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