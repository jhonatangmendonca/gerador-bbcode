<?php
session_start();
require '../../Login/check.php';
$PkDescricao =  $_GET["PkDescricao"];

$query = "DELETE FROM `adultos` WHERE `Pk` = $PkDescricao";

$resultado = $CONEXAO->query($query);
if ($resultado) {
    header("location:Index.php");
} else {
    die("Erro!");
}
