<!DOCTYPE html>
<html>

<head>
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
            <h1 class="main-header__logo">Vida Saudável</h1>
            <div class="main-header__user">
                <span class="main-header__username" id="headerUserNome">Jacinto Leite</span>
                <a class="main-header__logout-btn" href="#">Logout</a>
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
                        <input type="radio" name="medico" class="medico-select-widget__medico-radio">
                    </label>
                </div>

        </div>
        <br>

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
</body>

<script>
    function CarregaMedicos(){
        var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                obj = JSON.parse(this.responseText);
                Carrega(obj);
            }
        };
        
        codigo = "1";
        envio = "codigo=" + codigo;
        
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
        var codMedico = $("input[type='radio'][name='medico']:checked").val();

        var codClinica = "<?php echo htmlspecialchars($_SESSION['codClinica']); ?>";
        codClinica = 1;

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                alert(this.responseText);
                location.reload(); 
            }
        };

        envio = "codMedico=" + codMedico + "&codClinica=" + codClinica;

        console.log(envio);

        xmlhttp.open("GET", "<?php $_SERVER['DOCUMENT_ROOT']?>/ServerScripts/refactored/CadastraMedicoNaClinica.php?" + envio, true);
        xmlhttp.send();

    }


    CarregaMedicos();
    SvgInliner();
    Horarios();



    
</script>
        
</html>
