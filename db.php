<?php
// Configurações de conexão
$host = "localhost";
$db   = "techBridge";
$user = "root";
$pass = "";

$link = mysqli_connect($host, $user, $pass);
if (!$link) {
  die();
}
$sql = 'CREATE DATABASE IF NOT EXISTS ' . $db;
mysqli_query($link, $sql);

// conexão e seleção do banco de dados
// Cria a conexão
$con = mysqli_connect($host, $user, $pass, $db);

// Checar conexão
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
