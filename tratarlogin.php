<!-- tratando o login -->

<?php
require "index.php"; //inserindo aq p aparecer no index 

if ($_SERVER['REQUEST_METHOD'] == "POST") {  
    $login = $_POST['login'];   //Recuperando os dados POST 
    $senha = $_POST['senha'];

    require_once "cadastro-login/bancodados.php";

    $sqlBuscar = "SELECT * FROM usuarios WHERE login = '$login'";
    $resultado = mysqli_query($conn, $sqlBuscar);

    $usuario = mysqli_fetch_array($resultado, MYSQLI_ASSOC);  //coloca os dados do usuario no bd dentro de uma variavel-array

    if ($usuario){ //se usuario for true
        //checa se senha confere e efetua o login 
        if (password_verify($senha, $usuario['senha'])) {
            session_start();
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
