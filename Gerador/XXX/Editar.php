<?php
session_start();
require '../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];
$idInserido =  $_GET['idInserido'];

$query = "SELECT 1 FROM adultos WHERE Pk = $idInserido";
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

$query = "SELECT * FROM adultos Where Pk = $idInserido";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    while ($linha = $resultado->fetch_assoc()) {
        $Titulo = $linha["Titulo"];
        $Capa = $linha["Capa"];
        $Data = $linha["Data"];
        $Resolucao = $linha["Resolucao"];
        $Largura = $linha["Largura"];
        $Altura = $linha["Altura"];
        $Descricao = $linha["Descricao"];
        $Elenco = $linha["Elenco"];
        $Qualidade = $linha["Qualidade"];
        $TipoAudio = $linha["TipoAudio"];
        $Video = $linha["CodecVideo"];
        $Audio = $linha["CodecAudio"];
        $Formato = $linha["Formato"];
        $Legenda = $linha["Legenda"];
        $Idioma = $linha["Idioma"];
        $Categoria = $Categoria;
        $Duracao = $linha["Duracao"];
        $Direcao = $linha["Direcao"];
        $Pais = $linha["Pais"];
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
                <span class="breadcrumb grey-text lighten-5">Editar</span>

            </div>
        </nav>
    </header>

    <main class="container" style="margin-top: 80px;margin-bottom: 80px;">
        <form action="Gera.php" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input id="titulo" name="titulo" type="text" class="validate" value="<?php echo $Titulo ?>" required="">
                    <label class="active" for="titulo">Título</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="capa" name="capa" type="text" class="validate" required="" value="<?php echo $Capa ?>">
                    <label class="active" for="capa">Link da Capa</label>
                </div>
                <div class="input-field col s6">
                    <input id="duracao" name="duracao" type="text" class="validate" required="" value="<?php echo $Duracao ?>">
                    <label class="active" for="duracao">Duração</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="direcao" name="direcao" type="text" class="validate" required="" value="<?php echo $Direcao ?>">
                    <label class="active" for="direcao">Direção</label>
                </div>
                <div class="input-field col s6">
                    <input id="pais" name="pais" type="text" class="validate" required="" value="<?php echo $Pais ?>">
                    <label class="active" for="pais">País de Origem</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $Data ?>" id="data" name="data" type="text" class="validate" required="">
                    <label class="active" for="data">Data de Lançamento</label>
                </div>

                <div class="input-field inline col s6">
                    <?php
                    $Res =  explode('x', $Resolucao);
                    ?>
                    <input class="input-field inline col s6 left" id="largura" placeholder="1920" name="largura" type="text" class="validate" required="" value="<?php echo $Res[0] ?>">
                    <label class="active" for="largura">Resolução</label>

                    <input class="input-field inline col s6 right" id="altura" placeholder="1080" name="altura" type="text" class="validate" required="" value="<?php echo $Res[1] ?>">
                    <label class="active" for="altura">Resolução</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input value="<?php echo $Screen1 ?>" id="screen1" name="screen1" type="text" class="validate" required="">
                    <label class="active" for="screen1">Screen 1</label>
                </div>

                <div class="input-field col s6">
                    <input value="<?php echo $Screen2 ?>" id="screen2" name="screen2" type="text" class="validate" required="">
                    <label class="active" for="screen2">Screen 2</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input value="<?php echo $Screen3 ?>" id="screen3" name="screen3" type="text" class="validate" required="">
                    <label class="active" for="screen3">Screen 3</label>
                </div>

                <div class="input-field col s6">
                    <input value="<?php echo $Screen4 ?>" id="screen4" name="screen4" type="text" class="validate" required="">
                    <label class="active" for="screen4">Screen 4</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <small>Qualidade</small>
                    <select class="browser-default" id="qualidade" name="qualidade" required="">
                        <option value="BD-R" <?= ($Qualidade == 'BD-R') ? 'selected' : '' ?>>BD-R</option>
                        <option value="BD100" <?= ($Qualidade == 'BD100') ? 'selected' : '' ?>>BD100</option>
                        <option value="BD25" <?= ($Qualidade == 'BD25') ? 'selected' : '' ?>>BD25</option>
                        <option value="BD50" <?= ($Qualidade == 'BD50') ? 'selected' : '' ?>>BD50</option>
                        <option value="BD66" <?= ($Qualidade == 'BD66') ? 'selected' : '' ?>>BD66</option>
                        <option value="BDRip" <?= ($Qualidade == 'BDRip') ? 'selected' : '' ?>>BDRip</option>
                        <option value="Blu-Ray" <?= ($Qualidade == 'Blu-Ray') ? 'selected' : '' ?>>Blu-Ray</option>
                        <option value="Blu-Ray RC" <?= ($Qualidade == 'Blu-Ray RC') ? 'selected' : '' ?>>Blu-Ray RC</option>
                        <option value="BRRip" <?= ($Qualidade == 'BRRip') ? 'selected' : '' ?>>BRRip</option>
                        <option value="DSR" <?= ($Qualidade == 'DSR') ? 'selected' : '' ?>>DSR</option>
                        <option value="DVD5" <?= ($Qualidade == 'DVD5') ? 'selected' : '' ?>>DVD5</option>
                        <option value="DVD9" <?= ($Qualidade == 'DVD9') ? 'selected' : '' ?>>DVD9</option>
                        <option value="DVDrip" <?= ($Qualidade == 'DVDrip') ? 'selected' : '' ?>>DVDrip</option>
                        <option value="HD-DVD" <?= ($Qualidade == 'HD-DVD') ? 'selected' : '' ?>>HD-DVD</option>
                        <option value="HDCAM" <?= ($Qualidade == 'HDCAM') ? 'selected' : '' ?>>HDCAM</option>
                        <option value="HDR" <?= ($Qualidade == 'HDR') ? 'selected' : '' ?>>HDR</option>
                        <option value="HDrip" <?= ($Qualidade == 'HDrip') ? 'selected' : '' ?>>HDrip</option>
                        <option value="HDTC" <?= ($Qualidade == 'HDTC') ? 'selected' : '' ?>>HDTC</option>
                        <option value="HDTS" <?= ($Qualidade == 'HDTS') ? 'selected' : '' ?>>HDTS</option>
                        <option value="HDTV" <?= ($Qualidade == 'HDTV') ? 'selected' : '' ?>>HDTV</option>
                        <option value="PDTV" <?= ($Qualidade == 'PDTV') ? 'selected' : '' ?>>PDTV</option>
                        <option value="PPVRip" <?= ($Qualidade == 'PPVRip') ? 'selected' : '' ?>>PPVRip</option>
                        <option value="R5" <?= ($Qualidade == 'R5') ? 'selected' : '' ?>>R5</option>
                        <option value="R6" <?= ($Qualidade == 'R6') ? 'selected' : '' ?>>R6</option>
                        <option value="REMUX" <?= ($Qualidade == 'REMUX') ? 'selected' : '' ?>>REMUX</option>
                        <option value="SDTV" <?= ($Qualidade == 'SDTV') ? 'selected' : '' ?>>SDTV</option>
                        <option value="TS" <?= ($Qualidade == 'TS') ? 'selected' : '' ?>>TS</option>
                        <option value="TV-Screen" <?= ($Qualidade == 'TV-Screen') ? 'selected' : '' ?>>TV-Screen</option>
                        <option value="TVRip" <?= ($Qualidade == 'TVRip') ? 'selected' : '' ?>>TVRip</option>
                        <option value="VHSRip" <?= ($Qualidade == 'VHSRip') ? 'selected' : '' ?>>VHSRip</option>
                        <option value="WEB-DL" <?= ($Qualidade == 'WEB-DL') ? 'selected' : '' ?>>WEB-DL</option>
                        <option value="WEB-RIP" <?= ($Qualidade == 'WEB-RIP') ? 'selected' : '' ?>>WEB-RIP</option>
                        <option value="Workprint" <?= ($Qualidade == 'Workprint') ? 'selected' : '' ?>>Workprint</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <small>Tipo de Áudio</small>
                    <select class="browser-default" id="tipoAudio" name="tipoAudio" required="">
                        <option value="Dual-Audio" <?= ($TipoAudio == 'Dual-Audio') ? 'selected' : '' ?>>Dual-Audio</option>
                        <option value="Dublado" <?= ($TipoAudio == 'Dublado') ? 'selected' : '' ?>>Dublado</option>
                        <option value="Legendado" <?= ($TipoAudio == 'Legendado') ? 'selected' : '' ?>>Legendado</option>
                        <option value="Nacional" <?= ($TipoAudio == 'Nacional') ? 'selected' : '' ?>>Nacional</option>
                        <option value="Original" <?= ($TipoAudio == 'Original') ? 'selected' : '' ?>>Original</option>
                        <option value="Outro" <?= ($TipoAudio == 'Outro') ? 'selected' : '' ?>>Outro</option>
                        <option value="Sem Audio" <?= ($TipoAudio == 'Sem Audio') ? 'selected' : '' ?>>Sem Audio</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <small>Codec de Áudio</small>
                    <select class="browser-default" id="audio" name="audio" required="">
                        <option value="AAC" <?= ($Audio == 'AAC') ? 'selected' : '' ?>>AAC</option>
                        <option value="AC3" <?= ($Audio == 'AC3') ? 'selected' : '' ?>>AC3</option>
                        <option value="AC3/DTS" <?= ($Audio == 'AC3/DTS') ? 'selected' : '' ?>>AC3/DTS</option>
                        <option value="DTS" <?= ($Audio == 'DTS') ? 'selected' : '' ?>>DTS</option>
                        <option value="DTS-HD" <?= ($Audio == 'DTS-HD') ? 'selected' : '' ?>>DTS-HD</option>
                        <option value="DTS-HD-MA" <?= ($Audio == 'DTS-HD-MA') ? 'selected' : '' ?>>DTS-HD-MA</option>
                        <option value="DTS-X" <?= ($Audio == 'DTS-X') ? 'selected' : '' ?>>DTS-X</option>
                        <option value="E-AC-3" <?= ($Audio == 'E-AC-3') ? 'selected' : '' ?>>E-AC-3</option>
                        <option value="FLAC" <?= ($Audio == 'FLAC') ? 'selected' : '' ?>>FLAC</option>
                        <option value="LPCM" <?= ($Audio == 'LPCM') ? 'selected' : '' ?>>LPCM</option>
                        <option value="MPC" <?= ($Audio == 'MPC') ? 'selected' : '' ?>>MPC</option>
                        <option value="MPEG Layer-3 (MP3)" <?= ($Audio == 'MPEG Layer-3 (MP3') ? 'selected' : '' ?>>MPEG Layer-3 (MP3)</option>
                        <option value="OGG" <?= ($Audio == 'OGG') ? 'selected' : '' ?>>OGG</option>
                        <option value="OPUS" <?= ($Audio == 'OPUS') ? 'selected' : '' ?>>OPUS</option>
                        <option value="Outros" <?= ($Audio == 'Outros') ? 'selected' : '' ?>>Outros</option>
                        <option value="PCM" <?= ($Audio == 'PCM') ? 'selected' : '' ?>>PCM</option>
                        <option value="Real Audio (RMVB)" <?= ($Audio == 'Real Audio (RMVB)') ? 'selected' : '' ?>>Real Audio (RMVB)</option>
                        <option value="TrueHD" <?= ($Audio == 'TrueHD') ? 'selected' : '' ?>>TrueHD</option>
                        <option value="Vorbis" <?= ($Audio == 'Vorbis') ? 'selected' : '' ?>>Vorbis</option>
                        <option value="Windows Media Audio" <?= ($Audio == 'indows Media Audio') ? 'selected' : '' ?>>Windows Media Audio</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <small>Codec de Vídeo</small>
                    <select class="browser-default" id="video" name="video" required="">
                        <option value="DivX" <?= ($Video == 'DivX') ? 'selected' : '' ?>>DivX</option>
                        <option value="H264" <?= ($Video == 'H264') ? 'selected' : '' ?>>H264</option>
                        <option value="H265" <?= ($Video == 'H265') ? 'selected' : '' ?>>H265</option>
                        <option value="M4V" <?= ($Video == 'M4V') ? 'selected' : '' ?>>M4V</option>
                        <option value="MPEG-1" <?= ($Video == 'MPEG-1') ? 'selected' : '' ?>>MPEG-1</option>
                        <option value="MPEG-2" <?= ($Video == 'MPEG-2') ? 'selected' : '' ?>>MPEG-2</option>
                        <option value="Outros" <?= ($Video == 'Outros') ? 'selected' : '' ?>>Outros</option>
                        <option value="Real Video (RMVB)" <?= ($Video == 'Real Video (RMVB)') ? 'selected' : '' ?>>Real Video (RMVB)</option>
                        <option value="VC-1" <?= ($Video == 'VC-1') ? 'selected' : '' ?>>VC-1</option>
                        <option value="VP6" <?= ($Video == 'VP6') ? 'selected' : '' ?>>VP6</option>
                        <option value="VP9" <?= ($Video == 'VP9') ? 'selected' : '' ?>>VP9</option>
                        <option value="Windows Media Video" <?= ($Video == 'Windows Media Video') ? 'selected' : '' ?>>Windows Media Video</option>
                        <option value="XviD" <?= ($Video == 'XviD') ? 'selected' : '' ?>>XviD</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <small>Extensão</small>
                    <select class="browser-default" id="formato" name="formato" required="">
                        <option value="ASF" <?= ($Formato == 'ASF') ? 'selected' : '' ?>>ASF</option>
                        <option value="AVI" <?= ($Formato == 'AVI') ? 'selected' : '' ?>>AVI</option>
                        <option value="FLV" <?= ($Formato == 'FLV') ? 'selected' : '' ?>>FLV</option>
                        <option value="M2TS" <?= ($Formato == 'M2TS') ? 'selected' : '' ?>>M2TS</option>
                        <option value="MKV" <?= ($Formato == 'MKV') ? 'selected' : '' ?>>MKV</option>
                        <option value="MOV" <?= ($Formato == 'MOV') ? 'selected' : '' ?>>MOV</option>
                        <option value="MP4" <?= ($Formato == 'MP4') ? 'selected' : '' ?>>MP4</option>
                        <option value="MPG" <?= ($Formato == 'MPG') ? 'selected' : '' ?>>MPG</option>
                        <option value="MPEG" <?= ($Formato == 'MPEG') ? 'selected' : '' ?>>MPEG</option>
                        <option value="RM" <?= ($Formato == 'RM') ? 'selected' : '' ?>>RM</option>
                        <option value="RMVB" <?= ($Formato == 'RMVB') ? 'selected' : '' ?>>RMVB</option>
                        <option value="SWF" <?= ($Formato == 'SWF') ? 'selected' : '' ?>>SWF</option>
                        <option value="TS" <?= ($Formato == 'TS') ? 'selected' : '' ?>>TS</option>
                        <option value="VOB" <?= ($Formato == 'VOB') ? 'selected' : '' ?>>VOB</option>
                        <option value="WMV" <?= ($Formato == 'WMV') ? 'selected' : '' ?>>WMV</option>
                        <option value="Outros" <?= ($Formato == 'Outros') ? 'selected' : '' ?>>Outros</option>
                        <option value="ISO" <?= ($Formato == 'ISO') ? 'selected' : '' ?>>ISO</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <small>Legenda</small>
                    <select class="browser-default" id="legenda" name="legenda" required="">
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
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <small>Idioma</small>
                    <select class="browser-default" id="idioma" name="idioma" required="">
                        <option value="Inglês" <?= ($Idioma == 'Inglês') ? 'selected' : '' ?>>Inglês</option>
                        <option value="Francês" <?= ($Idioma == 'Francês') ? 'selected' : '' ?>>Francês</option>
                        <option value="Alemão" <?= ($Idioma == 'Alemão') ? 'selected' : '' ?>>Alemão</option>
                        <option value="Italiano" <?= ($Idioma == 'Italiano') ? 'selected' : '' ?>>Italiano</option>
                        <option value="Japonês" <?= ($Idioma == 'Japonês') ? 'selected' : '' ?>>Japonês</option>
                        <option value="Espanhol" <?= ($Idioma == 'Espanhol') ? 'selected' : '' ?>>Espanhol</option>
                        <option value="Russo" <?= ($Idioma == 'Russo') ? 'selected' : '' ?>>Russo</option>
                        <option value="Português" <?= ($Idioma == 'Português') ? 'selected' : '' ?>>Português</option>
                        <option value="Multilinguagem" <?= ($Idioma == 'Multilinguagem') ? 'selected' : '' ?>>Multilinguagem</option>
                        <option value="Chinês" <?= ($Idioma == 'Chinês') ? 'selected' : '' ?>>Chinês</option>
                        <option value="Outros" <?= ($Idioma == 'Outros') ? 'selected' : '' ?>>Outros</option>
                        <option value="Dinamarques" <?= ($Idioma == 'Dinamarques') ? 'selected' : '' ?>>Dinamarques</option>
                        <option value="Sueco" <?= ($Idioma == 'Sueco') ? 'selected' : '' ?>>Sueco</option>
                        <option value="Finlandes" <?= ($Idioma == 'Finlandes') ? 'selected' : '' ?>>Finlandes</option>
                        <option value="Bulgaro" <?= ($Idioma == 'Bulgaro') ? 'selected' : '' ?>>Bulgaro</option>
                        <option value="Noruegues" <?= ($Idioma == 'Noruegues') ? 'selected' : '' ?>>Noruegues</option>
                        <option value="Holandes" <?= ($Idioma == 'Holandes') ? 'selected' : '' ?>>Holandes</option>
                        <option value="Italiano" <?= ($Idioma == 'Italiano') ? 'selected' : '' ?>>Italiano</option>
                        <option value="Polones" <?= ($Idioma == 'Polones') ? 'selected' : '' ?>>Polones</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <small>Categoria</small>
                    <select class="browser-default" id="categoria" name="categoria" required="">
                        <option value="Gay" <?= ($Categoria == 'Gay') ? 'selected' : '' ?>>Gay</option>
                        <option value="Hentai" <?= ($Categoria == 'Hentai') ? 'selected' : '' ?>>Hentai</option>
                        <option value="Transex/Female" <?= ($Categoria == 'Transex/Female') ? 'selected' : '' ?>>Transex/Female</option>
                        <option value="XXX" <?= ($Categoria == 'XXX') ? 'selected' : '' ?>>XXX</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="descricao" name="descricao" class="materialize-textarea"><?php echo str_replace("<br />", "", $Descricao) ?></textarea>
                    <label for="descricao">Descrição</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="musicas" name="musicas" class="materialize-textarea"><?php echo str_replace("<br />", "", $Elenco) ?></textarea>
                    <label for="musicas">Elenco</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input type="submit" name="BntCadastrar" id="BntCadastrar" class="btn btn-sm light-blue darken-4" value="SALVAR DESCRIÇÃO">
                </div>
            </div>
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