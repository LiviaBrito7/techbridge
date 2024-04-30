<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Login</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <form method="POST" action="verifica_login.php">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" required><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br>
        <input type="submit" value="Entrar" id="submitBtn">
    </form>
    <a href='index.php'>Voltar</a>
</body>

</html>