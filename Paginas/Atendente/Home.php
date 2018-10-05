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
  <link rel="stylesheet" href="../css/Atendente.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="../js/scripts.js"></script>

  <title>Atendente</title>
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

      <a class="main-header__nav-btn main-header__nav-btn--currentPage" href="Home.php">
        <img class="main-header__nav-icon main-header__nav-icon--currentPage svg" src="../img/common/icons/home.svg">
        Home
      </a>

      <a class="main-header__nav-btn" href="Marcar.php">
        <img class="main-header__nav-icon svg" src="/Paginas/img/common/icons/calendar.svg">
        Cadastrar
      </a>

      <a class="main-header__nav-btn" href="Confirmar.php">
        <img class="main-header__nav-icon svg" src="/Paginas/img/common/icons/calendar.svg">
        Confirmar <br> Consultas
      </a>

      <a class="main-header__nav-btn" href="Consultas.php">
        <img class="main-header__nav-icon svg" src="../img/common/icons/heart.svg">
        Consultas
      </a>

      <a class="main-header__nav-btn" href="Perfil.php">
        <img class="main-header__nav-icon svg" src="../img/common/icons/profile.svg">
        Perfil
      </a>

    </nav>
  </header>
  
  
  <div class="main-body home-body">
    <div class="seu-perfil-widget">
        
      <h1>
        Seu Perfil
      </h1>
      <div class="card" id="atendente">
      </div>
    </div>
    <div class="prox-consulta-widget">
      <h1>Próxima Consulta</h1>
      <div class="card" id="consulta">
      </div>
    </div>
  </div>

</body>

<script>
  
  function inicializa()
  {
    SvgInliner();
    CarregaAtendente();
    CarregaProximaConsulta();
  }
  function CarregaAtendente() 
  {
    var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("atendente").innerHTML = this.responseText;
      }
    };
    
    codigo = "1";
    envio = "codigo=" + codigo;
    
    console.log(envio);
    xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaAtendente.php?" + envio, true);
    xmlhttp.send();
  }

  function CarregaProximaConsulta() 
  {
    var codClinica = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("consulta").innerHTML = this.responseText;
      }
    };
    
    codClinica = "1";
    envio = "codClinica=" + codClinica;
    
    console.log(envio);
    xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaProximaConsultaAtendente.php?" + envio, true);
    xmlhttp.send();
  }


</script>

</html>
