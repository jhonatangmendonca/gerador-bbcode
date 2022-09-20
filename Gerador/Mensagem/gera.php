<?php
session_start();
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

$titulo = $_POST["titulo"];
$Mensagem = nl2br($_POST["mensagem"]);
$array = array();

$query = "SELECT Pk FROM usuarios";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            array_push($array, $linha['Pk']);
        }
    }
} else {
    die("Erro!");
}

foreach ($array as $value) {

    $query = "INSERT INTO mensagens(FkUsuario, Titulo, Mensagem) 
    VALUES('" . $value . "','" . addslashes($titulo) . "', '" . $Mensagem . "');";
    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro ao Inserir Mensagem!");
    }
}

$CONEXAO->close();
header("location: Index.php");
exit;
