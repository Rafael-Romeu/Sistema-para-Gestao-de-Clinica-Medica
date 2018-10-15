<?php
    session_start();

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ServerScripts/refactored/TemPermissao.php";

    if(!isset($_SESSION['cpf']) || empty($_SESSION['cpf'])){
        header("location: /Paginas/Login.php");
        exit;
    }
    if($_SESSION['tipo'] != "lMedico"){
        shell_exec('php ' . $_SERVER['DOCUMENT_ROOT'] . '/ServerScripts/refactored/Logout.php');
        header('location: /Paginas/Login.php');
        exit;
    }

    if(!TemPermissao($_SESSION['tipo'], $_SESSION['codigo'], $_SESSION['codClinica']))
    {
      shell_exec('php ' . $_SERVER['DOCUMENT_ROOT'] . '/ServerScripts/refactored/Logout.php');
      header('location: /Paginas/Login.php');
      exit;
    }
?>

<!DOCTYPE html>
<html>

<head>   <style>   :root {      /* COLORS */     --primary: <?php echo htmlspecialchars($_SESSION['corPrimaria']); ?>;      --success: <?php echo htmlspecialchars($_SESSION['corSucesso']); ?>;     --failure: <?php echo htmlspecialchars($_SESSION['corFalha']); ?>;      --color-1: <?php echo htmlspecialchars($_SESSION['cor1']); ?>;     --color-2: <?php echo htmlspecialchars($_SESSION['cor2']); ?>;     --color-3: <?php echo htmlspecialchars($_SESSION['cor3']); ?>;     --color-4: <?php echo htmlspecialchars($_SESSION['cor4']); ?>;     --color-5: <?php echo htmlspecialchars($_SESSION['cor5']); ?>;   }        </style>
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

      <span>
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
  function CarregaConsultas() 
  {
    var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";
    var codClinica = "<?php echo htmlspecialchars($_SESSION['codClinica']); ?>";

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("consultas-widget__list").innerHTML = this.responseText;
          EditarConsulta();
      }
      Accordion();
    };
    
    envio = "codigo=" + codigo + "&codClinica=" + codClinica;
    
    console.log(envio);
    xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaHistoricoMedico.php?" + envio, true);
    xmlhttp.send();
  }

  function EditarConsulta() {
    var btn = document.getElementsByClassName("consultas-widget__edit-btn");
    var i;

    for (i = 0; i < btn.length; i++) {

      btn[i].addEventListener("click", function() {

        if (this.classList.contains("active")) {
          this.parentElement.parentElement.parentElement.classList.toggle("editing");
          this.parentElement.parentElement.parentElement.addEventListener("click", ToggleAccordion);
          this.parentElement.click();
          this.lastElementChild.innerHTML = "Editar";

          var campos = this.parentElement.children;

          var dia = this.parentElement.parentElement.parentElement.children[0].innerHTML;
          var hora = this.parentElement.parentElement.parentElement.children[1].innerHTML;
          var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";
          
          var receita = textToHtml(campos[0].lastElementChild.lastElementChild.value);
          var observa = textToHtml(campos[1].lastElementChild.lastElementChild.value);

          campos[0].lastElementChild.innerHTML = receita;

          campos[1].lastElementChild.innerHTML = observa;


          var xmlhttp = new XMLHttpRequest();

          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              this.classList.toggle("active");
            }
            Accordion();
          };

          envio = "codMedico=" + codigo + "&data=" + dia + "&hora=" + hora + "&rec=" + receita + "&obs=" + observa;

          console.log(envio);
          xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/EditaConsulta.php?" + envio, true);
          xmlhttp.send();
        }
        else {
          this.parentElement.parentElement.parentElement.classList.toggle("editing");
          this.parentElement.parentElement.parentElement.removeEventListener("click", ToggleAccordion);
          this.parentElement.parentElement.style.maxHeight = "500px";

          this.lastElementChild.innerHTML = "Salvar";
          var campos = this.parentElement.children;

          var receita = htmlToText(campos[0].lastElementChild.innerHTML.trim());
          var recomen = htmlToText(campos[1].lastElementChild.innerHTML.trim());

          campos[0].lastElementChild.innerHTML = "<textarea rows='10' cols='40'>" + receita + "</textarea>";

          campos[1].lastElementChild.innerHTML = "<textarea rows='10' cols='40'>" + recomen + "</textarea>";
          this.classList.toggle("active");
        }

          
      });
    }
  }

  CarregaConsultas();
  SvgInliner();
  ConsultasFilter();
  Accordion();
  carregaClinicas();
  
</script>


</html>