<?php
session_start(); // Inicia a sessão
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/contacto.css" />
    <title>Contacto - Pinturas do Sr. Graça</title>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <a href="#"><img src="imagens/Logo.png" alt="Logotipo Pinturas do Sr. Graça" /></a>
            </div>
            <ul class="links">
                <li><a href="index.php">Início</a></li>
                <li><a href="orcamento.php">Orçamento</a></li>
                <li><a href="simulador.php">Simulador</a></li>
                <li><a href="#">Sobre Nós</a></li>
                <li><a href="contacto.php">Contacto</a></li>

                <?php if (isset($_SESSION['id']) && $_SESSION['id'] != ''): ?>
                    <button type="button" class="botao-logout" onclick="window.location.href='logout.php'">Logout</button> <!-- Se o utilizador estiver logado, mostra o botão de Logout -->
                <?php else: ?>
                    <button type="button" class="botao-login" onclick="window.location.href='login.html'">Login</button> <!-- Se o utilizador não estiver logado, mostra o botão de Login -->
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <main>
            <div class="contacto">
                <h1>Fale Connosco</h1>
                <p>Tem dúvidas? Envie-nos uma mensagem!</p>

                <form action="#" method="post">
                    <input type="text" name="nome" placeholder="Nome" required />
                    <input type="email" name="email" placeholder="Email" required />
                    <input type="number" name="telefone" placeholder="Número de telefone" required/>
                    <input type="text" name="assunto" placeholder="Assunto" required />
                    <textarea name="mensagem" rows="6" placeholder="Mensagem" required></textarea>
                    <button type="submit">Enviar</button>
                    <button type="button" onclick="window.location.href='index.php'">Voltar para o menu inicial</button>
                </form>
            </div>
    </main>
</body>
</html>
