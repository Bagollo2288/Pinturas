<?php

include('db_connect.php');


if (isset($_GET['change_permission'])) {
    $userId = $_GET['change_permission'];


    $result = $conn->query("SELECT tipo_utilizador FROM utilizadores WHERE id = $userId");
    if ($result) {
        $user = $result->fetch_assoc();


        $newPermission = ($user['tipo_utilizador'] == 'Admin') ? 'User' : 'Admin';

        // Atualizar o tipo de utilizador na base de dados
        $updateResult = $conn->query("UPDATE utilizadores SET tipo_utilizadores = '$newPermission' WHERE id = $userId");

        // Verifica se a atualização foi bem-sucedida
        if ($updateResult) {

            header("Location: admin_dashboard.php");
            exit;
        } else {
            echo "Erro ao alterar permissão: " . $conn->error;
        }
    } else {
        echo "Erro ao obter utilizador: " . $conn->error;
    }
}

// Buscar todos os utilizadores da base de dados
$result = $conn->query("SELECT id, nome_utilizador, telefone, email, tipo_utilizador FROM utilizadores");
if (!$result) {
    die("Erro ao buscar utilizadores: " . $conn->error);
}

// Armazenar os utilizadores em um array
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="styles/admin_dashboard.css">
</head>
<body>
    <div class="admin-dashboard">
        <h1>Painel de Administração</h1>
        <div class="users-list">
            <h2>Utilizadores</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Tipo de Utilizador</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['nome_utilizador']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['telefone']); ?></td>
                            <td><?php echo htmlspecialchars($user['tipo_utilizador']); ?></td>
                            <td>
                                <a href="admin_dashboard.php?change_permission=<?php echo $user['id']; ?>">
                                    Alterar Permissão
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
