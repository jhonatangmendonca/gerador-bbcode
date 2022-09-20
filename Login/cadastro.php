<?php
require './../Config/Config.php';

$nome =  $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];
$aux = 0;

if ($senha != $senha2) {
    header('Location: cadastrar.php?senhas-diferentes');
    exit;
}

// cria o hash da senha
$senhaHash = base64_encode($senha);
$senhaHash2 = base64_encode($senha2);

$query = "SELECT * FROM usuarios WHERE Email = '$email' OR NomeUsuario = '$nome'";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            $nomeUsuario = $linha["NomeUsuario"];
            $emailUsuario = $linha["Email"];
            if ($nomeUsuario == $nome) {
                header('Location: cadastrar.php?usuario-duplicado');
            } else if ($emailUsuario == $email) {
                header('Location: cadastrar.php?email-duplicado');
            }
        }
    } else {
        $var = 1;
    }
} else {
    die("ERRO AO PEGAR DADOS DO BANCO");
}

if ($var == 1) {
    $query = "INSERT INTO usuarios(NomeUsuario, Senha, Senha2, Email) VALUES('" . $nome . "', '" . $senhaHash . "', '" . $senhaHash2 . "', '" . $email . "');";
    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        $var = 2;
    } else {
        die("ERRO AO CADASTRAR USUARIO");
    }
}
$FkUsuario = mysqli_insert_id($CONEXAO);
if ($var == 2) {
    $query = "INSERT INTO assinaturas(FkUsuario, Assinatura, Assinatura2, UrlLancamentos) VALUES('" . $FkUsuario . "', '', '', '');";
    $resultado = $CONEXAO->query($query);
    if ($resultado) {
    } else {
        die("ERRO AO CADASTRAR ASSINATURA");
    }

    $query = "INSERT INTO tags(FkUsuario) VALUES('" . $FkUsuario . "');";
    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        header('Location: login.php?cadastro-realizado');
    } else {
        die("ERRO AO CADASTRAR ASSINATURA");
    }
}
$CONEXAO->close();
exit;
