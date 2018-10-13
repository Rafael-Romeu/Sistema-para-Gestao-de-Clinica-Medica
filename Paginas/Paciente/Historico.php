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
  <link rel="stylesheet" href="../css/Base.css">
  <link rel="stylesheet" href="../css/Paciente.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="../js/scripts.js"></script>

  <title>Paciente</title>
  <meta charset = "UTF-8">
</head>


<body>
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

      <a class="main-header__nav-btn main-header__nav-btn--currentPage" href="Historico.php">
        <img class="main-header__nav-icon main-header__nav-icon--currentPage svg" src="../img/common/icons/history.svg">
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
        Histórico
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
          <span>Especialidade</span>
        </span>
          
        <div id="consultas-widget__list">

          <!--  
          <div class="consultas-widget__list-row accordion">
            <span>01/01/2019</span>
            <span>18:00h</span>
            <span>Paula Dentro</span>
            <span>Ginecologista</span>
            <div class="consultas-widget__accordion-panel">
              <div class="consultas-widget__accordion-content">
                <div class="consultas-widget__receita">
                    <h3>Receita</h3>
                    Um<br>
                    Dois<br>
                    Feijão com arroz.
                </div>
                <div class="consultas-widget__observacoes">
                    <h3>Observações</h3>
                    Três<br>
                    Quatro<br>
                    Feijão no prato.
              
                </div>
              </div>
            </div>
          </div>
            -->
        </div>
      </div>
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
  
</script>


<script>
  function CarregaConsultas() 
  {
    var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("consultas-widget__list").innerHTML = this.responseText;
      }
      Accordion();
    };
    
    envio = "codigo=" + codigo;
    
    console.log(envio);
    xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaHistoricoPaciente.php?" + envio, true);
    xmlhttp.send();
  }
  CarregaConsultas();
  SvgInliner();
  ConsultasFilter();
  carregaClinicas();
</script>

</html>
