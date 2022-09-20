<?php
header('Access-Control-Allow-Origin: *');
session_start();
require './../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

$idSteam = '';

if (empty($_GET['idSteam'])) {
    header("Location: NovoJogo.php?idSteam=noData");
} else {
    $idSteam = $_GET['idSteam'];
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

$months = [
    'jan',
    'fev',
    'mar',
    'abr',
    'mai',
    'jun',
    'jul',
    'ago',
    'set',
    'out',
    'nov',
    'dez',
];
$monthsPtBr = [
    'Janeiro',
    'Fevereiro',
    'Março',
    'Abril',
    'Maio',
    'Junho',
    'Julho',
    'Agosto',
    'Setembro',
    'Outubro',
    'Novembro',
    'Dezembro',
];
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://store.steampowered.com/api/appdetails/?appids=" . $idSteam . "&l=brazilian",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$steam = json_decode($response, true);
// echo $response;
if ($err) {
    echo "cURL Error #:" . $err;
} else if ($steam[$idSteam]['success'] == false) {
    header("Location: NovoJogo.php?idSteam=noData");
} else {
    function dateFormat($idSteam, $steam, $months, $monthsPtBr)
    {
        $str = $steam[$idSteam]['data']['release_date']['date'];
        $dateArray = explode("/", $str);

        for ($i = 0; $i < 12; $i++) {
            if ($dateArray[1] == $months[$i]) {
                $dateArray[1] = $monthsPtBr[$i];
            }
        }

        $date = implode(" de ", $dateArray);
        echo $date;
    }

    function returnScreenshot($idSteam, $steam, $index)
    {
        if (isset($steam[$idSteam]['data']['screenshots'][$index]['path_full'])) {
            echo strstr($steam[$idSteam]['data']['screenshots'][$index]['path_full'], '?', true);
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
                    <label class="active" for="idGameSteam">Código STEAM</label>
                </div>

                <div class="input-field col s1 m1 l1 xl1">
                    <button data-position="top" data-tooltip="Buscar Dados" style="right: 10px;top: 7px;" class="btn-floating btn-small waves-effect waves-light indigo tooltipped" onclick="searchGameSteam()" type="button"><i class="material-icons">search</i></button>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo $steam[$idSteam]['data']['name']; ?>" id="titulo" name="titulo" type="text" class="validate" required="">
                    <label class="active" for="titulo">Título</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo "https://steamcdn-a.akamaihd.net/steam/apps/" . $idSteam . "/library_600x900_2x.jpg" ?>" id="capa" name="capa" type="text" class="validate" required="">
                    <label class="active" for="capa">Link da Capa</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input id="release" name="release" type="text" class="validate" required="">
                    <label class="active" for="release">Release</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php echo  $steam[$idSteam]['data']['developers'][0]; ?>" id="desenvolvedora" name="desenvolvedora" type="text" class="validate" required="">
                    <label class="active" for="desenvolvedora">Desenvolvedora</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 xl6">
                    <input value="<?php dateFormat($idSteam, $steam, $months, $monthsPtBr);  ?>" id="data" name="data" type="text" class="validate" required="">
                    <label class="active" for="data">Data de Lançamento</label>
                </div>

                <div class="input-field col s12 m6 l6 xl6">
                    <input id="trailer" name="trailer" type="text" class="validate" placeholder="Insira o Link do Youtube" required="">
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
                        <option value="Sim">Não</option>
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
                        <option value="Português PT">Português PT</option>
                        <option value="Português BR">Português BR</option>
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
                        <option value="Português PT">Português PT</option>
                        <option value="Português BR">Português BR</option>
                        <option value="Russo">Russo</option>
                        <option value="Multilinguagem">Multilinguagem</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m4 l4 xl4">
                    <small>Extensão</small>
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
                        <option value="Emulação">Emulação</option>
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
                    <small>Gênero</small>
                    <select class="browser-default" id="genero" name="genero" required="">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Ação" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Ação') ? 'selected' : '' ?>>Ação</option>
                        <option value="Arcade" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Arcade') ? 'selected' : '' ?>>Arcade</option>
                        <option value="Aventura" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Aventura') ? 'selected' : '' ?>>Aventura</option>
                        <option value="Caça" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Caça') ? 'selected' : '' ?>>Caça</option>
                        <option value="Corrida" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Corridas') ? 'selected' : '' ?>>Corrida</option>
                        <option value="Esportes" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Esportes') ? 'selected' : '' ?>>Esportes</option>
                        <option value="Estratégia" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Estratégia') ? 'selected' : '' ?>>Estratégia</option>
                        <option value="Fliperama" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Fliperama') ? 'selected' : '' ?>>Fliperama</option>
                        <option value="FPS" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Tiros em Primeira Pessoa') ? 'selected' : '' ?>>FPS</option>
                        <option value="Guerra" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Guerras') ? 'selected' : '' ?>>Guerra</option>
                        <option value="Humor" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Humor Negro') ? 'selected' : '' ?>>Humor</option>
                        <option value="Infantis" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Infantis') ? 'selected' : '' ?>>Infantis</option>
                        <option value="Luta" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Luta') ? 'selected' : '' ?>>Luta</option>
                        <option value="Musica">Musical</option>
                        <option value="Quebra-Cabeça" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Quebra-Cabeças') ? 'selected' : '' ?>>Quebra-Cabeça</option>
                        <option value="Rpg" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'RPG') ? 'selected' : '' ?>>Rpg</option>
                        <option value="Simulador" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Simulação') ? 'selected' : '' ?>>Simulador</option>
                        <option value="Simulador De Combate Áereo" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Simulador De Combate Áereo') ? 'selected' : '' ?>>Simulador De Combate Áereo</option>
                        <option value="Tabuleiro" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Jogo de Tabuleiro') ? 'selected' : '' ?>>Tabuleiro</option>
                        <option value="XXX" <?= ($steam[$idSteam]['data']['genres'][0]['description'] == 'Para Adultos') ? 'selected' : '' ?>>XXX</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="descricao" name="descricao" class="materialize-textarea validate" required=""><?php echo str_replace("<br>", "\n", $steam[$idSteam]['data']['about_the_game']); ?></textarea>
                    <label for="descricao">Descrição</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="requisitos" name="requisitos" class="materialize-textarea validate" required=""><?php if (isset($steam[$idSteam]['data']['pc_requirements']['minimum'])) {
                                                                                                                        echo $steam[$idSteam]['data']['pc_requirements']['minimum'];
                                                                                                                    }
                                                                                                                    if (isset($steam[$idSteam]['data']['pc_requirements']['recommended'])) {
                                                                                                                        echo $steam[$idSteam]['data']['pc_requirements']['recommended'];
                                                                                                                    }
                                                                                                                    ?></textarea>
                    <label for="requisitos">Requisitos</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="instalacao" name="instalacao" class="materialize-textarea validate" required=""></textarea>
                    <label for="instalacao">Instalação</label>
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