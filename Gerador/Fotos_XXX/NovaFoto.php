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
    <title>Fotos XXX</title>
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
                <a class="breadcrumb white-text" href="./Index.php">Fotos</a>
                <span class="breadcrumb grey-text lighten-5">Nova Foto XXX</span>

            </div>
        </nav>
    </header>

    <main class="container" style="margin-top: 80px;margin-bottom: 80px;">
        <form action="gera.php" method="post" class="p-3">
            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="titulo" name="titulo" type="text" class="validate" required="">
                    <label class="active" for="titulo">Título</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="capa" name="capa" type="text" class="validate" required="">
                    <label class="active" for="capa">Link da Capa</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="data" name="data" type="text" class="validate" required="">
                    <label class="active" for="data">Data da Publicação</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="paginas" name="paginas" type="number" class="validate" required="">
                    <label class="active" for="paginas">Número de Páginas</label>
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
                <div class="input-field col s6">
                    <small>Formato do Arquivo</small>
                    <select class="browser-default" id="extensao" name="extensao" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="MP3">MP3</option>
                        <option value="PNG">PNG</option>
                        <option value="JPG">JPG</option>
                        <option value="PDF">PDF</option>
                        <option value="DOC">DOC</option>
                        <option value="EPUB">EPUB</option>
                        <option value="MOBI">MOBI</option>
                        <option value="CBR">CBR</option>
                        <option value="HTML">HTML</option>
                        <option value="SVG">SVG</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <small>Idioma do Conteúdo</small>
                    <select class="browser-default" id="idioma" name="idioma" required="">
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
                        <option value="Multilinguagem">Multilinguagem</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <small>Tipo de Publicação</small>
                    <select class="browser-default" id="publicacao" name="publicacao" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Mensal">Mensal</option>
                        <option value="Semanal">Semanal</option>
                        <option value="Quinzenal">Quinzenal</option>
                        <option value="Semestral">Semestral</option>
                        <option value="Anual">Anual</option>
                        <option value="Diario">Diário</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <small>Gênero</small>
                    <select class="browser-default" id="genero" name="genero" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Porno">Porno</option>
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