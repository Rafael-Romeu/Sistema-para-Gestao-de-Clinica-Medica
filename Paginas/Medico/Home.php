<?php
    session_start();

    if(!isset($_SESSION['cpf']) || empty($_SESSION['cpf'])){
        header("location: /Paginas/Login.php");
        exit;
    }
    if($_SESSION['tipo'] != "lMedico"){
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


<body>
  <header class="main-header">
    <div class="main-header__top-bar">
      <h1 class="main-header__logo">Vida Saudável</h1>
      <div class="main-header__user">
        <span class="main-header__username" id="headerUserNome"><?php echo htmlspecialchars($_SESSION['nome']); ?></span>
        <a class="main-header__logout-btn" href="#" onclick="Logout();">Logout</a>
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
    <div class="seu-perfil-widget">
        
      <h1>
        Seu Perfil
      </h1>
      <div class="card">
        <b>Nome:</b>
        <br>
        <span id="infoUserNome"><?php echo htmlspecialchars($_SESSION['nome']); ?></span>
        <br><br>
        <b>Plano de Saúde:</b>
        <br>
        <span id="infoUserPlano"><?php echo htmlspecialchars($_SESSION['planoDeSaude']); ?></span>
        <br><br>
        <b>Email:</b>
        <br>
        <span id="infoUserEmail"><?php echo htmlspecialchars($_SESSION['email']); ?></span>
        <br><br>
        <b>Endereço:</b>
        <br>
        <span id="infoUserEnd"><?php echo htmlspecialchars($_SESSION['endereco']); ?></span>
        <br>
      </div>
    </div>
    <div class="prox-consulta-widget">
      <h1>Próxima Consulta</h1>
      <div class="card" id="proxCons">
        <b>Paciente:</b>
        <br>
        <span id="proxConsPacNome"></span>
        <br><br>
        <b>Dia e Hora:</b>
        <br>
        <span id="proxConsDia"></span>, às <span id="proxConsHora"></span>.
      </div>
    </div>
  </div>

</body>

<script>
  
  function CarregaDadosHome() 
  {
    console.log("envio");
      var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";
      
      var xmlhttp = new XMLHttpRequest();
      
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          
          if (data.length == 0){
            document.getElementById("proxCons").innerHTML = "Nenhuma consulta marcada.<br>";
          }
          else {
            document.getElementById("proxConsPacNome").innerHTML = data.nomePaciente;
            document.getElementById("proxConsDia").innerHTML = data.data;
            document.getElementById("proxConsHora").innerHTML = data.hora;
          }

        }
      };
      
      envio = "codigo=" + codigo;
      
      console.log(envio);
      xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaProximaConsultaMedico.php?" + envio, true);
      xmlhttp.send();
  }
  
  SvgInliner();
  CarregaDadosHome();
</script>

</html>