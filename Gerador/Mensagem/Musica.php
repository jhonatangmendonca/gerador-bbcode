<?php
session_start();
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];
?>
<html>

<head>
    <title>Gerador de Músicas</title>
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
</head>

<body class="new-form">
    <form action="https://cliente.####.club/enviar-musicas.php" method="post" target="_blank">
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
            </div>
        </header>
        <main>
            <textarea id="descrCopia" style="margin-top: -1000px;">
            <?php
            $idInserido =  $_GET["idInserido"];

            $query = " SELECT T.*, M.*, A.* FROM musicas M 
            inner join assinaturas A On M.FkUsuario = A.FkUsuario
            inner join tags T On T.FkUsuario = A.FkUsuario 
            WHERE M.Pk = $idInserido";
            $resultado = $CONEXAO->query($query);
            if ($resultado) {
                if ($resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_assoc()) {
                        $assinatura = $linha["Assinatura"];
                        $assinatura2 = $linha["Assinatura2"];
                        $artista = $linha["Artista"];
                        $capa = $linha["Capa"];
                        $artista = $linha["Artista"];
                        $album = $linha["Album"];
                        $loja = $linha["Loja"];
                        $alinhamentoTag =  $linha["AlinhamentoTag"];
                        $alinhamentoTexto =  $linha["AlinhamentoTexto"];
                        $alinhamentoAssinatura = $linha["AlinhamentoAssinatura"];

                        echo "[" . $alinhamentoTag . "]";
                        echo "[img]" . $linha["Features"] . "[/img]";
                        echo "[/" . $alinhamentoTag . "]";
                        echo "\n";
                        echo "[" . $alinhamentoTexto . "]";
                        echo "[font=" . $linha["TipoFonteTitulo"] . "][b][size=" . $linha["FonteTitulo"] . "]" . $linha["Artista"] . "[/size][/b]";
                        echo "\n";
                        echo "[b][size=" . $linha["FonteSubTitulo"] . "]" . $linha["Album"] . "[/size][/b][/font]";
                        echo "[/" . $alinhamentoTexto . "]";
                        echo "\n";
                        echo "[" . $alinhamentoTag . "]";
                        echo "[size=" . $linha["FonteCorpo"] . "][font=" . $linha["TipoFonteCorpo"] . "][img]" . $linha["Cover"] . "[/img]";
                        echo "[/" . $alinhamentoTag . "]";
                        echo "\n";
                        echo "[" . $alinhamentoTexto . "]";
                        echo "[img]" . $linha["Capa"] . "[/img]";
                        echo "[/" . $alinhamentoTexto . "]";
                        echo "\n";
                        echo "[" . $alinhamentoTag . "]";
                        echo "[img]" . $linha["Datasheet"] . "[/img]";
                        echo "[/" . $alinhamentoTag . "]";
                        echo "\n";
                        echo "[" . $alinhamentoTexto . "]";
                        echo "[b]Data de Lançamento: [/b]" . $linha["Data"] . "\n";
                        echo "[b]Formato: [/b]" . $linha["Formato"] . "\n";
                        echo "[b]Qualidade: [/b]" . $linha["Qualidade"] . "\n";
                        echo "[b]Gênero: [/b]" . $linha["Genero"] . "";
                        echo "[/" . $alinhamentoTexto . "]";
                        echo "\n";
                        echo "[" . $alinhamentoTag . "]";
                        echo "[img]" . $linha["Tracks"] . "[/img]";
                        echo "[/" . $alinhamentoTag . "]";
                        echo "\n";
                        echo "[" . $alinhamentoTexto . "]";
                        echo str_replace("<br />", "", $linha["Faixas"]);
                        echo "[/" . $alinhamentoTexto . "]";
                        echo "\n";
                        echo "[" . $alinhamentoTag . "]";
                        echo "\n\n[img]" . $linha["Information"] . "[/img]";
                        echo "[/" . $alinhamentoTag . "]";
                        echo "\n";
                        echo "[" . $alinhamentoTexto . "]";
                        echo "[url=" . $linha["Loja"] . "][color=#ff0000] [b]Link de Venda[/b][/color][/url]";
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

                $query = " SELECT T.*, M.*, A.* FROM musicas M 
                inner join assinaturas A On M.FkUsuario = A.FkUsuario
                inner join tags T On T.FkUsuario = A.FkUsuario 
                WHERE M.Pk = $idInserido";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $assinatura = $linha["Assinatura"];
                            $assinatura2 = $linha["Assinatura2"];
                            $artista = $linha["Artista"];
                            $capa = $linha["Capa"];
                            $artista = $linha["Artista"];
                            $album = $linha["Album"];
                            $loja = $linha["Loja"];

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
                                <p class="h3"><?php echo $linha["Artista"] ?></p>
                                <p class="h4"><?php echo $linha["Album"] ?></p>
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Cover"] ?>">
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTexto ?> mb-5">
                                <img width="300" src="<?php echo $linha["Capa"] ?>">
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Datasheet"] ?>">
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTexto ?> mb-5">
                                <b>Data de Lançamento: </b><?php echo $linha["Data"] ?><br />
                                <b>Formato: </b><?php echo $linha["Formato"] ?><br />
                                <b>Qualidade: </b><?php echo $linha["Qualidade"] ?><br />
                                <b>Gênero: </b><?php echo $linha["Genero"] ?>
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Tracks"] ?>">
                            </div>

                            <div class="col-12 center-align mb-5">
                                <p><?php echo $linha["Faixas"] ?></p>
                            </div>

                            <div class="col-12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Information"] ?>">
                            </div>

                            <div class="col-12 center-align mb-5">
                                <a href="<?php echo $linha["Loja"] ?>" target="_blank"><span class="text-danger">Link de Venda</span></a>
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
                <input type="text" value="<?php echo $artista ?> - <?php echo $album ?>" name="name" id="name" />

                <input value="<?php echo $capa ?>" type="text" name="capa" id="capa" />

                <input value="<?php echo $artista ?>" type="text" name="screens1" id="screens1" />

                <input value="<?php echo $album ?>" type="text" name="screens2" id="screens2" />

                <input value="<?php echo $loja ?>" type="text" name="screens3" id="screens3" />
            </div>

    </form>
    </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../../Public/JS/Gerador.js"></script>
<script type="text/javascript" src="../../Public/JS/SweetAlert.js"></script>

</html>