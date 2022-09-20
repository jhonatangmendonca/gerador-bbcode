<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$DataGeracao = date("Y-m-d H:i:00");
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];
$titulo = str_replace("'", "\'", $_POST["titulo"]);
$release = $_POST["release"];
$desenvolvedora = $_POST["desenvolvedora"];
$data = $_POST["data"];
$multiplay = $_POST["multiplay"];
$trailer = $_POST["trailer"];
$legenda = $_POST["legenda"];
$capa = $_POST["capa"];
$idioma = $_POST["idioma"];
$extensao = $_POST["extensao"];
$categoria = $_POST["categoria"];
$genero = $_POST["genero"];
$descricao = str_replace("'", "\'", $_POST["descricao"]);
$requisitos = str_replace("'", "\'", $_POST["requisitos"]);
$instalacao = str_replace("'", "\'", $_POST["instalacao"]);
$screen1 = $_POST["screen1"];
$screen2 = $_POST["screen2"];
$screen3 = $_POST["screen3"];
$screen4 = $_POST["screen4"];

$query = "INSERT INTO jogos(
FkUsuario, Titulo, Releaser, Desenvolvedora, Data, 
Multiplay, Trailer, Legenda, Capa, Idioma, Extensao,
Categoria, Genero, Descricao, Requisitos, 
Instalacao, Screen1, Screen2, Screen3, Screen4, DataGeracao) 
VALUES(
'" . $idUsuario . "','" . $titulo . "', '" . $release . "', '" . $desenvolvedora . "', '" . $data . "',
'" . $multiplay . "','" . $trailer . "', '" . $legenda . "','" . $capa . "', '" . $idioma . "', '" . $extensao . "',
'" . $categoria . "', '" . $genero . "', '" . addslashes($descricao) . "','" . addslashes($requisitos) . "',
'" . $instalacao . "', '" . $screen1 . "', '" . $screen2 . "', '" . $screen3 . "', '" . $screen4 . "', '" .  $DataGeracao . "');";

$resultado = $CONEXAO->query($query);
if ($resultado) {
    echo "Salvou no banco!";
} else {
    die("Erro!");
}
$idInserido = mysqli_insert_id($CONEXAO);

$CONEXAO->close();
header("location: Jogo.php?idInserido=$idInserido");
exit;
