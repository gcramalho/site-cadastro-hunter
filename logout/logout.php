<?php //fechando sessão e deslogando
session_start();

session_destroy();

header('Location: ../index.php');
?>