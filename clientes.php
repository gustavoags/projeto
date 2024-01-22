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
    <link rel="stylesheet" href="Estilos/stylec.css">
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
    <!-- Animação da Barra Lateral -->
    <script src="menu.js"></script>

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
                    $telefone = formatar_telefone($cliente['telefone']);
                }
                $data_nascimento = "Não informada";
                if(!empty($cliente['data_nascimento'])){
                    $data_nascimento = formatar_data($cliente['data_nascimento']);
                }
                // Editando o tipo de Data
                $data_cadastro = date("d/m/Y H:i", strtotime($cliente['data_cadastro']));
            ?>
            <tr>
                <td><?php echo $cliente['id']; ?></td>
                <td><?php echo $cliente['nome']; ?></td>
                <td><?php echo $cliente['email']; ?></td>
                <td><?php echo $telefone; ?></td>
                <td><?php echo $data_nascimento; ?></td>
                <td><?php echo $data_cadastro; ?></td>
                <td>
                    <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>">Editar</a>
                </td>
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