<?php

use PHPMailer\PHPMailer\PHPMailer;

function enviar_email($destinatario, $assunto, $mensagemHTLM){

    require 'vendor/autoload.php';

    $mail = new PHPMailer;

    $mail->isSMTP();// define o uso de SMTP no envio
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true; // habilita a autenticação SMTP
    $mail->Username= 'greserva2307@outlook.com';
    $mail->Password = 'jqk325ig_@';

    $mail->SMTPSecure =false;
    $mail->isHTML(true);
    $mail->CharSet ='UTF-8';
    //E-mail de quem vai enviar, título do e-mail
    $mail->setFrom('greserva2307@outlook.com','Teste de envio de E-mail' );
    //Para quem será enviado o e-mail
    $mail->addAddress($destinatario);
    //Assunto do E-mail
    $mail->Subject = $assunto;

    $mail->msgHTML("<h1>E-mail enviado com sucesso!</h1><p>Parabéns deu tudo certo!</p>");

    $mail->Body = $mensagemHTLM;

    if($mail->send()){
        echo "E-mail enviado com sucesso!";
        return true;
    } else{
        echo "Falha do envio do email!";
        return false;
    }
}
?>