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
                <img class="main-header__nav-icon svg" src="/Paginas/img/common/icons/home.svg">
            Home
            </a>

            <a class="main-header__nav-btn main-header__nav-btn--currentPage" href="Marcar.php">
                <img class="main-header__nav-icon main-header__nav-icon--currentPage svg" src="/Paginas/img/common/icons/calendar.svg">
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

            <a class="main-header__nav-btn" href="Perfil.php">
                <img class="main-header__nav-icon svg" src="../img/common/icons/profile.svg">
                Perfil
            </a>

        </nav>
    </header>
  
  
    <div class="main-body marcar-body">
        
        <h1>
            Marcar Consulta
        </h1>
        <br>
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
                        <input type="radio" name="medico" class="medico-select-widget__medico-radio">
                    </label>
                </div>

        </div>
        <br>
        <div class="horario-select-widget">
            <h2>
                Selecione um dia e horário:
            </h2>

            <div class="card">
                <div class="horario-select-widget__calendar" onclick="MostraSelecionados()">
                    <div id="datepicker" class="card"></div>
                </div>


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
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>08:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>09:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>09:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>10:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>10:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>11:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>11:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>12:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>12:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>13:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>13:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>14:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>14:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>15:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>15:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>16:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>16:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>17:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>17:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>18:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>18:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()" disabled>
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    
                    
                </table>

            </div>
        </div>
        <br>
        <div class="confirmar-consulta-widget">
            <h2>
                Confirme as informações:
            </h2>

            <div class="card confirmar-consulta-widget__card">
                <b>Médico(a):</b>
                <br>
                <span id="med-selecionado">Nenhum selecionado.</span>
                <br><br>
                <b>Especialidade:</b>
                <br>
                <span id="esp-selecionado">Nenhum selecionado.</span>
                <br><br>
                <b>Dia e Hora:</b>
                <br>
                <span id="hora-selecionado">Nenhum selecionado.</span>
                <br><br>
                <button id="marcar-btn" type="button" onclick="return MarcaConsulta()" disabled>Marcar Consulta</button>
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
        var codClinica = "<?php echo htmlspecialchars($_SESSION['codClinica']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                obj = JSON.parse(this.responseText);
                Carrega(obj);
            }
        };
        
        codigo = "1";
        envio = "codClinica=" + codigo;
        
        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaListaMedicos.php?" + envio, true);
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

    function Horarios() {

        function getPreviousMonday(dateOrigin)
        {
            var date = new Date(dateOrigin);
            var day = date.getDay();
            var prevMonday;
            if(date.getDay() == 0){
                prevMonday = new Date().setDate(date.getDate() - 7);
            }
            else{
                prevMonday = new Date().setDate(date.getDate() - day);
            }

            return addDays(prevMonday,1);
        }

        function addDays(date, days) {
            var result = new Date(date);
            result.setDate(result.getDate() + days);
            return result;
        } 

        function getPreviousWorkWeek(dateOrigin) {
            var dates = [];
            var monday = getPreviousMonday(dateOrigin);
            
            for (var i=0; i<5; ++i){
                dates.push(addDays(monday, i));
            }
            return dates;
        }

        function showDays(days) {
            document.getElementById("cal-seg").innerHTML = days[0].getDate();
            document.getElementById("cal-ter").innerHTML = days[1].getDate();
            document.getElementById("cal-qua").innerHTML = days[2].getDate();
            document.getElementById("cal-qui").innerHTML = days[3].getDate();
            document.getElementById("cal-sex").innerHTML = days[4].getDate();
        }



        function formatTime(time) {
            var horarioTable = ["08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30","17:00","17:30","18:00","18:30"];
            return horarioTable[time];
        }

        function getHorarios(codMedico, date)
        {
            var clinica = "<?php echo htmlspecialchars($_SESSION['codClinica']); ?>";

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);
                    ShowHorarios(obj);
                }
            };
            
            clinica = 1;
            envio = "codMedico=" + codMedico + "&codClinica=" + clinica + "&date=" + FormatDate(date);

            console.log(envio);
            
            xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaListaHorarios.php?" + envio, true);
            xmlhttp.send();
        }

        var codMedico = $("input[type='radio'][name='medico']:checked").val();
        var date = new Date($( "#datepicker" ).datepicker( "getDate" ));

        var dates = getPreviousWorkWeek(date);

        showDays(dates);


        getHorarios(codMedico, dates[0]);
        
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
                    d.value=FormatDate(dates[j]) + " " + formatTime(i);
                }
    
            }
        }
    }

    $( function DatePicker() {
        var dp = $( "#datepicker" ).datepicker({
            inline: true,
            dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            nextText: '>',
            prevText: '<',
            onSelect: function(date) {
                Horarios();
                MostraSelecionados();
            }
        });
    } );

    function MostraSelecionados(){
        var medInput = $("input[type='radio'][name='medico']:checked");
        var horaInput = $("input[type='radio'][name='horario']:checked");

        var medVal, espVal, horaVal;

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

        if (horaInput.length === 0)
        {
            horaVal =  "Nenhum selecionado.";
            incompleto = true;
        }
        else 
        {
            horaVal = horaInput.val().substr(0,10) + ", às " + horaInput.val().substr(11);
        }


        document.getElementById("marcar-btn").disabled = incompleto;


        var medDiv  = document.getElementById("med-selecionado");
        var espDiv  = document.getElementById("esp-selecionado");
        var horaDiv  = document.getElementById("hora-selecionado");
        
        medDiv.innerHTML = medVal;
        espDiv.innerHTML = espVal;
        horaDiv.innerHTML = horaVal;

    }

    
    function MarcaConsulta() {
        var codPaciente = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

        var codMedico = $("input[type='radio'][name='medico']:checked").val();
        var horaInput = $("input[type='radio'][name='horario']:checked").val();
        var codClinica = "<?php echo htmlspecialchars($_SESSION['codClinica']); ?>";

        
        var data  = horaInput.substr(0,10);
        var hora = horaInput.substr(11) + ":00";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                alert(this.responseText);
                location.reload(); 
            }
        };
        
        envio = "codPaciente=" + codPaciente + "&codMedico=" + codMedico + "&codClinica=" + codClinica + "&data=" + data + "&hora=" + hora;

        console.log(envio);
        
        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/MarcaConsultaPaciente.php?" + envio, true);
        xmlhttp.send();
    }

    CarregaMedicos();
    SvgInliner();
    Horarios();
    carregaClinicas();



    
</script>
        
</html>
