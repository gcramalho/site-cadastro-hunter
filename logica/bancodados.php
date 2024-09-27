<?php
// Conectando com o banco de dados; Variaveis de conexão
$hostName = "localhost";
$bdUsuario = "root";
$bdSenha = "";
$bdNome = "hunterscadastro";


$conn = mysqli_connect($hostName, $bdUsuario, $bdSenha, $bdNome);


// Tratando a var de conexão (se conn for false)
if (!$conn) {
    die("Falha na conexão");
}
