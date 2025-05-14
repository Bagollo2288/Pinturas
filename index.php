<?php
session_start(); // Inicia a sessão
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/index.css" />
    <title>Pinturas do Sr. Graça</title>
</head>
<body>

<div class="overlay"></div>
    <header>
        <div class="navbar">
            <div class="logo"><a href="#"><img src="imagens/Logo.png" alt="Logotipo Pinturas do Sr. Graça" /></a></div>
            <ul class="links">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="orcamento.php">Orçamento</a></li>
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

    <div class="main-content">
        <div class="container">
            <h1>Bem-vindo às Pinturas do Sr. Graça</h1>
            <p>Se procura renovar a sua casa, e dar uma nova vida às paredes, está no lugar certo. Utilizamos apenas materiais de alta qualidade e adaptamo-nos às suas necessidades e orçamento.</p>
            <p>Peça já o seu orçamento gratuito</p>
            <button type="button" class="botao-login" onclick="window.location.href='orcamento.php'">Peça um orçamento</button>
        </div>
    </div>
</body>
</html>
