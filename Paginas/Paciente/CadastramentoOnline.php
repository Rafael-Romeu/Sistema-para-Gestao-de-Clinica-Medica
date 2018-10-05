<?php
    session_start();

    /*if(!isset($_SESSION['cpf']) || empty($_SESSION['cpf'])){
        header("location: /Paginas/Login.php");
        exit;
    }
    if($_SESSION['tipo'] != "lPaciente"){
        shell_exec('php ' . $_SERVER['DOCUMENT_ROOT'] . '/ServerScripts/Logout.php');
        header('location: /Paginas/Login.php');
        exit;
    }*/
?>

<!DOCTYPE html>
<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Fira Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="../css/CadastramentoOnline.css">
  <!--<link rel="stylesheet" href="../css/Paciente.css">-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="../js/scripts.js"></script>

  <title>Paciente</title>
  <meta charset = "UTF-8">
</head>


<body onload="inicializa()">

<p id="paa">asdasd</p>
    
  <div class="main-body perfil-body">
    <h1 class="perfil-header">Cadastro</h1>

    <span class="perfil-edit">
      <img class="svg" src="../img/common/icons/pencil.svg">
    </span>
    
    <div class="perfil-info">
      <div class="perfil-column-left">
        <div class="perfil-widget">

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

                <b>G?nero:</b>
                <br>
                <input type="text" id="genero"><br>
                <br>
                
                <b>CEP:</b>
                <br>
                <input type="text" id="CEP"><br>
                <br>

                <b>Endere?o:</b>
                <br>
                <input type="text" id="endereco"><br>
                <br>

                <b>Cl?nicas:</b>
                <br>
                <div id="clinicas">

                </div>
                <br>

                <b>Defina a Senha:</b>
                <br>
                <input type="password" id="senha"><br>
                <br>

            </form>
          </div>

            
        </div>
          
      </div>

      <div class="perfil-column-right">
        <div class="perfil-widget">
          <h2>Contato</h2>
          <div class="card" id="contato">
            <form action="">  
            
                <b>Email:</b>
                <br>
                <input type="text" id="email"><br>
                <br>
                <b>Telefone:</b>
                <br>
                <input type="text" id="telefone1"><br>
                <br>
                <b>Telefone:</b>
                <br>
                <input type="text" id="telefone2"><br>
                <br>
            
            </form>
          </div>
        </div>
        <div class="perfil-widget">
          <h2>Dados M?dicos</h2>
          <div class="card" name="dadosMedicos">
            
            <form action="" id="dadosMedicos">
            
                <b>Plano de Sa?de:</b>
                <br>
                
                    <select id="PlanoDeSaude" class="select">
                        <option value="Platinum">Platinum</option>
                        <option value="Executive">Executive</option>
                        <option value="Master">Master</option>
                        <option value="Standard">Standard</option>
                    </select> 
                
                <br><br>

                <b>Tipo Sangu?neo:</b>
                <br>
                    <form id="tipoSanguineoRadio">
                        <label class="container"> O+
                            <input type="radio" name="sangue" value="O+" >
                            <span class="checkmark"> </span> 
                        </label>
                        <label class="container"> A+
                            <input type="radio" name="sangue" value="A+" >
                            <span class="checkmark"></span> 
                        </label>
                        <label class="container"> B+ 
                            <input type="radio" name="sangue" value="B+" >
                            <span class="checkmark"></span> 
                        </label>
                        <label class="container"> AB+
                            <input type="radio" name="sangue" value="AB+" >
                            <span class="checkmark"></span> 
                        </label>
                        <label class="container"> O-
                            <input type="radio" name="sangue" value="O-" >
                            <span class="checkmark"> </span> 
                        </label>
                        <label class="container"> A-
                            <input type="radio" name="sangue" value="A-" >
                            <span class="checkmark"> </span> 
                        </label>
                        <label class="container"> B-
                            <input type="radio" name="sangue" value="B-" >
                            <span class="checkmark"> </span>
                        </label>
                        <label class="container"> AB-
                            <input type="radio" name="sangue" value="AB-" checked>
                            <span class="checkmark"></span>
                        </label>
                    </form>
                <br>
                
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
        CarregaClinicas();
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
        var genero   = document.getElementById("genero").value;
        var CEP      = document.getElementById("CEP").value;
        var endereco = document.getElementById("endereco").value;
        var senha    = document.getElementById("senha").value;

        var email     = document.getElementById("email").value;
        var telefone1  = document.getElementById("telefone1").value;
        var telefone2 = document.getElementById("telefone2").value;
        
        var selector = document.getElementById('PlanoDeSaude');
        var planoDeSaude = selector[selector.selectedIndex].value;

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

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("paa").innerHTML = this.responseText;
            }
        };
        
        console.log(clinicas);

        envio = "nome=" + nome + "&cpf=" + cpf + "&bday=" + bday + "&genero=" + genero + "&CEP=" + CEP
        + "&endereco=" + endereco + "&senha=" + senha + "&email=" + email + "&telefone1=" + telefone1
        + "&telefone2=" + telefone2 + "&planoDeSaude=" + planoDeSaude + "&tipoSanguineo=" + tipoSanguineo
        + "&clinicas=" + clinicas ;

        console.log(envio);

        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/salvaNovoPaciente.php?" + envio, true);
        xmlhttp.send();
    }
</script>

</html>
