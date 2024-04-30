<?php
require_once("db.php");
session_start();

// Assuming the email is stored in $_SESSION['Logado'][0]
$email = $_SESSION['Logado'][0];

// Fetch user data
$sql = "SELECT * FROM provider WHERE email = '$email'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
} else {
    echo "No user found with this email.";
    exit;
}

// Close connection
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
        <form class="modal" action="update.php" method="post">
            <ul class="center">
                <h1>Editar Usuário</h1>
                <li>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo $_SESSION['Logado'][0]; ?>" disabled>
                </li>
                <li>
                    <label for="nome">Nome:</label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($userData['nome']); ?>" required>
                </li>
                <li>
                    <label for="senha">Senha:</label>
                    <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($userData['senha']); ?>" required>
                </li>
                    <li>
                        <label for="telefone">Telefone:</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($userData['telefone']); ?>">
                    </li>
                    <li>
                        <label for="area">Área de atuação:</label>
                        <input type="text" id="area" name="area" value="<?php echo htmlspecialchars($userData['area']); ?>">
                    </li>
                    <li>
                        <label for="descricao">Mensagem:</label>
                        <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($userData['descricao']); ?></textarea>
                    </li>
                    <li>
                    <label for="image">Selecione uma imagem:</label>
                    <div id="imageOptions">
                        <!-- As opções de imagem serão geradas dinamicamente aqui -->
                    </div>
                </li>
                <li>
                    <input type="hidden" name="table" value="provider">
                    <button type="submit">Enviar</button>
                </li>
            </ul>
        </form>
        <script>
    const selectedImage = '<?php echo htmlspecialchars($userData['imagem']); ?>';
    const imageNames = ['mm.jpg', 'hm.jpg', 'mp.jpg', 'hp.jpg']; // Example image names

    // Generate image options dynamically
    let imageOptionsHTML = '';
    imageNames.forEach((imageName, index) => {
        let checked = imageName === selectedImage ? 'checked' : '';
        imageOptionsHTML += `
            <input type="radio" id="image${index}" name="image" value="${imageName}" ${checked} required>
            <label for="image${index}">
                <img src="img/${imageName}" alt="Imagem ${index + 1}" style="width: 50px; height: auto;">
            </label>
        `;
    });

    // Insert the image options into the form
    const imageOptionsElement = document.createElement('div');
    imageOptionsElement.innerHTML = imageOptionsHTML;
    document.getElementById('imageOptions').appendChild(imageOptionsElement);
</script>
</body>
</html>