<?php
session_start();
include 'db_connect.php'; // Conexão com a base de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];  // Variável para o campo de email
    $senha = $_POST['password'];  // Variável para o campo de senha

    // Verificar se o utilizador existe
    $sql = "SELECT * FROM utilizadores WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // Parametrizar a consulta
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificar a senha encriptada
        if (password_verify($senha, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['nome_utilizador'] = $user['nome_utilizador'];
            $_SESSION['tipo_utilizador'] = $user['tipo_utilizador'];

            // Criar um cookie com o nome do utilizador que dura 7 dias
            

            // Redirecionar para a página principal (pode ser diferente dependendo do tipo de utilizador)
            if ($user['tipo_utilizador'] == 1) {
                // Se for admin
                header("Location: admin_dashboard.php");
            } else {
                // Se for cliente
                header("Location: index.php");
            }
            exit();
        } else {
            echo "<script>alert('Senha incorreta!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Utilizador não encontrado!'); window.history.back();</script>";
    }
}
?>
