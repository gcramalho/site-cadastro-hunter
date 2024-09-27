<?php
// Dependências 
session_start();
require_once "bancodados.php";

// Recuperando dados se botão "registrar-se" for acionado

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


        if($arquivo['size'] > 5242880){
            array_push($erros, "Arquivo muito grande. Max:5MB");               
        }

        $pasta_final = "../src/imagens/";
        $nomeArquivo = $arquivo['name'];
        $novoNomeArquivo = uniqid();  // Criando ID único pro arquivo
        
        // Formatando extensão do arquivo
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


    // Se existir erros separa cada e imprime na tela (erro)

    if (count($erros) > 0) 
    {
        $_SESSION['msgErros'] = $erros;
        header('Location: ../cadastro.php');
        exit();
    } else 
    {
        // Se não houver erros, insere no banco de dados
        $sql = "INSERT INTO usuarios (login, email, senha, foto) VALUES ( ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $preparaStmt = mysqli_stmt_prepare($stmt, $sql);

        if ($preparaStmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $login, $email, $senhaHash, $caminho);
            mysqli_stmt_execute($stmt);
            echo "<script> alert('Registrado com sucesso') </script>";
            header('Location: ../index.php');
            exit();
        } else {
            die("Algo deu errado");
        }
    }
}

?>
