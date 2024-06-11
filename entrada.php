<?php 
session_start();
if (!isset ($_SESSION['logado'])) {
    header("Location: index.php?error=1");
    exit();
}  

echo "teste de branch";
?>

<html><p>Oi, inserir ppagina de funcionario com foto aqui</p></html>

