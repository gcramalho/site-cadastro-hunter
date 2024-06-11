<?php
//conectando com o banco de dados, passando variaveis de conexão
$hostName = "localhost";
$bdUsuario = "root";
$bdSenha = "";
$bdNome = "hunterscadastro";

$conn = mysqli_connect($hostName, $bdUsuario, $bdSenha, $bdNome);


//tratando a variavel de conexão (se conn for false)

if (!$conn) {
    die("Falha na conexão");
} /*else {
    echo "<script> alert('Conexão bem sucedida!') </script>";
}*/


?>