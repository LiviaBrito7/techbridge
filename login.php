<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Bridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav>
        <div style="max-width: 900px;">
            <div class="d-flex align-items-center">
                <div>
                    <a class="navbar-brand" href="index.html"><img src="img/logo-t8.png" alt="logo TechBridge"
                            srcset="" class="logo"></a>
                </div>
                <div style="padding-right: 30px;">
                    <h1>Logar</h1>
                </div>
            </div>
        </div>
    </nav>
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
    <form method="POST" action="action-login.php" class="container mt-5">
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="login" name="login" placeholder="name@example.com">
            <label for="login">Email</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Password">
            <label for="senha">Senha</label>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>