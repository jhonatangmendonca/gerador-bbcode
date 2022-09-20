<?php
require 'Config.php';

// resgata variáveis do formulário
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
$senhaUsuario = base64_encode($senha);

if (empty($usuario) || empty($senha)) {
    header('Location: Index.php?informe-dados');
    exit;
}

// // cria o hash da senha
// $senhaHash = make_hash($senha);

// $PDO = db_connect();

$query = "SELECT U.Pk, U.NomeUsuario, U.Tema, U.Email
FROM usuarios U
Where U.NomeUsuario = '$usuario' and U.Senha = '$senhaUsuario'";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            $id = $linha["Pk"];
            $nome = $linha["NomeUsuario"];
        }
    } else {
        header('Location: Index.php?senha-invalida');
        exit;
    }
}

session_start();
$_SESSION['logado'] = true;
$_SESSION['PkUsuario'] =  $id;
$_SESSION['nome_usuario'] = $nome;

header('Location: ../Gerador/Index.php');

?>

<!-- $sql = "SELECT id, nome FROM usuarios WHERE login = :email AND senha = :senha";
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senhaHash);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) <= 0) { header('Location: login.php?senha-invalida'); exit; } // pega o primeiro usuário $user=$users[0]; session_start(); $_SESSION['logado']=true; $_SESSION['PkUsuario']=$user['id']; $_SESSION['nome_usuario']=$user['nome']; header('Location: ../MinhasDespesas/Index.php'); -->