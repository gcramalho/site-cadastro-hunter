<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['logado'])) {
   header("Location: entrada.php");
   
} else {
    if (isset($_GET['error']) && $_GET['error'] === '1') {
        echo  "<script> alert('É necessário fazer login para acessar esta página'); </script>";
        
    }

    }

?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Site Hunter</title>
        <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <div class="container">

            <form action="tratarlogin.php" method="post">
                <h1>Bem-vindo de volta, hunter!</h1>

                <div class="input-caixa">
                    <input type="text" placeholder="Insira seu ID" name="login" required>
                </div>

                <div class="input-caixa">
                    <input type="password" placeholder="Insira sua senha" name="senha" required>
                </div>

                <div class="lembrar-caixa">
                    <label for="lembrar"><input type="checkbox" name="lembrar" id="lembrar"> Lembrar de mim</label>

                    <a href="#">Esqueceu seu login?</a>
                </div>


                <input type="submit" id="entrar" value="Entrar" name="entrar" class="btn">

            <div class="registrar-se">
                <p>Não possui cadastro? <a href="cadastro-login/cadastro.php"> Registre-se aqui!</a> </p>
            </div>


            </form>
        </div>

    </body>

    </html>
