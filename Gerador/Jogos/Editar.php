<?php
session_start();
require './../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];
$idSteam = '';

if (!empty($_GET['idSteam']))
    $idSteam = $_GET['idSteam'];

if ($idSteam == 'noData') {
?>
    <script language="javascript" type="text/javascript">
        window.onload = function() {
            document.getElementById("errorRequest").click();
        }
    </script>
<?php
}

if (!empty($_GET["idInserido"])) {
    $idInserido = $_GET['idInserido'];
} else {
    echo "<script>location.href='Index.php';</script>";
}

$idInserido =  $_GET['idInserido'];

$query = "SELECT 1 FROM jogos WHERE Pk = $idInserido";
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
} else {
    die("Errov!");
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

$query = "SELECT * FROM jogos Where Pk = $idInserido";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    while ($linha = $resultado->fetch_assoc()) {
        $Titulo = $linha["Titulo"];
        $Capa = $linha["Capa"];
        $Releaser = $linha["Releaser"];
        $Desenvolvedora = $linha["Desenvolvedora"];
        $Data = $linha["Data"];
        $Multiplay = $linha["Multiplay"];
        $Trailer = $linha["Trailer"];
        $Legenda = $linha["Legenda"];
        $Idioma = $linha["Idioma"];
        $Extensao = $linha["Extensao"];
        $Categoria = $linha["Categoria"];
        $Genero = $linha["Genero"];
        $Descricao = $linha["Descricao"];
        $Requisitos = $linha["Requisitos"];
        $Instalacao = $linha["Instalacao"];
        $Screen1 = $linha["Screen1"];
        $Screen2 = $linha["Screen2"];
        $Screen3 = $linha["Screen3"];
        $Screen4 = $linha["Screen4"];
    }
} else {
    die("Erro ao pesquisar na tabela!");
}
$CONEXAO->close();
?>
<html>

