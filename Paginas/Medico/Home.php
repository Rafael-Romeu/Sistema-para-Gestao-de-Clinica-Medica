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

<head>
  <link href="https://fonts.googleapis.com/css?family=Fira Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="/Paginas/css/Base.css">
  <link rel="stylesheet" href="/Paginas/css/Medico.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script src="/Paginas/js/scripts.js"></script>

  <title>Medico</title>
  <meta charset = "UTF-8">
</head>


<body onload="CarregaDadosHome()">
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
        <img class="main-header__nav-icon main-header__nav-icon--currentPage svg" src="/Paginas/img/common/icons/home.svg">
        Home
      </a>

      <a class="main-header__nav-btn" href="Consultas.php">
        <img class="main-header__nav-icon svg" src="/Paginas/img/common/icons/heart.svg">
        Consultas
      </a>

      <a class="main-header__nav-btn" href="Historico.php">
        <img class="main-header__nav-icon svg" src="/Paginas/img/common/icons/history.svg">
        Histórico
      </a>

      <a class="main-header__nav-btn" href="Perfil.php">
        <img class="main-header__nav-icon svg" src="/Paginas/img/common/icons/profile.svg">
        Perfil
      </a>

    </nav>
  </header>
  
  <div class="main-body home-body" id="home">
    <!--<div class="seu-perfil-widget">
        
      <h1>
        Seu Perfil
      </h1>
      <div class="card">
        <b>Nome:</b>
        <br>
        <span id="infoUserNome">Jacinto Leite</span>
        <br><br>
        <b>Plano de Saúde:</b>
        <br>
        <span id="infoUserPlano">Unimed</span>
        <br><br>
        <b>Email:</b>
        <br>
        <span id="infoUserEmail">jacinto@leite.com</span>
        <br><br>
        <b>Endereço:</b>
        <br>
        <span id="infoUserEnd">Rua Jussara, 159</span>
        <br>
      </div>
    </div>
    <div class="prox-consulta-widget">
      <h1>Próxima Consulta</h1>
      <div class="card">
        <b>Paciente:</b>
        <br>
        <span id="proxConsPacNome">Paula Dentro</span>
        <br><br>
        <b>Dia e Hora:</b>
        <br>
        <span id="proxConsDia">01/01/2019</span>, às <span id="proxConsHora">18:00h</span>.
      </div>
    </div>-->
  </div>

</body>

<script>
  SvgInliner();

  function CarregaDadosHome() 
    {
        console.log("envio");
        var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("home").innerHTML = this.responseText;
            }
        };
        
        codigo = "1";
        envio = "codigo=" + codigo;
        
        console.log(envio);
        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaMedicoHome.php?" + envio, true);
        xmlhttp.send();
    }
</script>

</html>