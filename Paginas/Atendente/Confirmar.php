<?php
    session_start();

    if(!isset($_SESSION['cpf']) || empty($_SESSION['cpf'])){
        header("location: /Paginas/Login.php");
        exit;
    }
    if($_SESSION['tipo'] != "lAtendente"){
        shell_exec('php ' . $_SERVER['DOCUMENT_ROOT'] . '/ServerScripts/Logout.php');
        header('location: /Paginas/Login.php');
        exit;
    }
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

  <title>Paciente</title>
  <meta charset = "UTF-8">
</head>


<body>
  <header class="main-header">
    <div class="main-header__top-bar">
      <h1 class="main-header__logo">Vida Saudável</h1>
      <div class="main-header__user">
        <span class="main-header__username" id="headerUserNome"><?php echo htmlspecialchars($_SESSION['nome']); ?></span>
        <a class="main-header__logout-btn" href="#">Logout</a>
      </div>
    </div>

    <nav class="main-header__nav-bar">

      <a class="main-header__nav-btn" href="Home.php">
        <img class="main-header__nav-icon svg" src="../img/common/icons/home.svg">
        Home
      </a>

      <a class="main-header__nav-btn" href="Cadastrar.php">
        <img class="main-header__nav-icon svg" src="/Paginas/img/common/icons/calendar.svg">
        Cadastrar
      </a>

      <a class="main-header__nav-btn main-header__nav-btn--currentPage" href="Confirmar.php">
        <img class="main-header__nav-icon main-header__nav-icon--currentPage svg" src="../img/common/icons/heart.svg">
        Confirmar <br> Consultas
      </a>

      <a class="main-header__nav-btn" href="Consultas.php">
        <img class="main-header__nav-icon svg" src="../img/common/icons/heart.svg">
        Consultas
      </a>

      <a class="main-header__nav-btn" href="Historico.php">
        <img class="main-header__nav-icon svg" src="../img/common/icons/history.svg">
        Histórico
      </a>

      <a class="main-header__nav-btn" href="Perfil.php">
        <img class="main-header__nav-icon svg" src="../img/common/icons/profile.svg">
        Perfil
      </a>

    </nav>
  </header>
    
    
  <div class="main-body consultas-body">
    <div class="consultas-widget">
    
      <h1 class="consultas-widget__header">
        Confirmar Consultas
      </h1>

      <span class="consultas-widget__filter-toggle" id="filter-toggle">
        <img class="consultas-widget__filter-icon svg" src="../img/common/icons/search.svg">
      </span>

      <div class="consultas-widget__filter-box card" id="filter-box">
        <form class="consultas-widget__filter-form">
          <label>
            Médico(a) <br>
            <input type="text" name="filter-nome">
          </label>
          <label>
            Especialidade <br>
            <input type="text" name="filter-esp">
          </label>
        </form>
      </div>

    
      <div class="consultas-widget__body card">
          
        <span class="consultas-widget__list-header">
          <span>Dia</span>
          <span>Hora</span>
          <span>Médico(a)</span>
          <span>Paciente</span>
        </span>
          
        <div id="consultas-widget__list">

          
          <div class="consultas-widget__list-row accordion">
            <span>01/01/2019</span>
            <span>18:00h</span>
            <span>Paula Dentro</span>
            <span>Ginecologista</span>
            <div class="consultas-widget__accordion-panel">
              <div class="consultas-widget__accordion-content">
                <button class="consultas-widget__confirmar-btn" id="">Confirmar Consulta</button>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
        
</body>


<script>
  
</script>


<script>
  function CarregaConsultasNaoConfirmadas() 
  {
    var codClinica = "<?php echo htmlspecialchars($_SESSION['codCLinica']); ?>";

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("consultas-widget__list").innerHTML = this.responseText;
      }
      Accordion();
    };
    
    envio = "codClinica=" + codClinica;
    
    console.log(envio);
    xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaConsultasNaoConfirmadas.php?" + envio, true);
    xmlhttp.send();
  }

  function ConfirmaConsulta(args)
  {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        location.reload();
      }
      Accordion();
    };
    
    var codAtendente = <?php echo htmlspecialchars($_SESSION['codigo']); ?>;
    envio = args + "&codAtendente=" + codAtendente;
    console.log(envio);
    xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/ConfirmaConsulta.php?" + envio, true);
    xmlhttp.send();
  }
  CarregaConsultasNaoConfirmadas();
  SvgInliner();
  ConsultasFilter();
  Accordion();
</script>

</html>
