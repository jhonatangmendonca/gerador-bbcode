<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$DataGeracao = date("Y-m-d H:i:00");
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

$pk = 0;
$acao = 0;
$titulo = $_POST["titulo"];
$capa = $_POST["capa"];
$duracao = $_POST["duracao"];
$diretor = $_POST["diretor"];
$produtora = $_POST["produtora"];
$pais = $_POST["pais"];
$data = $_POST["dataLanc"];
$genero = $_POST["genero"];
$imdb = $_POST["imdb"];
$metacritic = $_POST["metacritic"];
$rotten = $_POST["rotten"];
$sinopse = nl2br($_POST["sinopse"]);
echo $elenco = nl2br($_POST["elenco"]);

if (empty($_POST["elenco2"])) {
    $elenco2 = nl2br($_POST["elenco"]);
} else {
    $elenco2 = nl2br($_POST["elenco2"]);
}

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
    $query = "INSERT INTO filmes(FkUsuario, Titulo, Capa, Duracao, Diretor, Produtora, Pais, Data, Genero, Imdb, Rotten, Metacritic, Sinopse, Elenco, Elenco2, DataGeracao) 
        VALUES('" . $idUsuario . "', '" . addslashes($titulo) . "', '" . $capa . "', '" . $duracao . "',  '" . $diretor . "','" . $produtora . "','" . $pais . "', '" . $data . "','" . $genero . "',
        '" . $imdb . "', '" . $rotten . "', '" . $metacritic . "','" . addslashes($sinopse) . "', '" . addslashes($elenco) . "', '" . addslashes($elenco2) . "', '" .  $DataGeracao . "');";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }
    $idInserido = mysqli_insert_id($CONEXAO);

    $CONEXAO->close();
    header("location: Filme.php?idInserido=$idInserido");
    exit;
} else if ($acao == 1) {
    $query = "UPDATE filmes Set FkUsuario = '" . $idUsuario . "', Titulo = '" . addslashes($titulo) . "', Capa = '" . addslashes($capa) . "', Duracao = '" . $duracao . "', Pais = '" . $pais . "', Data = '" . $data . "',
    Genero = '" . $genero . "', Imdb = '" . $imdb . "', Rotten = '" . $rotten . "', Metacritic = '" . $metacritic . "', Sinopse = '" . addslashes($sinopse) . "', Elenco = '" . addslashes($elenco) . "',
    Elenco2 = '" . addslashes($elenco2) . "' Where Pk = '" . $Pk . "';";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }
    $idInserido = mysqli_insert_id($CONEXAO);
    //referencia para adicionar os produtos escolhidos na tabela de associação entre Pedido e Produto

    $CONEXAO->close();
    header("location: Filme.php?idInserido=$Pk");
    exit;
}
