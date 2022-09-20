<?php
session_start();
require './../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];
$idInserido =  $_GET['idInserido'];

$query = "SELECT 1 FROM animes WHERE Pk = $idInserido";
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
    <title>Animes</title>
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
                <a class="breadcrumb white-text" href="./Index.php">Animes</a>
                <span class="breadcrumb grey-text lighten-5">Editar</span>

            </div>
        </nav>
    </header>

    <main class="container" style="margin-top: 80px;margin-bottom: 80px;">
        <form action="Gera.php" method="post">
            <?php
            $query = " SELECT *  FROM animes Where Pk = $idInserido";
            $resultado = $CONEXAO->query($query);
            if ($resultado) {
                if ($resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_assoc()) {
            ?>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="titulo" name="titulo" type="text" class="validate" value="<?php echo $linha["Titulo"] ?>" required="">
                                <label class="active" for="titulo">Título</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="capa" name="capa" type="text" class="validate" required="" value="<?php echo $linha["Capa"] ?>">
                                <label class="active" for="capa">Link da Capa</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="duracao" name="duracao" type="text" class="validate" required="" value="<?php echo $linha["Duracao"] ?>">
                                <label class="active" for="duracao">Duração</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="direcao" name="direcao" type="text" class="validate" required="" value="<?php echo $linha["Direcao"] ?>">
                                <label class="active" for="direcao">Direção</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="genero" name="genero" type="text" class="validate" required="" value="<?php echo $linha["Genero"] ?>">
                                <label class="active" for="genero">Gênero</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="data" name="data" type="text" class="validate" required="" value="<?php echo $linha["Data"] ?>">
                                <label class="active" for="cadatapa">Data de Lançamento</label>
                            </div>

                            <div class="input-field inline col s6">
                                <?php
                                $resolucao =  explode('x', $linha["Resolucao"]);
                                $altura =  strrchr($linha["Resolucao"], 'x');
                                ?>
                                <input class="input-field inline col s6 left" id="largura" placeholder="1920" name="largura" type="text" class="validate" required="" value="<?php echo $resolucao[0] ?>">
                                <label class="active" for="largura">Resolução</label>

                                <input class="input-field inline col s6 right" id="altura" placeholder="1080" name="altura" type="text" class="validate" required="" value="<?php echo $resolucao[1] ?>">
                                <label class="active" for="altura">Resolução</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="screen1" name="screen1" type="text" class="validate" required="" value="<?php echo $linha["Screen1"] ?>">
                                <label class="active" for="screen1">Screen 1</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="screen2" name="screen2" type="text" class="validate" required="" value="<?php echo $linha["Screen2"] ?>">
                                <label class="active" for="screen2">Screen 2</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="screen3" name="screen3" type="text" class="validate" required="" value="<?php echo $linha["Screen3"] ?>">
                                <label class="active" for="screen3">Screen 3</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="screen4" name="screen4" type="text" class="validate" required="" value="<?php echo $linha["Screen4"] ?>">
                                <label class="active" for="screen4">Screen 4</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <small>Qualidade</small>
                                <select class="browser-default" id="qualidade" name="qualidade" required="">
                                    <option value="BD-R" <?= ($linha["Qualidade"] == 'BD-R') ? 'selected' : '' ?>>BD-R</option>
                                    <option value="BD100" <?= ($linha["Qualidade"] == 'BD100') ? 'selected' : '' ?>>BD100</option>
                                    <option value="BD25" <?= ($linha["Qualidade"] == 'BD25') ? 'selected' : '' ?>>BD25</option>
                                    <option value="BD50" <?= ($linha["Qualidade"] == 'BD50') ? 'selected' : '' ?>>BD50</option>
                                    <option value="BD66" <?= ($linha["Qualidade"] == 'BD66') ? 'selected' : '' ?>>BD66</option>
                                    <option value="BDRip" <?= ($linha["Qualidade"] == 'BDRip') ? 'selected' : '' ?>>BDRip</option>
                                    <option value="Blu-Ray" <?= ($linha["Qualidade"] == 'Blu-Ray') ? 'selected' : '' ?>>Blu-Ray</option>
                                    <option value="Blu-Ray RC" <?= ($linha["Qualidade"] == 'Blu-Ray RC') ? 'selected' : '' ?>>Blu-Ray RC</option>
                                    <option value="BRRip" <?= ($linha["Qualidade"] == 'BRRip') ? 'selected' : '' ?>>BRRip</option>
                                    <option value="DSR" <?= ($linha["Qualidade"] == 'DSR') ? 'selected' : '' ?>>DSR</option>
                                    <option value="DVD5" <?= ($linha["Qualidade"] == 'DVD5') ? 'selected' : '' ?>>DVD5</option>
                                    <option value="DVD9" <?= ($linha["Qualidade"] == 'DVD9') ? 'selected' : '' ?>>DVD9</option>
                                    <option value="DVDrip" <?= ($linha["Qualidade"] == 'DVDrip') ? 'selected' : '' ?>>DVDrip</option>
                                    <option value="HD-DVD" <?= ($linha["Qualidade"] == 'HD-DVD') ? 'selected' : '' ?>>HD-DVD</option>
                                    <option value="HDCAM" <?= ($linha["Qualidade"] == 'HDCAM') ? 'selected' : '' ?>>HDCAM</option>
                                    <option value="HDR" <?= ($linha["Qualidade"] == 'HDR') ? 'selected' : '' ?>>HDR</option>
                                    <option value="HDrip" <?= ($linha["Qualidade"] == 'HDrip') ? 'selected' : '' ?>>HDrip</option>
                                    <option value="HDTC" <?= ($linha["Qualidade"] == 'HDTC') ? 'selected' : '' ?>>HDTC</option>
                                    <option value="HDTS" <?= ($linha["Qualidade"] == 'HDTS') ? 'selected' : '' ?>>HDTS</option>
                                    <option value="HDTV" <?= ($linha["Qualidade"] == 'HDTV') ? 'selected' : '' ?>>HDTV</option>
                                    <option value="PDTV" <?= ($linha["Qualidade"] == 'PDTV') ? 'selected' : '' ?>>PDTV</option>
                                    <option value="PPVRip" <?= ($linha["Qualidade"] == 'PPVRip') ? 'selected' : '' ?>>PPVRip</option>
                                    <option value="R5" <?= ($linha["Qualidade"] == 'R5') ? 'selected' : '' ?>>R5</option>
                                    <option value="R6" <?= ($linha["Qualidade"] == 'R6') ? 'selected' : '' ?>>R6</option>
                                    <option value="REMUX" <?= ($linha["Qualidade"] == 'REMUX') ? 'selected' : '' ?>>REMUX</option>
                                    <option value="SDTV" <?= ($linha["Qualidade"] == 'SDTV') ? 'selected' : '' ?>>SDTV</option>
                                    <option value="TS" <?= ($linha["Qualidade"] == 'TS') ? 'selected' : '' ?>>TS</option>
                                    <option value="TV-Screen" <?= ($linha["Qualidade"] == 'TV-Screen') ? 'selected' : '' ?>>TV-Screen</option>
                                    <option value="TVRip" <?= ($linha["Qualidade"] == 'TVRip') ? 'selected' : '' ?>>TVRip</option>
                                    <option value="VHSRip" <?= ($linha["Qualidade"] == 'VHSRip') ? 'selected' : '' ?>>VHSRip</option>
                                    <option value="WEB-DL" <?= ($linha["Qualidade"] == 'WEB-DL') ? 'selected' : '' ?>>WEB-DL</option>
                                    <option value="WEB-RIP" <?= ($linha["Qualidade"] == 'WEB-RIP') ? 'selected' : '' ?>>WEB-RIP</option>
                                    <option value="Workprint" <?= ($linha["Qualidade"] == 'Workprint') ? 'selected' : '' ?>>Workprint</option>
                                </select>
                            </div>

                            <div class="input-field col s6">
                                <small>Tipo de Áudio</small>
                                <select class="browser-default" id="tipoAudio" name="tipoAudio" required="">
                                    <option value="Dual-Audio" <?= ($linha["TipoAudio"] == 'Dual-Audio') ? 'selected' : '' ?>>Dual-Audio</option>
                                    <option value="Dublado" <?= ($linha["TipoAudio"] == 'Dublado') ? 'selected' : '' ?>>Dublado</option>
                                    <option value="Legendado" <?= ($linha["TipoAudio"] == 'Legendado') ? 'selected' : '' ?>>Legendado</option>
                                    <option value="Nacional" <?= ($linha["TipoAudio"] == 'Nacional') ? 'selected' : '' ?>>Nacional</option>
                                    <option value="Original" <?= ($linha["TipoAudio"] == 'Original') ? 'selected' : '' ?>>Original</option>
                                    <option value="Outro" <?= ($linha["TipoAudio"] == 'Outro') ? 'selected' : '' ?>>Outro</option>
                                    <option value="Sem Audio" <?= ($linha["TipoAudio"] == 'Sem Audio') ? 'selected' : '' ?>>Sem Audio</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <small>Codec de Áudio</small>
                                <select class="browser-default" id="audio" name="audio" required="">
                                    <option value="AAC" <?= ($linha["CodecAudio"] == 'AAC') ? 'selected' : '' ?>>AAC</option>
                                    <option value="AC3" <?= ($linha["CodecAudio"] == 'AC3') ? 'selected' : '' ?>>AC3</option>
                                    <option value="AC3/DTS" <?= ($linha["CodecAudio"] == 'AC3/DTS') ? 'selected' : '' ?>>AC3/DTS</option>
                                    <option value="DTS" <?= ($linha["CodecAudio"] == 'DTS') ? 'selected' : '' ?>>DTS</option>
                                    <option value="DTS-HD" <?= ($linha["CodecAudio"] == 'DTS-HD') ? 'selected' : '' ?>>DTS-HD</option>
                                    <option value="DTS-HD-MA" <?= ($linha["CodecAudio"] == 'DTS-HD-MA') ? 'selected' : '' ?>>DTS-HD-MA</option>
                                    <option value="DTS-X" <?= ($linha["CodecAudio"] == 'DTS-X') ? 'selected' : '' ?>>DTS-X</option>
                                    <option value="E-AC-3" <?= ($linha["CodecAudio"] == 'E-AC-3') ? 'selected' : '' ?>>E-AC-3</option>
                                    <option value="FLAC" <?= ($linha["CodecAudio"] == 'FLAC') ? 'selected' : '' ?>>FLAC</option>
                                    <option value="LPCM" <?= ($linha["CodecAudio"] == 'LPCM') ? 'selected' : '' ?>>LPCM</option>
                                    <option value="MPC" <?= ($linha["CodecAudio"] == 'MPC') ? 'selected' : '' ?>>MPC</option>
                                    <option value="MPEG Layer-3 (MP3)" <?= ($linha["CodecAudio"] == 'MPEG Layer-3 (MP3') ? 'selected' : '' ?>>MPEG Layer-3 (MP3)</option>
                                    <option value="OGG" <?= ($linha["CodecAudio"] == 'OGG') ? 'selected' : '' ?>>OGG</option>
                                    <option value="OPUS" <?= ($linha["CodecAudio"] == 'OPUS') ? 'selected' : '' ?>>OPUS</option>
                                    <option value="Outros" <?= ($linha["CodecAudio"] == 'Outros') ? 'selected' : '' ?>>Outros</option>
                                    <option value="PCM" <?= ($linha["CodecAudio"] == 'PCM') ? 'selected' : '' ?>>PCM</option>
                                    <option value="Real Audio (RMVB)" <?= ($linha["CodecAudio"] == 'Real Audio (RMVB)') ? 'selected' : '' ?>>Real Audio (RMVB)</option>
                                    <option value="TrueHD" <?= ($linha["CodecAudio"] == 'TrueHD') ? 'selected' : '' ?>>TrueHD</option>
                                    <option value="Vorbis" <?= ($linha["CodecAudio"] == 'Vorbis') ? 'selected' : '' ?>>Vorbis</option>
                                    <option value="Windows Media Audio" <?= ($linha["CodecAudio"] == 'indows Media Audio') ? 'selected' : '' ?>>Windows Media Audio</option>
                                </select>
                            </div>

                            <div class="input-field col s6">
                                <small>Codec de Vídeo</small>
                                <select class="browser-default" id="video" name="video" required="">
                                    <option value="DivX" <?= ($linha["CodecVideo"] == 'DivX') ? 'selected' : '' ?>>DivX</option>
                                    <option value="H264" <?= ($linha["CodecVideo"] == 'H264') ? 'selected' : '' ?>>H264</option>
                                    <option value="H265" <?= ($linha["CodecVideo"] == 'H265') ? 'selected' : '' ?>>H265</option>
                                    <option value="M4V" <?= ($linha["CodecVideo"] == 'M4V') ? 'selected' : '' ?>>M4V</option>
                                    <option value="MPEG-1" <?= ($linha["CodecVideo"] == 'MPEG-1') ? 'selected' : '' ?>>MPEG-1</option>
                                    <option value="MPEG-2" <?= ($linha["CodecVideo"] == 'MPEG-2') ? 'selected' : '' ?>>MPEG-2</option>
                                    <option value="Outros" <?= ($linha["CodecVideo"] == 'Outros') ? 'selected' : '' ?>>Outros</option>
                                    <option value="Real Video (RMVB)" <?= ($linha["CodecVideo"] == 'Real Video (RMVB)') ? 'selected' : '' ?>>Real Video (RMVB)</option>
                                    <option value="VC-1" <?= ($linha["CodecVideo"] == 'VC-1') ? 'selected' : '' ?>>VC-1</option>
                                    <option value="VP6" <?= ($linha["CodecVideo"] == 'VP6') ? 'selected' : '' ?>>VP6</option>
                                    <option value="VP9" <?= ($linha["CodecVideo"] == 'VP9') ? 'selected' : '' ?>>VP9</option>
                                    <option value="Windows Media Video" <?= ($linha["CodecVideo"] == 'Windows Media Video') ? 'selected' : '' ?>>Windows Media Video</option>
                                    <option value="XviD" <?= ($linha["CodecVideo"] == 'XviD') ? 'selected' : '' ?>>XviD</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <small>Extensão</small>
                                <select class="browser-default" id="formato" name="formato" required="">
                                    <option value="ASF" <?= ($linha["Formato"] == 'ASF') ? 'selected' : '' ?>>ASF</option>
                                    <option value="AVI" <?= ($linha["Formato"] == 'AVI') ? 'selected' : '' ?>>AVI</option>
                                    <option value="FLV" <?= ($linha["Formato"] == 'FLV') ? 'selected' : '' ?>>FLV</option>
                                    <option value="M2TS" <?= ($linha["Formato"] == 'M2TS') ? 'selected' : '' ?>>M2TS</option>
                                    <option value="MKV" <?= ($linha["Formato"] == 'MKV') ? 'selected' : '' ?>>MKV</option>
                                    <option value="MOV" <?= ($linha["Formato"] == 'MOV') ? 'selected' : '' ?>>MOV</option>
                                    <option value="MP4" <?= ($linha["Formato"] == 'MP4') ? 'selected' : '' ?>>MP4</option>
                                    <option value="MPG" <?= ($linha["Formato"] == 'MPG') ? 'selected' : '' ?>>MPG</option>
                                    <option value="MPEG" <?= ($linha["Formato"] == 'MPEG') ? 'selected' : '' ?>>MPEG</option>
                                    <option value="RM" <?= ($linha["Formato"] == 'RM') ? 'selected' : '' ?>>RM</option>
                                    <option value="RMVB" <?= ($linha["Formato"] == 'RMVB') ? 'selected' : '' ?>>RMVB</option>
                                    <option value="SWF" <?= ($linha["Formato"] == 'SWF') ? 'selected' : '' ?>>SWF</option>
                                    <option value="TS" <?= ($linha["Formato"] == 'TS') ? 'selected' : '' ?>>TS</option>
                                    <option value="VOB" <?= ($linha["Formato"] == 'VOB') ? 'selected' : '' ?>>VOB</option>
                                    <option value="WMV" <?= ($linha["Formato"] == 'WMV') ? 'selected' : '' ?>>WMV</option>
                                    <option value="Outros" <?= ($linha["Formato"] == 'Outros') ? 'selected' : '' ?>>Outros</option>
                                    <option value="ISO" <?= ($linha["Formato"] == 'ISO') ? 'selected' : '' ?>>ISO</option>
                                </select>
                            </div>

                            <div class="input-field col s6">
                                <small>Legenda</small>
                                <select class="browser-default" id="legenda" name="legenda" required="">
                                    <option value="Alemao" <?= ($linha["Legenda"] == 'Alemao') ? 'selected' : '' ?>>Alemao</option>
                                    <option value="Chines" <?= ($linha["Legenda"] == 'Chines') ? 'selected' : '' ?>>Chines</option>
                                    <option value="Coreano" <?= ($linha["Legenda"] == 'Coreano') ? 'selected' : '' ?>>Coreano</option>
                                    <option value="Espanhol" <?= ($linha["Legenda"] == 'Espanhol') ? 'selected' : '' ?>>Espanhol</option>
                                    <option value="Ingles" <?= ($linha["Legenda"] == 'Ingles') ? 'selected' : '' ?>>Ingles</option>
                                    <option value="Japones" <?= ($linha["Legenda"] == 'Japones') ? 'selected' : '' ?>>Japones</option>
                                    <option value="Outros" <?= ($linha["Legenda"] == 'Outros') ? 'selected' : '' ?>>Outros</option>
                                    <option value="Português PT" <?= ($linha["Legenda"] == 'Português PT') ? 'selected' : '' ?>>Português PT</option>
                                    <option value="Português BR" <?= ($linha["Legenda"] == 'Português BR') ? 'selected' : '' ?>>Português BR</option>
                                    <option value="Russo" <?= ($linha["Legenda"] == 'Russo') ? 'selected' : '' ?>>Russo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <small>Idioma</small>
                                <select class="browser-default" id="idioma" name="idioma" required="">
                                    <option value="Inglês" <?= ($linha["Idioma"] == 'Inglês') ? 'selected' : '' ?>>Inglês</option>
                                    <option value="Francês" <?= ($linha["Idioma"] == 'Francês') ? 'selected' : '' ?>>Francês</option>
                                    <option value="Alemão" <?= ($linha["Idioma"] == 'Alemão') ? 'selected' : '' ?>>Alemão</option>
                                    <option value="Italiano" <?= ($linha["Idioma"] == 'Italiano') ? 'selected' : '' ?>>Italiano</option>
                                    <option value="Japonês" <?= ($linha["Idioma"] == 'Japonês') ? 'selected' : '' ?>>Japonês</option>
                                    <option value="Espanhol" <?= ($linha["Idioma"] == 'Espanhol') ? 'selected' : '' ?>>Espanhol</option>
                                    <option value="Russo" <?= ($linha["Idioma"] == 'Russo') ? 'selected' : '' ?>>Russo</option>
                                    <option value="Português" <?= ($linha["Idioma"] == 'Português') ? 'selected' : '' ?>>Português</option>
                                    <option value="Multilinguagem" <?= ($linha["Idioma"] == 'Multilinguagem') ? 'selected' : '' ?>>Multilinguagem</option>
                                    <option value="Chinês" <?= ($linha["Idioma"] == 'Chinês') ? 'selected' : '' ?>>Chinês</option>
                                    <option value="Outros" <?= ($linha["Idioma"] == 'Outros') ? 'selected' : '' ?>>Outros</option>
                                    <option value="Dinamarques" <?= ($linha["Idioma"] == 'Dinamarques') ? 'selected' : '' ?>>Dinamarques</option>
                                    <option value="Sueco" <?= ($linha["Idioma"] == 'Sueco') ? 'selected' : '' ?>>Sueco</option>
                                    <option value="Finlandes" <?= ($linha["Idioma"] == 'Finlandes') ? 'selected' : '' ?>>Finlandes</option>
                                    <option value="Bulgaro" <?= ($linha["Idioma"] == 'Bulgaro') ? 'selected' : '' ?>>Bulgaro</option>
                                    <option value="Noruegues" <?= ($linha["Idioma"] == 'Noruegues') ? 'selected' : '' ?>>Noruegues</option>
                                    <option value="Holandes" <?= ($linha["Idioma"] == 'Holandes') ? 'selected' : '' ?>>Holandes</option>
                                    <option value="Italiano" <?= ($linha["Idioma"] == 'Italiano') ? 'selected' : '' ?>>Italiano</option>
                                    <option value="Polones" <?= ($linha["Idioma"] == 'Polones') ? 'selected' : '' ?>>Polones</option>
                                </select>
                            </div>

                            <div class="input-field col s6">
                                <small>Idioma Original</small>
                                <select class="browser-default" id="idiomaOriginal" name="idiomaOriginal" required="">
                                    <option value="Alemao" <?= ($linha["IdiomaOriginal"] == 'Alemao') ? 'selected' : '' ?>>Alemao</option>
                                    <option value="Chines" <?= ($linha["IdiomaOriginal"] == 'Chines') ? 'selected' : '' ?>>Chines</option>
                                    <option value="Coreano" <?= ($linha["IdiomaOriginal"] == 'Coreano') ? 'selected' : '' ?>>Coreano</option>
                                    <option value="Espanhol" <?= ($linha["IdiomaOriginal"] == 'Espanhol') ? 'selected' : '' ?>>Espanhol</option>
                                    <option value="Inglês" <?= ($linha["IdiomaOriginal"] == 'Inglês') ? 'selected' : '' ?>>Inglês</option>
                                    <option value="Japones" <?= ($linha["IdiomaOriginal"] == 'Japones') ? 'selected' : '' ?>>Japones</option>
                                    <option value="Outros" <?= ($linha["IdiomaOriginal"] == 'Outros') ? 'selected' : '' ?>>Outros</option>
                                    <option value="Português PT" <?= ($linha["IdiomaOriginal"] == 'Português PT') ? 'selected' : '' ?>>Português PT</option>
                                    <option value="Português BR" <?= ($linha["IdiomaOriginal"] == 'Português BR') ? 'selected' : '' ?>>Português BR</option>
                                    <option value="Russo" <?= ($linha["IdiomaOriginal"] == 'Russo') ? 'selected' : '' ?>>Russo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="descricao" name="descricao" class="materialize-textarea"><?php echo str_replace("<br />", "", $linha["Descricao"]) ?></textarea>
                                <label for="descricao">Descrição</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="musicas" name="musicas" class="materialize-textarea"><?php echo str_replace("<br />", "", $linha["Elenco"]) ?></textarea>
                                <label for="musicas">Elenco</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input type="submit" name="BntCadastrar" id="BntCadastrar" class="btn btn-sm light-blue darken-4" value="SALVAR DESCRIÇÃO">
                            </div>
                        </div>
            <?php   }
                } else {
                    header("location:Index.php");
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