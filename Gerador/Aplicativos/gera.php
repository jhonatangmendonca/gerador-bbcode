<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$DataGeracao = date("Y-m-d H:i:00");
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

$titulo = $_POST["titulo"];
$capa = $_POST["capa"];
$build = $_POST["build"];
$data = $_POST["data"];
$screen1 = $_POST["screen1"];
$screen2 = $_POST["screen2"];
$screen3 = $_POST["screen3"];
$screen4 = $_POST["screen4"];
$categoria = $_POST["categoria"];
$extensao = $_POST["extensao"];
$idioma = $_POST["idioma"];
$plataforma = $_POST["plataforma"];
$descricao = nl2br($_POST["descricao"]);
$requisitos = nl2br($_POST["requisitos"]);
$instalacao = nl2br($_POST["instalacao"]);

if (empty($_POST["Pk"])) {
    $Pk = 0;
} else {
    $Pk = $_POST["Pk"];
}

$acao = 0;
if (empty($_POST["acao"])) {
    $acao = 0;
} else {
    $acao = 1;
}
if ($acao == 0) {
    $query = "INSERT INTO aplicativos(FkUsuario, Titulo, Capa, Descricao, Build, Plataforma, Categoria, Data, Idioma, Extensao, Requisitos, Instalacao, Screen1, Screen2, Screen3, Screen4, DataGeracao) 
        VALUES('" . $idUsuario . "', '" . addslashes($titulo) . "', '" . $capa . "', '" . addslashes($descricao) . "', '" . $build . "','" . $plataforma . "','" . $categoria . "','" . $data . "','" . $idioma . "', '" . $extensao . "', '" . addslashes($requisitos) . "', 
        '" . addslashes($instalacao) . "', '" . $screen1 . "', '" . $screen2 . "', '" . $screen3 . "', '" . $screen4 . "', '" .  $DataGeracao . "');";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }
    $idInserido = mysqli_insert_id($CONEXAO);
    //referencia para adicionar os produtos escolhidos na tabela de associação entre Pedido e Produto

    $CONEXAO->close();
    header("location: Aplicativo.php?idInserido=$idInserido");
    exit;
} else if ($acao == 1) {
    $query = "UPDATE aplicativos Set FkUsuario = '" . $idUsuario . "', Titulo = '" . addslashes($titulo) . "', Capa = '" . $capa . "', Descricao = '" . addslashes($descricao) . "', Build = '" . $build . "',
    Plataforma = '" . $plataforma . "', Categoria = '" . $categoria . "', Data = '" . $data . "', Idioma = '" . $idioma . "', Extensao = '" . $extensao . "', Requisitos = '" . addslashes($requisitos) . "',
    Instalacao = '" . addslashes($instalacao) . "', Screen1 = '" . $screen1 . "', Screen2 =  '" . $screen2 . "', Screen3 =  '" . $screen3 . "', Screen4 =  '" . $screen4 . "' Where Pk = '" . $Pk . "';";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }
    $idInserido = mysqli_insert_id($CONEXAO);
    //referencia para adicionar os produtos escolhidos na tabela de associação entre Pedido e Produto

    $CONEXAO->close();
    header("location: Aplicativo.php?idInserido=$Pk");
    exit;
}
