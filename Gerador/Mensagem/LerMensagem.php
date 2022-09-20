<?php
session_start();
require '../../Login/check.php';
$PkMensagem =  $_GET["PkMensagem"];

$query = "UPDATE `mensagens` Set Status = 1 WHERE `Pk` = $PkMensagem";

$resultado = $CONEXAO->query($query);
if ($resultado) {
    header("location:Index.php");
} else {
    die("Erro!");
}
