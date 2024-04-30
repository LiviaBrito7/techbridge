<?php
require_once("db.php");
session_start();
$email = $_POST['login'];
$senha = $_POST['senha'];

$_SESSION['Logado'] = array();
array_push($_SESSION['Logado'], $email);
array_push($_SESSION['Logado'], $senha);

var_dump($_SESSION);

if (!$con) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Verifica se o usuário existe em ambas as tabelas
$sql = "SELECT * FROM contract WHERE email = '$email' AND senha = '$senha'";
$result_user = mysqli_query($con, $sql);

$sql = "SELECT * FROM provider WHERE email = '$email' AND senha = '$senha'";
$result_provider = mysqli_query($con, $sql);

if (mysqli_num_rows($result_user) > 0 || mysqli_num_rows($result_provider) > 0) {
    echo "Login bem-sucedido!"; // Usuário encontrado em uma das tabelas
    header("Location: home.php");
    exit(); // Termina a execução do script para evitar execução adicional
} else {
    echo "Usuário ou senha incorretos."; // Usuário não encontrado
    echo "<a href='login.php'>Voltar para login</a>";
}

// Fecha a conexão
mysqli_close($con);
?>
