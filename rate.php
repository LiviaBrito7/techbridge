<?php
require_once("db.php");

$quem = mysqli_real_escape_string($con, $_GET['quem']);
$avaliacao = mysqli_real_escape_string($con, $_GET['avaliacao']);

$sql = "UPDATE provider SET notas = notas + $avaliacao, num_avaliacoes = num_avaliacoes + 1 WHERE email = '$quem'";
if (mysqli_query($con, $sql)) {
    $sucess = urlencode('Avaliação bem sucedida!.');
    header("Location: home.php?success=$sucess");
    exit;
} else {
    $errorMessage = urlencode('Erro ao avaliar.');
    header("Location: home.php?error=$errorMessage");
    exit;
}

mysqli_close($con);
