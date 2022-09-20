<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$DataGeracao = date("Y-m-d H:i:00");
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

$artista = $_POST["artista"];
$album = $_POST["album"];
$capa = $_POST["capa"];
$data = $_POST["data"];
$formato = $_POST["formato"];
$qualidade = $_POST["qualidade"];
$genero = $_POST["genero"];
$faixas = nl2br($_POST["faixas"]);
$loja = $_POST["loja"];
$acao = 0;
$pk = 0;

if (empty($_POST["acao"])) {
    $acao = 0;
} else {
    $acao = 1;
}

if (empty($_POST["trailer"])) {
    $trailer = NULL;
} else {
    $trailer = $_POST["trailer"];
}

if (empty($_POST["Pk"])) {
    $Pk = 0;
} else {
    $Pk = $_POST["Pk"];
}

if ($acao == 0) {
    $query = "INSERT INTO musicas(FkUsuario, Artista, Album, Capa, Data, Formato, Qualidade, Genero, Faixas, Loja, TrailerMusica, DataGeracao) 
VALUES('" . $idUsuario . "','" . addslashes($artista) . "', '" . addslashes($album) . "', '" . $capa . "', '" . $data . "','" . $formato . "',
'" . $qualidade . "', '" . $genero . "', '" . addslashes($faixas) . "', '" . $loja . "', '" . addslashes($trailer) . "', '" .  $DataGeracao . "');";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }
    $idInserido = mysqli_insert_id($CONEXAO);
    //referencia para adicionar os produtos escolhidos na tabela de associação entre Pedido e Produto

    $CONEXAO->close();
    header("location: Musica.php?idInserido=$idInserido");
    exit;
} else if ($acao == 1) {
    $query = "UPDATE musicas Set FkUsuario = '" . $idUsuario . "', Artista = '" . addslashes($artista) . "', Album = '" . addslashes($album) . "', Capa = '" . $capa . "', Data = '" . $data . "',
    Formato = '" . $formato . "', Qualidade = '" . $qualidade . "', Genero = '" . $genero . "', Faixas = '" . addslashes($faixas) . "', Loja = '" . $loja . "', TrailerMusica = '" . addslashes($trailer) . "' Where Pk = '" . $Pk . "';";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }
    $idInserido = mysqli_insert_id($CONEXAO);
    //referencia para adicionar os produtos escolhidos na tabela de associação entre Pedido e Produto

    $CONEXAO->close();
    header("location: Musica.php?idInserido=$Pk");
    exit;
}
