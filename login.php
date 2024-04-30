<?php
require_once("db.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Bridge</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    
</body>
</html>
<?php
$email = $_POST['login'];
$senha = $_POST['senha'];

$_SESSION['Logado'] = array();
array_push($_SESSION['Logado'], $email);

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
    echo '<div class="error-message">Usuário ou senha incorretos.</div>';
    header("Refresh: 2; url=login.html");
    exit;
}

// Fecha a conexão
mysqli_close($con);
?>
