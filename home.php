<?php
require_once("db.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function avaliacao(nome, quem) {
            document.getElementById('avaliacao').innerHTML = `

        <div class="modal_avaliacao" id="myModal">
            <div class="modal_content_avaliacao">
            <div>
            <p>Como você avalia ${nome}?</p>
                <a href="salvar_avaliacao.php?avaliacao=1&quem=${quem}">⭐</a>
                <a href="salvar_avaliacao.php?avaliacao=2&quem=${quem}">⭐</a>
                <a href="salvar_avaliacao.php?avaliacao=3&quem=${quem}">⭐</a>
                <a href="salvar_avaliacao.php?avaliacao=4&quem=${quem}">⭐</a>
                <a href="salvar_avaliacao.php?avaliacao=5&quem=${quem}">⭐</a>
            </div>
            </div>
            <button class="fechar-btn">x</button>
        </div>
    `;
            // Get the modal
            var modal = document.getElementById("myModal");

            // Show the modal
            modal.style.display = "flex";

            // Add an event listener to the close button
            document.querySelector('.fechar-btn').addEventListener('click', function() {
                modal.style.display = "none";
            });

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    </script>
</head>

<body>
    <a href="login.php">Login</a>
    <div id="avaliacao"></div>


    <div class="container">
        <?php


        if (!$con) {
            die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM provider";
        $res = mysqli_query($con, $sql);

        echo "<p>Total de Resultados no Banco de Dados: " . mysqli_num_rows($res) . "</p>";
         
        while ($f = mysqli_fetch_assoc($res)) {
            $media = $f['num_avaliacoes'] ? round($f['notas'] / $f['num_avaliacoes']) : 0;
            echo "<div class='res'>";
            echo "<div style='float:left; width:80%'>";
            echo "<p>Nome: {$f['nome']}</p>";
            echo "<p>E-mail: {$f['email']}</p>";
            echo "<p>Telefone: {$f['telefone']}</p>";
            echo "<p>Área de Atuação: {$f['area']}</p>";
            echo "<p>Descrição: {$f['descricao']}</p>";
            for ($i=0; $i < $media; $i++) { 
                echo "⭐";
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

        mysqli_close($con);
        ?>

    </div>

</body>

</html>