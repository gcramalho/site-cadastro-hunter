<?php
require_once "bancodados.php";

// Recuperando dados SE o botão "registrar-se" foi clicado

if (isset($_POST['registro'])) {
    $login = ucwords($_POST['login']);
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaRepetida = $_POST['senhaRepetida'];

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $erros = array();


    // Tratamento da foto 
    if (isset($_FILES['imagem']['tmp_name'])) {
        $arquivo = $_FILES['imagem'];

        /*if($arquivo['error']){
            die("Falha ao enviar arquivo");
        }*/

        if($arquivo['size'] > 5242880){
            array_push($erros, "Arquivo muito grande. Max:2MB");               
        }

        $pasta_final = "../src/imagens/";
        $nomeArquivo = $arquivo['name'];
        $novoNomeArquivo = uniqid();  //criando id único pro arquivo
        
        // Formatando extensao
       $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
        
       if($extensao != 'jpg' && $extensao != 'png'){
        array_push($erros, "Tipo de arquivo inválido");

       } 

       $caminho = $pasta_final . $novoNomeArquivo . "." . $extensao;

       // Movendo o arquivo para a pasta "imagens" do código
       $moveu = move_uploaded_file($arquivo["tmp_name"], $caminho);

    }


    // Checando se campos estão vazios, se sim entram na array de erros
    if (empty($login) || empty($email) || empty($senha) || empty($senhaRepetida)) {
        array_push($erros, "Todos os campos são obrigatorios" . PHP_EOL);
    }


    // Checando digitação do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($erros, "E-mail não é valido ");
    }


    // Checando tamanho da senha 
    if (strlen($senha) < 8) {
        array_push($erros, "Senha não pode ser menor que 8 digitos ");
    }


    // Checando se senha é diferente
    if ($senha !== $senhaRepetida) {
        array_push($erros, "Senhas não conferem ");
    }

    // Ver se o email já existe no BD
    $sqlChecaEmail = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conn, $sqlChecaEmail);
    $rowTotal = mysqli_num_rows($resultado);

    if ($rowTotal > 0) {
        array_push($erros, 'Email já em uso');
    }


    // Se existir erros tira cada dos array e mostra na tela (erro)
    $msgErros = '';

    if (count($erros) > 0) 
    {
        foreach ($erros as $erro) {
            $msgErros .= "<p> $erro <br> </p>";
        }
    } else 
    {
        //se n houver erros insere no banco de dados
        $sql = "INSERT INTO usuarios (login, email, senha, foto) VALUES ( ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $preparaStmt = mysqli_stmt_prepare($stmt, $sql);

        if ($preparaStmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $login, $email, $senhaHash, $caminho);
            mysqli_stmt_execute($stmt);
            echo "<script> alert('Registrado com sucesso') </script>";
            header('Location: ../index.php'); // REDIRECIONA DIRETO DEPOIS DO REGISTRO
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
    <link rel="stylesheet" href="../src/css/style.css">
    <style>
        body {
            background: url(../src/imagens/wallpaper.jpg);
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

            <?php if (!empty($msgErros)): ?>
                <div class="error-msg">
                    <?= $msgErros; ?>
                </div>
            <?php endif; ?>

            <input type="submit" value="Registrar-se" name="registro" class="registrar">

        </form>

    </div>

</body>

</html>