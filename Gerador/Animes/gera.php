<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$DataGeracao = date("Y-m-d H:i:00");
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
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
$direcao = $_POST["direcao"];
$genero = $_POST["genero"];
$tipoAudio = $_POST["tipoAudio"];
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
    $query = "INSERT INTO animes(FkUsuario, Titulo, Capa, Data, Resolucao, Descricao, Elenco, Qualidade, TipoAudio, CodecAudio, CodecVideo,	Formato, Legenda, Idioma, IdiomaOriginal, Duracao, Direcao, Genero, Screen1, Screen2, Screen3, Screen4, DataGeracao) 
        VALUES('" . $idUsuario . "', '" . addslashes($titulo) . "', '" . $capa . "', '" . $data . "', '" . $resolucao . "','" . addslashes($descricao) . "', '" . addslashes($musicas) . "', '" . $qualidade . "','" . $tipoAudio . "','" . $audio . "',
         '" . $video . "', '" . $formato . "', '" . $legenda . "','" . $idioma . "', '" . $idiomaOriginal . "', '" . $duracao . "', '" . $direcao . "', '" . $genero . "', '" . $screen1 . "', '" . $screen2 . "', '" . $screen3 . "', '" . $screen4 . "', '" .  $DataGeracao . "');";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }
    $idInserido = mysqli_insert_id($CONEXAO);

    $CONEXAO->close();
    header("location: Anime.php?idInserido=$idInserido");
    exit;
} else if ($acao == 1) {
    $query = "UPDATE animes Set FkUsuario = '" . $idUsuario . "', Titulo = '" . addslashes($titulo) . "', Capa = '" . $capa . "', Data = '" . $data . "', Resolucao = '" . $resolucao . "',
    Descricao = '" . addslashes($descricao) . "', Elenco = '" . addslashes($musicas) . "', Qualidade = '" . $qualidade . "', TipoAudio = '" . $tipoAudio . "', CodecAudio = '" . $audio . "',    
    CodecVideo = '" . $video . "', Formato = '" . $formato . "', Legenda = '" . $legenda . "', Idioma = '" . $idioma . "', IdiomaOriginal = '" . $idiomaOriginal . "',
    Duracao = '" . $duracao . "', Direcao = '" . $direcao . "', Genero = '" . $genero . "', Screen1 = '" . $screen1 . "', Screen2 = '" . $screen2 . "',   
    Screen3 = '" . $screen3 . "', Screen4 = '" . $screen4 . "' Where Pk = '" . $Pk . "';";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }

    $CONEXAO->close();
    header("location: Anime.php?idInserido=$Pk");
    exit;
}
