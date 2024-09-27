<?php 
// Fechando sessão (deslogando)
session_start();

session_destroy();

header('Location: ../index.php');
?>