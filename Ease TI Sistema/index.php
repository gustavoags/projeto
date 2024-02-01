<?php

if(isset($_POST['email']) && isset($_POST['senha'])){

    include('lib/conexao.php');

    $email = $mysqli->escape_string($_POST['email']);
    $senha = $_POST['senha'];

    $sql_code = "SELECT *FROM clientes WHERE email = '$email'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query->num_rows == 0){
        echo "O e-mail informado é incorreto";
    } else{
        $usuario = $sql_query->fetch_assoc();
        if(!password_verify($senha, $usuario['senha'])){
            echo "A senha informada está incorreta";
        } else{
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['usuario'] = $usuario['id'];
            $_SESSION['admin'] = $usuario['admin'];
            header("Location: clientes.php");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login">
            <form action="" method="POST">
                <h1>Login</h1>
                <label for="">E-mail</label>
                <input type="text" name="email" placeholder="E-mail"><br>
                <label for="">Senha</label>
                <input type="password" name="senha" placeholder="Senha"><br>
                <button type="submit">Entrar</button>
            </form>
        </div>
        <div class="pic">
            <img src="/imgs/logo-easeti-color-vi.png">
        </div>
    </div>
</body>
</html>