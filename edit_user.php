<?php
session_start(); // Inicia a sessão
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //Buscar usuário pelo ID
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];

    $sql = "UPDATE users SET name='$name', age=$age WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro: ". $conn->error;
    }    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Editar Usuário</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1>Editar Usuário</h1>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            Nome: <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>
            Idade: <input type="number" name="age" value="<?php echo $user['age']; ?>" required><br>
            <button type="submit">Salvar</button>
        </form>
    </body>
</html>