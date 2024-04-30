<?php
require_once("db.php");

$quem = mysqli_real_escape_string($con, $_GET['quem']);
$avaliacao = mysqli_real_escape_string($con, $_GET['avaliacao']);

echo $quem;
echo $avaliacao;

$sql = "UPDATE provider SET notas = notas + $avaliacao, num_avaliacoes = num_avaliacoes + 1 WHERE email = '$quem'";
if (mysqli_query($con, $sql)) {
    echo "Avaliação salva com sucesso!";
} else {
    echo "Erro ao salvar a avaliação: " . mysqli_error($con);
}

mysqli_close($con);
?>