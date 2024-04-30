<?php
require_once("db.php");
session_start();

// Assuming the email is stored in $_SESSION['Logado'][0]
$email = $_SESSION['Logado'][0];

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$name = $_POST['name'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$area = $_POST['area'];
$description = $_POST['description'];
$image = $_POST['image'];
$table = $_POST['table'];
echo $table;
// Update the database
$sql = "UPDATE $table SET nome = '$name', email = '$email', senha = '$password'";
if ($table === 'provider') {
    $sql .= ", telefone = '$phone', area = '$area', descricao = '$description', imagem = '$image'";
}
$sql .= " WHERE email = '$email'";

if (mysqli_query($con, $sql)) {
    // Redirect to home.php
    header('Location: home.php');
    exit;
} else {
    echo "Error updating record: " . mysqli_error($con);
}

// Close connection
mysqli_close($con);
?>