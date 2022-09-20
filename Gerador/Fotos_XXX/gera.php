<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
echo '<br>' . $DataGeracao = date("Y-m-d H:i:00");
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

echo '<br>' . $titulo = $_POST["titulo"];
echo '<br>' . $capa = $_POST["capa"];
echo '<br>' . $data = $_POST["data"];
echo '<br>' . $paginas = $_POST["paginas"];
echo '<br>' . $screen1 = $_POST["screen1"];
echo '<br>' . $screen2 = $_POST["screen2"];
echo '<br>' . $screen3 = $_POST["screen3"];
echo '<br>' . $screen4 = $_POST["screen4"];
echo '<br>' . $extensao = $_POST["extensao"];
echo '<br>' . $idioma = $_POST["idioma"];
echo '<br>' . $genero = $_POST["genero"];
echo '<br>' . $publicacao = $_POST["publicacao"];
echo '<br>' . $descricao = nl2br($_POST["descricao"]);

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
    $query = "INSERT INTO fotosxxx(FkUsuario, Titulo, Capa, Genero, Descricao, Paginas, Extensao, Data, Idioma, Publicacao, Screen1, Screen2, Screen3, Screen4, DataGeracao) 
        VALUES('" . $idUsuario . "', '" . addslashes($titulo) . "', '" . $capa . "', '" . $genero . "', '" . addslashes($descricao) . "', '" . $paginas . "','" . $extensao . "','" . $data . "','" . $idioma . "','" . $publicacao . "', 
        '" . $screen1 . "', '" . $screen2 . "', '" . $screen3 . "', '" . $screen4 . "', '" .  $DataGeracao . "');";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Err36o!");
    }
    $idInserido = mysqli_insert_id($CONEXAO);
    //referencia para adicionar os produtos escolhidos na tabela de associação entre Pedido e Produto

    $CONEXAO->close();
    header("location: Foto.php?idInserido=$idInserido");
    exit;
} else if ($acao == 1) {
    $query = "UPDATE fotosxxx Set FkUsuario = '" . $idUsuario . "', Titulo = '" . addslashes($titulo) . "', Capa = '" . $capa . "', Descricao = '" . addslashes($descricao) . "', Genero = '" . $genero . "',
    Paginas = '" . $paginas . "', Extensao = '" . $extensao . "', Data = '" . $data . "', Idioma = '" . $idioma . "', Publicacao = '" . $publicacao . "',
    Screen1 = '" . $screen1 . "', Screen2 =  '" . $screen2 . "', Screen3 =  '" . $screen3 . "', Screen4 =  '" . $screen4 . "' Where Pk = '" . $Pk . "';";

    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        echo "Salvou no banco!";
    } else {
        die("Erro!");
    }
    $idInserido = mysqli_insert_id($CONEXAO);
    //referencia para adicionar os produtos escolhidos na tabela de associação entre Pedido e Produto

    $CONEXAO->close();
    header("location: Foto.php?idInserido=$Pk");
    exit;
}
