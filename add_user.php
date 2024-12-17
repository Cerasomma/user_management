<?php
session_start(); // Inicia a sessão
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';

$errors = []; // Array para armazenar mensagens de erro

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']); // Remover espaços extras
    $age = $_POST['age'];

    // Validação do Nome: não vazio e sem números
    if (empty(trim($name))) {
        $errors[] = "O campo Nome não pode estar vazio.";
    } elseif (!preg_match("/^[a-zA-ZÀ-ú\s]+$/", $name)) {
        $errors[] = "O campo Nome deve conter apenas letras e espaços.";
    }

    // Validação da Idade: número positivo
    if (empty($age) || $age <= 0) {
        $errors[] = "O campo Idade deve ser um número positivo.";
    }

    // Se não houver erros, insere os dados no banco
    if (empty($errors)) {
        $sql = "INSERT INTO users (name, age) VALUES ('$name', $age)";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Erro ao adicionar: ". $conn->error;
            header("Location: index.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Usuário</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Adicionar Usuário</h1>

    <?php if (!empty($errors)) { ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $err) {
                    echo "<li>$err</li>";
                } ?>
            </ul>
        </div>
    <?php } ?>

    <form method="post" action="">
        Nome: <input type="text" name="name"><br>
        Idade: <input type="number" name="age" required><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>



