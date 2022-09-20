<?php
session_start();
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Nova Mensagem</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../../Public/IMG/favicon.png" type="image/x-icon">
    <meta name="theme-color" content="#345D7E">
    <meta name="apple-mobile-web-app-status-bar-style" content="#345D7E">
    <meta name="msapplication-navbutton-color" content="#345D7E">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../Public/SCSS/forms.css">
    <link rel="stylesheet" type="text/css" href="../../Public/SCSS/buttons.css">
    <link rel="stylesheet" type="text/css" href="../../Public/CSS/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans|Roboto&display=swap');
    </style>
    <?php if ($tema == 1) {
        $temaSystem = "new-form-black"; ?>
        <style>
            body {
                background-color: #181a1b
            }
        </style>
    <?php } else if ($tema == 2) {
        $temaSystem = "new-form-transparent";  ?>
        <style>
            body {
                background-color: transparent;
                background-image: url(<?php echo $background ?>);
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
        </style>
    <?php } else {
        $temaSystem = "new-form";  ?>
        <style>
            body {
                background-color: white;
            }
        </style>
    <?php   } ?>
</head>

<div class="<?php echo $temaSystem ?>">
    <header>
        <div class="cabecalho-form">
            <div>
                <a type="button" href="Index.php"><button type="button" class="btn btn-sm btn-danger btnVoltar">Voltar</button></a>
            </div>
            <div class="title">
                <p>Enviar Nova Mensagem</p>
            </div>
            <div style="visibility: hidden;">
                <input type="submit" value="Gerar Descrição" class="btn btn-sm btn-success" />
            </div>
        </div>
    </header>
    <main>
        <form action="gera.php" method="post" class="p-3">
            <div class="row">
                <div class="form-group col-lg mb-2 center-align mt-2">
                    <label for="titulo">Título:</label>
                    <input required type="text" class="form-control form-control-sm" name="titulo" id="titulo" />
                </div>
            </div>

            <div class="row">
                <div class="form-group col mb-2 center-align mt-2">
                    <label for="mensagem">Mensagem:</label>
                    <textarea required class="form-control" id="mensagem" name="mensagem" rows="19"></textarea>
                </div>
            </div>

            <div class="col-lg col-xs mb-3 mt-3 center-align">
                <button type="submit" value="Gerar Descrição" class="btn btn-sm btn-danger">
                    <a style="text-decoration: none; color: white;" href="../Index.php">Página Inicial</a>
                </button>
                <input type="reset" value="Limpar" class="btn btn-sm btn-info" />
                <input type="submit" value="Enviar" class="btn btn-sm btn-success" />
            </div>
        </form>
    </main>
    </body>

</html>