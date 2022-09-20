<?php
session_start();
require './../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];
$contMensagem = 0;

include "./../../Config/Config.php";
$query = "SELECT * FROM mensagens where Status = 0 And FkUsuario = $idUsuario";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            $contMensagem++;
        }
    }
}
if (!empty($_GET['idDeezer'])) {
    $dataDeezer = $_GET['idDeezer'];
    if ($dataDeezer == 'noData') {
?>
        <script language="javascript" type="text/javascript">
            window.onload = function() {
                document.getElementById("errorRequest").click();
            }
        </script>
<?php
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
                <a class="breadcrumb white-text" href="./Index.php">Músicas</a>
                <span class="breadcrumb grey-text lighten-5">Nova Música</span>

            </div>
        </nav>
    </header>

    <main class="container" style="margin-top: 80px;margin-bottom: 80px;">
        <button class="item-hide" onclick="errorRequest()" id="errorRequest" type="button"></button>
        <form class="form-group" action="Gera.php" method="post">
            <div class="row">
                <div class="input-field col s6 m6 l4 xl4">
                    <input id="idAlbumDeezer" name="idAlbumDeezer" type="text" class="validate">
                    <label class="active" for="idAlbumDeezer">Código Álbum Deezer</label>
                </div>

                <div class="input-field col s1 m1 l1 xl1">
                    <button data-position="top" data-tooltip="Pesquisar Álbum" style="right: 10px;top: 7px;" class="btn-floating btn-small waves-effect waves-light indigo tooltipped" onclick="searchDeezerAlbum()" type="button"><i class="material-icons">search</i></button>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="artista" name="artista" type="text" class="validate" required="">
                    <label class="active" for="artista">Artista</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="album" name="album" type="text" class="validate" required="">
                    <label class="active" for="album">Álbum</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="data" name="data" type="text" class="validate" required="">
                    <label class="active" for="data">Data de Lançamento</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="capa" name="capa" type="text" class="validate" required="">
                    <label class="active" for="capa">Link da Capa</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="loja" name="loja" type="text" class="validate" required="">
                    <label class="active" for="loja">Link Oficial</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="trailer" name="trailer" type="text" class="validate">
                    <label class="active" for="trailer">Trailer (Opcional)</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m4 l4 xl4">
                    <small>Qualidade</small>
                    <select class="browser-default" id="formato" name="formato" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="MPEG Layer 3 - MP3">MPEG Layer 3 - MP3</option>
                        <option value="iTunes Match AAC - M4A">iTunes Match AAC - M4A</option>
                        <option value="Free Lossless Audio Codec - FLAC">Free Lossless Audio Codec - FLAC</option>
                        <option value="Waveform Audio File Format - WAV">Waveform Audio File Format - WAV</option>
                        <option value="Windows Media Audio - WMA">Windows Media Audio - WMA</option>
                    </select>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <small>Qualidade</small>
                    <select class="browser-default" id="qualidade" name="qualidade" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="96 Kbps">96 Kbps</option>
                        <option value="128 Kbps">128 Kbps</option>
                        <option value="160 Kbps">160 Kbps</option>
                        <option value="256 Kbps">256 Kbps</option>
                        <option value="320 Kbps">320 Kbps</option>
                        <option value="LossLess">LossLess</option>
                        <option value="VBR (Variável)">VBR (Variável)</option>
                    </select>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <small>Gênero</small>
                    <select class="browser-default" id="genero" name="genero" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Axé">Axé</option>
                        <option value="Blues">Blues</option>
                        <option value="Brega">Brega</option>
                        <option value="Country">Country</option>
                        <option value="Dance">Dance</option>
                        <option value="Discografia">Discografia</option>
                        <option value="Dubstep">Dubstep</option>
                        <option value="Eletrônica">Eletrônica</option>
                        <option value="Erudita">Erudita</option>
                        <option value="Forró">Forró</option>
                        <option value="Funk">Funk</option>
                        <option value="Game">Game</option>
                        <option value="Gospel">Gospel</option>
                        <option value="Hard Rock">Hard Rock</option>
                        <option value="Hip-Hop">Hip-Hop</option>
                        <option value="Jazz">Jazz</option>
                        <option value="Latina">Latina</option>
                        <option value="MPB">MPB</option>
                        <option value="Música Clássica">Música Clássica</option>
                        <option value="Outros">Outros</option>
                        <option value="Pagode">Pagode</option>
                        <option value="Pop">Pop</option>
                        <option value="Rap">Rap</option>
                        <option value="Reggae">Reggae</option>
                        <option value="Rock">Rock</option>
                        <option value="Samba">Samba</option>
                        <option value="Sertanejo">Sertanejo</option>
                        <option value="Trilha Sonora">Trilha Sonora</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="faixas" name="faixas" class="materialize-textarea validate" required=""></textarea>
                    <label for="faixas">Faixas</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input type="reset" value="Limpar" class="btn btn-sm red darken-4" />
                    <input type="submit" name="BntCadastrar" id="BntCadastrar" class="btn btn-sm light-blue darken-4" value="Gerar Descrição">
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