<?php
    session_start();

    if(!isset($_SESSION['cpf']) || empty($_SESSION['cpf'])){
        header("location: /Paginas/Login.php");
        exit;
    }
    if($_SESSION['tipo'] != "lPaciente"){
        shell_exec('php ' . $_SERVER['DOCUMENT_ROOT'] . '/ServerScripts/Logout.php');
        header('location: /Paginas/Login.php');
        exit;
    }
?>

<!DOCTYPE html>
<html>

<head>   <style>   :root {      /* COLORS */     --primary: <?php echo htmlspecialchars($_SESSION['corPrimaria']); ?>;      --success: <?php echo htmlspecialchars($_SESSION['corSucesso']); ?>;     --failure: <?php echo htmlspecialchars($_SESSION['corFalha']); ?>;      --color-1: <?php echo htmlspecialchars($_SESSION['cor1']); ?>;     --color-2: <?php echo htmlspecialchars($_SESSION['cor2']); ?>;     --color-3: <?php echo htmlspecialchars($_SESSION['cor3']); ?>;     --color-4: <?php echo htmlspecialchars($_SESSION['cor4']); ?>;     --color-5: <?php echo htmlspecialchars($_SESSION['cor5']); ?>;   }        </style>
  <link href="https://fonts.googleapis.com/css?family=Fira Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="../css/Base.css">
  <link rel="stylesheet" href="../css/Paciente.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="../js/scripts.js"></script>

  <title>Paciente</title>
  <meta charset = "UTF-8">
</head>


<body onload="inicializa()">
  <header class="main-header">
    <div class="main-header__top-bar">
      <h1 class="main-header__logo"><?php echo htmlspecialchars($_SESSION['nomeClinica']); ?></h1>
      <div class="main-header__user">
        <span class="main-header__username" id="headerUserNome"><?php echo htmlspecialchars($_SESSION['nome']); ?></span>
        <a class="main-header__logout-btn" href="#" onclick="Logout();">Logout</a>
      </div>
    </div>

    <nav class="main-header__nav-bar">

      <a class="main-header__nav-btn" href="Home.php">
        <img class="main-header__nav-icon svg" src="../img/common/icons/home.svg">
        Home
      </a>

      <a class="main-header__nav-btn" href="Marcar.php">
        <img class="main-header__nav-icon svg" src="/Paginas/img/common/icons/calendar.svg">
        Marcar
      </a>

      <a class="main-header__nav-btn" href="Consultas.php">
        <img class="main-header__nav-icon svg" src="../img/common/icons/heart.svg">
        Consultas
      </a>

      <a class="main-header__nav-btn" href="Historico.php">
        <img class="main-header__nav-icon svg" src="../img/common/icons/history.svg">
        Histórico
      </a>

      <a class="main-header__nav-btn main-header__nav-btn--currentPage" href="Perfil.php">
        <img class="main-header__nav-icon main-header__nav-icon--currentPage svg" src="../img/common/icons/profile.svg">
        Perfil
      </a>

    </nav>
  </header>
    
    
  <div class="main-body perfil-body">
    <h1 class="perfil-header">Perfil</h1>

    <span class="perfil-edit" id="perfil-edit">
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
              <input type="text" id="nome" value="<?php echo htmlspecialchars($_SESSION['nome']); ?>"><br>
              <br>

              <b>CPF:</b>
              <br>
              <input type="text" id="cpf" value="<?php echo htmlspecialchars($_SESSION['cpf']); ?>"><br>
              <br>

              <b>Data de Nascimento:</b>
              <br>
              <input type="date" id="bday" max="3000-12-31" value="<?php echo htmlspecialchars($_SESSION['dtNascimento']); ?>"><br>
              <br>

              <b>Gênero:</b>
              <br>
              <input type="text" id="genero" value="<?php echo htmlspecialchars($_SESSION['genero']); ?>"><br>
              <br>
              
              <b>CEP:</b>
              <br>
              <input type="text" id="CEP" value="<?php echo htmlspecialchars($_SESSION['cep']); ?>"><br>
              <br>

              <b>Endereço:</b>
              <br>
              <input type="text" id="endereco" value="<?php echo htmlspecialchars($_SESSION['endereco']); ?>"><br>
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
              <input type="text" id="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>"><br>
              <br>
              <b>Telefone 1:</b>
              <br>
              <input type="text" id="telefone1" value="<?php echo htmlspecialchars($_SESSION['telefone1']); ?>"><br>
              <br>
              <b>Telefone 2:</b>
              <br>
              <input type="text" id="telefone2" value="<?php echo htmlspecialchars($_SESSION['telefone2']); ?>"><br>
              <br>
            
            </form>
            
          </div>
        </div>
        <div class="perfil-widget">
          <h2>Dados Médicos</h2>
          <div class="card" id="dadosMedicos">
            
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

                <b>Tipo Sanguíneo:</b>
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
                            <input type="radio" name="sangue" value="AB-">
                            <span class="checkmark"></span>
                        </label>
                    </form>
                <br>
                
            </form>  

          </div>
        </div>
          
      </div>
      
      </div>
    <div class="perfil-column-center">
        <input type="button" value="Submit" onclick="salvaBanco()"><br>
    </div>
  </div>
  <div class="main-footer">
    Selecione uma clínica:
    <select name="clinica" id="selectClinica">
    </select>
    
    <button type="button" onclick="mudaDeClinica();">Ir</button>

  </div>
</body>

<script>
  function inicializa()
  {
    SvgInliner();
    carregaClinicas();
  }

  function salvaBanco() 
    {
        var codigo   = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";
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
        /*
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
                if (this.readyState == 4 && this.status == 200) {

                    alert("Perfil atualizado!");
                    window.location.replace("/Paginas/Paciente/Perfil.php"); 
                }
            }
        };
        

        envio = "codigo=" + codigo + "&nome=" + nome + "&cpf=" + cpf + "&bday=" + bday + "&genero=" + genero + "&CEP=" + CEP
        + "&endereco=" + endereco + "&senha=" + senha + "&email=" + email + "&telefone1=" + telefone1
        + "&telefone2=" + telefone2 + "&planoDeSaude=" + planoDeSaude + "&tipoSanguineo=" + tipoSanguineo;

        console.log(envio);

        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/editaPaciente.php?" + envio, true);
        xmlhttp.send();
    }
  
</script>

</html>
