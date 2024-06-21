<?php
/*if (session_status() == PHP_SESSION_NONE) {
    session_start();
}*/


require "index.php"; //inserindo aq p aparecer no index (ver se é necessario deletar isso)

if ($_SERVER['REQUEST_METHOD'] == "POST") {  
    $login = $_POST['login'];   //Recuperando os dados POST 
    $senha = $_POST['senha'];

    require_once "cadastro-login/bancodados.php";

    $sqlBuscar = "SELECT * FROM usuarios WHERE login = '$login'";
    $resultado = mysqli_query($conn, $sqlBuscar);

    //session_start(); //guardando infos em session p usar em outras páginas

    $usuario = mysqli_fetch_array($resultado, MYSQLI_ASSOC);  //coloca os dados da tabela usuario dentro da variavel-array

    $_SESSION['usuarioOn'] = $usuario; 

    if ($usuario){ 
        //checa se senha confere e efetua o login 
        if (password_verify($senha, $usuario['senha'])) {
           
            $_SESSION['logado'] = "sim";  //sessão de login
            header('Location: entrada.php');
            die();
        } else {
            echo "<div class ='alerta'> Senha não confere! </div>";
        }

    } else { //se usuario for false
        echo "<div class='alerta'> Usuário não encontrado! </div>";
    }
}
?>
