
<!DOCTYPE html>
<html>

<head>   <style>   :root {      /* COLORS */     --primary: <?php echo htmlspecialchars($_SESSION['corPrimaria']); ?>;      --success: <?php echo htmlspecialchars($_SESSION['corSucesso']); ?>;     --failure: <?php echo htmlspecialchars($_SESSION['corFalha']); ?>;      --color-1: <?php echo htmlspecialchars($_SESSION['cor1']); ?>;     --color-2: <?php echo htmlspecialchars($_SESSION['cor2']); ?>;     --color-3: <?php echo htmlspecialchars($_SESSION['cor3']); ?>;     --color-4: <?php echo htmlspecialchars($_SESSION['cor4']); ?>;     --color-5: <?php echo htmlspecialchars($_SESSION['cor5']); ?>;   }        </style>
  <link href="https://fonts.googleapis.com/css?family=Fira Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="../css/CadastramentoOnline.css">
  <!--<link rel="stylesheet" href="../css/Paciente.css">-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="../js/scripts.js"></script>

  <title>Cadastro</title>
  <meta charset = "UTF-8">
</head>


<body onload="inicializa()">

    <h1 class="cadastro-header">Cadastro</h1>

    
    <div class="main-body cadastro-body">
    
        <div class="cadastro-tipo">
            <a class="cadastro-tipo-widget__option card" href="CadastroPaciente.php"> Cadastrar Paciente </a>
            <a class="cadastro-tipo-widget__option cadastro-tipo-widget__option--selected card" href="CadastroMedico.php"> Cadastrar Médico </a>
            <a class="cadastro-tipo-widget__option card" href="CadastroAtendente.php"> Cadastrar Atendente </a>
        </div>
        
        <div class="cadastro-info">
        <div class="cadastro-column-left">
            <div class="cadastro-widget">

            <h2>Dados Pessoais</h2>
            <div class="card" id="dadosPessoais">
                <form action="">
                    <b>Nome:</b>
                    <br>
                    <input type="text" id="nome"><br>
                    <br>

                    <b>CPF:</b>
                    <br>
                    <input type="text" id="cpf"><br>
                    <br>

                    <b>Data de Nascimento:</b>
                    <br>
                    <input type="date" id="bday" max="3000-12-31"><br>
                    <br>

                    
                    <b>CEP:</b>
                    <br>
                    <input type="text" id="CEP"><br>
                    <br>

                    <b>Endereço:</b>
                    <br>
                    <input type="text" id="endereco"><br>
                    <br>

                    <b>Defina a Senha:</b>
                    <br>
                    <input type="password" id="senha"><br>
                    <br>

                </form>
            </div>

                
            </div>
            
        </div>

        <div class="cadastro-column-right">
            <div class="cadastro-widget">
                <h2>Contato</h2>
                <div class="card" id="contato">
                    <form action="">  
                    
                        <b>Email:</b>
                        <br>
                        <input type="text" id="email"><br>
                        <br>
                        <b>Telefone 1:</b>
                        <br>
                        <input type="text" id="telefone1"><br>
                        <br>
                        <b>Telefone 2:</b>
                        <br>
                        <input type="text" id="telefone2"><br>
                        <br>
                    
                    </form>
                </div>
            </div>
            
            <div class="cadastro-widget">
                <h2>Dados Médicos</h2>
                <div class="card" name="dadosMedicos">
                
                <form action="" id="dadosMedicos">
                
                    <b>Plano de Saúde:</b>
                    <br>
                    
                        <select id="PlanoDeSaude" class="select">
                            <option value="Platinum">Platinum</option>
                            <option value="Executive">Executive</option>
                            <option value="Master">Master</option>
                            <option value="Standard">Standard</option>
                        </select> 
                    
                    <br><br>
                    
                </form>  
                
                </div>
            </div>
            
        </div>
        
        </div>

        <div class="centro">
            <input type="button" value="Submit" onclick="salvaBanco()"><br>
        </div>
    </div>
        
</body>

<script>
    function inicializa()
    {
        SvgInliner();
        //CarregaClinicas();
    }
    function CarregaClinicas() 
    {
        console.log("envio");
        //var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("clinicas").innerHTML = this.responseText;
            }
        };
        
        //codigo = "1";
        //envio = "codigo=" + codigo + "&tipoDeDadosASerCarregados=" + "dadosPessoais";

        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaClinicasCadastramento.php?", true);
        xmlhttp.send();
    }
    function salvaBanco() 
    {
        var nome     = document.getElementById("nome").value;
        var cpf      = document.getElementById("cpf").value;
        var bday     = document.getElementById("bday").value;
        var CEP      = document.getElementById("CEP").value;
        var endereco = document.getElementById("endereco").value;
        var senha    = document.getElementById("senha").value;

        var email     = document.getElementById("email").value;
        var telefone1  = document.getElementById("telefone1").value;
        var telefone2 = document.getElementById("telefone2").value;
        
        var selector = document.getElementById('PlanoDeSaude');
        var planoDeSaude = selector[selector.selectedIndex].value;
/*
        var rates = document.getElementsByName("sangue");
        var tipoSanguineo;
        for(var i = 0; i < rates.length; i++){
            if(rates[i].checked){
                tipoSanguineo = rates[i].value;
            }
        }
        
        var clinicasAux = document.getElementsByName("clinicas");
        var clinicas = "";
        for(var i = 0; i < clinicasAux.length; i++){
            if(clinicasAux[i].checked){
                clinicas = clinicas + clinicasAux[i].value;
            }
        }
        */
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "1")
                {
                    alert("Cadastrado com sucesso!");
                    window.location.replace("/Paginas/Login.php"); 
                }
            }
        };
        

        envio = "nome=" + nome + "&cpf=" + cpf + "&bday=" + bday + "&CEP=" + CEP
        + "&endereco=" + endereco + "&senha=" + senha + "&email=" + email + "&telefone1=" + telefone1
        + "&telefone2=" + telefone2 + "&planoDeSaude=" + planoDeSaude;

        console.log(envio);

        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/salvaNovoMedico.php?" + envio, true);
        xmlhttp.send();
    }
</script>

</html>
