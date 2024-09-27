<?php
// Tratamento de sessão
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logado'])) {
    header("Location: index.php?error=1");
    exit();
}

if (isset($_SESSION['usuarioOn'])) {
    $nomeUsu = $_SESSION['usuarioOn']['login'];
    $fotoUsu = $_SESSION['usuarioOn']['foto'];
    $emailUsu = $_SESSION['usuarioOn']['email'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Hunter</title>
    <link rel="stylesheet" href="src/css/user.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="src/imagens/favicon.png" type="image/x-icon">
</head>

<body>

    <div class="container">
        <div class="texto-geral">

        <!-- Impressão de info-usuário -->

            <h1>Olá, <?= $nomeUsu ?>!</h1>

            <div class="image-section">
                <img height="200" src="<?= "projetoHxH/" . $fotoUsu ?>" />
            </div>


            <div class="email">

                <i class='bx bx-envelope'></i>

                <p> <?= $emailUsu ?> </p>

            </div>

            <!-- Gerador de level aleatório -->

            <div class="medalha">

                <i class='bx bxs-medal'></i>

                <p> Level do Caçador: <?php echo rand(5, 200)?>  </p>
            </div>

        </div>

    </div>

     <!-- Lógica de logout -->
    <button onclick="window.location.href='logout/logout.php'" class="btn">Sair</button>
    </div>
</body>

</html>
