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

  <title>Atendente</title>
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
            <a class="cadastro-tipo-widget__option card" href="Cadastrar.php"> Cadastrar Médico </a>
            <a class="cadastro-tipo-widget__option cadastro-tipo-widget__option--selected card" href="CadastrarAtendente.php"> Cadastrar Atendente </a>

        </div>

        <div class="medico-select-widget">
            <h2>
                Selecione um atendente:
            </h2>
            <div class="card">
            
                <form>
                    <label>
                        Atendente <br>
                        <input type="text" name="filter-nome" id="filter-nome" autocomplete="off">
                    </label>
                </form>

                <form class="atendente-select-widget__atendentes" id="atendente-select-widget__atendentes">
                    <label>
                        <input type="radio" name="atendente" class="atendente-select-widget__atendente-radio">
                    </label>
                </div>

        </div>
        <br>
        <div class="confirmar-cadastro-widget">
            <h2>
                Confirme as informações:
            </h2>

            <div class="card confirmar-cadastro__card">
                <b>Atendente:</b>
                <br>
                <span id="ate-selecionado">Nenhum selecionado.</span>
                <br><br>
                <button id="cadastra-atendente-btn" type="button" onclick="CadastraAtendente();" disabled>Cadastrar na Clínica</button>
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
    function CarregaAtendentes(){
        var codClinica = "<?php echo htmlspecialchars($_SESSION['codClinica']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                obj = JSON.parse(this.responseText);
                Carrega(obj);
            }
        };
        
        envio = "codClinica=" + codClinica;
        
        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CarregaListaAtendentesNaoCadastrados.php?" + envio, true);
        xmlhttp.send();

        function Carrega(atendentes) {

            function DisplayAtendentes(atendentes, div) {
                var html = "";

                if (atendentes === undefined || atendentes.length == 0)
                {
                    html += "<p><br>Não foi encontrado um atendente com esses parâmetros.</p>";
                }
                else {
                    for (const a of atendentes) {
                        html += "<label> <input type='radio' name='atendente' value='" + a.cod + "' class='atendente-select-widget__atendente-radio' onclick='MostraSelecionados();Horarios();'> <div  class='atendente-select-widget__atendente-card card'> <div><b>Nome:</b> " + a.nome + "</div></div></label>";
                    }
                }
                div.innerHTML = html;
            }

            function FilterAtendentes(atendentes, nome) {
                var result = [];
                for (const a of atendentes) {
                    if (a.nome.toUpperCase().includes(nome.toUpperCase()) )
                    {
                        result.push(a);
                    }
                }
                return result;
            }


            var div = document.getElementById("atendente-select-widget__atendentes");

            var nomeInput = document.getElementById("filter-nome");

            nomeInput.addEventListener("input", function(e) {
                var filtered = FilterAtendentes(atendentes, this.value);
                DisplayAtendentes(filtered, div);
            });

            var filtered = FilterAtendentes(atendentes, "", "");
            DisplayAtendentes(filtered, div);
        }
    }


    function MostraSelecionados(){
        var atInput = $("input[type='radio'][name='atendente']:checked");
        var atVal;

        var incompleto = false;

        if (atInput.length === 0)
        {
            atVal = "Nenhum selecionado.";
            incompleto = true;
        }
        else
        {
            atVal = atInput.parent().children()[1].children[0].innerHTML;
        }



        document.getElementById("cadastra-atendente-btn").disabled = incompleto;


        var atDiv  = document.getElementById("ate-selecionado");
        
        atDiv.innerHTML = atVal;

    }

    function CadastraAtendente() {
        var codAtendente = $("input[type='radio'][name='atendente']:checked").val();

        var codClinica = "<?php echo htmlspecialchars($_SESSION['codClinica']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                alert("Atendente cadastrado!");
                location.reload(); 
            }
        };

        envio = "codAtendente=" + codAtendente + "&codClinica=" + codClinica;

        console.log(envio);

        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CadastraAtendenteAtendente.php?" + envio, true);
        xmlhttp.send();

    }


    CarregaAtendentes();
    SvgInliner();
    carregaClinicas();



    
</script>
        
</html>
