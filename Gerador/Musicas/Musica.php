<?php
session_start();
require './../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];
$idInserido =  $_GET['idInserido'];

$query = "SELECT 1 FROM musicas WHERE Pk = $idInserido";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    if ($resultado->num_rows == 0) {
        echo "<script>location.href='Index.php';</script>";
    }
}

$contMensagem = 0;
$query = "SELECT * FROM mensagens where Status = 0 And FkUsuario = $idUsuario";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            $contMensagem++;
        }
    }
}

$Users = 0;
$query = "SELECT count(Pk) Pk FROM usuarios Where Pk != 1 And Pk != 4";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            $Users = $linha["Pk"];
        }
    }
}
?>

<html>

<head>
    <!-- TITLE  -->
    <title>Músicas</title>
    <meta charset="utf-8">
    <meta name="theme-color" content="#000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">
    <meta name="msapplication-navbutton-color" content="#000">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- FAVICON  -->
    <link rel="shortcut icon" href="./../../Public/IMG/favicon.png" type="image/x-icon" />
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="./../../Public/CSS/Menu.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./../../Public/CSS/Classes.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./../../Public/SCSS/buttons.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./../../Public/SCSS/layout.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./../../Public/CSS/spacing.css" media="screen,projection" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

    <!-- SCRIPT -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</head>

