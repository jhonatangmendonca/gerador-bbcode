<?php
session_start();
require '../../Login/check.php';
include "../../Config/Config.php";

$idUsuario = $_SESSION['PkUsuario'];
$Apresenta = $_POST["Apresenta"];
$Criticas = $_POST["Criticas"];
$Descricao = $_POST["Descricao"];
$Elenco = $_POST["Elenco"];
$Capa = $_POST["Capa"];
$Episodios = $_POST["Episodios"];
$Faixas = $_POST["Faixas"];
$FichaTecnica = $_POST["FichaTecnica"];
$Informacoes =  $_POST["Informacoes"];
$Instalacao =  $_POST["Instalacao"];
$Requisitos = $_POST["Requisitos"];
$RequisitosRecomendados = $_POST["RequisitosRecomendados"];
$RequisitosMinimos = $_POST["RequisitosMinimos"];
$Screens = $_POST["Screens"];
$Sinopse = $_POST["Sinopse"];
$Trailer =  $_POST["Trailer"];
$Agradecimento =  $_POST["Agradecimento"];

$query = "UPDATE tags SET Features = '" . $Apresenta . "', Reviews = '" . $Criticas . "', Description = '" . $Descricao . "', Cast = '" . $Elenco . "', Cover =  '" . $Capa . "', Episodes = '" . $Episodios . "', Tracks = '" . $Faixas . "',  Datasheet = '" . $FichaTecnica . "', Information = '" . $Informacoes . "', Installation = '" . $Instalacao . "', Requirements = '" . $Requisitos . "', RequirementsRecommended = '" . $RequisitosRecomendados . "', RequirementsMinimum = '" . $RequisitosMinimos . "',  Screens = '" . $Screens . "', Synopsis = '" . $Sinopse . "',TrailerTag = '" . $Trailer . "', Acknowledgment = '" . $Agradecimento . "' WHERE FkUsuario = '" . $idUsuario . "';";

$resultado = $CONEXAO->query($query);
if ($resultado) {
  echo $Trailer =  $resultado;
} else {
  die("ERRO AO GRAVAR EDITAR");
}
$CONEXAO->close();
header('Location:Index.php');
exit;
