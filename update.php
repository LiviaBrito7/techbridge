<?php
require_once("db.php");
session_start();

$email = $_SESSION['Logado'][0];

$name = $_POST['name'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$area = $_POST['area'];
$description = $_POST['description'];
$image = $_POST['image'];
$table = $_POST['table'];
echo $table;

$sql = "UPDATE $table SET nome = '$name', email = '$email', senha = '$password'";
if ($table === 'provider') {
    $sql .= ", telefone = '$phone', area = '$area', descricao = '$description', imagem = '$image'";
}
$sql .= " WHERE email = '$email'";

if (mysqli_query($con, $sql)) {

    header('Location: home.php');
    exit;
} else {
    echo "Error updating record: " . mysqli_error($con);
}

mysqli_close($con);
?>