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

  <title>Médico</title>
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
          <img class="main-header__nav-icon svg" src="/Paginas/img/common/icons/home.svg">
          Home
        </a>

        <a class="main-header__nav-btn" href="Consultas.php">
          <img class="main-header__nav-icon svg" src="/Paginas/img/common/icons/heart.svg">
          Consultas
        </a>

        <a class="main-header__nav-btn main-header__nav-btn--currentPage" href="Historico.php">
          <img class="main-header__nav-icon main-header__nav-icon--currentPage svg" src="/Paginas/img/common/icons/history.svg">
          Histórico
        </a>

        <a class="main-header__nav-btn" href="Perfil.php">
          <img class="main-header__nav-icon svg" src="/Paginas/img/common/icons/profile.svg">
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
        <img class="consultas-widget__filter-icon svg" src="/Paginas/img/common/icons/search.svg">
      </span>

      <div class="consultas-widget__filter-box card" id="filter-box">
        <form class="consultas-widget__filter-form">
          <label>
            Paciente <br>
            <input type="text" name="filter-nome">
          </label>
        </form>
      </div>

    
      <div class="consultas-widget__body card">
          
        <span class="consultas-widget__list-header">
          <span>Dia</span>
          <span>Hora</span>
          <span>Paciente</span>
        </span>
          
        <div id="consultas-widget__list">
<!--
          <div class="consultas-widget__list-row accordion">
            <span>01/01/2019</span>
            <span>18:00h</span>
            <span>Paula Dentro</span>
            <div class="consultas-widget__accordion-panel">
              <div class="consultas-widget__accordion-content">
                
                <div class="consultas-widget__receita">
                  <div>
                    <h3>Receita</h3>
                  </div>
                  <div>
                    Um<br>
                    Dois<br>
                    Feijão com arroz.
                  </div>
                </div>
                
                <div class="consultas-widget__observacoes">
                  <div>
                    <h3>Observações</h3>
                  </div>
                  <div>
                    Três<br>
                    Quatro<br>
                    Feijão no prato.
                  </div>
                </div>

                <div class="consultas-widget__edit-btn">
                  <a href="#">
                    Editar
                  </a>
                </div>

              </div>
            </div>
          </div>
  -->       
        </div>
      </div>
    </div>
  </div>
      
</body>

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
    xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaHistoricoMedico.php?" + envio, true);
    xmlhttp.send();
  }

  CarregaConsultas();
  SvgInliner();
  ConsultasFilter();
  Accordion();
  EditarConsulta();
</script>


</html>