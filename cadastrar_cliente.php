<?php

function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
} 

if(count($_POST) > 0) {
    //Conectando com o Banco de Dados
    include('conexao.php');

    //Validações
    $erro = false;
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];

    // VALIDANDO O NOME

    if(empty($nome)) {
        $erro = "Preencha o nome";
    }
    // VALIDANDO O EMAIL

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o E-mail";
    }
    // VALIDANDO A DATA DE NASCIMENTO

    if (!empty($data_nascimento)) {
        $pedacos = explode('/', $data_nascimento);
        if(count($pedacos) == 3) {
            $data_nascimento = implode('-', array_reverse($pedacos)); 
        } else {
            $erro = "A Data de Nascimento deve seguir o padrão dia/mês/ano*";
        }
    }
    // VALIDANDO O TELEFONE
    if(!empty($telefone)){
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) != 11){
            $erro = "O telefone deve ser preenchido no padrão (00) 00000-0000";
        }
    }

    if($erro) {
        echo "<p><b>Erro: $erro </b></p>";
    } else {
        $sql_code = "INSERT INTO clientes (nome, email, telefone, data_nascimento, data_cadastro)
        VALUES ('$nome','$email','$telefone','$data_nascimento', NOW())";

        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo){
            echo "<p><b>Cliente cadastrado com sucesso!</b></p>";
            unset($_POST);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="Estilos/stylecc.css">
    <link rel="stylesheet" href="Estilos/stylebl.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <!-- Barra de Navegação Lateral: ADM -->
    <nav class="menu-lateral">
        <div class="btn-expandir">
            <i class="bi bi-list" id="btn-exp"></i>
        </div>
        
        <ul>
            <li class="item-menu ativo">
                <a href="#">
                    <span class="icon"><i class="bi bi-house"></i></span>
                    <span class="txt-link">Home</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-columns"></i></span>
                    <span class="txt-link">Cadastar</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-gear-fill"></i></span>
                    <span class="txt-link">Configurações</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-person"></i></span>
                    <span class="txt-link">Conta</span>
                </a>
            </li>
        </ul>
    </nav>

    <script src="menu.js"></script>

    <form method="POST" action="">
        <div class="tela-login">
            <img src="imgs/logo-easeti-color-v1.png" alt=""><br><br>
            <h1>Cadastrar cliente</h1>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" type="text" name="nome" placeholder="Nome" class="inputUser"><br><br>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" type="text" name="email" placeholder="E-mail" class="inputUser" ><br><br>
            <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone']; ?>" type="text" name="telefone" placeholder="Telefone" class="inputUser" >
            <br><br>
            <label for="data_nascimento">Data de Nascimento:</label>
            <br><br>
            <input value="<?php if(isset($_POST['data_nascimento'])) echo $_POST['data_nascimento']; ?>" type="text" name="data_nascimento" placeholder="Data de Nascimento" class="inputUser">
            <br><br>
            <button type="submit">Realizar Cadastro</button><br><br>
            <a href="/clientes.php"><img src="imgs/icons8-voltar-64.png" alt=""></a>
        </div>
    </form>

   
</body>
</html>