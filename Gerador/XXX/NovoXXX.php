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
    <title>Adultos</title>
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
                <a class="breadcrumb white-text" href="./Index.php">Adultos</a>
                <span class="breadcrumb grey-text lighten-5">Novo Adulto</span>

            </div>
        </nav>
    </header>

    <main class="container" style="margin-top: 80px;margin-bottom: 80px;">
        <form action="gera.php" method="post" class="p-3">
            <div class="row">
                <div class="input-field col s12">
                    <input id="titulo" name="titulo" type="text" class="validate" required="">
                    <label class="active" for="titulo">Título</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="capa" name="capa" type="text" class="validate" required="">
                    <label class="active" for="capa">Link da Capa</label>
                </div>
                <div class="input-field col s6">
                    <input id="duracao" name="duracao" type="text" class="validate" required="">
                    <label class="active" for="duracao">Duração</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="direcao" name="direcao" type="text" class="validate" required="">
                    <label class="active" for="direcao">Direção</label>
                </div>

                <div class="input-field col s6">
                    <input id="pais" name="pais" type="text" class="validate" required="">
                    <label class="active" for="pais">País de Origem</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="data" name="data" type="text" class="validate" required="">
                    <label class="active" for="cadatapa">Data de Lançamento</label>
                </div>

                <div class="input-field inline col s6">
                    <input class="input-field inline col s6 left" id="largura" placeholder="1920" name="largura" type="text" class="validate" required="">
                    <label class="active" for="largura">Resolução</label>

                    <input class="input-field inline col s6 right" id="altura" placeholder="1080" name="altura" type="text" class="validate" required="">
                    <label class="active" for="altura">Resolução</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="screen1" name="screen1" type="text" class="validate" required="">
                    <label class="active" for="screen1">Screen 1</label>
                </div>

                <div class="input-field col s6">
                    <input id="screen2" name="screen2" type="text" class="validate" required="">
                    <label class="active" for="screen2">Screen 2</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="screen3" name="screen3" type="text" class="validate" required="">
                    <label class="active" for="screen3">Screen 3</label>
                </div>

                <div class="input-field col s6">
                    <input id="screen4" name="screen4" type="text" class="validate" required="">
                    <label class="active" for="screen4">Screen 4</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <small>Qualidade</small>
                    <select class="browser-default" id="qualidade" name="qualidade" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="BD-R">BD-R</option>
                        <option value="BD100">BD100</option>
                        <option value="BD25">BD25</option>
                        <option value="BD50">BD50</option>
                        <option value="BD66">BD66</option>
                        <option value="BDRip">BDRip</option>
                        <option value="Blu-Ray">Blu-Ray</option>
                        <option value="Blu-Ray RC">Blu-Ray RC</option>
                        <option value="BRRip">BRRip</option>
                        <option value="DSR">DSR</option>
                        <option value="DVD5">DVD5</option>
                        <option value="DVD9">DVD9</option>
                        <option value="DVDrip">DVDrip</option>
                        <option value="HD-DVD">HD-DVD</option>
                        <option value="HDCAM">HDCAM</option>
                        <option value="HDR">HDR</option>
                        <option value="HDrip">HDrip</option>
                        <option value="HDTC">HDTC</option>
                        <option value="HDTS">HDTS</option>
                        <option value="HDTV">HDTV</option>
                        <option value="PDTV">PDTV</option>
                        <option value="PPVRip">PPVRip</option>
                        <option value="R5">R5</option>
                        <option value="R6">R6</option>
                        <option value="REMUX">REMUX</option>
                        <option value="SDTV">SDTV</option>
                        <option value="TS">TS</option>
                        <option value="TV-Screen">TV-Screen</option>
                        <option value="TVRip">TVRip</option>
                        <option value="VHSRip">VHSRip</option>
                        <option value="WEB-DL">WEB-DL</option>
                        <option value="WEB-RIP">WEB-RIP</option>
                        <option value="Workprint">Workprint</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <small>Tipo de Áudio</small>
                    <select class="browser-default" id="tipoAudio" name="tipoAudio" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Dual-Audio">Dual-Audio</option>
                        <option value="Dublado">Dublado</option>
                        <option value="Legendado">Legendado</option>
                        <option value="Nacional">Nacional</option>
                        <option value="Original">Original</option>
                        <option value="Outro">Outro</option>
                        <option value="Sem Audio">Sem Audio</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <small>Codec de Áudio</small>
                    <select class="browser-default" id="audio" name="audio" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="AAC">AAC</option>
                        <option value="AC3">AC3</option>
                        <option value="AC3/DTS">AC3/DTS</option>
                        <option value="DTS">DTS</option>
                        <option value="DTS-HD">DTS-HD</option>
                        <option value="DTS-HD-MA">DTS-HD-MA</option>
                        <option value="DTS-X">DTS-X</option>
                        <option value="E-AC-3">E-AC-3</option>
                        <option value="FLAC">FLAC</option>
                        <option value="LPCM">LPCM</option>
                        <option value="MPC">MPC</option>
                        <option value="MPEG Layer-3 (MP3)">MPEG Layer-3 (MP3)</option>
                        <option value="OGG">OGG</option>
                        <option value="OPUS">OPUS</option>
                        <option value="Outros">Outros</option>
                        <option value="PCM">PCM</option>
                        <option value="Real Audio (RMVB)">Real Audio (RMVB)</option>
                        <option value="TrueHD">TrueHD</option>
                        <option value="Vorbis">Vorbis</option>
                        <option value="Windows Media Audio">Windows Media Audio</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <small>Codec de Vídeo</small>
                    <select class="browser-default" id="video" name="video" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="DivX">DivX</option>
                        <option value="H264">H264</option>
                        <option value="H265">H265</option>
                        <option value="M4V">M4V</option>
                        <option value="MPEG-1">MPEG-1</option>
                        <option value="MPEG-2">MPEG-2</option>
                        <option value="Outros">Outros</option>
                        <option value="Real Video (RMVB)">Real Video (RMVB)</option>
                        <option value="VC-1">VC-1</option>
                        <option value="VP6">VP6</option>
                        <option value="VP9">VP9</option>
                        <option value="Windows Media Video">Windows Media Video</option>
                        <option value="XviD">XviD</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <small>Extensão</small>
                    <select class="browser-default" id="formato" name="formato" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="ASF">ASF</option>
                        <option value="AVI">AVI</option>
                        <option value="FLV">FLV</option>
                        <option value="M2TS">M2TS</option>
                        <option value="MKV">MKV</option>
                        <option value="MOV">MOV</option>
                        <option value="MP4">MP4</option>
                        <option value="MPG">MPG</option>
                        <option value="MPEG">MPEG</option>
                        <option value="RM">RM</option>
                        <option value="RMVB">RMVB</option>
                        <option value="SWF">SWF</option>
                        <option value="TS">TS</option>
                        <option value="VOB">VOB</option>
                        <option value="WMV">WMV</option>
                        <option value="Outros">Outros</option>
                        <option value="ISO">ISO</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <small>Legenda</small>
                    <select class="browser-default" id="legenda" name="legenda" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Alemao">Alemao</option>
                        <option value="Chines">Chines</option>
                        <option value="Coreano">Coreano</option>
                        <option value="Espanhol">Espanhol</option>
                        <option value="Ingles">Ingles</option>
                        <option value="Japones">Japones</option>
                        <option value="Outros">Outros</option>
                        <option value="Português PT">Português PT</option>
                        <option value="Português BR">Português BR</option>
                        <option value="Russo">Russo</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <small>Idioma</small>
                    <select class="browser-default" id="idioma" name="idioma" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Inglês">Inglês</option>
                        <option value="Francês">Francês</option>
                        <option value="Alemão">Alemão</option>
                        <option value="Italiano">Italiano</option>
                        <option value="Japonês">Japonês</option>
                        <option value="Espanhol">Espanhol</option>
                        <option value="Russo">Russo</option>
                        <option value="Português">Português</option>
                        <option value="Multilinguagem">Multilinguagem</option>
                        <option value="Chinês">Chinês</option>
                        <option value="Outros">Outros</option>
                        <option value="Dinamarques">Dinamarques</option>
                        <option value="Sueco">Sueco</option>
                        <option value="Finlandes">Finlandes</option>
                        <option value="Bulgaro">Bulgaro</option>
                        <option value="Noruegues">Noruegues</option>
                        <option value="Holandes">Holandes</option>
                        <option value="Italiano">Italiano</option>
                        <option value="Polones">Polones</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <small>Categoria</small>
                    <select class="browser-default" id="idiomaOriginal" name="idiomaOriginal" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Gay">Gay</option>
                        <option value="Hentai">Hentai</option>
                        <option value="Transex/Female">Transex/Female</option>
                        <option value="XXX">XXX</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="descricao" name="descricao" class="materialize-textarea"></textarea>
                    <label for="descricao">Descrição</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="musicas" name="musicas" class="materialize-textarea"></textarea>
                    <label for="musicas">Elenco</label>
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

</html>