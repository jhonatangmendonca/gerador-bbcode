<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

$titulo = addslashes($_POST["titulo"]);
$capa = $_POST["capa"];
$data = $_POST["data"];
// $resolucao = $_POST["largura"] . "x" . $_POST["altura"];
$resolucao = "";
$largura = $_POST["largura"];
$altura = $_POST["altura"];
$descricao = nl2br($_POST["descricao"]);
$elenco = nl2br($_POST["elenco"]);
$qualidade = $_POST["qualidade"];
$tipoAudio = $_POST["tipoAudio"];
$codecAudio = $_POST["codecAudio"];
$codecVideo = $_POST["codecVideo"];
$formato = $_POST["formato"];
$legenda = $_POST["legenda"];
$idioma = $_POST["idioma"];
$duracao = $_POST["duracao"];
$direcao = $_POST["direcao"];
$genero = $_POST["genero"];
$categoria = $_POST["categoria"];
$screen1 = $_POST["screen1"];
$screen2 = $_POST["screen2"];
$screen3 = $_POST["screen3"];
$screen4 = $_POST["screen4"];
$DataGeracao = date("Y-m-d H:i:00");

$query = "INSERT INTO tv(FkUsuario, Titulo, Capa, Data, Resolucao, Largura, Altura, Descricao, Elenco, Qualidade, TipoAudio, CodecAudio, CodecVideo, Formato, Legenda, Idioma, Duracao, Direcao, Genero, Categoria, Screen1, Screen2, Screen3, Screen4, DataGeracao) 
VALUES('" . $idUsuario . "', '" . addslashes($titulo) . "', '" . $capa . "', '" . $data . "', '" . $resolucao . "', '" . $largura . "', '" . $altura . "', '" . addslashes($descricao) . "', '" . addslashes($elenco) . "', '" . $qualidade . "', '" . $tipoAudio . "', '" . $codecAudio . "', '" . $codecVideo . "', '" . $formato . "', '" . $legenda . "', '" . $idioma . "', '" . $duracao . "', '" . $direcao . "', '" . $genero . "', '" . $categoria . "', '" . $screen1 . "', '" . $screen2 . "', '" . $screen3 . "', '" . $screen4 . "', '" . $DataGeracao . "');";

$resultado = $CONEXAO->query($query);
if (!$resultado)
    die("Erro!");

$idInserido = mysqli_insert_id($CONEXAO);

$CONEXAO->close();
header("location: TV.php?idInserido=$idInserido");
exit;
