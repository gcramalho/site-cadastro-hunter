<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset ($_SESSION['logado'])) {
    header("Location: index.php?error=1");
    exit();
}

if(isset($_SESSION['usuarioOn'])){
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
    <title>Perfil Funcionário</title>
</head>
<body>

    <h1>Olá, <?= $nomeUsu ?> !</h1>

    <p>Sua foto upada:</p>
    <img height="200" src="<?= "projetoHxH/". $fotoUsu ?>"> </img>
    
    <p>Seu email: <?= $emailUsu?> </p>

    <br> <a href="logout/logout.php">Sair</a>
</body>
</html>

