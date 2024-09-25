<?php
session_start();
require_once "cadastro-login/bancodados.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $login = $_POST['login'];   // Recupera os dados POST 
    $senha = $_POST['senha'];

    $sqlBuscar = "SELECT * FROM usuarios WHERE login = '$login'";
    $resultado = mysqli_query($conn, $sqlBuscar);

    $usuario = mysqli_fetch_array($resultado, MYSQLI_ASSOC);  // Coloca os dados da tabela usuario dentro da variável-array

    if ($usuario) 
    { 
        // Checa se a senha confere e efetua o login 
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['logado'] = "sim";  // Sessão de login
            $_SESSION['usuarioOn'] = $usuario; // Armazena dados do usuário
            header('Location: user_side/entrada.php');
            die();
        } else {
            $_SESSION['error'] = "Senha não confere.";
        }
    } else {
        $_SESSION['error'] = "Usuário não encontrado.";
    }

    // Redireciona de volta para o formulário se houver erro
    header('Location: index.php');
    die();
}
