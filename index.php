<?php
//PENDENTE - CRIAR LÓGICA DE 'REMEMBER ME' E 'ESQUECEU LOGIN'

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
    <title>Portal Hunter</title>
    <link rel="stylesheet" type="text/css" href="src/css/style.css">
    <link rel="shortcut icon" href="src/imagens/favicon.png" type="image/x-icon">
</head>

<body>
    <div class="container">

        <form action="logica/tratarlogin.php" method="post">
            <h1>Bem-vindo de volta, hunter!</h1>

            <div class="input-caixa">
                <input type="email" placeholder="Informe seu e-mail" name="email" required>
            </div>

            <div class="input-caixa">
                <input type="password" placeholder="Informe sua senha" name="senha" required>
            </div>

            <div class="lembrar-caixa">
                <label for="lembrar"><input type="checkbox" name="lembrar" id="lembrar"> Lembrar de mim</label>

                <a href="#">Esqueceu seu login?</a>
            </div>

            <input type="submit" id="entrar" value="Entrar" name="entrar" class="btn">

            <div class="registrar-se">
                <p>Não possui cadastro? <a href="cadastro.php"> Registre-se aqui!</a> </p>
            </div>


            <?php
        // Exibe a mensagem de erro, se existir
        if (isset($_SESSION['error'])) {
            echo "<div class='alerta'>{$_SESSION['error']}</div>";
            // Limpa a sessão-mensagem após exibir
            unset($_SESSION['error']);
        }
        ?>

        </form>

    </div>

</body>

</html>