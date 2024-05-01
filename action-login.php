<?php
require_once("db.php");
session_start();

$email = $_POST['login'];
$senha = $_POST['senha'];

$_SESSION['Logado'] = array();
array_push($_SESSION['Logado'], $email);

// Verifica se a tabela existe ou cria vazia porque ele precisa procurar nas duas (se nao existir vai dar erro).
$result = mysqli_query($con, "SHOW TABLES LIKE 'provider'");
$tableExists = $result && mysqli_num_rows($result) > 0;

if (!$tableExists) {
    $sql = "CREATE TABLE provider (nome varchar(255) not null, email varchar(255) not null, senha varchar(255) not null, telefone varchar(15) not null, area varchar(255) not null, descricao varchar(255) not null, imagem varchar(20), notas int DEFAULT 0, num_avaliacoes int DEFAULT 0)";
    mysqli_query($con, $sql);
}

$result = mysqli_query($con, "SHOW TABLES LIKE 'contract'");
$tableExists = $result && mysqli_num_rows($result) > 0;

if (!$tableExists) {
    $sql = "CREATE TABLE contract (nome varchar(255) not null, email varchar(255) not null, senha varchar(255) not null)";
    mysqli_query($con, $sql);
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
    $errorMessage = urlencode('Usuário ou senha incorretos.');
    header("Location: login.php?error=$errorMessage");
    exit;
}
// Fecha a conexão
mysqli_close($con);
