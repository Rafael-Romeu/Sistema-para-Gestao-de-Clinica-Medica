<?php
    session_start();

    if(!isset($_SESSION['cpf']) || empty($_SESSION['cpf'])){
        header("location: Login.php");
        exit;
    }
    if($_SESSION['tipo'] != "lPaciente"){
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
    <title> Paciente </title> <!-- Titulo da pagina --> 
    <meta charset = "UTF-8">
</head>


<body onload="getGenero()">
    
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
            <button id = "VisualizarConsulta" onclick="CarregaConsultas()"> Visualizar Consulta </button>
            
            <button id = "AlterarCadastro"> Alterar Cadastro </button>

            <button id = "Logout" onclick="Logout()"> Logout </button>
        </nav>
    </div>
    
    <div class="Corpo">
        <!-- Paciente --> 
        <div class = "Paciente">

            <div class = "VisualizarConsulta">
                <h3 class="Forms"> Visualizar Consulta</h3>
                <div class="Forms">
                    <table id="Tabela" >
                    </table>
                </div>
            </div>

            <div class = "AlterarCadastro">

                <h3 class = "Forms">Alterar Cadastro</h3>
               
                <form>
                    <label class = "Forms" for="name">Nome: </label>
                    <input type="text" id="CadPacName" name="name" value="<?php echo htmlspecialchars($_SESSION['nome']);?>" required>

                    <label class = "Forms" for="Cpf">Cpf: </label>
                    <input type="text" id="CadPacCpf" name="Cpf" value="<?php echo htmlspecialchars($_SESSION['cpf']);?>" required>

                    
                    <label class = "Forms" for="DataNascimento">Data de Nascimento: </label>
                    <input type="date" id="CadPacDataNascimento" name="DataNascimento" value="<?php echo htmlspecialchars($_SESSION['dtNascimento']);?>" required>

                    <label class = "Forms" for="gender">Gênero: </label><br>

                    <ul id="FormGeneros" class="Generos" style = "margin: 0px 0px 0px 20px" onewS>
                    </ul>

                    <br>
                    <br>

                    <label class = "Forms" for="Endereco">Endereço: </label>
                    <input type="text" id="CadPacEndereco" name="Endereco" value="<?php echo htmlspecialchars($_SESSION['endereco']);?>">

                    <label class = "Forms" for="Email">Email: </label>
                    <input type="email" id="CadPacEmail" name="Email" value="<?php echo htmlspecialchars($_SESSION['email']);?>">

                    <label class = "Forms" for="Telefone">Telefone: </label>
                    <input type="text" id="CadPacTel" name="Telefone" value="<?php echo htmlspecialchars($_SESSION['telefone']);?>">

                    <label class = "Forms" for="TipoSanguineo">Tipo Sanguineo: </label>
                    <input type="text" id="CadPacTipoSanguineo" name="TipoSanguineo" value= "<?php echo htmlspecialchars($_SESSION['tipoSanguineo']);?>">

                    <label class = "Forms" for="PlanoDeSaude">Plano de Saude: </label>
                    <input type="text" id="CadPacPlanoDeSaude" name="PlanoDeSaude" value="<?php echo htmlspecialchars($_SESSION['planoDeSaude']);?>">
                
                    <label class = "Forms" for="passwordAntiga">Senha Antiga: </label>
                    <input type="password" id="CadPacPasswordAntiga" name="passwordAntiga" required>

                    <label class = "Forms" for="passwordNova">Senha Nova: </label>
                    <input type="password" id="CadPacPasswordNova" name="passwordNova" placeholder="Deixe em branco para não alterar">
                </form>

                <input type="submit" value="Enviar" onclick="AlterarCadastro()">

                <div id="CadPacResultado"></div>
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
        $(".VisualizarConsulta, .AlterarCadastro").hide();

        $("#VisualizarConsulta").click(function(){
            $(".AlterarCadastro").hide();
            $(".VisualizarConsulta").show();
        });

        $("#AlterarCadastro").click(function(){
            $(".AlterarCadastro").show();
            $(".VisualizarConsulta").hide();
        });
    });

    function Logout() {
        window.location.replace("<?php $_SERVER['DOCUMENT_ROOT']?>/serverScripts/Logout.php");
    }

    function getGenero() {
        var genero = "<?php echo htmlspecialchars($_SESSION['genero']);?>";
        
        if (genero == "M")
        {
            var opcoes = `<li class="Genero Homem">
                          <input name="CadPacGenero" type="radio" id="CadPacHomem" checked>
                          <label for="CadPacHomem">Homem</label> 
                        </li>
                          
                        <li class="Genero Mulher">
                          <input name="CadPacGenero" type="radio" id="CadPacMulher">
                          <label for="CadPacMulher">Mulher</label>
                        </li>
                          
                        <li class="Genero Outro">
                          <input name="CadPacGenero" type="radio" id="CadPacOutro">
                          <label for="CadPacOutro">Outro</label>
                        </li>`;
        }
        else if (genero == "F")
        {
            var opcoes = `<li class="Genero Homem">
                          <input name="CadPacGenero" type="radio" id="CadPacHomem">
                          <label for="CadPacHomem">Homem</label> 
                        </li>
                          
                        <li class="Genero Mulher">
                          <input name="CadPacGenero" type="radio" id="CadPacMulher" checked>
                          <label for="CadPacMulher">Mulher</label>
                        </li>
                          
                        <li class="Genero Outro">
                          <input name="CadPacGenero" type="radio" id="CadPacOutro">
                          <label for="CadPacOutro">Outro</label>
                        </li>`;
        }
        else
        {
            var opcoes = `<li class="Genero Homem">
                          <input name="CadPacGenero" type="radio" id="CadPacHomem">
                          <label for="CadPacHomem">Homem</label> 
                        </li>
                          
                        <li class="Genero Mulher">
                          <input name="CadPacGenero" type="radio" id="CadPacMulher" >
                          <label for="CadPacMulher">Mulher</label>
                        </li>
                          
                        <li class="Genero Outro">
                          <input name="CadPacGenero" type="radio" id="CadPacOutro" checked>
                          <label for="CadPacOutro">Outro</label>
                        </li>`;
        }

        document.getElementById("FormGeneros").innerHTML = opcoes;

    }

    function AlterarCadastro(){
        var variaveis = {"name" : document.getElementById("CadPacName").value,
                         "cpf"  : document.getElementById("CadPacCpf").value,
                         "senhaNova" : document.getElementById("CadPacPasswordNova").value,
                         "senhaAntiga" : document.getElementById("CadPacPasswordAntiga").value,
                         "endereco" : document.getElementById("CadPacEndereco").value,
                         "email" : document.getElementById("CadPacEmail").value,
                         "nascimento" : document.getElementById("CadPacDataNascimento").value,
                         "plano" : document.getElementById("CadPacPlanoDeSaude").value,
                         "sangue" : document.getElementById("CadPacTipoSanguineo").value,
                         "telefone" : document.getElementById("CadPacTel").value,
                         "codigo" : "<?php echo htmlspecialchars($_SESSION["codigo"]); ?>"};
        

        var generos = document.getElementsByName("CadPacGenero");
        
        for(var index in generos){

            if (generos[index].checked){
                
                if (generos[index].id == "CadPacOutro"){
                    variaveis["genero"] = "O";

                }
                else if (generos[index].id == "CadPacHomem"){
                    variaveis["genero"] = "M";

                }
                else if (generos[index].id == "CadPacMulher"){
                    variaveis["genero"] = "F";

                }
                
            }
        }
            

        var envio = "";

        for (var variavel in variaveis){
            envio += variavel + "=" + variaveis[variavel] + "&";
        }

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("CadPacResultado").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "serverScripts/AlteraCadastroPaciente.php?" + envio, true);
        xmlhttp.send();  
    }
    function CarregaConsultas() {
        var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Tabela").innerHTML = this.responseText;
            }
        };

        envio = "Codigo=" + codigo + "&medico=" + "Any";
        
        console.log(envio);
        xmlhttp.open("GET", "serverScripts/CarregaConsulta.php?" + envio, true);
        xmlhttp.send();
    }

</script>


</html>