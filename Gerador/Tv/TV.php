<?php
session_start();
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];
$idInserido =  $_GET['idInserido'];

$query = "SELECT 1 FROM tv WHERE Pk = $idInserido";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    if ($resultado->num_rows == 0) {
        echo "<script>location.href='Index.php';</script>";
    }
}
?>
<html>

<head>
    <title>Gerador de TV</title>
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

<body class="<?php echo $temaSystem ?>">
    <form action="https://cliente.####.club/enviar-tv.php" method="post" target="_blank">
        <header>
            <div class="cabecalho-form">
                <div>
                    <a type="button" href="Index.php"><button type="button" class="btn btn-sm btn-danger btnVoltar">Voltar</button></a>
                </div>
                <div class="title" style="width: 55% !important;">
                    <p>Descrição Gerada</p>
                </div>
                <div class="mr-2">
                    <input type="button" value="Copiar Descrição" onclick="CopiaDescricao();fnCopiar();" class="btn btn-sm btn-secondary btnCopy" />
                </div>
                <div>
                    <input type="submit" value="Abrir Site" onclick="CopiaDescricao();" class="btn btn-sm btn-primary btnSite" />
                </div>
                <div class="ml-2">
                    <a id="BtnAbreEdicao" href="NovoTV.php"><button type="button" class="btn btn-sm btn-success btnAdicionar">Adicionar</button></a>
                </div>
            </div>
        </header>
        <main>
            <textarea id="descrCopia" style="margin-top: -1000px;">
<?php
$idInserido =  $_GET["idInserido"];

