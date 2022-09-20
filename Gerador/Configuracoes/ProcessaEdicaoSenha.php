<?php
session_start();
require '../../Login/check.php';
include "../../Config/Config.php";

$idUsuario = $_SESSION['PkUsuario'];
$Email = ($_POST["Email"]);
$Usuario = ($_POST["Usuario"]);
$Senha = base64_encode($_POST["Senha"]);

$query = "UPDATE usuarios SET Email = '" . $Email . "', NomeUsuario = '" . $Usuario . "', Senha = '" . $Senha . "', Senha2 = '" . $Senha . "'  WHERE Pk = '" . $idUsuario . "';";

$resultado = $CONEXAO->query($query);
if ($resultado) {
} else {
  die("ERRO AO GRAVAR EDITAR");
}
$CONEXAO->close();
header('Location:Index.php');
exit;
