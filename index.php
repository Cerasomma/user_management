<?php
session_start();

// Mostrar mensagem de sucesso
if (isset($_SESSION['success'])) {
    echo "<div style='color: green;'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']); // Apaga a mensagem após exibir
}

// Mostrar mensagem de erro
if (isset($_SESSION['error'])) {
    echo "<div style='color: red;'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']); // Apaga a mensagem após exibir
}
?>

<?php
// Exibir erros no PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include 'db_connect.php';

//Recuperar usuários do banco
$sql = "SELECT * FROM users";
$result = $conn->query( $sql );
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Lista de usuários</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1>Usuários</h1>
        <a href="add_user.php">Adicionar usuário</a>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Ações</th>
            </tr>
            <?php while ( $row = $result->fetch_assoc() ) { ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['age'];?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>">Editar</a>
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>">Deletar</a>
                    </td>
                </tr> 
                <?php } ?>   
        </table>
    </body>
</html>