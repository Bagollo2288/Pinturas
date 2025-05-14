<?php
$servidor = "localhost";
$utilizador = "root"; // Muda se necessário
$senha = ""; // Adiciona a senha se tiver
$base_dados = "pinturas";

$conn = new mysqli($servidor, $utilizador, $senha, $base_dados);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
