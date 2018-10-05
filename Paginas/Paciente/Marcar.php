<!DOCTYPE html>
<html>

<head>
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
            <h1 class="main-header__logo">Vida Saudável</h1>
            <div class="main-header__user">
                <span class="main-header__username" id="headerUserNome">Jacinto Leite</span>
                <a class="main-header__logout-btn" href="#">Logout</a>
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
                        <div  class="medico-select-widget__medico-card card">
                            <div>Nome: Jacinto</div>
                            <div>Especialidade: Uro</div> 
                        </div>
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
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>08:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>09:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>09:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>10:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>10:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>11:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>11:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>12:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>12:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>13:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>13:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>14:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>14:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>15:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>15:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>16:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>16:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>17:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>17:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>18:00</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>18:30</td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
                                <div  class="horario-select-widget__horario-card" onclick="MostraSelecionados()">
                                </div>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="horario" class="horario-select-widget__horario-radio" value="0-00" onclick="MostraSelecionados()">
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
                <button id="marcar-btn" onclick="MarcaConsulta()" disabled>Marcar Consulta</button>
            </div>
        </div>
    </div>
</body>

<script>
    function CarregaMedicos1()
    {
        var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                obj = JSON.parse(this.responseText);
                console.log(this.response_text);
                CarregaMedicos2(obj);
            }
        };
        
        codigo = "1";
        envio = "codigo=" + codigo;
        
        console.log(envio);
        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaListaMedicos.php?" + envio, true);
        xmlhttp.send();
    }
    CarregaMedicos1();
    SvgInliner();
    horarios();


    
</script>
        
</html>
