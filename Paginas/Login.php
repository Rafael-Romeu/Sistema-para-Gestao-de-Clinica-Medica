<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lMedico.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lPaciente.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lAtendente.php";include_once $_SERVER['DOCUMENT_ROOT'] . "/BancoDeDados/MySQL/logicas/lClinica.php";

    $cpf = $password = "";
    $cpf_err = $password_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        //Valida o cpf
        if(empty(trim($_POST["cpf"])))
        {
            $cpf_err = 'Insira o CPF.';
        } 
        else
        {
            $cpf = trim($_POST["cpf"]);
        }

        //Valida a senha
        if(empty(trim($_POST['password'])))
        {
            $password_err = 'Insira a senha';
        } 
        else
        {
            $password = trim($_POST['password']);
        }

        //Caso CPF e senha sejam validos
        if(empty($username_err) && empty($password_err)){
            
            $usuario = procuraUsuario($cpf);

            //Usuario encontrado
            if ($usuario != false)
            {
                if (checaSenha($password, $usuario))
                {
                    session_start();
                    $_SESSION['cpf'] = $cpf;

                    $tipo = get_class($usuario);
                    $_SESSION['tipo'] = $tipo;

                    $_SESSION['nome'] = $usuario->getNome();
                    $_SESSION['codigo'] = $usuario->getCodigo();
                    $_SESSION['dtNascimento'] = $usuario->getDataNascimento();
                    $_SESSION['endereco'] = $usuario->getEndereco();
                    $_SESSION['telefone1'] = $usuario->getTelefone1();
                    $_SESSION['telefone2'] = $usuario->getTelefone2();
                    $_SESSION['email'] = $usuario->getEmail();
                    
                    if ($tipo == "lPaciente")
                    {
                        $_SESSION['tipoSanguineo'] = $usuario->getTipoSanguineo();
                        $_SESSION['genero'] = $usuario->getGenero();
                    }
                    
                    if ($tipo == "lPaciente" or $tipo == "lMedico")
                    {
                        $_SESSION['planoDeSaude'] = $usuario->getPlanoDeSaude();
                    }

                    $codClinica = $_POST['clinica'];
                    $_SESSION['codClinica'] = $codClinica;
                    
                    $clinica = new lClinica();
                    $clinica->setCodigo($codClinica);
                    $clinica->identifica();

                    $_SESSION['nomeClinica'] = $clinica->getNome();

                    $_SESSION['corPrimaria'] = $clinica->getCorPrimaria();
                    $_SESSION['corSucesso'] = $clinica->getCorSucesso();
                    $_SESSION['corFalha'] = $clinica->getCorFalha();
                    $_SESSION['cor1'] = $clinica->getCor1();
                    $_SESSION['cor2'] = $clinica->getCor2();
                    $_SESSION['cor3'] = $clinica->getCor3();
                    $_SESSION['cor4'] = $clinica->getCor4();
                    $_SESSION['cor5'] = $clinica->getCor5();



                    redireciona($tipo);
                }
                else
                {
                    $password_err = "Senha inválida.";
                }
            }
            else
            {
                $cpf_err = "Nenhum usuário encontrado com esse CPF.";
            }
        }
        else
        {
            echo "Erro ao efetuar login.";
        }
    }

    function procuraUsuario($cpf)
    {
        $oAtendente = new lAtendente();
        $oAtendente->setCpf($cpf);
    
        if($oAtendente->identifica())
        {
            return $oAtendente;
        }
    
        $oMedico = new lMedico();
        $oMedico->setCpf($cpf);
    
        if($oMedico -> identifica())
        {
            return $oMedico;
        }
    
        $oPaciente = new lPaciente();
        $oPaciente->setCpf($cpf);
    
        if($oPaciente -> identifica())
        {
            return $oPaciente;
        }
    
        return false;
    }

    function checaSenha($senha, $usuario)
    {
        if ($senha == $usuario->getSenha())
        {
            return true;
        }
        return false;
    }

    function redireciona($tipo)
    {
        if ($tipo == "lAtendente")
            header("location: /Paginas/Atendente/Home.php");
        if ($tipo == "lMedico")
            header("location: /Paginas/Medico/Home.php");
        if ($tipo == "lPaciente")
            header("location: /Paginas/Paciente/Home.php");
        
    }
    
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<link rel="stylesheet" href="css/Login.css">
<title> Login </title> <!-- Titulo da pagina --> 
<meta charset = "UTF-8">
</head>
<body>

    <div class = "central">
        <div class = "Login">
            <h2>Login</h2>
    
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="imgcontainer">
                    <img src="Imagens/avatar.png" alt="Avatar" class="avatar">
                </div>
            
                <div class="container">
                    <label for="CPF"><b></b></label>
                    <input type="text" placeholder="Insira o CPF" name="cpf" required>

                    <label for="password"><b></b></label>
                    <input type="password" placeholder="Insira a senha" name="password" required>

                    <br>
                    Selecione uma clínica:
                    <br>
                    <select class="selectClinica" name="clinica" id="selectClinica">
                    </select>

                    <button type="submit">Login</button>
                    
                    <a href="/Paginas/Cadastros/CadastroPaciente.php">Criar nova conta</a>
                </div>
            
            </form>
        </div>

    </div>


</body>
</html>

<script>

    carregaClinicas();

</script>