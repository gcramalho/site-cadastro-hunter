<?php
//recuperando dados SE o botão "registrar-se" foi clicado

if (isset($_POST['registro'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaRepetida = $_POST['senhaRepetida'];
    $foto = $_FILES['imagem']['tmp_name'];

    //insert tratamento da foto aq (tratarfoto.php)
    

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $erros = array();

    //checando se campos estão vazios, se sim entram na array de erros
    if (empty($login) || empty($email) || empty($senha) || empty($senhaRepetida)) {
        array_push($erros, "Todos os campos são obrigatorios" . PHP_EOL);
    }


    //checando digitação do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($erros, "E-mail não é valido ");
    }


    //checando tamanho da senha 
    if (strlen($senha) < 8) {
        array_push($erros, "Senha não pode ser menor que 8 digitos ");
    }


    //checando se senha é diferente
    if ($senha !== $senhaRepetida) {
        array_push($erros, "Senhas não conferem ");
    }

    //ver se o email já existe no bd

    require_once "bancodados.php";

    $sqlChecaEmail = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conn, $sqlChecaEmail);
    $rowTotal = mysqli_num_rows($resultado);

    if ($rowTotal > 0) {
        array_push($erros, 'Email já em uso');
    }

    //se existir erros tirar cada dos array e mostrar na tela (erro)
    if (count($erros) > 0) {
        foreach($erros as $erro) {
            echo "<div class='alerta'> $erro </div>";
            
        } 
    } else {
        //trabalhando/inserindo no banco de dados
        
        $sql = "INSERT INTO usuarios (login, email, senha, foto) VALUES ( ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $preparaStmt = mysqli_stmt_prepare($stmt, $sql);

        if ($preparaStmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $login, $email, $senhaHash, $foto);
            mysqli_stmt_execute($stmt);
            echo "<script> alert('Registrado com sucesso') </script>";
            header('Location: ../index.php');
        } else {
            die("Algo deu errado");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Hunter</title>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background: url(../imagens/wallpaper.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>

</head>

<body>
    <div class="container">

        <div class="obtenha">
            <h2>OBTENHA SUA CREDENCIAL HUNTER!: </h2>
        </div>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

            <div class="input-cadastro">
                <input type="text" name="login" id="login" placeholder="Nome">

            </div>

            <div class="input-cadastro">
                <input type="email" name="email" id="email" placeholder="Endereço de e-mail">
            </div>

            <div class="input-cadastro">
                <input type="password" name="senha" id="senha" placeholder="Senha">
            </div>

            <div class="input-cadastro">
                <input type="password" name="senhaRepetida" placeholder="Repetir Senha">
            </div>

            <!-- campo pra upar foto d perfil-->
            <div class="input-imagem">
                <label for="imagem">Foto para Identificação:</label>
                <input type="file" name="imagem" id="imagem" accept=".jpg, .jpeg, .png">
                <p>*os formatos suportados são: PNG/JPG/JPEG</p>
            </div>


            <input type="submit" value="Registrar-se" name="registro" class="registrar">

        </form>

    </div>


</body>

</html>