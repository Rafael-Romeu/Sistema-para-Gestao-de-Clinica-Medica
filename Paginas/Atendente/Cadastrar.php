<?php
    session_start();

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ServerScripts/refactored/TemPermissao.php";

    if(!isset($_SESSION['cpf']) || empty($_SESSION['cpf'])){
        header("location: /Paginas/Login.php");
        exit;
    }
    if($_SESSION['tipo'] != "lAtendente"){
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
  <link rel="stylesheet" href="../css/Base.css">
  <link rel="stylesheet" href="../css/Atendente.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
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

            <a class="main-header__nav-btn main-header__nav-btn--currentPage" href="Cadastrar.php">
                <img class="main-header__nav-icon main-header__nav-icon--currentPage svg" src="/Paginas/img/common/icons/calendar.svg">
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
  
  
    <div class="main-body cadastrar-body">
        
        <h1>
            Cadastrar
        </h1>
        <br>

        <div class="cadastro-tipo-widget" >
            <a class="cadastro-tipo-widget__option cadastro-tipo-widget__option--selected card" href="Cadastrar.php"> Cadastrar Médico </a>
            <a class="cadastro-tipo-widget__option card" href="CadastrarAtendente.php"> Cadastrar Atendente </a>

        </div>

        <div class="medico-select-widget">
            <h2>
                Selecione um médico:
            </h2>
            <div class="card">
            
                <form>
                    <label>
                        Médico(a) <br>
                        <input type="text" name="filter-nome" id="filter-nome" autocomplete="off">
                    </label>
                    <br><br>
                    <label>
                        Especialidade <br>
                        <input type="text" name="filter-esp" id="filter-esp" autocomplete="off">
                    </label>
                </form>

                <form class="medico-select-widget__medicos" id="medico-select-widget__medicos">
                    <label>
                        <input type="checkbox" name="medico" class="medico-select-widget__medico-radio">
                    </label>
                </div>

        </div>
        <br>

        <div>
            <h2>
                Selecione os horários:
            </h2>

            <div class="card">
            <table class="table horario-select-widget__agenda" id="horario-select-widget__agenda">
                    <tr>
                        <th></th>
                        <th>
                            Seg
                            <h1 id="cal-seg"></h1>
                        </th>
                        <th>
                            Ter
                            <h1 id="cal-ter"></h1>
                        </th>
                        <th>
                            Qua
                            <h1 id="cal-qua"></h1>
                        </th>
                        <th>
                            Qui
                            <h1 id="cal-qui"></h1>
                        </th>
                        <th>
                            Sex
                            <h1 id="cal-sex"></h1>
                        </th>
                    </tr>
                    <tr>
                        <td>08:00</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>08:30</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>09:00</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>09:30</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>10:00</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>10:30</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>11:00</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>11:30</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>12:00</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>12:30</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>13:00</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>13:30</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>14:00</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>14:30</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>15:00</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>15:30</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>16:00</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>16:30</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>17:00</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>17:30</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>18:00</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>18:30</td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    
                    
                </table>

            </div>
        </div>
            
        <div class="confirmar-cadastro-widget">
            <h2>
                Confirme as informações:
            </h2>

            <div class="card confirmar-cadastro__card">
                <b>Médico(a):</b>
                <br>
                <span id="med-selecionado">Nenhum selecionado.</span>
                <br><br>
                <b>Especialidade:</b>
                <br>
                <span id="esp-selecionado">Nenhum selecionado.</span>
                <br><br>
                <button id="cadastra-medico-btn" type="button" onclick="return CadastraMedico()" disabled>Cadastrar na Clínica</button>
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
    function CarregaMedicos(){
        var codigo = "<?php echo htmlspecialchars($_SESSION['codClinica']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                obj = JSON.parse(this.responseText);
                Carrega(obj);
            }
        };
        
        envio = "codClinica=" + codigo;
        
        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaListaMedicosNaoCadastrados.php?" + envio, true);
        xmlhttp.send();

        function Carrega(medicos) {

            function DisplayMedicos(medicos, div) {
                var html = "";

                if (medicos === undefined || medicos.length == 0)
                {
                    html += "<p><br>Não foi encontrado um médico com esses parâmetros.</p>";
                }
                else {
                    for (const m of medicos) {
                        html += "<label> <input type='radio' name='medico' value='" + m.cod + "' class='medico-select-widget__medico-radio' onclick='MostraSelecionados();Horarios();'> <div  class='medico-select-widget__medico-card card'> <div><b>Nome:</b> " + m.nome + "</div><div><b>Especialidade: </b>" + m.esp + "</div></div></label>";
                    }
                }
                div.innerHTML = html;
            }

            function FilterMedicos(medicos, nome, esp) {
                var result = [];
                for (const m of medicos) {
                    if (m.nome.toUpperCase().includes(nome.toUpperCase()) && m.esp.toUpperCase().includes(esp.toUpperCase()))
                    {
                        result.push(m);
                    }
                }
                return result;
            }


            var div = document.getElementById("medico-select-widget__medicos");

            var nomeInput = document.getElementById("filter-nome");
            var espInput =  document.getElementById("filter-esp");

            nomeInput.addEventListener("input", function(e) {
                var filtered = FilterMedicos(medicos, this.value, espInput.value);
                DisplayMedicos(filtered, div);
            });

            espInput.addEventListener("input", function(e) {
                var filtered = FilterMedicos(medicos, nomeInput.value, this.value);
                DisplayMedicos(filtered, div);
            });

            var filtered = FilterMedicos(medicos, "", "");
            DisplayMedicos(filtered, div);
            }
    }


    function MostraSelecionados(){
        var medInput = $("input[type='radio'][name='medico']:checked");

        var medVal, espVal;

        var incompleto = false;

        if (medInput.length === 0)
        {
            medVal = "Nenhum selecionado.";
            espVal = "Nenhum selecionado.";
            incompleto = true;
        }
        else
        {
            medVal = medInput.parent().children()[1].children[0].innerHTML.substr(8);
            espVal = medInput.parent().children()[1].children[1].innerHTML.substr(17);
        }


        document.getElementById("cadastra-medico-btn").disabled = incompleto;


        var medDiv  = document.getElementById("med-selecionado");
        var espDiv  = document.getElementById("esp-selecionado");
        
        medDiv.innerHTML = medVal;
        espDiv.innerHTML = espVal;

    }

    function CadastraMedico() {
        function replaceAt(str, replacement, index){

            return str.substr(0, index) + replacement + str.substr(index + replacement.length);
        }


        var codMedico = $("input[type='radio'][name='medico']:checked").val();

        var codClinica = "<?php echo htmlspecialchars($_SESSION['codClinica']); ?>";
        
        var horarios = ["0000000000000000000000","0000000000000000000000","0000000000000000000000","0000000000000000000000","0000000000000000000000"];

        var checked = $("input:checkbox[name='horario']:checked");
        
        for (var i=0; i<checked.length; ++i)
        {
            function diaToIndex(dia) {
                if (dia == "seg")
                    return 0;
                if (dia == "ter")
                    return 1;
                if (dia == "qua")
                    return 2;
                if (dia == "qui")
                    return 3;
                if (dia == "sex")
                    return 4;
            }

            function horaToIndex(hora) {
                if (hora == "08:00")
                    return 0;
                if (hora == "08:30")
                    return 1;
                if (hora == "09:00")
                    return 2;
                if (hora == "09:30")
                    return 3;
                if (hora == "10:00")
                    return 4;
                if (hora == "10:30")
                    return 5;
                if (hora == "11:00")
                    return 6;
                if (hora == "11:30")
                    return 7;
                if (hora == "12:00")
                    return 8;
                if (hora == "12:30")
                    return 9;
                if (hora == "13:00")
                    return 10;
                if (hora == "13:30")
                    return 11;
                if (hora == "14:00")
                    return 12;
                if (hora == "14:30")
                    return 13;
                if (hora == "15:00")
                    return 14;
                if (hora == "15:30")
                    return 15;
                if (hora == "16:00")
                    return 16;
                if (hora == "16:30")
                    return 17;
                if (hora == "17:00")
                    return 18;
                if (hora == "17:30")
                    return 19;
                if (hora == "18:00")
                    return 20;
                if (hora == "18:30")
                    return 21;
            
            }

            var dia = diaToIndex($(checked[i]).val().substring(0,3));
            var hora = horaToIndex($(checked[i]).val().substring(4));

            console.log($(checked[i]).val().substring(4));


            
            horarios[dia] = replaceAt(horarios[dia], "1", hora);
            
        }


        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                alert("Médico cadastrado!");
                location.reload(); 
            }
        };

        envio = "codMedico=" + codMedico + "&codClinica=" + codClinica + "&seg=" + horarios[0] + "&ter=" + horarios[1] + "&qua=" + horarios[2] + "&qui=" + horarios[3] + "&sex=" + horarios[4];

        console.log(envio);

        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CadastraMedicoAtendente.php?" + envio, true);
        xmlhttp.send();

    }

    function Horarios() {


        function formatTime(time) {
            var horarioTable = ["08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30","17:00","17:30","18:00","18:30"];
            return horarioTable[time];
        }

        function getHorarios(codMedico)
        {
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    obj = JSON.parse(this.responseText);
                    ShowHorarios(obj);
                }
            };
            
            clinica = 1;
            envio = "codMedico=" + codMedico;

            console.log(envio);
            
            xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaListaHorariosAtendente.php?" + envio, true);
            xmlhttp.send();
        }

        var codMedico = $("input[type='radio'][name='medico']:checked").val();

        getHorarios(codMedico);
        var dates=['seg','ter','qua','qui','sex'];

        function ShowHorarios(horarios)
        {
            var rows = document.getElementById("horario-select-widget__agenda").children[0].children;

            for (var i=0; i<horarios[0].length; ++i) {

                for (var j=0; j<5; ++j) {
                    var d = rows[i+1].children[j+1].children[0].children[0];
                    d.checked=false;
                    
                    if (horarios[j][i] === "0") {
                        d.disabled=true;
                    }
                    else {
                        d.disabled=false;
                    }
                    d.value=dates[j] + " " + formatTime(i);
                }

            }
        }
    }


    CarregaMedicos();
    SvgInliner();
    Horarios();
    carregaClinicas();



    
</script>
        
</html>
