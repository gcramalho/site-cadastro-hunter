<?php
// Dependências
require_once "logica/tratarcadastro.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Hunter</title>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="shortcut icon" href="src/imagens/favicon.png" type="image/x-icon">
    <style>
        body {
            background: url(src/imagens/wallpaper.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        #back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 10px 20px;
            background-color: #2f6a42fa;
            border: none;
            text-decoration: none;
            color: #ffffffd4;
            font-family: 'Pixelify Sans', sans-serif;
            border-radius: 5px;
            font-size: 17px;
            cursor: pointer;
        }

        #back-button:hover {
            background-color: #47cd5dd1;
            color: #fff;
        }
    </style>

</head>

<body>

    <a href="index.php" id="back-button">Voltar</a>

    <div class="container">

        <div class="obtenha">
            <h2>OBTENHA SUA CREDENCIAL HUNTER!:</h2>
        </div>

        <form action="logica/tratarcadastro.php" method="post" enctype="multipart/form-data">

            <div class="input-cadastro">
                <input type="text" name="login" id="login" placeholder="Nome">

            </div>

            <div class="input-cadastro">
                <input type="email" name="email" id="email" placeholder="Endereço de e-mail">
            </div>

            <div class="input-cadastro">
                <input type="password" name="senha" id="senha" placeholder="Senha">
            </div>

            <div class="input-cadastro">
                <input type="password" name="senhaRepetida" placeholder="Repetir Senha">
            </div>

            <div class="input-imagem">
                <label for="imagem">Foto para Identificação:</label>
                <input type="file" name="imagem" id="imagem" accept=".jpg, .jpeg, .png">
                <p>*os formatos suportados são: PNG/JPG/JPEG</p>
            </div>

            <!-- Lógica de impressão de mensagem-erro -->
            <?php if (!empty($_SESSION['msgErros'])): ?>
                <div class="error-msg">

                    <?php foreach ($_SESSION['msgErros'] as $erro): ?>

                        <p> <?= $erro ?> </p>

                    <?php endforeach;
                    unset($_SESSION['msgErros']); ?>
                </div>

            <?php endif; ?>

            <input type="submit" value="Registrar-se" name="registro" class="registrar">

        </form>


    </div>


</body>

</html>