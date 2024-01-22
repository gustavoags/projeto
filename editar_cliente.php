<?php

include('conexao.php');

function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
} 

if(count($_POST) > 0) {

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

$id = intval($_GET['id']);
$sql_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="stylecc.css">
</head>
<body>
    <form method="POST" action="">
        <div class="tela-login">
            <img src="imgs/logo-easeti-color-v1.png" alt=""><br><br>
            <h1>Cadastrar cliente</h1>
            <input value="<?php echo $cliente['nome']; ?>" type="text" name="nome" placeholder="Nome" class="inputUser" >
            <br><br>
            <input value="<?php echo $cliente['email']; ?>" type="text" name="email" placeholder="E-mail" class="inputUser" >
            <br><br>
            <input value="<?php echo formatar_telefone($cliente['telefone']); ?>" type="text" name="telefone" placeholder="Telefone" class="inputUser" >
            <br><br>
            <label for="data_nascimento">Data de Nascimento:</label>
            <br><br>
            <input value="<?php echo formatar_data($cliente['data_nascimento']); ?>" type="text" name="data_nascimento" placeholder="Data de Nascimento" class="inputUser">
            <br><br>
            <button type="submit">Realizar Cadastro</button><br><br>
            <a href="/clientes.php"><img src="imgs/icons8-voltar-64.png" alt=""></a>
        </div>
    </form>

   
</body>
</html>