$query = " SELECT T.*, S.*, A.* FROM tv S 
inner join assinaturas A On S.FkUsuario = A.FkUsuario
inner join tags T On T.FkUsuario = A.FkUsuario  
WHERE S.Pk = $idInserido";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            $assinatura = $linha["Assinatura"];
            $assinatura2 = $linha["Assinatura2"];
            $Titulo = $linha["Titulo"];
            $Capa = $linha["Capa"];
            $Screen1 = $linha["Screen1"];
            $Screen2 = $linha["Screen2"];
            $Screen3 = $linha["Screen3"];
            $Screen4 = $linha["Screen4"];
            $Largura = $linha["Largura"];
            $Altura = $linha["Altura"];
            $alinhamentoTag =  $linha["AlinhamentoTag"];
            $alinhamentoTexto =  $linha["AlinhamentoTexto"];
            $alinhamentoAssinatura = $linha["AlinhamentoAssinatura"];

            echo "[" . $alinhamentoTag . "]";
            echo "[img]" . $linha["Features"] . "[/img]";
            echo "[/" . $alinhamentoTag . "]";
            echo "\n";
            echo "[" . $alinhamentoTexto . "]";
            echo "[b][size=" . $linha["FonteTitulo"] . "][font=" . $linha["TipoFonteTitulo"] . "]" . $linha["Titulo"] . "[/size][/b][/font]";
            echo "[/" . $alinhamentoTexto . "]";
            echo "\n";
            echo "[" . $alinhamentoTag . "]";
            echo "[img]" . $linha["Cover"] . "[/img]";
            echo "[/" . $alinhamentoTag . "]";
            echo "\n";
            echo "[" . $alinhamentoTexto . "]";
            echo "[size=" . $linha["FonteCorpo"] . "][font=" . $linha["TipoFonteCorpo"] . "][img]" . $linha["Capa"] . "[/img]";
            echo "[/" . $alinhamentoTexto . "]";
            echo "\n";
            echo "[" . $alinhamentoTag . "]";
            echo "[img]" . $linha["Description"] . "[/img]";
            echo "[/" . $alinhamentoTag . "]";
            echo "\n";
            echo "[" . $alinhamentoTexto . "]";
            echo "" . str_replace("<br />", "", $linha["Descricao"]) . "";
            echo "[/" . $alinhamentoTexto . "]";
            echo "\n";
            echo "[" . $alinhamentoTag . "]";
            echo "[img]" . $linha["Datasheet"] . "[/img]";
            echo "[/" . $alinhamentoTag . "]";
            echo "\n";
            echo "[" . $alinhamentoTexto . "]";
            echo "[b]Formato: [/b]" . $linha["Formato"] . "\n";
            echo "[b]Qualidade: [/b]" . $linha["Qualidade"] . "\n";
            echo "[b]Codec de Áudio: [/b]" . $linha["CodecAudio"] . "\n";
            echo "[b]Codec de Vídeo: [/b]" . $linha["CodecVideo"] . "\n";
            echo "[b]Resolução: [/b]" . $linha["Resolucao"] . "\n";
            echo "[b]Data de Lançamento: [/b]" . $linha["Data"] . "\n";
            echo "[b]Duração: [/b]" . $linha["Duracao"] . "\n";
            echo "[b]Idioma: [/b]" . $linha["Idioma"] . "\n";
            echo "[b]Legenda: [/b]" . $linha["Legenda"] . "";
            echo "[/" . $alinhamentoTexto . "]";
            echo "\n";
            echo "[" . $alinhamentoTag . "]";
            echo "[img]" . $linha["Cast"] . "[/img]";
            echo "[/" . $alinhamentoTag . "]";
            echo "\n";
            echo "[" . $alinhamentoTexto . "]";
            echo "" . str_replace("<br />", "", $linha["Elenco"]) . "";
            echo "[/" . $alinhamentoTexto . "]";
            echo "\n";
            echo "[" . $alinhamentoTag . "]";
            echo "[img]" . $linha["Acknowledgment"] . "[/img]";
            echo "[/" . $alinhamentoTag . "]";
            echo "\n";
            if ($assinatura != "") {
                echo "[" . $alinhamentoAssinatura . "]";
                echo "[url=" . $linha["UrlLancamentos"] . "][img]" . $linha["Assinatura"] . "[/img][/url]";
                echo "[/" . $alinhamentoAssinatura . "]";
            }
            if ($assinatura2 != "") {
                echo "\n";
                echo "[" . $alinhamentoAssinatura . "]";
                echo "[url=" . $linha["UrlLancamentos"] . "][img]" . $linha["Assinatura2"] . "[/img][/url]";
                echo "[/" . $alinhamentoAssinatura . "]";
            }

            echo "\n";
            echo "[" . $alinhamentoTag . "]";
            echo "[img]" . $linha["Screens"] . "[/img]";
            echo "[/" . $alinhamentoTag . "]";
            echo "[/font][/size]";
        }
    } else {
        header("location:Index.php");
    }
} else {
    die("Erro!");
}
?>
</textarea>
            <div class="row justify-content-center m-5">
                <?php
                $idInserido =  $_GET["idInserido"];

                $query = " SELECT T.*, S.*, A.* FROM tv S 
                inner join assinaturas A On S.FkUsuario = A.FkUsuario
                inner join tags T On T.FkUsuario = A.FkUsuario  
                WHERE S.Pk = $idInserido";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $assinatura = $linha["Assinatura"];
                            $assinatura2 = $linha["Assinatura2"];
                            $Titulo = $linha["Titulo"];
                            $Capa = $linha["Capa"];
                            $Screen1 = $linha["Screen1"];
                            $Screen2 = $linha["Screen2"];
                            $Screen3 = $linha["Screen3"];
                            $Screen4 = $linha["Screen4"];

                            if ($linha["AlinhamentoTag"] == "center") {
                                $alinhamentoTag = "center-align";
                            } else if ($linha["AlinhamentoTag"] == "left") {
                                $alinhamentoTag = "left-align";
                            } else {
                                $alinhamentoTag = "right-align";
                            }

                            if ($linha["AlinhamentoTexto"] == "center") {
                                $alinhamentoTexto = "center-align";
                            } else if ($linha["AlinhamentoTexto"] == "left") {
                                $alinhamentoTexto = "left-align";
                            } else {
                                $alinhamentoTexto = "right-align";
                            }

                            if ($linha["AlinhamentoAssinatura"] == "center") {
                                $alinhamentoAssinatura = "center-align";
                            } else if ($linha["AlinhamentoAssinatura"] == "left") {
                                $alinhamentoAssinatura = "left-align";
                            } else {
                                $alinhamentoAssinatura = "right-align";
                            }

                            if ($linha["TagExtra"] !== '') {   ?>
                                <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                    <img src="<?php echo $linha["TagExtra"] ?>">
                                </div>
                            <?php  }

                            ?>
                            <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Features"] ?>">
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTexto ?> mb-5">
                                <p class="h3"><?php echo $linha["Titulo"] ?></p>
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Cover"] ?>">
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTexto ?> mb-5">
                                <img width="300" src="<?php echo $linha["Capa"] ?>">
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Description"] ?>">
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTexto ?> mb-5">
                                <p><?php echo $linha["Descricao"] ?></p>
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Datasheet"] ?>">
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTexto ?> mb-5">
                                <b>Formato: </b><?php echo $linha["Formato"] ?><br />
                                <b>Qualidade: </b><?php echo $linha["Qualidade"] ?><br />
                                <b>Codec de Áudio: </b><?php echo $linha["CodecAudio"] ?><br />
                                <b>Codec de Vídeo: </b><?php echo $linha["CodecVideo"] ?><br />
                                <b>Resolução: </b><?php echo $linha["Resolucao"] ?><br />
                                <b>Idioma: </b><?php echo $linha["Idioma"] ?><br />
                                <b>Data de Lançamento: </b><?php echo $linha["Data"] ?><br />
                                <b>Duracao: </b><?php echo $linha["Duracao"] ?><br />
                                <b>Idioma: </b><?php echo $linha["Idioma"] ?><br />
                                <b>Legenda: </b><?php echo $linha["Legenda"] ?>
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Cast"] ?>">
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTexto ?> mb-5">
                                <p><?php echo $linha["Elenco"] ?></p>
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Acknowledgment"] ?>">
                            </div>

                            <?php
                            if ($assinatura != "") {
                            ?>
                                <div class="col-12 <?php echo $alinhamentoAssinatura ?> mb-5">
                                    <a href="<?php echo $linha["UrlLancamentos"] ?>" target="_blank"><img src="<?php echo $linha["Assinatura"] ?>"></a>
                                </div>
                            <?php
                            }
                            if ($assinatura != "") {
                            ?>
                                <div class="col-12 <?php echo $alinhamentoAssinatura ?> mb-5">
                                    <a href="<?php echo $linha["UrlLancamentos"] ?>" target="_blank"><img src="<?php echo $linha["Assinatura2"] ?>"></a>
                                </div>

                            <?php
                            }
                            ?>
                            <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Screens"] ?>">
                            </div>
                <?php
                        }
                    } else {
                        header("location:Index.php");
                    }
                } else {
                    die("Erro!");
                }
                ?>
            </div>

            <div class="item-hide">
                <input type="text" value="<?php echo $Titulo ?>" name="name" id="name" />

                <input value="<?php echo $Capa ?>" type="text" name="capa" id="capa" />

                <input value="<?php echo $Largura ?>" type="text" name="largura" id="largura" />

                <input value="<?php echo $Altura ?>" type="text" name="altura" id="altura" />

                <input value="<?php echo $Screen1 ?>" type="text" name="screens1" id="screens1" />

                <input value="<?php echo $Screen2 ?>" type="text" name="screens2" id="screens2" />

                <input value="<?php echo $Screen3 ?>" type="text" name="screens3" id="screens3" />

                <input value="<?php echo $Screen4 ?>" type="text" name="screens4" id="screens4" />
            </div>
        </main>
    </form>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../../Public/JS/Gerador.js"></script>
<script type="text/javascript" src="../../Public/JS/SweetAlert.js"></script>

</html>