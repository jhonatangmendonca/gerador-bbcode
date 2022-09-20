<?php
session_start();
require '../../Login/check.php';
include "../../Config/Config.php";

$idUsuario = $_SESSION['PkUsuario'];
$assinatura1 = $_POST["Assinatura1"];
$assinatura2 = $_POST["Assinatura2"];
$urllancamentos = $_POST["UrlLancamentos"];
$tipofontetitulo = $_POST["TipoFonteTitulo"];
$tipofontecorpo = $_POST["TipoFonteCorpo"];
$tagextra = $_POST["TagExtra"];
$fontetitulo = $_POST["FonteTitulo"];
$fontesubtitulo = $_POST["FonteSubTitulo"];
$fontecorpo = $_POST["FonteCorpo"];
$alinhamentoTag =  $_POST["AlinhamentoTag"];
$alinhamentoTexto =  $_POST["AlinhamentoTexto"];
$alinhamentoAssinatura = $_POST["AlinhamentoAssinatura"];

$query = "UPDATE assinaturas SET Assinatura = '" . $assinatura1 . "', Assinatura2 = '" . $assinatura2 . "', UrlLancamentos = '" . $urllancamentos . "', 
TagExtra = '" . $tagextra . "', TipoFonteTitulo = '" . $tipofontetitulo . "', TipoFonteCorpo =  '" . $tipofontecorpo . "', 
FonteTitulo = $fontetitulo, FonteSubTitulo = $fontesubtitulo,  FonteCorpo = $fontecorpo, AlinhamentoTag = '" . $alinhamentoTag . "',
AlinhamentoTexto = '" . $alinhamentoTexto . "', AlinhamentoAssinatura = '" . $alinhamentoAssinatura . "'  WHERE FkUsuario = '" . $idUsuario . "';";

$resultado = $CONEXAO->query($query);
if ($resultado) {
} else {
  die("ERRO AO GRAVAR EDITAR");
}
$CONEXAO->close();
header('Location:Index.php');
exit;
