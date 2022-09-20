<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$DataGeracao = date("Y-m-d H:i:00");
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$editora = $_POST["editora"];
$data = $_POST["data"];
$genero = $_POST["genero"];
$volume = $_POST["volume"];
$edicao = $_POST["edicao"];
$paginas = $_POST["paginas"];
$capa = $_POST["capa"];
$idioma = $_POST["idioma"];
$formato = $_POST["formato"];
$descricao = nl2br($_POST["descricao"]);
$screen1 = $_POST["screen1"];
$screen2 = $_POST["screen2"];
$Pk = $_POST["Pk"];
if (empty($_POST["acao"])) {
    $acao = 0;
} else {
    $acao = 1;
}

if ($acao == 0) {
    $query = "INSERT INTO livros(FKUsuario, Titulo, Autor, Editora, Data, Genero, Volume, Edicao, Paginas, Capa, Idioma, Formato, Descricao, Screen1, Screen2, DataGeracao) 
    VALUES('" . $idUsuario . "','" . addslashes($titulo) . "', '" . $autor . "', '" . $editora . "', '" . $data . "','" . $genero . "','" . $volume . "', '" . $edicao . "','" . $paginas . "', '" . $capa . "',
    '" . $idioma . "', '" . $formato . "', '" . addslashes($descricao) . "', '" . $screen1 . "', '" . $screen2 . "', '" .  $DataGeracao . "');";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }
    $idInserido = mysqli_insert_id($CONEXAO);
    //referencia para adicionar os produtos escolhidos na tabela de associação entre Pedido e Produto

    $CONEXAO->close();
    header("location: Livro.php?idInserido=$idInserido");
    exit;
} else if ($acao == 1) {
    $query = "UPDATE livros Set Titulo = '" . addslashes($titulo) . "', Autor = '" . $autor . "', Editora = '" . $editora . "',
    Data = '" . $data . "', Genero = '" . $genero . "', Volume = '" . $volume . "',  Edicao = '" . $edicao . "', Paginas = '" . $paginas . "', Capa = '" . $capa . "',
    Idioma = '" . $idioma . "', Formato = '" . $formato . "', Descricao = '" . addslashes($descricao) . "', Screen1 = '" . $screen1 . "', Screen2 = '" . $screen2 . "' 
    Where Pk = '" . $Pk . "';";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }

    $CONEXAO->close();
    header("location: Livro.php?idInserido=$Pk");
    exit;
}
