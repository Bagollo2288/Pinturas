<?php
session_start();

// Destruir a sessão
session_unset();
session_destroy();

// Redireciona para a página inicial
header("Location: index.php");
exit;
?>
