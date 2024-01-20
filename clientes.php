<?php
include('conexao.php');
//Consulta de todos do BD
$sql_clientes = "SELECT * FROM clientes";
//Consulta
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
//Verificar quantos clientes existem
$num_clientes = $query_clientes->num_rows;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="stylec.css">
    <style>
       

    </style>
</head>
<body>
    <div>
    <h1>Lista de Clientes</h1>
    <p>Clientes cadastrados na EASE TI</p>
    <table cellpadding ="12px" >
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Data de Nascimento</th>
            <th>Data de Cadastro</th>
            <th>Editar</th>
            <th>Imprimir</th>
            <th>Cancelar</th>
        </thead>
        <tbody>
            <?php if($num_clientes == 0){ ?>
                <tr>
                    <td colspan="7">Nenhum cliente foi cadastrado</td>
                </tr>
            <?php } else{ 
                // Loop => Enquanto houver clientes no BD
                while ($cliente = $query_clientes->fetch_assoc()) {

                // Editando o telefone para tipo (DDD) Telefone
                $telefone = "Não informado";
                if(!empty($cliente['telefone'])){
                    $ddd = substr($cliente['telefone'], 0, 2);
                    $parte_1 = substr($cliente['telefone'], 2, 5);
                    $parte_2 = substr($cliente['telefone'], 6);
                    $telefone ="($ddd) $parte_1-$parte_2";
                }
                $data_nascimento = "Não informada";
                if(!empty($cliente['data_nascimento'])){
                    $data_nascimento =implode('/', array_reverse (explode('-', $cliente['data_nascimento'])));
                }
                
                $data_cadastro = date("d/m/Y H:i", strtotime($cliente['data_cadastro']));
                
    
            ?>
            <tr>
                <td><?php echo $cliente['id']; ?></td>
                <td><?php echo $cliente['nome']; ?></td>
                <td><?php echo $cliente['email']; ?></td>
                <td><?php echo $telefone; ?></td>
                <td><?php echo $data_nascimento; ?></td>
                <td><?php echo $data_cadastro; ?></td>
                <td><a href="">Editar</a></td>
                <td><a href="">Imprimir</a></td>
                <td><a href="">Cancelar</a></td>
            </tr>
            <?php
            }
        } ?>
        </tbody>
    </table>
    </div>
</body>
</html>