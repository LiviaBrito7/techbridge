<?php
require_once("db.php");

$quem = mysqli_real_escape_string($con, $_GET['quem']);
$avaliacao = mysqli_real_escape_string($con, $_GET['avaliacao']);

$sql = "UPDATE provider SET notas = notas + $avaliacao, num_avaliacoes = num_avaliacoes + 1 WHERE email = '$quem'";
if (mysqli_query($con, $sql)) {
    echo '<div id="successMessage" class="success-message">Avaliação bem sucedida!</div>';
} else {
    echo '<div id="errorMessage" class="error-message">Erro ao avaliar.</div>';
}

mysqli_close($con);
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
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.location.href = "home.php";
            }, 2000); 
        };
    </script>
</body>
</html>