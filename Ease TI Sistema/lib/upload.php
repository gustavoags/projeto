<?php

function enviarArquivo($error, $size, $name, $tmp_name){

    if($error)
        die("Falha ao enviar o arquivo");

    //CONDIÇÕES PARA O ENVIO DO ARQUIVO
    if($size > 2097152)
        die("Arquivo muito grande!! Max: 2MB");

    $pasta = "arquivos/";

    //A função uniqid gera um nome aleatório para o arquivo que será enviado
    $nomeDoArquivo = $name;
    $novoNomeDoArquivo = uniqid();

    //pathinfo => retorna informações sobre o caminho de um arquivo
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    //Verificando se os tipos de extensões são aceitas
    if($extensao != "jpg" && $extensao != "png")
        die("Tipo de arquivo não aceito");

    $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

    //move_uploaded_file => move um arquivo enviado para um novo local

    $deu_certo = move_uploaded_file($tmp_name, $path);
    if($deu_certo){
        return $path;
    } else {
        return false;
    }
}
?>