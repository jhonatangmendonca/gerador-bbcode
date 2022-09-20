<?php
session_start();
require './../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];
$idInserido =  $_GET['idInserido'];

$query = "SELECT 1 FROM aplicativos WHERE Pk = $idInserido";
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
    <title>Aplicativos</title>

    <!-- META  -->
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
    <link type="text/css" rel="stylesheet" href="./../../Public/SCSS/layout.css" media="screen,projection" />
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
                <a class="breadcrumb white-text" href="./Index.php">Aplicativos</a>
                <span class="breadcrumb grey-text lighten-5">Editar</span>
            </div>
        </nav>
    </header>

    <main class="container" style="margin-top: 80px;margin-bottom: 80px;">
        <form action="gera.php" method="post">
            <?php
            $idInserido =  $_GET["idInserido"];

            $query = " SELECT *  FROM aplicativos Where Pk = $idInserido";
            $resultado = $CONEXAO->query($query);
            if ($resultado) {
                if ($resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_assoc()) {
            ?>
                        <div class="row">
                            <div class="input-field col s12 m6 l6 xl6">
                                <input value="<?php echo $linha["Titulo"] ?>" id="titulo" name="titulo" type="text" class="validate" required="">
                                <label class="active" for="titulo">Título</label>
                            </div>

                            <div class="input-field col s12 m6 l6 xl6">
                                <input value="<?php echo $linha["Capa"] ?>" id="capa" name="capa" type="text" class="validate" required="">
                                <label class="active" for="capa">Link da Capa</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6 l6 xl6">
                                <input value="<?php echo $linha["Build"] ?>" id="build" name="build" type="text" class="validate" required="">
                                <label class="active" for="build">Build</label>
                            </div>

                            <div class="input-field col s12 m6 l6 xl6">
                                <input value="<?php echo $linha["Data"] ?>" id="data" name="data" type="text" class="validate" required="">
                                <label class="active" for="data">Data de Lançamento</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6 l6 xl6">
                                <input value="<?php echo $linha["Screen1"] ?>" id="screen1" name="screen1" type="text" class="validate" required="">
                                <label class="active" for="screen1">Screen 1</label>
                            </div>

                            <div class="input-field col s12 m6 l6 xl6">
                                <input value="<?php echo $linha["Screen2"] ?>" id="screen2" name="screen2" type="text" class="validate" required="">
                                <label class="active" for="screen2">Screen 2</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6 l6 xl6">
                                <input value="<?php echo $linha["Screen3"] ?>" id="screen3" name="screen3" type="text" class="validate" required="">
                                <label class="active" for="screen3">Screen 3</label>
                            </div>

                            <div class="input-field col s12 m6 l6 xl6">
                                <input value="<?php echo $linha["Screen4"] ?>" id="screen4" name="screen4" type="text" class="validate" required="">
                                <label class="active" for="screen4">Screen 4</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <small>Categoria</small>
                                <select class="browser-default" id="categoria" name="categoria" required="">
                                    <option value="Android" <?= ($linha["Categoria"] == 'Android') ? 'selected' : '' ?>>Android</option>
                                    <option value="iPad" <?= ($linha["Categoria"] == 'iPad') ? 'selected' : '' ?>>iPad</option>
                                    <option value="iPhone" <?= ($linha["Categoria"] == 'iPhone') ? 'selected' : '' ?>>iPhone</option>
                                    <option value="iPod" <?= ($linha["Categoria"] == 'iPod') ? 'selected' : '' ?>>iPod</option>
                                    <option value="Linux" <?= ($linha["Categoria"] == 'Linux') ? 'selected' : '' ?>>Linux</option>
                                    <option value="Mac" <?= ($linha["Categoria"] == 'Mac') ? 'selected' : '' ?>>Mac</option>
                                    <option value="Windows" <?= ($linha["Categoria"] == 'Windows') ? 'selected' : '' ?>>Windows</option>
                                </select>
                            </div>

                            <div class="input-field col s6">
                                <small>Extensão</small>
                                <select class="browser-default" id="extensao" name="extensao" required="">
                                    <option value="APK" <?= ($linha["Extensao"] == 'APK') ? 'selected' : '' ?>>APK</option>
                                    <option value="ARJ" <?= ($linha["Extensao"] == 'ARJ') ? 'selected' : '' ?>>ARJ</option>
                                    <option value="BIN" <?= ($linha["Extensao"] == 'BIN') ? 'selected' : '' ?>>BIN</option>
                                    <option value="CAB" <?= ($linha["Extensao"] == 'CAB') ? 'selected' : '' ?>>CAB</option>
                                    <option value="COM" <?= ($linha["Extensao"] == 'COM') ? 'selected' : '' ?>>COM</option>
                                    <option value="DMG" <?= ($linha["Extensao"] == 'DMG') ? 'selected' : '' ?>>DMG</option>
                                    <option value="EXE" <?= ($linha["Extensao"] == 'EXE') ? 'selected' : '' ?>>EXE</option>
                                    <option value="ISO" <?= ($linha["Extensao"] == 'ISO') ? 'selected' : '' ?>>ISO</option>
                                    <option value="JAR" <?= ($linha["Extensao"] == 'JAR') ? 'selected' : '' ?>>JAR</option>
                                    <option value="MSI" <?= ($linha["Extensao"] == 'MSI') ? 'selected' : '' ?>>MSI</option>
                                    <option value="NRG" <?= ($linha["Extensao"] == 'NRG') ? 'selected' : '' ?>>NRG</option>
                                    <option value="PPT" <?= ($linha["Extensao"] == 'PPT') ? 'selected' : '' ?>>PPT</option>
                                    <option value="Outros" <?= ($linha["Extensao"] == 'Outros') ? 'selected' : '' ?>>Outros</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <small>Plataforma</small>
                                <select class="browser-default" id="plataforma" name="plataforma" required="">
                                    <option value="X86 - 32 Bits" <?= ($linha["Plataforma"] == 'X86 - 32 Bits') ? 'selected' : '' ?>>X86 - 32 Bits</option>
                                    <option value="X86 - 64 Bits" <?= ($linha["Plataforma"] == 'X86 - 64 Bits') ? 'selected' : '' ?>>X86 - 64 Bits</option>
                                    <option value="Multiplataforma" <?= ($linha["Plataforma"] == 'Multiplataforma') ? 'selected' : '' ?>>Multiplataforma</option>
                                </select>
                            </div>

                            <div class="input-field col s6">
                                <small>Idioma</small>
                                <select class="browser-default" id="idioma" name="idioma" required="">
                                    <option value="Alemao" <?= ($linha["Idioma"] == 'Alemao') ? 'selected' : '' ?>>Alemao</option>
                                    <option value="Chines" <?= ($linha["Idioma"] == 'Chines') ? 'selected' : '' ?>>Chines</option>
                                    <option value="Coreano" <?= ($linha["Idioma"] == 'Coreano') ? 'selected' : '' ?>>Coreano</option>
                                    <option value="Espanhol" <?= ($linha["Idioma"] == 'Espanhol') ? 'selected' : '' ?>>Espanhol</option>
                                    <option value="Ingles" <?= ($linha["Idioma"] == 'Ingles') ? 'selected' : '' ?>>Inglês</option>
                                    <option value="Japones" <?= ($linha["Idioma"] == 'Japones') ? 'selected' : '' ?>>Japones</option>
                                    <option value="Outros" <?= ($linha["Idioma"] == 'Outros') ? 'selected' : '' ?>>Outros</option>
                                    <option value="Português PT" <?= ($linha["Idioma"] == 'Português PT') ? 'selected' : '' ?>>Português PT</option>
                                    <option value="Português BR" <?= ($linha["Idioma"] == 'Português BR') ? 'selected' : '' ?>>Português BR</option>
                                    <option value="Russo" <?= ($linha["Idioma"] == 'Russo') ? 'selected' : '' ?>>Russo</option>
                                    <option value="Multilinguagem" <?= ($linha["Idioma"] == 'Multilinguagem') ? 'selected' : '' ?>>Multilinguagem</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="descricao" name="descricao" class="materialize-textarea"><?php echo $linha["Descricao"] ?></textarea>
                                <label for="descricao">Descrição</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="requisitos" name="requisitos" class="materialize-textarea"><?php echo $linha["Requisitos"] ?></textarea>
                                <label for="requisitos">Requisitos</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="instalacao" name="instalacao" class="materialize-textarea"><?php echo $linha["Instalacao"] ?></textarea>
                                <label for="instalacao">Instalação</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input type="submit" name="BntCadastrar" id="BntCadastrar" class="btn btn-sm light-blue darken-4" value="SALVAR DESCRIÇÃO">
                            </div>
                        </div>
                    <?php   }
                } else {
                    ?>
                    <div class="container center-align mt-5">
                        <img class="mb-5" style="max-width: 350px" src="../../Public/IMG/nodata.png">
                        <h4 style="color: rgb(255,143,142);">Sem BBCODE Gerado</h4>
                    </div>
            <?php
                }
            } else {
                die("Erro!");

                $CONEXAO->close();
            }
            ?>
            <input type="text" name="acao" id="acao" class="item-hide" value="1">
            <input type="text" name="Pk" id="Pk" class="item-hide" value="<?php echo $idInserido ?>">
        </form>
    </main>
</body>

<!-- SCRIPTS -->
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script type="text/javascript" src="./../../Public/JS/Script.js"></script>

</html>