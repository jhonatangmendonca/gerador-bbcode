<?php
session_start();
require './../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

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
    <title>Filmes</title>
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
                <a class="breadcrumb white-text" href="./Index.php">Filmes</a>
                <span class="breadcrumb grey-text lighten-5">Novo Filme</span>
            </div>
        </nav>
    </header>

    <main class="container" style="margin-top: 80px;margin-bottom: 80px;">
        <button class="item-hide" onclick="erroFilme()" id="errorRequest" type="button"></button>
        <form action="gera.php" method="post" class="p-3">
            <div class="row">
                <div class="input-field col s6 m6 l4 xl4">
                    <input id="idMovieImdb" name="idMovieImdb" type="text" class="validate">
                    <label class="active" for="idMovieImdb">Código IMDB</label>
                </div>

                <div class="input-field col s1 m1 l1 xl1">
                    <button data-position="top" data-tooltip="Buscar Dados" style="right: 10px;top: 7px;" class="btn-floating btn-small waves-effect waves-light indigo tooltipped" onclick="searchMovieImdb()" type="button"><i class="material-icons">search</i></button>
                </div>
            </div>

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
                    <input id="diretor" name="diretor" type="text" class="validate" required="">
                    <label class="active" for="diretor">Diretor</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="produtora" name="produtora" type="text" class="validate" required="">
                    <label class="active" for="produtora">Produtora</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="duracao" name="duracao" type="text" class="validate" required="">
                    <label class="active" for="duracao">Duração</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="pais" name="pais" type="text" class="validate" required="">
                    <label class="active" for="pais">País de Origem</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="dataLanc" name="dataLanc" type="text" class="validate" required="">
                    <label class="active" for="dataLanc">Data de Lançamento</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="genero" name="genero" type="text" class="validate" required="">
                    <label class="active" for="genero">Gênero</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m4 l4 xl4">
                    <input id="dataLanc" name="imdb" type="text" class="validate">
                    <label class="imdb" for="imdb">Nota IMDB</label>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <input id="rotten" name="rotten" type="text" class="validate">
                    <label class="active" for="rotten">Nota Rotten Tomatoes</label>
                </div>

                <div class="input-field col s12 m4 l4 xl4">
                    <input id="metacritic" name="metacritic" type="text" class="validate">
                    <label class="active" for="metacritic">Nota Metacritic</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="sinopse" name="sinopse" class="materialize-textarea validate" required=""></textarea>
                    <label for="sinopse">Sinopse</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="elenco" name="elenco" class="materialize-textarea validate" required=""></textarea>
                    <label for="elenco">Elenco</label>
                </div>
            </div>

            <div class="row item-hide">
                <div class="input-field col s12">
                    <textarea id="elenco2" name="elenco2" class="materialize-textarea validate"></textarea>
                    <label for="elenco2">Elenco</label>
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