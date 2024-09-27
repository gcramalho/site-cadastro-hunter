<?php
// Dependências
session_start();
require_once "bancodados.php";

// Tratamento dados POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];    
    $senha = $_POST['senha'];

    $sqlBuscar = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conn, $sqlBuscar);

    $usuario = mysqli_fetch_array($resultado, MYSQLI_ASSOC);  // Armazena dados da tabela

    if ($usuario) 
    { 
        // Checa se a senha confere e efetua o login 
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['logado'] = "sim";  // Sessão de login
            $_SESSION['usuarioOn'] = $usuario; // Armazena dados do usuário na sessão
            header('Location: ../entrada.php'); 
            die();
        } else {
            $_SESSION['error'] = "Senha não confere.";
        }
    } else {
        $_SESSION['error'] = "Usuário não encontrado.";
    }

    // Se houver erro no request, redireciona de volta para o formulário.
    header('Location: ../index.php'); 
    die();
}
