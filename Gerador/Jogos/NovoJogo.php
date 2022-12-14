<?php
header('Access-Control-Allow-Origin: *');
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
            <a href="./../Index.php" style="padding-right: 32px;"><b>P??gina Inicial</b>
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
                <a href="./../Admin/Index.php" style="padding-right: 32px;"><b>Usu??rios</b>
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
            <a target="_blank" href="https://mpago.la/2Af2AHc" style="padding-right: 32px;"><b>Fa??a uma Doa????o</b>
                <i style="float: right; line-height: 64px;" class="material-icons">credit_card</i>
            </a>
        </li>

        <li id="dash_users">
            <a target="_blank" href="./../Configuracoes/Index.php" style="padding-right: 32px;"><b>Configura????es</b>
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
                <a style="margin-left: 20px;" class="breadcrumb white-text" href="./../Index.php">P??gina Inicial</a>
                <a class="breadcrumb white-text" href="./Index.php">Jogos</a>
                <span class="breadcrumb grey-text lighten-5">Novo Jogo</span>
            </div>
        </nav>
    </header>

    <main class="container" style="margin-top: 80px;margin-bottom: 80px;">
        <button class="item-hide" onclick="naoEncontrado()" id="errorRequest" type="button"></button>
        <form action="gera.php" method="post" class="p-3">
            <div class="row">
                <div class="input-field col s6 m6 l4 xl4">
                    <input id="idGameSteam" name="idGameSteam" type="text" class="validate">
                    <label class="active" for="idGameSteam">C??digo STEAM</label>
                </div>

                <div class="input-field col s1 m1 l1 xl1">
                    <button data-position="top" data-tooltip="Buscar Dados" style="right: 10px;top: 7px;" class="btn-floating btn-small waves-effect waves-light indigo tooltipped" onclick="searchGameSteam()" type="button"><i class="material-icons">search</i></button>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="titulo" name="titulo" type="text" class="validate" required="">
                    <label class="active" for="titulo">T??tulo</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="capa" name="capa" type="text" class="validate" required="">
                    <label class="active" for="capa">Link da Capa</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="release" name="release" type="text" class="validate" required="">
                    <label class="active" for="release">Release</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="desenvolvedora" name="desenvolvedora" type="text" class="validate" required="">
                    <label class="active" for="desenvolvedora">Desenvolvedora</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="data" name="data" type="text" class="validate" required="">
                    <label class="active" for="data">Data de Lan??amento</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="trailer" name="trailer" type="text" class="validate" required="">
                    <label class="active" for="trailer">Trailer</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="screen1" name="screen1" type="text" class="validate" required="">
                    <label class="active" for="screen1">Screen 1</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="screen2" name="screen2" type="text" class="validate" required="">
                    <label class="active" for="screen2">Screen 2</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="screen3" name="screen3" type="text" class="validate" required="">
                    <label class="active" for="screen3">Screen 3</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="screen4" name="screen4" type="text" class="validate" required="">
                    <label class="active" for="screen4">Screen 4</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m4 l4 xl4">
                    <small>Multiplay</small>
                    <select class="browser-default" id="multiplay" name="multiplay" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Sim">Sim</option>
                        <option value="Sim">N??o</option>
                    </select>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <small>Legendas</small>
                    <select class="browser-default" id="legenda" name="legenda" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Sem Legendas">Sem Legendas</option>
                        <option value="Alemao">Alemao</option>
                        <option value="Chines">Chines</option>
                        <option value="Coreano">Coreano</option>
                        <option value="Espanhol">Espanhol</option>
                        <option value="Ingles">Ingles</option>
                        <option value="Japones">Japones</option>
                        <option value="Outros">Outros</option>
                        <option value="Portugu??s PT">Portugu??s PT</option>
                        <option value="Portugu??s BR">Portugu??s BR</option>
                        <option value="Russo">Russo</option>
                    </select>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <small>Idioma</small>
                    <select class="browser-default" id="idioma" name="idioma" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Alemao">Alemao</option>
                        <option value="Chines">Chines</option>
                        <option value="Coreano">Coreano</option>
                        <option value="Espanhol">Espanhol</option>
                        <option value="Ingles">Ingles</option>
                        <option value="Japones">Japones</option>
                        <option value="Outros">Outros</option>
                        <option value="Portugu??s PT">Portugu??s PT</option>
                        <option value="Portugu??s BR">Portugu??s BR</option>
                        <option value="Russo">Russo</option>
                        <option value="Multilinguagem">Multilinguagem</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m4 l4 xl4">
                    <small>Extens??o</small>
                    <select class="browser-default" id="extensao" name="extensao" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="EXE">EXE</option>
                        <option value="ISO">ISO</option>
                        <option value="RAR">RAR</option>
                        <option value="GOD">GOD</option>
                        <option value="JAR">JAR</option>
                        <option value="APK">APK</option>
                    </select>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <small>Categoria</small>
                    <select class="browser-default" id="categoria" name="categoria" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Sem Legendas">Sem Legendas</option>
                        <option value="Android">Android</option>
                        <option value="Dreamcast">Dreamcast</option>
                        <option value="Emula????o">Emula????o</option>
                        <option value="Emuladores e Roms">Emuladores e Roms</option>
                        <option value="Mac">Mac</option>
                        <option value="Nintendo DS">Nintendo DS</option>
                        <option value="Nintendo Switch">Nintendo Switch</option>
                        <option value="Pc">Pc</option>
                        <option value="Ps1">Ps1</option>
                        <option value="Ps2">Ps2</option>
                        <option value="Ps3">Ps3</option>
                        <option value="Ps4">Ps4</option>
                        <option value="PSP">PSP</option>
                        <option value="Wii">Wii</option>
                        <option value="X360">X360</option>
                        <option value="Xbox">Xbox</option>
                        <option value="Xbox One">Xbox One</option>
                    </select>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <small>G??nero</small>
                    <select class="browser-default" id="genero" name="genero" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="A????o">A????o</option>
                        <option value="Arcade">Arcade</option>
                        <option value="Aventura">Aventura</option>
                        <option value="Ca??a">Ca??a</option>
                        <option value="Corrida">Corrida</option>
                        <option value="Esportes">Esportes</option>
                        <option value="Estrat??gia">Estrat??gia</option>
                        <option value="Fliperama">Fliperama</option>
                        <option value="FPS">FPS</option>
                        <option value="Guerra">Guerra</option>
                        <option value="Humor">Humor</option>
                        <option value="Infantis">Infantis</option>
                        <option value="Luta">Luta</option>
                        <option value="Musical">Musical</option>
                        <option value="Quebra-Cabe??a">Quebra-Cabe??a</option>
                        <option value="Rpg">Rpg</option>
                        <option value="Simulador">Simulador</option>
                        <option value="Simulador De Combate ??ereo">Simulador Combate ??ereo</option>
                        <option value="Tabuleiro">Tabuleiro</option>
                        <option value="XXX">XXX</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="descricao" name="descricao" class="materialize-textarea validate" required=""></textarea>
                    <label for="descricao">Descri????o</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="requisitos" name="requisitos" class="materialize-textarea validate" required=""></textarea>
                    <label for="requisitos">Requisitos</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="instalacao" name="instalacao" class="materialize-textarea validate" required=""></textarea>
                    <label for="instalacao">Instala????o</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input type="reset" value="Limpar" class="btn btn-sm red darken-4" />
                    <input type="submit" name="BntCadastrar" id="BntCadastrar" class="btn btn-sm light-blue darken-4" value="Gerar Descri????o">
                </div>
            </div>
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
<script src="Script.js"></script>

</html>