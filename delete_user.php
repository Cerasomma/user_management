<?php
session_start(); // Inicia a sessão
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Usuário deletado com sucesso!";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION["error"] = "Erro ao deletar: ". $conn->error;
        header("Location: index.php");
        exit();
    }    
} 
?>