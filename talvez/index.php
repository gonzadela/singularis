<?php
include "conexao.php";
if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "<p style='color: white; margin-top: 200px; margin-left: 1240px; position: absolute'>Preencha seu e-mail</p>";
    } else if(strlen($_POST['senha']) == 0) {
        echo "<p style='color: white; margin-top: 200px; margin-left: 1240px; position: absolute'>Preencha sua senha</p>";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM users WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: segundahome.php");

        } else {
            echo "<p style='color: white; margin-top: 200px; margin-left: 1240px; position: absolute'>Falha ao logar, e-mail ou senha incorretos.</p>";
        }

    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="./src/img/logo.svg">
    <link rel="stylesheet" href="./src/css/init.css">
    <link rel="stylesheet" href="./src/css/fomrLogin.css">
</head>

<body class="corpo_login">
    <main>
    <form class="form" method ="POST" id="systemLogin">
            <header class="formHeader">
                <h2 class="formHeaderTitle">Login no Sistema </h2>
                <p class="loggin">Faça o login para acessar o sistema</p>
            </header>
            <div class="formBox1">
                <label for="email" class="formLabel1"> Email: <br>
                    <input class="formInput" type="text" name="email" id="email" placeholder="Seu e-mail:" >
                </label>
            </div>
            <div class="formBox">
                <label for="password" class="formLabel">
                    Senha: <br>
                    <input class="formInput" type="password" name="senha" id="password" >
                </label>
            </div>
            <div class="formBox">
                <button class="formButtonSubmit" type="submit" title="Clique para efetuar o login">
                    Entrar
                </button>
            </div>
            <div class="formBoxExtra" id="formBoxExtra">
                <a class="formLinkExtra" href="#">Esqueci a senha</a>
                <a class="formLinkExtra" href="#">Cadastrar</a>
            </div>  
        </form>
        
    </form>
    </main>
    
</body>
</html>