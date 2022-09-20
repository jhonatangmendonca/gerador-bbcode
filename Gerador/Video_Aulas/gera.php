<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$DataGeracao = date("Y-m-d H:i:00");
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

$titulo = $_POST["titulo"];
$capa = $_POST["capa"];
$autor = $_POST["autor"];
$data = $_POST["data"];
$resolucao = $_POST["largura"] . "x" . $_POST["altura"];
$screen1 = $_POST["screen1"];
$screen2 = $_POST["screen2"];
$audio = $_POST["audio"];
$video = $_POST["video"];
$idioma = $_POST["idioma"];
$formato = $_POST["formato"];
$descricao = nl2br($_POST["descricao"]);
$Pk = 0;

if (empty($_POST["acao"])) {
    $acao = 0;
} else {
    $acao = 1;
}

if (empty($_POST["Pk"])) {
    $Pk = 0;
} else {
    $Pk = $_POST["Pk"];
}

if ($acao == 0) {
    $query = "INSERT INTO videoaulas(FkUsuario, Titulo, Capa, Descricao, Autor, Formato, CodecAudio, CodecVideo, Idioma, Resolucao, Data, Screen1, Screen2, DataGeracao) 
        VALUES('" . $idUsuario . "', '" . addslashes($titulo) . "', '" . $capa . "', '" . addslashes($descricao) . "', '" . addslashes($autor) . "', '" . $formato . "','" . $audio . "','" . $video . "',
         '" . $idioma . "', '" . $resolucao . "', '" . $data . "','" . $screen1 . "', '" . $screen2 . "', '" .  $DataGeracao . "');";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }
    $idInserido = mysqli_insert_id($CONEXAO);

    $CONEXAO->close();
    header("location: VideoAula.php?idInserido=$idInserido");
    exit;
} else if ($acao == 1) {
    $query = "UPDATE videoaulas Set FkUsuario = '" . $idUsuario . "', Titulo = '" . addslashes($titulo) . "', Capa = '" . $capa . "', Data = '" . $data . "', Resolucao = '" . $resolucao . "',
    Descricao = '" . addslashes($descricao) . "', CodecAudio = '" . $audio . "', CodecVideo = '" . $video . "', Formato = '" . $formato . "', Idioma = '" . $idioma . "',
    Autor = '" . $autor . "', Screen1 = '" . $screen1 . "', Screen2 = '" . $screen2 . "' Where Pk = '" . $Pk . "';";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }

    $CONEXAO->close();
    header("location: VideoAula.php?idInserido=$Pk");
    exit;
}