<head>
    <!-- TITLE  -->
    <title>Jogos</title>
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
                <a class="breadcrumb white-text" href="./Index.php">Jogos</a>
                <span class="breadcrumb grey-text lighten-5">Editar</span>
            </div>
        </nav>
    </header>

    <main class="container" style="margin-top: 80px;margin-bottom: 80px;">
        <form action="gera.php" method="post" class="p-3">
            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $Titulo ?>" id="titulo" name="titulo" type="text" class="validate" required="">
                    <label class="active" for="titulo">Título</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $Capa ?>" id="capa" name="capa" type="text" class="validate" required="">
                    <label class="active" for="capa">Link da Capa</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $Releaser ?>" id="release" name="release" type="text" class="validate" required="">
                    <label class="active" for="release">Release</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $Desenvolvedora ?>" id="desenvolvedora" name="desenvolvedora" type="text" class="validate" required="">
                    <label class="active" for="desenvolvedora">Desenvolvedora</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $Data ?>" id="data" name="data" type="text" class="validate" required="">
                    <label class="active" for="data">Data de Lançamento</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $Trailer ?>" id="trailer" name="trailer" type="text" class="validate" required="">
                    <label class="active" for="trailer">Trailer</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $Screen1 ?>" id="screen1" name="screen1" type="text" class="validate" required="">
                    <label class="active" for="screen1">Screen 1</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $Screen2 ?>" id="screen2" name="screen2" type="text" class="validate" required="">
                    <label class="active" for="screen2">Screen 2</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $Screen3 ?>" id="screen3" name="screen3" type="text" class="validate" required="">
                    <label class="active" for="screen3">Screen 3</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $Screen4 ?>" id="screen4" name="screen4" type="text" class="validate" required="">
                    <label class="active" for="screen4">Screen 4</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m4 l4 xl4">
                    <small>Multiplay</small>
                    <select class="browser-default" id="multiplay" name="multiplay" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Sim" <?= ($Multiplay == 'Sim') ? 'selected' : '' ?>>Sim</option>
                        <option value="Não" <?= ($Multiplay == 'Não') ? 'selected' : '' ?>>Não</option>
                    </select>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <small>Legendas</small>
                    <select class="browser-default" id="legenda" name="legenda" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Sem Legendas" <?= ($Legenda == 'Sem Legendas') ? 'selected' : '' ?>>Sem Legendas</option>
                        <option value="Alemao" <?= ($Legenda == 'Alemao') ? 'selected' : '' ?>>Alemao</option>
                        <option value="Chines" <?= ($Legenda == 'Chines') ? 'selected' : '' ?>>Chines</option>
                        <option value="Coreano" <?= ($Legenda == 'Coreano') ? 'selected' : '' ?>>Coreano</option>
                        <option value="Espanhol" <?= ($Legenda == 'Espanhol') ? 'selected' : '' ?>>Espanhol</option>
                        <option value="Ingles" <?= ($Legenda == 'Ingles') ? 'selected' : '' ?>>Ingles</option>
                        <option value="Japones" <?= ($Legenda == 'Japones') ? 'selected' : '' ?>>Japones</option>
                        <option value="Outros" <?= ($Legenda == 'Outros') ? 'selected' : '' ?>>Outros</option>
                        <option value="Português PT" <?= ($Legenda == 'Português PT') ? 'selected' : '' ?>>Português PT</option>
                        <option value="Português BR" <?= ($Legenda == 'Português BR') ? 'selected' : '' ?>>Português BR</option>
                        <option value="Russo" <?= ($Legenda == 'Russo') ? 'selected' : '' ?>>Russo</option>
                    </select>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <small>Idioma</small>
                    <select class="browser-default" id="idioma" name="idioma" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Alemao" <?= ($Idioma == 'Alemao') ? 'selected' : '' ?>>Alemao</option>
                        <option value="Chines" <?= ($Idioma == 'Chines') ? 'selected' : '' ?>>Chines</option>
                        <option value="Coreano" <?= ($Idioma == 'Coreano') ? 'selected' : '' ?>>Coreano</option>
                        <option value="Espanhol" <?= ($Idioma == 'Espanhol') ? 'selected' : '' ?>>Espanhol</option>
                        <option value="Ingles" <?= ($Idioma == 'Ingles') ? 'selected' : '' ?>>Ingles</option>
                        <option value="Japones" <?= ($Idioma == 'Japones') ? 'selected' : '' ?>>Japones</option>
                        <option value="Outros" <?= ($Idioma == 'Outros') ? 'selected' : '' ?>>Outros</option>
                        <option value="Português PT" <?= ($Idioma == 'Português PT') ? 'selected' : '' ?>>Português PT</option>
                        <option value="Português BR" <?= ($Idioma == 'Português BR') ? 'selected' : '' ?>>Português BR</option>
                        <option value="Russo" <?= ($Idioma == 'Russo') ? 'selected' : '' ?>>Russo</option>
                        <option value="Multilinguagem" <?= ($Idioma == 'Multilinguagem') ? 'selected' : '' ?>>Multilinguagem</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m4 l4 xl4">
                    <small>Extensão</small>
                    <select class="browser-default" id="extensao" name="extensao" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="EXE" <?= ($Extensao == 'EXE') ? 'selected' : '' ?>>EXE</option>
                        <option value="ISO" <?= ($Extensao == 'ISO') ? 'selected' : '' ?>>ISO</option>
                        <option value="RAR" <?= ($Extensao == 'RAR') ? 'selected' : '' ?>>RAR</option>
                        <option value="GOD" <?= ($Extensao == 'GOD') ? 'selected' : '' ?>>GOD</option>
                        <option value="JAR" <?= ($Extensao == 'JAR') ? 'selected' : '' ?>>JAR</option>
                        <option value="APK" <?= ($Extensao == 'APK') ? 'selected' : '' ?>>APK</option>
                    </select>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <small>Categoria</small>
                    <select class="browser-default" id="categoria" name="categoria" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Android" <?= ($Categoria == 'Android') ? 'selected' : '' ?>>Android</option>
                        <option value="Dreamcast" <?= ($Categoria == 'Dreamcast') ? 'selected' : '' ?>>Dreamcast</option>
                        <option value="Emulação" <?= ($Categoria == 'Emulação') ? 'selected' : '' ?>>Emulação</option>
                        <option value="Emuladores e Roms" <?= ($Categoria == 'Emuladores e Roms') ? 'selected' : '' ?>>Emuladores e Roms</option>
                        <option value="Mac" <?= ($Categoria == 'Mac') ? 'selected' : '' ?>>Mac</option>
                        <option value="Nintendo DS" <?= ($Categoria == 'Nintendo DS') ? 'selected' : '' ?>>Nintendo DS</option>
                        <option value="Nintendo Switch" <?= ($Categoria == 'Nintendo Switch') ? 'selected' : '' ?>>Nintendo Switch</option>
                        <option value="Pc" <?= ($Categoria == 'Pc') ? 'selected' : '' ?>>Pc</option>
                        <option value="Ps1" <?= ($Categoria == 'Ps1') ? 'selected' : '' ?>>Ps1</option>
                        <option value="Ps2" <?= ($Categoria == 'Ps2') ? 'selected' : '' ?>>Ps2</option>
                        <option value="Ps3" <?= ($Categoria == 'Ps3') ? 'selected' : '' ?>>Ps3</option>
                        <option value="Ps4" <?= ($Categoria == 'Ps4') ? 'selected' : '' ?>>Ps4</option>
                        <option value="PSP" <?= ($Categoria == 'PSP') ? 'selected' : '' ?>>PSP</option>
                        <option value="Wii" <?= ($Categoria == 'Wii') ? 'selected' : '' ?>>Wii</option>
                        <option value="X360" <?= ($Categoria == 'X360') ? 'selected' : '' ?>>X360</option>
                        <option value="Xbox" <?= ($Categoria == 'Xbox') ? 'selected' : '' ?>>Xbox</option>
                        <option value="Xbox One" <?= ($Categoria == 'Xbox One') ? 'selected' : '' ?>>Xbox One</option>
                    </select>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <small>Gênero</small>
                    <select class="browser-default" id="genero" name="genero" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Ação" <?= ($Genero == 'Ação') ? 'selected' : '' ?>>Ação</option>
                        <option value="Arcade" <?= ($Genero == 'Arcade') ? 'selected' : '' ?>>Arcade</option>
                        <option value="Aventura" <?= ($Genero == 'Aventura') ? 'selected' : '' ?>>Aventura</option>
                        <option value="Caça" <?= ($Genero == 'Caça') ? 'selected' : '' ?>>Caça</option>
                        <option value="Corrida" <?= ($Genero == 'Corrida') ? 'selected' : '' ?>>Corrida</option>
                        <option value="Esportes" <?= ($Genero == 'Esportes') ? 'selected' : '' ?>>Esportes</option>
                        <option value="Estratégia"> <?= ($Genero == 'Estratégia') ? 'selected' : '' ?>Estratégia</option>
                        <option value="Fliperama" <?= ($Genero == 'Fliperama') ? 'selected' : '' ?>>Fliperama</option>
                        <option value="FPS" <?= ($Genero == 'FPS') ? 'selected' : '' ?>>FPS</option>
                        <option value="Guerra" <?= ($Genero == 'Guerra') ? 'selected' : '' ?>>Guerra</option>
                        <option value="Humor" <?= ($Genero == 'Humor') ? 'selected' : '' ?>>Humor</option>
                        <option value="Infantis" <?= ($Genero == 'Infantis') ? 'selected' : '' ?>>Infantis</option>
                        <option value="Luta" <?= ($Genero == 'Luta') ? 'selected' : '' ?>>Luta</option>
                        <option value="Musical" <?= ($Genero == 'Musical') ? 'selected' : '' ?>>Musical</option>
                        <option value="Quebra-Cabeça" <?= ($Genero == 'Quebra-Cabeça') ? 'selected' : '' ?>>Quebra-Cabeça</option>
                        <option value="Rpg" <?= ($Genero == 'Rpg') ? 'selected' : '' ?>>Rpg</option>
                        <option value="Simulador" <?= ($Genero == 'Simulador') ? 'selected' : '' ?>>Simulador</option>
                        <option value="Simulador De Combate Áereo" <?= ($Genero == 'Simulador De Combate Áereo') ? 'selected' : '' ?>>Simulador Combate Áereo</option>
                        <option value="Tabuleiro" <?= ($Genero == 'Tabuleiro') ? 'selected' : '' ?>>Tabuleiro</option>
                        <option value="XXX" <?= ($Genero == 'XXX') ? 'selected' : '' ?>>XXX</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="descricao" name="descricao" class="materialize-textarea validate" required=""><?php echo str_replace("<br />", "", $Descricao); ?></textarea>
                    <label for="descricao">Descrição</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="requisitos" name="requisitos" class="materialize-textarea validate" required=""><?php echo str_replace("<br />", "", $Requisitos); ?></textarea>
                    <label for="requisitos">Requisitos</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="instalacao" name="instalacao" class="materialize-textarea validate" required=""><?php echo str_replace("<br />", "", $Instalacao); ?></textarea>
                    <label for="instalacao">Instalação</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input type="submit" name="BntCadastrar" id="BntCadastrar" class="btn btn-sm light-blue darken-4" value="Salvar Descrição">
                </div>
            </div>

            <input type="text" name="acao" id="acao" class="item-hide" value="1">
            <input type="text" name="Pk" id="Pk" class="item-hide" value="<?php echo $idInserido ?>">
        </form>
    </main>
</body>

</html>