
<!DOCTYPE html>
<html>

<head> 
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
            <a class="cadastro-tipo-widget__option cadastro-tipo-widget__option--selected card" href="CadastroClínica.php"> Cadastrar Clínica </a>
        </div>
        
        <div class="cadastro-info">
            <div class="cadastro-column-left">
                <div class="cadastro-widget">

                <h2>Dados da Clínica</h2>
                <div class="card" id="dadosPessoais">
                    <form action="">
                        <b>Nome:</b>
                        <br>
                        <input type="text" id="nome"><br>
                        <br>

                        <b>CNPJ:</b>
                        <br>
                        <input type="text" id="cnpj"><br>
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

            
        </div>
        
        </div>

        <div class="centro">
        <div class="cadastro-widget">
                <h2>Cores</h2>
                <div class="card" name="cores">
                
                <form action="" id="cores">
                
                    <b>Cor Primária:</b>
                    <br>
                        <input type="color" name="corPrimaria" id="corPrimaria">
                    <br><br>

                    <b>Cor Sucesso:</b>
                    <br>
                        <input type="color" name="corSucesso" id="corSucesso">
                    <br><br>

                    <b>Cor Falha:</b>
                    <br>
                        <input type="color" name="corFalha" id="corFalha">
                    <br><br>

                    <b>Cor 1:</b>
                    <br>
                        <input type="color" name="cor1" id="cor1">
                    <br><br>

                    <b>Cor 2:</b>
                    <br>
                        <input type="color" name="cor2" id="cor2">
                    <br><br>

                    <b>Cor 3:</b>
                    <br>
                        <input type="color" name="cor3" id="cor3">
                    <br><br>

                    <b>Cor 4:</b>
                    <br>
                        <input type="color" name="cor4" id="cor4">
                    <br><br>

                    <b>Cor 5:</b>
                    <br>
                        <input type="color" name="cor5" id="cor5">
                    <br><br>

                    
                </form>  
                
                </div>
            </div>
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

    function salvaBanco() 
    {
        var nome     = document.getElementById("nome").value;
        var cnpj      = document.getElementById("cnpj").value;
        var CEP      = document.getElementById("CEP").value;
        var endereco = document.getElementById("endereco").value;
        var senha    = document.getElementById("senha").value;

        var email     = document.getElementById("email").value;
        var telefone1  = document.getElementById("telefone1").value;
        var telefone2 = document.getElementById("telefone2").value;

        var corPrimaria = document.getElementById("corPrimaria").value.substring(1);
        var corSucesso =  document.getElementById("corSucesso").value.substring(1);
        var corFalha =    document.getElementById("corFalha").value.substring(1);
        var cor1 =        document.getElementById("cor1").value.substring(1);
        var cor2 =        document.getElementById("cor2").value.substring(1);
        var cor3 =        document.getElementById("cor3").value.substring(1);
        var cor4 =        document.getElementById("cor4").value.substring(1);
        var cor5 =        document.getElementById("cor5").value.substring(1);

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
        

        envio = "nome=" + nome + "&cnpj=" + cnpj + "&CEP=" + CEP
        + "&endereco=" + endereco + "&senha=" + senha + "&email=" + email + "&telefone1=" + telefone1
        + "&telefone2=" + telefone2 + "&corPrimaria=" + corPrimaria + "&corSucesso=" + corSucesso + "&corFalha=" + corFalha + "&cor1=" + cor1 + "&cor2=" + cor2 + "&cor3=" + cor3 + "&cor4=" + cor4 + "&cor5=" + cor5;

        console.log(envio);

        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/salvaNovaClinica.php?" + envio, true);
        xmlhttp.send();
    }
</script>

</html>
