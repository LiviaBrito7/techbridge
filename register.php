<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechBridge</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    
        <nav>
        <div style="max-width: 900px;">
        <div class="teste">
            <a class="navbar-brand" href="index.html"><img src="img/logo-t8.png" alt="logo TechBridge" srcset=""
                class="logo"></a>
            </div>
            <div style="padding-right: 30px;">
            <h1>Cadastrar</h1>
            </div>
    </nav>
    

  <hr style="border-top: 6px solid #006a63; margin: 0">
    <?php
    if (isset($_GET['error'])) {
        $errorMessage = urldecode($_GET['error']);
        echo "<div class='error-message' id='error-message'>$errorMessage</div>";
    }
    ?>
    <h1>Bem vindo a Tech Bridge</h1>

    <form id="form">
        <h3>Você é:</h3>
        <ul>
            <li><input type="radio" name="modality" value="contract" checked>Estou buscando serviço à pessoa com deficiência</li>
            <li><input type="radio" name="modality" value="provider">Prestador de serviço à pessoa com deficiência</li>
        </ul>
        <button id="btn-salvar" type="submit">Quero me cadastrar</button>
        <a href="login.php">Já tenho conta!</a>
    </form>
    <section id="contract"></section>
    <section id="provider"></section>
    <script>
        'use strict';

        document.querySelector('#btn-salvar').addEventListener('click', function(event) {
            event.preventDefault();
            const userType = document.querySelector('#form').modality.value;
            generateForm(userType);
        });

        function generateForm(userType) {
            const sectionElement = document.querySelector(`#${userType}`);
            const formContent = `
        <form class="modal" action="action-register.php" method="post">
            <ul class="center">
                <h1>Cadastrar Usuário ${userType === 'provider' ? 'Prestador de Serviço' : 'Contratante'}</h1>
                <li>
                    <label for="nome">Nome:</label>
                    <input type="text" name="name" id="name" required>
                </li>
                <li>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </li>
                <li>
                    <label for="senha">Senha:</label>
                    <input type="password" name="password" id="password" required>
                </li>
                ${userType === 'provider' ? `
                    <li>
                        <label for="telefone">Telefone:</label>
                        <input type="tel" id="phone" name="phone">
                    </li>
                    <li>
                        <label for="area">Área de atuação:</label>
                        <input type="text" id="area" name="area">
                    </li>
                    <li>
                        <label for="descricao">Mensagem:</label>
                        <textarea id="description" name="description" rows="4" required></textarea>
                    </li>
                    <li>
                    <label for="image">Selecione um avatar:</label>
                    <div id="imageOptions">
                        <!-- As opções de imagem serão geradas dinamicamente aqui -->
                    </div>
                </li>
                ` : ''}
                <li>
                    <input type="hidden" name="table" value="${userType}" />
                    <button type="submit">Enviar</button>
                </li>
            </ul>
            <button class="fechar-btn">x</button>
            <a href="login.html">Já tenho conta!</a>
        </form>
    `;

            sectionElement.innerHTML = formContent;
            sectionElement.style.display = 'flex';

            const imageNames = ['mm.jpg', 'hm.jpg', 'mp.jpg', 'hp.jpg']; // Exemplo de nomes de arquivos

            // Gerar opções de imagem dinamicamente
            let imageOptionsHTML = '';
            imageNames.forEach((imageName, index) => {
                imageOptionsHTML += `
        <input type="radio" id="image${index}" name="image" value="${imageName}" required>
        <label for="image${index}">
            <img src="img/${imageName}" alt="Imagem ${index + 1}" style="width: 50px; height: auto;">
        </label>
    `;
            });

            // Inserir as opções de imagem no formulário
            const imageOptionsElement = document.createElement('div');
            imageOptionsElement.innerHTML = imageOptionsHTML;
            document.getElementById('imageOptions').appendChild(imageOptionsElement);

        }

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('fechar-btn')) {
                let sectionElement = event.target.closest('section');
                if (sectionElement) {
                    sectionElement.style.display = 'none';
                }
            }
        });
        // Aguarda 2 segundos (2000 milissegundos) antes de ocultar a div
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'none';
        }, 2000);
    </script>
</body>

</html>