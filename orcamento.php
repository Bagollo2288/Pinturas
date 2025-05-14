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
  <link rel="stylesheet" href="styles/orcamento.css" />
  <title>Pedido de Orçamento</title>
  
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

  <h1>Pedido de Orçamento</h1>

  <form action="enviar_orcamento.php" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="telefone">Telefone:</label>
    <input type="text" id="telefone" name="telefone" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="mensagem">Detalhes do serviço pretendido:</label>
    <textarea id="mensagem" name="mensagem" rows="6" required></textarea>

    <input type="submit" value="Pedir Orçamento">
  </form>

</body>
</html>
