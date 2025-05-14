<?php
// Iniciar a sessão
session_start();

// Conectar à base de dados
include 'db_connect.php';

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $nome = $_POST['nome_utilizador'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $confirmaSenha = $_POST['confimar-password'];

    // Validar se as senhas coincidem
    if ($senha !== $confirmaSenha) {
        echo "<script>alert('As senhas não coincidem!'); window.history.back();</script>";
        exit();
    }

    // Encriptar a senha antes de salvar
    $senhaEncriptada = password_hash($senha, PASSWORD_DEFAULT);

    // Verificar se o email já existe na base de dados
    $sql = "SELECT * FROM utilizadores WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Este email já está registado!'); window.history.back();</script>";
        exit();
    }

    // Inserir o novo utilizador na base de dados
    $sql = "INSERT INTO utilizadores (nome_utilizador, telefone, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $telefone, $email, $senhaEncriptada);

    if ($stmt->execute()) {
        // Redirecionar para a página de login após o registo bem-sucedido
        echo "<script>alert('Registo efetuado com sucesso!'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Erro ao registar o utilizador: " . $stmt->error . "'); window.history.back();</script>";
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
}
?>
