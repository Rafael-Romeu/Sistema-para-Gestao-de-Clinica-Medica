<?php

    session_start();

    if(!isset($_SESSION['cpf']) || empty($_SESSION['cpf'])){
        header("location: Login.php");
        exit;
    }
    if($_SESSION['tipo'] != "lAtendente"){
        shell_exec('php serverScripts/Logout.php');
        header("location: Login.php");
        exit;
    }

?>


<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="css/Home.css">
    <title> Atendente </title> <!-- Titulo da pagina --> 
    <meta charset = "UTF-8">
</head>


<body>
    
    <div class="Background">
       <img src = "Imagens/Medica-Transparencia.png">
    </div>
    
    <header>
        <!-- Header --> 
        <img src="Imagens/Capa/Logo.png" style="flex-shrink: 0">
        <img src="Imagens/Capa/Linha.png" style="flex-grow: 1; min-width: 0px">
        <img src="Imagens/Capa/Detalhe.png" style="flex-shrink: 0;">
    </header>
    
    
    <!-- Menu de navegação --> 
    <nav>
        <div class = "Atendente">
            <button id = "CadastrarPaciente"    class="Botao-Menu"> Cadastrar Paciente </button>
            <button id = "CadastrarMedico"      class="Botao-Menu"> Cadastrar Medico </button>
            <button id = "CadastrarAtendente"   class="Botao-Menu"> Cadastrar Atendente </button>
            <button id = "AgendarConsulta"      class="Botao-Menu"> Agendar Consulta </button>
            <button id = "VerConsultas"         class="Botao-Menu" onclick="CarregaMedicosConsultas()"> Visualizar Consultas </button>
        </div>
    </nav>
    
    <div class="Corpo">

        <!-- Atendente --> 
        <div class = "Atendente">
            <div class = "CadastrarPaciente">
                <h3 class = "Forms">Cadastrar Paciente</h3>
               
                <form>
                    <label class = "Forms" for="name">Nome: </label>
                    <input type="text" id="CadPacName" name="name" placeholder="* Your name.." required>

                    <label class = "Forms" for="Cpf">Cpf: </label>
                    <input type="text" id="CadPacCpf" name="Cpf" placeholder="* Cpf" pattern="[0-9]{11}" required>

                    <label class = "Forms" for="password">Senha: </label>
                    <input type="password" id="CadPacPassword" name="password" placeholder="* Your password.." required>

                    <label class = "Forms" for="DataNascimento">Data de Nascimento: </label>
                    <input type="date" id="CadPacDataNascimento" name="DataNascimento" placeholder="* Data Nascimento.." required>

                    <label class = "Forms" for="gender">Gênero: </label><br>

                    <ul class="Generos" style = "margin: 0px 0px 0px 20px">
                        <li class="Genero Homem">
                          <input name="CadPacGenero" type="radio" id="CadPacHomem">
                          <label for="CadPacHomem">Homem</label> 
                        </li>
                          
                        <li class="Genero Mulher">
                          <input name="CadPacGenero" type="radio" id="CadPacMulher">
                          <label for="CadPacMulher">Mulher</label>
                        </li>
                          
                        <li class="Genero Outro">
                          <input name="CadPacGenero" type="radio" id="CadPacOutro" checked>
                          <label for="CadPacOutro">Outro</label>
                        </li>
                    </ul>

                    <br>
                    <br>

                    <label class = "Forms" for="Endereco">Endereço: </label>
                    <input type="text" id="CadPacEndereco" name="Endereco" placeholder="Endereço..">

                    <label class = "Forms" for="Email">Email: </label>
                    <input type="email" id="CadPacEmail" name="Email" placeholder="Your Email..">

                    <label class = "Forms" for="Telefone">Telefone: </label>
                    <input type="text" id="CadPacTel" name="Telefone" placeholder="Telefone..">

                    <label class = "Forms" for="TipoSanguineo">Tipo Sanguineo: </label>
                    <input type="text" id="CadPacTipoSanguineo" name="TipoSanguineo" placeholder= "Tipo Sanguineo..">

                    <label class = "Forms" for="PlanoDeSaude">Plano de Saude: </label>
                    <input type="text" id="CadPacPlanoDeSaude" name="PlanoDeSaude" placeholder="Plano De Saude..">
                </form>

                <input type="submit" value="Enviar" onclick="CadastrarPaciente()">

                <div id="CadPacResultado"></div>
            </div>

            <div class = "CadastrarMedico">
                <h3 class = "Forms">Cadastrar Medico</h3>
                <div>
                    <form action="">
                    <label class = "Forms" for="name">Nome: </label>
                    <input type="text" id="CadMedName" name="name" placeholder="* Your name.." required>

                    <label class = "Forms" for="Cpf">Cpf: </label>
                    <input type="text" id="CadMedCpf" name="Cpf" placeholder="* Cpf" pattern="[0-9]{11}" required>

                    <label class = "Forms" for="password">Senha: </label>
                    <input type="password" id="CadMedPassword" name="password" placeholder="* Your password.." required>

                    <label class = "Forms" for="DataNascimento">Data de Nascimento: </label>
                    <input type="date" id="CadMedDataNascimento" name="DataNascimento" placeholder="* Data Nascimento.." required>

                    <label class = "Forms" for="Endereco">Endereço: </label>
                    <input type="text" id="CadMedEndereco" name="Endereco" placeholder="Endereço..">

                    <label class = "Forms" for="Email">Email: </label>
                    <input type="email" id="CadMedEmail" name="Email" placeholder="Your Email..">
                    
                    <label class = "Forms" for="Telefone">Telefone: </label>
                    <input type="text" id="CadMedTel" name="Telefone" placeholder="Telefone..">

                    <label class = "Forms" for="Especialidade">Especialidade: </label>
                    <input type="text" id="CadMedEspecialidade" name="Especialidade" placeholder= "* Especialidade .." required>

                    <label class = "Forms" for="PlanoDeSaude">Plano de Saude: </label>
                    <input type="text" id="CadMedPlanoDeSaude" name="PlanoDeSaude" placeholder="Plano De Saude..">
                    
                    <label class = "Forms" for="Horarios">Horarios: </label>
                    
                    <form id="FormsSegunda" action="">
                            <ul class="Forms">
                                <p>Segunda</p>
                                <li>
                                    <input name="segunda" type="checkbox" id="s1" value="1" checked>
                                    <label for="s1">8:00</label>
                                </li>
        
                                <li>
                                    <input name="segunda" type="checkbox" id="s2" value="2">
                                    <label for="s2">8:30</label>
                                </li>
        
                                <li>
                                    <input name="segunda" type="checkbox" id="s3" value="3">
                                    <label for="s3">9:00</label>
                                </li>
                                
                                <li>
                                    <input name="segunda" type="checkbox" id="s4" value="4">
                                    <label for="s4">9:30</label>
                                </li>
        
                                <li>
                                    <input name="segunda" type="checkbox" id="s5" value="5">
                                    <label for="s5">10:00</label>
                                </li>
                                
                                <li>
                                    <input name="segunda" type="checkbox" id="s6" value="6">
                                    <label for="s6">10:30</label>
                                </li>
                                
                                <li>
                                    <input name="segunda" type="checkbox" id="s7" value="7">
                                    <label for="s7">11:00</label>
                                </li>
                                    
                                <li>
                                    <input name="segunda" type="checkbox" id="s8" value="9">
                                    <label for="s8">11:30</label>
                                </li>
        
                                <li>
                                    <input name="segunda" type="checkbox" id="s9" value="9">
                                    <label for="s9">12:00</label>
                                </li>
                                
                                <li>
                                    <input name="segunda" type="checkbox" id="s10" value="10">
                                    <label for="s10">12:30</label>
                                </li>
                                
                                <li>
                                    <input name="segunda" type="checkbox" id="s11" value="11">
                                    <label for="s11">13:00</label>
                                </li>
                                    
                                <li>
                                    <input name="segunda" type="checkbox" id="s12" value="12">
                                    <label for="s12">13:30</label>
                                </li>
                                
                                <li>
                                    <input name="segunda" type="checkbox" id="s13" value="13">
                                    <label for="s13">14:00</label>
                                </li>
                                    
                                <li>
                                    <input name="segunda" type="checkbox" id="s14" value="14">
                                    <label for="s14">14:30</label>
                                </li>
                                    
                                <li>
                                    <input name="segunda" type="checkbox" id="s15" value="15">
                                    <label for="s15">15:00</label>
                                </li>
                                        
                                <li>
                                    <input name="segunda" type="checkbox" id="s16" value="16">
                                    <label for="s16">15:30</label>
                                </li>
        
                                <li>
                                    <input name="segunda" type="checkbox" id="s17" value="17">
                                    <label for="s17">16:00</label>
                                </li>
                                
                                <li>
                                    <input name="segunda" type="checkbox" id="s18" value="18">
                                    <label for="s18">16:30</label>
                                </li>
                                
                                <li>
                                    <input name="segunda" type="checkbox" id="s19" value="19">
                                    <label for="s19">17:00</label>
                                </li>
                                    
                                <li>
                                    <input name="segunda" type="checkbox" id="s20" value="20">
                                    <label for="s20">17:30</label>
                                </li>
                                
                                <li>
                                    <input name="segunda" type="checkbox" id="s21" value="21">
                                    <label for="s21">18:00</label>
                                </li>
                                    
                                <li>
                                    <input name="segunda" type="checkbox" id="s22" value="22">
                                    <label for="s22">18:30</label>
                                </li>
                            </ul>
                    </form>
                    <form id="FormsTerca" action="">
                            <ul class="Forms">
                                <p>Terca</p>
                                <li>
                                    <input name="terca" type="checkbox" id="t1" value="1" checked>
                                    <label for="t1">8:00</label>
                                </li>
        
                                <li>
                                    <input name="terca" type="checkbox" id="t2" value="2">
                                    <label for="t2">8:30</label>
                                </li>
        
                                <li>
                                    <input name="terca" type="checkbox" id="t3" value="3">
                                    <label for="t3">9:00</label>
                                </li>
                                
                                <li>
                                    <input name="terca" type="checkbox" id="t4" value="4">
                                    <label for="t4">9:30</label>
                                </li>
        
                                <li>
                                    <input name="terca" type="checkbox" id="t5" value="5">
                                    <label for="t5">10:00</label>
                                </li>
                                
                                <li>
                                    <input name="terca" type="checkbox" id="t6" value="6">
                                    <label for="t6">10:30</label>
                                </li>
                                
                                <li>
                                    <input name="terca" type="checkbox" id="t7" value="7">
                                    <label for="t7">11:00</label>
                                </li>
                                    
                                <li>
                                    <input name="terca" type="checkbox" id="t8" value="9">
                                    <label for="t8">11:30</label>
                                </li>
        
                                <li>
                                    <input name="terca" type="checkbox" id="t9" value="9">
                                    <label for="t9">12:00</label>
                                </li>
                                
                                <li>
                                    <input name="terca" type="checkbox" id="t10" value="10">
                                    <label for="t10">12:30</label>
                                </li>
                                
                                <li>
                                    <input name="terca" type="checkbox" id="t11" value="11">
                                    <label for="t11">13:00</label>
                                </li>
                                    
                                <li>
                                    <input name="terca" type="checkbox" id="t12" value="12">
                                    <label for="t12">13:30</label>
                                </li>
                                
                                <li>
                                    <input name="terca" type="checkbox" id="t13" value="13">
                                    <label for="t13">14:00</label>
                                </li>
                                    
                                <li>
                                    <input name="terca" type="checkbox" id="t14" value="14">
                                    <label for="t14">14:30</label>
                                </li>
                                    
                                <li>
                                    <input name="terca" type="checkbox" id="t15" value="15">
                                    <label for="t15">15:00</label>
                                </li>
                                        
                                <li>
                                    <input name="terca" type="checkbox" id="t16" value="16">
                                    <label for="t16">15:30</label>
                                </li>
        
                                <li>
                                    <input name="terca" type="checkbox" id="t17" value="17">
                                    <label for="t17">16:00</label>
                                </li>
                                
                                <li>
                                    <input name="terca" type="checkbox" id="t18" value="18">
                                    <label for="t18">16:30</label>
                                </li>
                                
                                <li>
                                    <input name="terca" type="checkbox" id="t19" value="19">
                                    <label for="t19">17:00</label>
                                </li>
                                    
                                <li>
                                    <input name="terca" type="checkbox" id="t20" value="20">
                                    <label for="t20">17:30</label>
                                </li>
                                
                                <li>
                                    <input name="terca" type="checkbox" id="t21" value="21">
                                    <label for="t21">18:00</label>
                                </li>
                                    
                                <li>
                                    <input name="terca" type="checkbox" id="t22" value="22">
                                    <label for="t22">18:30</label>
                                </li>
                            </ul>
                    </form>
                    <form id="FormsQuarta" action="">
                            <ul class="Forms">
                                <p>Quarta</p>
                                <li>
                                    <input name="quarta" type="checkbox" id="qa1" value="1" checked>
                                    <label for="qa1">8:00</label>
                                </li>
        
                                <li>
                                    <input name="quarta" type="checkbox" id="qa2" value="2">
                                    <label for="qa2">8:30</label>
                                </li>
        
                                <li>
                                    <input name="quarta" type="checkbox" id="qa3" value="3">
                                    <label for="qa3">9:00</label>
                                </li>
                                
                                <li>
                                    <input name="quarta" type="checkbox" id="qa4" value="4">
                                    <label for="qa4">9:30</label>
                                </li>
        
                                <li>
                                    <input name="quarta" type="checkbox" id="qa5" value="5">
                                    <label for="qa5">10:00</label>
                                </li>
                                
                                <li>
                                    <input name="quarta" type="checkbox" id="qa6" value="6">
                                    <label for="qa6">10:30</label>
                                </li>
                                
                                <li>
                                    <input name="quarta" type="checkbox" id="qa7" value="7">
                                    <label for="qa7">11:00</label>
                                </li>
                                    
                                <li>
                                    <input name="quarta" type="checkbox" id="qa8" value="9">
                                    <label for="qa8">11:30</label>
                                </li>
        
                                <li>
                                    <input name="quarta" type="checkbox" id="qa9" value="9">
                                    <label for="qa9">12:00</label>
                                </li>
                                
                                <li>
                                    <input name="quarta" type="checkbox" id="qa10" value="10">
                                    <label for="qa10">12:30</label>
                                </li>
                                
                                <li>
                                    <input name="quarta" type="checkbox" id="qa11" value="11">
                                    <label for="qa11">13:00</label>
                                </li>
                                    
                                <li>
                                    <input name="quarta" type="checkbox" id="qa12" value="12">
                                    <label for="qa12">13:30</label>
                                </li>
                                
                                <li>
                                    <input name="quarta" type="checkbox" id="qa13" value="13">
                                    <label for="qa13">14:00</label>
                                </li>
                                    
                                <li>
                                    <input name="quarta" type="checkbox" id="qa14" value="14">
                                    <label for="qa14">14:30</label>
                                </li>
                                    
                                <li>
                                    <input name="quarta" type="checkbox" id="qa15" value="15">
                                    <label for="qa15">15:00</label>
                                </li>
                                        
                                <li>
                                    <input name="quarta" type="checkbox" id="qa16" value="16">
                                    <label for="qa16">15:30</label>
                                </li>
        
                                <li>
                                    <input name="quarta" type="checkbox" id="qa17" value="17">
                                    <label for="qa17">16:00</label>
                                </li>
                                
                                <li>
                                    <input name="quarta" type="checkbox" id="qa18" value="18">
                                    <label for="qa18">16:30</label>
                                </li>
                                
                                <li>
                                    <input name="quarta" type="checkbox" id="qa19" value="19">
                                    <label for="qa19">17:00</label>
                                </li>
                                    
                                <li>
                                    <input name="quarta" type="checkbox" id="qa20" value="20">
                                    <label for="qa20">17:30</label>
                                </li>
                                
                                <li>
                                    <input name="quarta" type="checkbox" id="qa21" value="21">
                                    <label for="qa21">18:00</label>
                                </li>
                                    
                                <li>
                                    <input name="quarta" type="checkbox" id="qa22" value="22">
                                    <label for="qa22">18:30</label>
                                </li>
                            </ul>
                    
                    </form>
                    <form id="FormsQuinta" action="">
                            <ul class="Forms">
                                <p>Quinta</p>
                                <li>
                                    <input name="quinta" type="checkbox" id="qi1" value="1" checked>
                                    <label for="qi1">8:00</label>
                                </li>
        
                                <li>
                                    <input name="quinta" type="checkbox" id="qi2" value="2">
                                    <label for="qi2">8:30</label>
                                </li>
        
                                <li>
                                    <input name="quinta" type="checkbox" id="qi3" value="3">
                                    <label for="qi3">9:00</label>
                                </li>
                                
                                <li>
                                    <input name="quinta" type="checkbox" id="qi4" value="4">
                                    <label for="qi4">9:30</label>
                                </li>
        
                                <li>
                                    <input name="quinta" type="checkbox" id="qi5" value="5">
                                    <label for="qi5">10:00</label>
                                </li>
                                
                                <li>
                                    <input name="quinta" type="checkbox" id="qi6" value="6">
                                    <label for="qi6">10:30</label>
                                </li>
                                
                                <li>
                                    <input name="quinta" type="checkbox" id="qi7" value="7">
                                    <label for="qi7">11:00</label>
                                </li>
                                    
                                <li>
                                    <input name="quinta" type="checkbox" id="qi8" value="9">
                                    <label for="qi8">11:30</label>
                                </li>
        
                                <li>
                                    <input name="quinta" type="checkbox" id="qi9" value="9">
                                    <label for="qi9">12:00</label>
                                </li>
                                
                                <li>
                                    <input name="quinta" type="checkbox" id="qi10" value="10">
                                    <label for="qi10">12:30</label>
                                </li>
                                
                                <li>
                                    <input name="quinta" type="checkbox" id="qi11" value="11">
                                    <label for="qi11">13:00</label>
                                </li>
                                    
                                <li>
                                    <input name="quinta" type="checkbox" id="qi12" value="12">
                                    <label for="qi12">13:30</label>
                                </li>
                                
                                <li>
                                    <input name="quinta" type="checkbox" id="qi13" value="13">
                                    <label for="qi13">14:00</label>
                                </li>
                                    
                                <li>
                                    <input name="quinta" type="checkbox" id="qi14" value="14">
                                    <label for="qi14">14:30</label>
                                </li>
                                    
                                <li>
                                    <input name="quinta" type="checkbox" id="qi15" value="15">
                                    <label for="qi15">15:00</label>
                                </li>
                                        
                                <li>
                                    <input name="quinta" type="checkbox" id="qi16" value="16">
                                    <label for="qi16">15:30</label>
                                </li>
        
                                <li>
                                    <input name="quinta" type="checkbox" id="qi17" value="17">
                                    <label for="qi17">16:00</label>
                                </li>
                                
                                <li>
                                    <input name="quinta" type="checkbox" id="qi18" value="18">
                                    <label for="qi18">16:30</label>
                                </li>
                                
                                <li>
                                    <input name="quinta" type="checkbox" id="qi19" value="19">
                                    <label for="qi19">17:00</label>
                                </li>
                                    
                                <li>
                                    <input name="quinta" type="checkbox" id="qi20" value="20">
                                    <label for="qi20">17:30</label>
                                </li>
                                
                                <li>
                                    <input name="quinta" type="checkbox" id="qi21" value="21">
                                    <label for="qi21">18:00</label>
                                </li>
                                    
                                <li>
                                    <input name="quinta" type="checkbox" id="qi22" value="22">
                                    <label for="qi22">18:30</label>
                                </li>
                            </ul>
                    </form>    
                    <form id="FormsSexta" action="">
                            <ul class="Forms">
                                <p>Sexta</p>
                                <li>
                                    <input name="sexta" type="checkbox" id="sx1" value="1" checked>
                                    <label for="sx1">8:00</label>
                                </li>
        
                                <li>
                                    <input name="sexta" type="checkbox" id="sx2" value="2">
                                    <label for="sx2">8:30</label>
                                </li>
        
                                <li>
                                    <input name="sexta" type="checkbox" id="sx3" value="3">
                                    <label for="sx3">9:00</label>
                                </li>
                                
                                <li>
                                    <input name="sexta" type="checkbox" id="sx4" value="4">
                                    <label for="sx4">9:30</label>
                                </li>
        
                                <li>
                                    <input name="sexta" type="checkbox" id="sx5" value="5">
                                    <label for="sx5">10:00</label>
                                </li>
                                
                                <li>
                                    <input name="sexta" type="checkbox" id="sx6" value="6">
                                    <label for="sx6">10:30</label>
                                </li>
                                
                                <li>
                                    <input name="sexta" type="checkbox" id="sx7" value="7">
                                    <label for="sx7">11:00</label>
                                </li>
                                    
                                <li>
                                    <input name="sexta" type="checkbox" id="sx8" value="9">
                                    <label for="sx8">11:30</label>
                                </li>
        
                                <li>
                                    <input name="sexta" type="checkbox" id="sx9" value="9">
                                    <label for="sx9">12:00</label>
                                </li>
                                
                                <li>
                                    <input name="sexta" type="checkbox" id="sx10" value="10">
                                    <label for="sx10">12:30</label>
                                </li>
                                
                                <li>
                                    <input name="sexta" type="checkbox" id="sx11" value="11">
                                    <label for="sx11">13:00</label>
                                </li>
                                    
                                <li>
                                    <input name="sexta" type="checkbox" id="sx12" value="12">
                                    <label for="sx12">13:30</label>
                                </li>
                                
                                <li>
                                    <input name="sexta" type="checkbox" id="sx13" value="13">
                                    <label for="sx13">14:00</label>
                                </li>
                                    
                                <li>
                                    <input name="sexta" type="checkbox" id="sx14" value="14">
                                    <label for="sx14">14:30</label>
                                </li>
                                    
                                <li>
                                    <input name="sexta" type="checkbox" id="sx15" value="15">
                                    <label for="sx15">15:00</label>
                                </li>
                                        
                                <li>
                                    <input name="sexta" type="checkbox" id="sx16" value="16">
                                    <label for="sx16">15:30</label>
                                </li>
        
                                <li>
                                    <input name="sexta" type="checkbox" id="sx17" value="17">
                                    <label for="sx17">16:00</label>
                                </li>
                                
                                <li>
                                    <input name="sexta" type="checkbox" id="sx18" value="18">
                                    <label for="sx18">16:30</label>
                                </li>
                                
                                <li>
                                    <input name="sexta" type="checkbox" id="sx19" value="19">
                                    <label for="sx19">17:00</label>
                                </li>
                                    
                                <li>
                                    <input name="sexta" type="checkbox" id="sx20" value="20">
                                    <label for="sx20">17:30</label>
                                </li>
                                
                                <li>
                                    <input name="sexta" type="checkbox" id="sx21" value="21">
                                    <label for="sx21">18:00</label>
                                </li>
                                    
                                <li>
                                    <input name="sexta" type="checkbox" id="sx22" value="22">
                                    <label for="sx22">18:30</label>
                                </li>
                            </ul>
                    </form>    

                    </form>
                </div>
                <input type="submit" value="Enviar" onclick="CadastrarMedico()">
                <div id="CadMedResultado"></div>
            </div>

            <div class = "CadastrarAtendente">
                <h3 class = "Forms">Cadastrar Atendente</h3>
                <div>
                    <form action="">
                        <label class = "Forms" for="name">Nome: </label>
                        <input type="text" id="CadAteName" name="name" placeholder="* Your name.." required>

                        <label class = "Forms" for="Cpf">Cpf: </label>
                        <input type="text" id="CadAteCpf" name="Cpf" placeholder="* Cpf" pattern="[0-9]{11}" required>

                        <label class = "Forms" for="password">Senha: </label>
                        <input type="password" id="CadAtePassword" name="password" placeholder="* Your password.." required>

                        <label class = "Forms" for="DataNascimento">Data de Nascimento: </label>
                        <input type="date" id="CadAteDataNascimento" name="DataNascimento" placeholder="* Data Nascimento.." required>

                        <label class = "Forms" for="Endereco">Endereço: </label>
                        <input type="text" id="CadAteEndereco" name="Endereco" placeholder="Endereço..">

                        <label class = "Forms" for="Email">Email: </label>
                        <input type="email" id="CadAteEmail" name="Email" placeholder="Your Email..">

                        <label class = "Forms" for="Telefone">Telefone: </label>
                        <input type="text" id="CadAteTel" name="Telefone" placeholder="Telefone..">
                    </form>
                </div>
                <input type="submit" value="Enviar" onclick="CadastrarAtendente()">
                <div id="CadAteResultado"></div>
            </div>

            <div class = "AgendarConsulta">
                <h3 class="Forms">Agendar Consulta</h3>
                <form>
                    <label class = "Forms" for="Cpf">Cpf: </label>
                    <input type="text" id="AgendaConsCpf" name="Cpf" placeholder="* Cpf ..." required onkeyup="VerificaCpf()">
                    <div id="AgendaConsPac"></div>

                    <label class = "Forms" for="Especialidade">Especialidade: </label>
                    <select class='custom-select' id='AgendaConsEsp' name='Especialidade' onchange="CarregaMedicos()">
                        <option value='Any' selected='selected'>Qualquer Especialidade</option>
                    </select>

                    <label class = "Forms" for="Medicos">Médico: </label>
                    <select class='custom-select' id='AgendaConsMed' name='Medicos' onchange="CarregaHorarios()">
                        <option value='Any' selected='selected'>Nenhum médico selecionado</option>
                    </select>

                    <label class = "Forms" for="date">Dia: </label>
                    <input type="date" name="date" id="AgendaConsDia" onchange="CarregaHorarios()">

                    <label class = "Forms" for="Horarios">Horários Disponíveis: </label>
                    <select class='custom-select' id='AgendaConsHor' name='Horarios'>
                        <option value='Any' selected='selected'>Nenhum horário selecionado</option>
                    </select>

                </form>

                <input type="submit" value="Enviar" onclick="AgendarConsulta()">
                <div id="AgendaConsResultado"></div>
            </div>
            <div class="VerConsultas">
                <h3 class = "Forms">Consultas</h3>

                <label class = "Forms" for="ConsultasMedicos">Médico: </label>
                
                <select class='custom-select' id='AgendaConsultasMedico' name='ConsultasMedicos' onchange="CarregaConsultas()" >
                    <option value='Any' selected='selected'>Nenhum médico selecionado</option>
                </select>

                <div class="Forms">
                <div class="table">
                    <table id="Tabela">
                        
                    </table>
                </div> 
                </div>
            </div>
        </div>
    </div>

    <!-- rodape -->
    <footer> 
        <h4>Unidades</h4> 
        <h5> -> Rio Grande do Sul - Rio Grande FURG</h5>
        <br>
        <h4>Siga-nos</h4> 
        <img src="Imagens/redesSociais.png" alt="">
        <br>
        <h4>Certificações</h4>
        <img src = "Imagens/certificados.png" alt="">
        <hr>
        <h6 style="text-align: right">&copy; 2018 Clínica Vida Saudável. Todos os Direitos Reservados</h6>     
    </footer>
    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script>

    $(document).ready(function(){
        $(".CadastrarAtendente, .CadastrarPaciente, .CadastrarMedico, .AgendarConsulta, .VerConsultas").hide();

        CarregaEspecialidades();
        CarregaMedicos();
    });

    //-----Atendente
    $(document).ready(function(){
        $("#CadastrarPaciente").click(function(){
            $(".CadastrarPaciente").show();
            $(".CadastrarMedico").hide();
            $(".AgendarConsulta").hide();
            $(".CadastrarAtendente").hide();
            $(".VerConsultas").hide();

        });
        $("#CadastrarMedico").click(function(){
            $(".CadastrarPaciente").hide();
            $(".CadastrarMedico").show();
            $(".AgendarConsulta").hide();
            $(".CadastrarAtendente").hide();
            $(".VerConsultas").hide();
        });
        $("#AgendarConsulta").click(function(){
            $(".CadastrarPaciente").hide();
            $(".CadastrarMedico").hide();
            $(".AgendarConsulta").show();
            $(".CadastrarAtendente").hide();
            $(".VerConsultas").hide();
        });
        $("#CadastrarAtendente").click(function(){
            $(".CadastrarPaciente").hide();
            $(".CadastrarMedico").hide();
            $(".AgendarConsulta").hide();
            $(".CadastrarAtendente").show();
            $(".VerConsultas").hide();
        });
        $("#VerConsultas").click(function(){
            $(".CadastrarPaciente").hide();
            $(".CadastrarMedico").hide();
            $(".AgendarConsulta").hide();
            $(".CadastrarAtendente").hide();
            $(".VerConsultas").show();
        });
    });
    
    function CadastrarPaciente(){
        var variaveis = {"name" : document.getElementById("CadPacName").value,
                            "cpf"  : document.getElementById("CadPacCpf").value,
                            "pass" : document.getElementById("CadPacPassword").value,
                            "endereco" : document.getElementById("CadPacEndereco").value,
                            "email" : document.getElementById("CadPacEmail").value,
                            "nascimento" : document.getElementById("CadPacDataNascimento").value,
                            "plano" : document.getElementById("CadPacPlanoDeSaude").value,
                            "sangue" : document.getElementById("CadPacTipoSanguineo").value,
                            "telefone" : document.getElementById("CadPacTel").value};
        
        var generos = document.getElementsByName("CadPacGenero");
        for(var index in generos){
            if (generos[index].value == "on"){
                variaveis["genero"] = generos[index].id;
            }
        }
        
        var envio = "";

        for (var variavel in variaveis){
            envio += variavel + "=" + variaveis[variavel] + "&";
        }

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("CadPacResultado").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "serverScripts/CadastraPaciente.php?" + envio, true);
        xmlhttp.send();  
    }

    function CadastrarMedico(){
        var segunda = "";
        var terca = "";
        var quarta = "";
        var quinta = "";
        var sexta = "";
        
        // Pegando horarios de Segunda-Feira
        var inputElements = document.getElementsByName("segunda");
        for(var i = 0; i < inputElements.length; i++){
            if(inputElements[i].type == "checkbox") 
            {
                if(inputElements[i].checked)
                {
                    segunda = segunda + "1";
                }
                else
                {
                    segunda = segunda + "0";
                }
            }
        }

        // Pegando horarios de Terça-Feira
        var inputElements = document.getElementsByName("terca");
        for(var i = 0; i < inputElements.length; i++){
            if(inputElements[i].type == "checkbox") 
            {
                if(inputElements[i].checked)
                {
                    terca = terca + "1";
                }
                else
                {
                    terca = terca + "0";
                }
            }
        }

        // Pegando horarios de Quarta-Feira
        var inputElements = document.getElementsByName("quarta");
        for(var i = 0; i < inputElements.length; i++){
            if(inputElements[i].type == "checkbox") 
            {
                if(inputElements[i].checked)
                {
                    quarta = quarta + "1";
                }
                else
                {
                    quarta = quarta + "0";
                }
            }
        }

        // Pegando horarios de Quinta-Feira
        var inputElements = document.getElementsByName("quinta");
        for(var i = 0; i < inputElements.length; i++){
            if(inputElements[i].type == "checkbox") 
            {
                if(inputElements[i].checked)
                {
                    quinta = quinta + "1";
                }
                else
                {
                    quinta = quinta + "0";
                }
            }
        }

        // Pegando horarios de Sexta-Feira
        var inputElements = document.getElementsByName("sexta");
        for(var i = 0; i < inputElements.length; i++){
            if(inputElements[i].type == "checkbox") 
            {
                if(inputElements[i].checked)
                {
                    sexta = sexta + "1";
                }
                else
                {
                    sexta = sexta + "0";
                }
            }
        }


        var variaveis = {"name"          : document.getElementById("CadMedName").value,
                            "cpf"           : document.getElementById("CadMedCpf").value,
                            "pass"          : document.getElementById("CadMedPassword").value,
                            "endereco"      : document.getElementById("CadMedEndereco").value,
                            "email"         : document.getElementById("CadMedEmail").value,
                            "nascimento"    : document.getElementById("CadMedDataNascimento").value,
                            "plano"         : document.getElementById("CadMedPlanoDeSaude").value,
                            "especialidade" : document.getElementById("CadMedEspecialidade").value,
                            "telefone"      : document.getElementById("CadMedTel").value,
                            "horSeg"        : segunda,
                            "horTer"        : terca,
                            "horQua"        : quarta,
                            "horQui"        : quinta,
                            "horSex"        : sexta};
        
        var envio = "";

        for (var variavel in variaveis){
            envio += variavel + "=" + variaveis[variavel] + "&";
        }

        console.log(envio);
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("CadMedResultado").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "serverScripts/CadastraMedico.php?" + envio, true);
        xmlhttp.send(); 
    }
    
    function CadastrarAtendente(){
        var variaveis = {"name" : document.getElementById("CadAteName").value,
                            "cpf"  : document.getElementById("CadAteCpf").value,
                            "pass" : document.getElementById("CadAtePassword").value,
                            "endereco" : document.getElementById("CadAteEndereco").value,
                            "email" : document.getElementById("CadAteEmail").value,
                            "nascimento" : document.getElementById("CadAteDataNascimento").value,
                            "telefone" : document.getElementById("CadAteTel").value};
        
        var envio = "";

        for (var variavel in variaveis){
            envio += variavel + "=" + variaveis[variavel] + "&";
        }

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("CadAteResultado").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "serverScripts/CadastraAtendente.php?" + envio, true);
        xmlhttp.send();
    }
    
    function CarregaEspecialidades() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "serverScripts/CarregaEspecialidades.php?", true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("AgendaConsEsp").innerHTML = this.responseText;
            }
        };
    }

    function CarregaMedicos() {
        var formEsp = document.getElementById("AgendaConsEsp");
        
        var especialidades = formEsp.options[formEsp.selectedIndex].value;

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("AgendaConsMed").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "serverScripts/CarregaMedicos.php?Especialidade=" + especialidades, true);
        xmlhttp.send();              
    }

    function CarregaHorarios() {
        var formMed = document.getElementById("AgendaConsMed");   
        var medico = formMed.options[formMed.selectedIndex].value;
        
        var dia = document.getElementById("AgendaConsDia").value;

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("AgendaConsHor").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "serverScripts/CarregaHorarios.php?Medico=" + medico + "&Dia=" + dia, true);
        xmlhttp.send(); 
    }

    function VerificaCpf() {
        var cpf = document.getElementById("AgendaConsCpf").value;
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "serverScripts/VerificaCpfPaciente.php?cpf="+cpf, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("AgendaConsPac").innerHTML = this.responseText;
            }
        };
    }

    function AgendarConsulta() {
        var cpf = document.getElementById("AgendaConsCpf").value;

        var formMed = document.getElementById("AgendaConsMed");   
        var medico = formMed.options[formMed.selectedIndex].value;
        
        var dia = document.getElementById("AgendaConsDia").value;

        var horario = document.getElementById("AgendaConsHor").value;

        var atendente = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";
        
        var envio = "cpf=" + cpf + "&medico=" + medico + "&dia=" + dia + "&horario=" + horario + "&atendente=" + atendente;
        
        console.log(envio);

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("AgendaConsResultado").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "serverScripts/AgendaConsulta.php?"+envio, true);
        xmlhttp.send();
    }
    function CarregaConsultas() {
            var formMed = document.getElementById("AgendaConsultasMedico");
            
            var Medico = formMed.options[formMed.selectedIndex].value;
            var codigo = "<?php echo htmlspecialchars($_SESSION['codigo']); ?>";

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("Tabela").innerHTML = this.responseText;
                }
            };

            envio = "medico=" + Medico + "&Codigo=" + codigo;
            
            console.log(envio);
            xmlhttp.open("GET", "serverScripts/CarregaConsulta.php?" + envio, true);
            xmlhttp.send();
        }
        function CarregaMedicosConsultas() {            
            var especialidades = "Any";

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("AgendaConsultasMedico").innerHTML = this.responseText;
                }
            };

            xmlhttp.open("GET", "serverScripts/CarregaMedicos.php?Especialidade=" + especialidades, true);
            xmlhttp.send();              
        }

</script>


</html>