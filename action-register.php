<?php
require_once("db.php");

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

// Verifica se o email já existe na tabela contract
$contract = mysqli_query($con, "SHOW TABLES LIKE 'contract'");
$contractExists = $contract && mysqli_num_rows($contract) > 0;

if ($contractExists) {
    $check_sql_contract = "SELECT COUNT(*) FROM contract WHERE email = '$email'";
    $result_contract = mysqli_query($con, $check_sql_contract);
    $row_contract = mysqli_fetch_array($result_contract);
}
// Verifica se o email já existe na tabela provider
$provider = mysqli_query($con, "SHOW TABLES LIKE 'provider'");
$providerExists = $provider && mysqli_num_rows($provider) > 0;

if ($providerExists) {
    $check_sql_provider = "SELECT COUNT(*) FROM provider WHERE email = '$email'";
    $result_provider = mysqli_query($con, $check_sql_provider);
    $row_provider = mysqli_fetch_array($result_provider);
}
// Verifica se o email já existe em qualquer uma das tabelas
if ($row_contract[0] == 0 && $row_provider[0] == 0) {
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
    $sucess = urlencode('Cadastro bem sucedido!.');
    header("Location: login.php?success=$sucess");
    exit;
} else {
    $errorMessage = urlencode('O registro com o email \'' . $email . '\' já existe..');
    header("Location: register.php?error=$errorMessage");
    exit;
}

// Fecha a conexão
mysqli_close($con);
