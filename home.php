<?php
require_once("db.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Bridge</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">

    <script>
        function avaliacao(nome, quem) {
            document.getElementById('avaliacao').innerHTML = `

        <div class="modal_avaliacao" id="myModal">
            <div class="modal_content_avaliacao">
            <div>
            <p>Como você avalia ${nome}?</p>
                <a href="rate.php?avaliacao=1&quem=${quem}">💛</a>
                <a href="rate.php?avaliacao=2&quem=${quem}">💛</a>
                <a href="rate.php?avaliacao=3&quem=${quem}">💛</a>
                <a href="rate.php?avaliacao=4&quem=${quem}">💛</a>
                <a href="rate.php?avaliacao=5&quem=${quem}">💛</a>
            </div>
            </div>
            <button class="fechar-btn">x</button>
        </div>
    `;
            // Pegar modal
            var modal = document.getElementById("myModal");

            // Mostrar modal
            modal.style.display = "flex";

            // Ouvidor de evento ao clicar no botao fechar
            document.querySelector('.fechar-btn').addEventListener('click', function() {
                modal.style.display = "none";
            });

            // Fechar quando o usuario clica fora
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    </script>
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
    <a href="login.php">Login</a>
    <div id="avaliacao"></div>


    <div class="container">
        <?php

        $provider = mysqli_query($con, "SHOW TABLES LIKE 'provider'");
        $providerExists = $provider && mysqli_num_rows($provider) > 0;

        if ($providerExists) {

            $sql = "SELECT * FROM provider";
            $res = mysqli_query($con, $sql);

            echo "<p>Total de Resultados no Banco de Dados: " . mysqli_num_rows($res) . "</p>";

            while ($f = mysqli_fetch_assoc($res)) {
                $media = $f['num_avaliacoes'] ? round($f['notas'] / $f['num_avaliacoes']) : 0;
                $mediaComplemento = 5 - $media;
                echo "<div class='res'>";
                echo "<div style='float:left; width:80%'>";
                echo "<p>Nome: {$f['nome']}</p>";
                echo "<p>E-mail: {$f['email']}</p>";
                echo "<p>Telefone: {$f['telefone']}</p>";
                echo "<p>Área de Atuação: {$f['area']}</p>";
                echo "<p>Descrição: {$f['descricao']}</p>";
                for ($i = 0; $i < $media; $i++) {
                    echo "💛";
                }
                for ($i = 0; $i < $mediaComplemento; $i++) {
                    echo "🤍";
                }
                echo "<button onclick='avaliacao(\"" . htmlspecialchars($f['nome'], ENT_QUOTES) . "\", \"" . htmlspecialchars($f['email'], ENT_QUOTES) . "\")'>Avaliar</button>";
                echo "</div>";
                echo "<div>";
                if ($f['email'] == $_SESSION['Logado'][0]) {
                    echo "<a href='edit.php'>Editar Infos</a>";
                }
                echo "<img src='img/{$f['imagem']}' width='100px' height='100px'>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo 'Ainda não há prestadores cadastrados.';
        }

        mysqli_close($con);
        ?>

    </div>
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