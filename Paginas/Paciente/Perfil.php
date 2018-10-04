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
      <h1 class="main-header__logo">Vida Saudável</h1>
      <div class="main-header__user">
        <span class="main-header__username" id="headerUserNome">Jacinto Leite</span>
        <a class="main-header__logout-btn" href="#">Logout</a>
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
          <!--  <b>Nome:</b>
            <br>
            <span id="infoUserNome">Jacinto Leite</span>
            <br><br>

            <b>CPF:</b>
            <br>
            <span id="infoUserCpf">123.123.123-12</span>
            <br><br>

            <b>Data de Nascimento:</b>
            <br>
            <span id="infoUserData">01/01/1990</span>
            <br><br>

            <b>Gênero:</b>
            <br>
            <span id="infoUserEnd">Masculino</span>
            <br><br>
            
            <b>Endereço:</b>
            <br>
            <span id="infoUserEnd">Rua Jussara, 159</span>
            <br>
          -->
          </div>

            
        </div>
          
      </div>

      <div class="perfil-column-right">
        <div class="perfil-widget">
          <h2>Contato</h2>
          <div class="card" id="contato">
            <!--
            <b>Email:</b>
            <br>
            <span id="infoUserEmail">jacinto@leite.com</span>
            <br><br>
            <b>Telefone:</b>
            <br>
            <span id="infoUserTel">(21)2345678</span>
            <br>
            -->
          </div>
        </div>
        <div class="perfil-widget">
          <h2>Dados Médicos</h2>
          <div class="card" id="dadosMedicos">
            <!--
            <b>Plano de Saúde:</b>
            <br>
            <span id="infoUserPlano">Unimed</span>
            <br><br>

            <b>Tipo Sanguíneo:</b>
            <br>
            <span id="infoUserSangue">O+</span>
            <br>
            -->
          </div>
        </div>
          
      </div>
    </div>
  </div>
        
</body>

<script>
  function inicializa()
  {
    SvgInliner();
    CarregaDadosPessoais();
    CarregaDadosMedicos();
    CarregaContato();
  }
  function CarregaDadosPessoais() 
    {
        console.log("envio");
        var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("dadosPessoais").innerHTML = this.responseText;
            }
        };
        
        codigo = "1";
        envio = "codigo=" + codigo + "&tipoDeDadosASerCarregados=" + "dadosPessoais";
        
        console.log(envio);
        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaPacientePerfil.php?" + envio, true);
        xmlhttp.send();
    }

    function CarregaContato() 
    {
        console.log("envio");
        var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("contato").innerHTML = this.responseText;
            }
        };
        
        codigo = "1";
        envio = "codigo=" + codigo + "&tipoDeDadosASerCarregados=" + "contato";
        
        console.log(envio);
        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaPacientePerfil.php?" + envio, true);
        xmlhttp.send();
    }

    function CarregaDadosMedicos() 
    {
        console.log("envio");
        var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("dadosMedicos").innerHTML = this.responseText;
            }
        };
        
        codigo = "1";
        envio = "codigo=" + codigo + "&tipoDeDadosASerCarregados=" + "dadosMedicos";
        
        console.log(envio);
        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaPacientePerfil.php?" + envio, true);
        xmlhttp.send();
    }
</script>

</html>
