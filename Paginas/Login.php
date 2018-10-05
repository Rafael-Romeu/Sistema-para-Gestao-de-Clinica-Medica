<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once "../BancoDeDados/logicas/lAtendente.php";
    include_once "../BancoDeDados/logicas/lPaciente.php";
    include_once "../BancoDeDados/logicas/lMedico.php";

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

                    $_SESSION['nome'] = $usuario->nome;

                    $_SESSION['codigo'] = $usuario->codigo;
                    $_SESSION['planoDeSaude'] = $usuario->planoDeSaude;
                    $_SESSION['genero'] = $usuario->genero;
                    $_SESSION['tipoSanguineo'] = $usuario->tipoSanguineo;
                    $_SESSION['dtNascimento'] = $usuario->dtNascimento;
                    $_SESSION['endereco'] = $usuario->endereco;
                    $_SESSION['telefone'] = $usuario->telefone;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['especialidade'] = $usuario->especialidade;
                    
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
        $atendente = $oAtendente->getAtendenteByCPF($cpf);
    
        if(sizeof($atendente) > 0)
        {
            return $atendente[0];
        }
    
        $oMedico = new lMedico();
        $medico = $oMedico->getMedicoByCpf($cpf);
    
        if(sizeof($medico) > 0)
        {
            return $medico[0];
        }
    
        $oPaciente = new lPaciente();
        $paciente = $oPaciente->getPacienteByCpf($cpf);
    
        if(sizeof($paciente) > 0)
        {
            return $paciente[0];
        }
    
        return false;
    }

    function checaSenha($senha, $usuario)
    {
        if ($senha == $usuario->senha)
        {
            return true;
        }
        return false;
    }

    function redireciona($tipo)
    {
        if ($tipo == "lAtendente")
            header("location: /Paginas/Atendente.php");
        if ($tipo == "lMedico")
            header("location: /Paginas/Medico.php");
        if ($tipo == "lPaciente")
            header("location: /Paginas/Paciente.php");
        
    }
    
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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

                    <button type="submit">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember">Lembrar usuário
                    </label>
                </div>
            
            </form>
        </div>

    </div>


</body>
</html>