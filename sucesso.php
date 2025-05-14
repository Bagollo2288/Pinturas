<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['id'] == '') {
    header("Location: login.html"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/sucesso.css" />
    <title>Sucesso</title>
    
</head>
<body>

    <header>
        <div class="navbar">
            <div class="logo"><a href="#"><img src="imagens/Logo.png" alt="Logotipo Pinturas do Sr. Graça" /></a></div>
            <ul class="links">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="#">Orçamento</a></li>
                <li><a href="simulador.php">Simulador</a></li>
                <li><a href="#">Sobre Nós</a></li>
                <li><a href="contacto.php">Contacto</a></li>

                

                <!-- Verifica se o utilizador está logado -->
                <?php if (isset($_SESSION['id']) && $_SESSION['id'] != ''): ?>
                    <button type="button" class="botao-logout" onclick="window.location.href='logout.php'">Logout</button> <!-- Se o utilizador estiver logado, mostra o botão de Logout -->
                <?php else: ?>
                    <button type="button" class="botao-login" onclick="window.location.href='login.html'">Login</button> <!-- Se o utilizador não estiver logado, mostra o botão de Login -->
                <?php endif; ?>
            </ul>
            
        </div>
    </header>
    <div class="i">
        <h1>Mensagem Enviada com Sucesso!</h1>
        <p>O seu pedido de orçamento foi enviado com sucesso. Responderemos em breve.</p>
        <button type="button" onclick="window.location.href='index.php'">Voltar para o menu inicial</button>
    </div>
</body>
</html>
