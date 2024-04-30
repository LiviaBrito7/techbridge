<?php
require_once("db.php");
echo "<a href='login.php'>Login</a><br>";
// Recebe os dados do formulário
$name = mysqli_real_escape_string($con, $_POST['name']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$phone = isset($_POST['phone']) ? mysqli_real_escape_string($con, $_POST['phone']) : null;
$area = isset($_POST['area']) ? mysqli_real_escape_string($con, $_POST['area']) : null;
$description = isset($_POST['description']) ? mysqli_real_escape_string($con, $_POST['description']) : null;
$image = isset($_POST['image']) ? mysqli_real_escape_string($con, $_POST['image']) : null;
$table = mysqli_real_escape_string($con, $_POST['table']);

// Verifica se a tabela existe, caso contrário, cria
$result = mysqli_query($con, "SHOW TABLES LIKE '$table'");
$tableExists = $result && mysqli_num_rows($result) > 0;

if (!$tableExists) {
    $sql = "CREATE TABLE $table (nome varchar(255) not null, email varchar(255) not null, senha varchar(255) not null";
    if ($table === 'provider') {
        $sql .= ", telefone varchar(15) not null, area varchar(255) not null, descricao varchar(255) not null, imagem varchar(20), notas int DEFAULT 0, num_avaliacoes int DEFAULT 0";
    }
    $sql .= ")";
    mysqli_query($con, $sql);
}

// Verifica se o email já existe na tabela
$check_sql = "SELECT COUNT(*) FROM $table WHERE email = '$email'";
$result2 = mysqli_query($con, $check_sql);
$row = mysqli_fetch_array($result2);

if ($row[0] == 0) {
    // Prepara os valores para inserção
    $values = "('$name', '$email', '$password'";
    if ($table === 'provider') {
        $values .= ", '$phone', '$area', '$description', '$image'";
    }
    $values .= ")";

    // Insere os dados na tabela
    $sql = "INSERT INTO $table (nome, email, senha";
    if ($table === 'provider') {
        $sql .= ", telefone, area, descricao, imagem";
    }
    $sql .= ") VALUES $values";
    mysqli_query($con, $sql);
    header("Location: login.php");
    exit(); // Termina a execução do script para evitar execução adicional
} else {
    echo "O registro com o email '$email' já existe.";
}

// Exibe os dados da tabela
$sql = "SELECT * from $table";
$res = mysqli_query($con, $sql);
$total = mysqli_num_rows($res);
echo "<p>Total de Resultados no Banco de Dados: " . $total . "</p>";
echo "<table>";
echo "<tr><th> Nome </th><th> E-mail </th><th> Senha </th><th> Telefone </th><th> Área </th><th> Descrição </th></tr>";

while ($f = mysqli_fetch_array($res)) {
    echo "<tr>";
    echo "<td>{$f['nome']}</td>";
    echo "<td>{$f['email']}</td>";
    echo "<td>{$f['senha']}</td>";
    echo "<td>" . (isset($f['telefone']) ? $f['telefone'] : '') . "</td>";
    echo "<td>" . (isset($f['area']) ? $f['area'] : '') . "</td>";
    echo "<td>" . (isset($f['descricao']) ? $f['descricao'] : '') . "</td>";
    echo "</tr>";
}
echo "</table>";

// Fecha a conexão
mysqli_close($con);
?>