<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Bridge</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <?php
    if (isset($_GET['error'])) {
        $errorMessage = urldecode($_GET['error']);
        echo "<div class='error-message' id='error-message'>$errorMessage</div>";
    }
    if (isset($_GET['success'])) {
        $success = urldecode($_GET['success']);
        echo "<div class='success-message' id='success-message'>$success</div>";
    }
    ?>
    <a href='index.html'>Voltar</a>
    <h1>Login</h1>
    <form method="POST" action="action-login.php">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" required><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br>
        <button type="submit" id="submitBtn">Entrar</button>
    </form>
    <script>
        // Aguarda 2 segundos (2000 milissegundos) antes de ocultar a div
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'none';
        }, 2000);
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 2000);
    </script>
</body>

</html>