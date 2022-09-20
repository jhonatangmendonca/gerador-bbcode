<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$DataGeracao = date("Y-m-d H:i:00");
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

$titulo = $_POST["titulo"];
$musicas = nl2br($_POST["musicas"]);
$capa = $_POST["capa"];
$duracao = $_POST["duracao"];
$data = $_POST["data"];
$resolucao = $_POST["largura"] . "x" . $_POST["altura"];
$screen1 = $_POST["screen1"];
$screen2 = $_POST["screen2"];
$screen3 = $_POST["screen3"];
$screen4 = $_POST["screen4"];
$audio = $_POST["audio"];
$video = $_POST["video"];
$legenda = $_POST["legenda"];
$idioma = $_POST["idioma"];
$idiomaOriginal = $_POST["idiomaOriginal"];
$formato = $_POST["formato"];
$qualidade = $_POST["qualidade"];
$tipoAudio = $_POST["tipoAudio"];
$descricao = nl2br($_POST["descricao"]);

$query = "INSERT INTO shows(FkUsuario, Titulo, Capa, Data, Resolucao, Descricao, Musicas, Qualidade, TipoAudio, CodecAudio,	CodecVideo,	Formato, Legenda, Idioma, IdiomaOriginal, Duracao, Screen1, Screen2, Screen3, Screen4, DataGeracao) 
        VALUES('" . $idUsuario . "', '" . addslashes($titulo) . "', '" . $capa . "', '" . $data . "', '" . $resolucao . "','" . addslashes($descricao) . "', '" . addslashes($musicas) . "', '" . $qualidade . "','" . $tipoAudio . "','" . $audio . "',
         '" . $video . "', '" . $formato . "', '" . $legenda . "','" . $idioma . "', '" . $idiomaOriginal . "', '" . $duracao . "','" . $screen1 . "', '" . $screen2 . "', '" . $screen3 . "', '" . $screen4 . "', '" .  $DataGeracao . "');";

$resultado = $CONEXAO->query($query);
if ($resultado) {
    echo "Salvou no banco!";
} else {
    die("Erro!");
}
$idInserido = mysqli_insert_id($CONEXAO);

$CONEXAO->close();
header("location: Show.php?idInserido=$idInserido");
exit;
