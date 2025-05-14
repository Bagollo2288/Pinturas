<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email_cliente = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bagaojoaopedro@gmail.com'; // <-- substitui aqui
        $mail->Password = 'nyet hoqe aycd tydl';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('bagaojoaopedro@gmail.com', 'Formulário do Site');
        $mail->addAddress('bagaojoaopedro@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Pedido de Orcamento';
        $mail->Body = "
            <strong>Nome:</strong> $nome<br>
            <strong>Telefone:</strong> $telefone<br>
            <strong>Email:</strong> $email_cliente<br>
            <strong>Mensagem:</strong><br>$mensagem
        ";

        $mail->send();
        header("Location: sucesso.php");
        exit();
    } catch (Exception $e) {
        echo "Erro ao enviar: {$mail->ErrorInfo}";
    }
}
?>
