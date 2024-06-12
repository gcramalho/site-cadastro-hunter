<?php 
session_start();
if (!isset ($_SESSION['logado'])) {
    header("Location: index.php?error=1");
    exit();
}

echo "teste de branch";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Funcionário</title>
</head>
<body>
    
    
    <a href="logout/logout.php">Sair</a>
</body>
</html>

