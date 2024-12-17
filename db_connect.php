<?php
//Configurações de conexão
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "user_management";

//Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

//Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: ". $conn->connect_error);
}
?>    