<body>
    <ul id="slide-out" class="side-nav fixed z-depth-2">
        <li class="center no-padding">
            <div class="black darken-2 white-text" style="height: 190px;">
                <div class="row">
                    <img style="margin-top: 15%;" width="100" height="100" src="./../../Public/IMG/logo.png" class="responsive-img" />
                </div>
                <span class="white-text name"> <?php echo $usuario; ?></span>
            </div>
        </li>

        <li id="dash_users">
            <a href="./../Index.php" style="padding-right: 32px;"><b>Página Inicial</b>
                <i style="float: right; line-height: 64px;" class="material-icons">home</i>
            </a>
        </li>

        <li id="dash_users">
            <a href="./../Mensagem/Index.php" style="padding-right: 32px;"><b>Mensagens</b>
                <i style="float: right; line-height: 64px;" class="material-icons">chat</i>
                <span class="red-text text-destaque" style="right: 87px; float: right;line-height: 62px; position: absolute;"><?php echo $contMensagem; ?></span>
            </a>
        </li>

        <?php if ($idUsuario == 1) { ?>
            <li id="dash_users">
                <a href="./../Admin/Index.php" style="padding-right: 32px;"><b>Usuários</b>
                    <i style="float: right; line-height: 64px;" class="material-icons">group</i>
                    <span class="red-text text-destaque" style="right: 87px; float: right;line-height: 62px; position: absolute;"><?php echo $Users; ?></span>
                </a>
            </li>
        <?php }  ?>

        <li id="dash_users">
            <a target="_blank" href="####" style="padding-right: 32px;"><b>Topico do Gerador</b>
                <i style="float: right; line-height: 64px;" class="material-icons">forum</i>
            </a>
        </li>

        <li id="dash_users">
            <a target="_blank" href="https://mpago.la/2Af2AHc" style="padding-right: 32px;"><b>Faça uma Doação</b>
                <i style="float: right; line-height: 64px;" class="material-icons">credit_card</i>
            </a>
        </li>

        <li id="dash_users">
            <a target="_blank" href="./../Configuracoes/Index.php" style="padding-right: 32px;"><b>Configurações</b>
                <i style="float: right; line-height: 64px;" class="material-icons">settings</i>
            </a>
        </li>

        <li id="dash_users">
            <a onclick="fnFazLogout();" style="padding-right: 30px;"><b>Sair</b>
                <i style="float: right; line-height: 64px; padding-left: 10px;" class="material-icons">logout</i>
            </a>
        </li>
    </ul>

    <header style="position: fixed; height: 56px !important; z-index: 10; width: 100vw; top:0">
        <nav style="background-color: transparent; box-shadow: none;">
            <a style="margin-left: 15px;" href="#" data-target="slide-out" data-activates="slide-out" class="sidenav-trigger  button-collapse"><i class="mdi-navigation-menu"></i></a>

            <div class="black darken-2">
                <a style="margin-left: 20px;" class="breadcrumb white-text" href="./../Index.php">Página Inicial</a>
                <a class="breadcrumb white-text" href="./Index.php">Músicas</a>
                <span class="breadcrumb grey-text lighten-5">Descrição</span>

            </div>
        </nav>
    </header>

    <main class="container" style="margin-top: 80px;margin-bottom: 80px;">
        <form class="center-align" action="https://cliente.####.club/enviar-musicas.php" method="post" target="_blank">
            <textarea id="descrCopia" style="margin-top: -1000px;">
                    <?php
                    $idInserido =  $_GET["idInserido"];

                    $query = " SELECT T.*, M.*, A.* FROM musicas M 
                     join assinaturas A On M.FkUsuario = A.FkUsuario
                     join tags T On T.FkUsuario = A.FkUsuario 
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
                                $trailerMusica = $linha["TrailerMusica"];
                                $alinhamentoTag =  $linha["AlinhamentoTag"];
                                $alinhamentoTexto =  $linha["AlinhamentoTexto"];
                                $alinhamentoAssinatura = $linha["AlinhamentoAssinatura"];
                                $tagextra = $linha["TagExtra"];

                                if ($linha["TagExtra"] !== '') {
                                    echo "[" . $alinhamentoTag . "]";
                                    echo "[img]" . $tagextra . "[/img]";
                                    echo "[/" . $alinhamentoTag . "]";
                                    echo "\n";
                                }
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
                                echo "[url=" . $linha["Loja"] . "][color=#ff0000] [b]Loja Oficial[/b][/color][/url]";
                                echo "[/" . $alinhamentoTexto . "]";
                                echo "\n";
                                if ($trailerMusica != "") {
                                    echo "[" . $alinhamentoTag . "]";
                                    echo "[img]" . $linha["TrailerTag"] . "[/img]";
                                    echo "[/" . $alinhamentoTag . "]";
                                    echo "\n";
                                    echo "[" . $alinhamentoTexto . "]";
                                    echo "[video]" . trim($linha["TrailerMusica"]) . "[/video]";
                                    echo "[/" . $alinhamentoTexto . "]";
                                    echo "\n";
                                }

                                echo "[" . $alinhamentoTag . "]";
                                echo "[img]" . $linha["Acknowledgment"] . "[/img]";
                                echo "[/" . $alinhamentoTag . "]";

                                if ($assinatura != "") {
                                    echo "\n";
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
            <div class="row center-align">
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
                                <div class="col s12 m12 l12 <?php echo $alinhamentoTag ?> mb-5">
                                    <img src="<?php echo $linha["TagExtra"] ?>">
                                </div>
                            <?php  }

                            ?>
                            <div class="col s12 m12 l12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Features"] ?>">
                            </div>

                            <div class="col s12 m12 l12 mb-5">
                                <p class="h3 <?php echo $alinhamentoTexto ?>"><?php echo $linha["Artista"] ?></p>
                                <p class="h4 <?php echo $alinhamentoTexto ?>"><?php echo $linha["Album"] ?></p>
                            </div>

                            <div class="col s12 m12 l12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Cover"] ?>">
                            </div>

                            <div class="col s12 m12 l12 <?php echo $alinhamentoTexto ?> mb-5">
                                <img width="300" src="<?php echo $linha["Capa"] ?>">
                            </div>

                            <div class="col s12 m12 l12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Datasheet"] ?>">
                            </div>

                            <div class="col s12 m12 l12 <?php echo $alinhamentoTexto ?> mb-5">
                                <b>Data de Lançamento: </b><?php echo $linha["Data"] ?><br />
                                <b>Formato: </b><?php echo $linha["Formato"] ?><br />
                                <b>Qualidade: </b><?php echo $linha["Qualidade"] ?><br />
                                <b>Gênero: </b><?php echo $linha["Genero"] ?>
                            </div>

                            <div class="col s12 m12 l12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Tracks"] ?>">
                            </div>

                            <div class="col s12 m12 l12 center-align mb-5">
                                <p class=" <?php echo $alinhamentoTexto ?>"><?php echo $linha["Faixas"] ?></p>
                            </div>

                            <div class="col s12 m12 l12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Information"] ?>">
                            </div>

                            <div class="col s12 m12 l12 center-align mb-5">
                                <a href="<?php echo $linha["Loja"] ?>" target="_blank"><span class="red-text">Loja Oficial</span></a>
                            </div>

                            <?php
                            if ($trailerMusica != "") {
                            ?>
                                <div class="col s12 m12 l12 <?php echo $alinhamentoTag ?> mb-5">
                                    <img src="<?php echo $linha["TrailerTag"] ?>">
                                </div>

                                <div class="col s12 m12 l12 <?php echo $alinhamentoTexto ?> mb-5">
                                    <object width="426" height="240">
                                        <param name="movie" value="<?php echo $linha["TrailerMusica"] ?>">
                                        </param>
                                        <param name="allowFullScreen" value="true">
                                        </param>
                                        <param name="allowscriptaccess" value="always">
                                        </param>
                                        <embed src="<?php echo $linha["TrailerMusica"] ?>" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="426" height="240">
                                        </embed>
                                    </object>
                                </div>
                            <?php
                            }
                            ?>

                            <div class="col s12 m12 l12 <?php echo $alinhamentoTag ?> mb-5">
                                <img src="<?php echo $linha["Acknowledgment"] ?>">
                            </div>

                            <?php
                            if ($assinatura != "") {
                            ?>
                                <div class="col s12 m12 l12 <?php echo $alinhamentoAssinatura ?> mb-5">
                                    <a href="<?php echo $linha["UrlLancamentos"] ?>" target="_blank"><img src="<?php echo $linha["Assinatura"] ?>"></a>
                                </div>
                            <?php
                            }
                            if ($assinatura != "") {
                            ?>
                                <div class="col s12 m12 l12 <?php echo $alinhamentoAssinatura ?> mb-5">
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

            <div class="fixed-action-btn click-to-toggle tooltipped" data-position="left" data-tooltip="Copiar Descrição" style="bottom: 175px; right: 25px;">
                <a onclick="CopiaDescricao();fnCopiar();" class="btn-floating btn-large deep-purple darken-1 waves-effect waves-light">
                    <i class="large material-icons">file_copy</i>
                </a>
            </div>

            <div class="fixed-action-btn click-to-toggle tooltipped" data-position="left" data-tooltip="Abrir Site" style="bottom: 100px; right: 25px;">
                <button type="submit" onclick="CopiaDescricao();" class="btn-floating btn-large red accent-4 waves-effect waves-light"> <i class="large material-icons">launch</i></button>
            </div>

            <div class="fixed-action-btn click-to-toggle tooltipped" data-position="left" data-tooltip="Adicionar Descrição" style="bottom: 25px; right: 25px;">
                <a href="./NovaMusica.php" class="btn-floating btn-large green accent-4 waves-effect waves-light">
                    <i class="large material-icons">add</i>
                </a>
            </div>
        </form>
    </main>
</body>

<!-- SCRIPTS -->
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>
<script src="../../Public/JS/Gerador.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script type="text/javascript" src="./../../Public/JS/Script.js"></script>

</html>