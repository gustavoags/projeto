<?php
if(isset($_POST['confirmar'])) {

    include("conexao.php");
    $id = intval($_GET['id']);
    $sql_code = "DELETE FROM clientes WHERE id ='$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query) { ?>

        <h1>Cliente deletado com sucesso!</h1>
        <p><a href="clientes.php">Clique aqui</a> para voltar para lista de clientes.</p>
        <?php
        die();
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente</title>
    <link rel="stylesheet" href="styledc.css">
    <link rel="stylesheet" href="stylebl.css">
</head>
<body>
    <h1>Tem certeza que deseja deletar o cliente?</h1>
    <form action="" method="post">
        <a href="clientes.php">Não</a>
        <button name="confirmar"  value="1"type="submit">Sim</button>
    </form>
</body>
</html>