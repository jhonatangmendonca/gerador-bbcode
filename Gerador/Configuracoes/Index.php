<?php
session_start();
require './../../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

if (($idUsuario != 1) && ($idUsuario != 0)) {
    $ExisteLogin = 0;
    date_default_timezone_set('America/Sao_Paulo');
    date('Y-m-d');

    $query = "SELECT * FROM login  Where FkUsuario = $idUsuario
                Order By Pk";
    $resultado = $CONEXAO->query($query);
    if ($resultado) {
        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                $ExisteLogin = 1;
            }
        }
    }

    if ($ExisteLogin == 1) {
        $DataHoraLogin = date('Y-m-d H:i:s');
        $query = "UPDATE login SET DataHora = '" . $DataHoraLogin . "'  Where FkUsuario = $idUsuario
                Order By Pk";
        $resultado = $CONEXAO->query($query);
        if ($resultado) {
        } else {
            die("ERRO Update Login");
        }
    } else {
        $DataHoraLogin = date('Y-m-d H:i:s');
        $query = "INSERT INTO login(FkUsuario, DataHora) VALUES('" . $idUsuario . "','" . $DataHoraLogin . "');";
        $resultado = $CONEXAO->query($query);
        if ($resultado) {
        } else {
            die("ERRO Insert Login");
        }
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
    <title>Configurações de Usuário</title>
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
                <span class="breadcrumb grey-text lighten-5">Configurações</span>
            </div>
        </nav>
    </header>

    <main>
        <div class="row">
            <?php
            $query = "SELECT A.*, U.*, T.* FROM usuarios U 
            left Join tags T ON T.FkUsuario = U.Pk 
            left Join assinaturas A ON A.FkUsuario = U.Pk 
            Where U.Pk = $idUsuario";
            $resultado = $CONEXAO->query($query);
            if ($resultado) {
                if ($resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_assoc()) {
                        $usuario = $linha["NomeUsuario"];
                        $senha = base64_decode($linha["Senha"]);
                        $email = $linha["Email"];
                        $PkAssinatura = $linha["Pk"];
                        $Assinatura = $linha["Assinatura"];
                        $Assinatura2 = $linha["Assinatura2"];
                        $UrlLancamentos = $linha["UrlLancamentos"];
                        $TagExtra = $linha["TagExtra"];
                        $TipoFonteTitulo = $linha["TipoFonteTitulo"];
                        $TipoFonteCorpo = $linha["TipoFonteCorpo"];
                        $FonteTitulo = $linha["FonteTitulo"];
                        $FonteSubTitulo = $linha["FonteSubTitulo"];
                        $FonteCorpo = $linha["FonteCorpo"];
                        $alinhamentoTag =  $linha["AlinhamentoTag"];
                        $alinhamentoTexto =  $linha["AlinhamentoTexto"];
                        $alinhamentoAssinatura = $linha["AlinhamentoAssinatura"];
            ?>
                        <ul id="usuarios" class="col s12 m12 l12 xl12 collapsible black-text">
                            <li>
                                <div class="collapsible-header active"><i class="material-icons">person</i>Usuário</div>
                                <div class="collapsible-body mt-5">
                                    <form name="FormConfigUsuario" method="post">
                                        <div class="row">
                                            <div class="input-field col s12 m6 l6 xl6">
                                                <input value="<?php echo $email ?>" id="Email" name="Email" type="text" class="validate" required="">
                                                <label class="active" for="Email">E-Mail</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12 m6 l6 xl6">
                                                <input value="<?php echo $usuario ?>" id="Usuario" name="Usuario" type="text" class="validate">
                                                <label class="active" for="Usuario">Usuário</label>
                                            </div>

                                            <div class="input-field col s12 m6 l6 xl6">
                                                <input value="<?php echo $senha ?>" minlength="8" maxlength="12" id="Senha" name="Senha" type="text" class="validate">
                                                <label class="active" for="Senha">Senha</label>
                                            </div>
                                        </div>

                                        <div class="input-field col s12 m6 l6 xl6">
                                            <button class="waves-effect waves-light green darken-4 btn" type="submit" title="Clique para editar as Tags" id="BntSalvarSenha" onclick="fnProcessaEdicaoConfigUsuario(2);">
                                                Alterar Dados
                                            </button>
                                        </div>

                                        <div class="row"> </div>
                                    </form>
                                </div>
                            </li>
                            <li class="active">
                                <div class="collapsible-header"><i class="material-icons">description</i>Descrição</div>
                                <div class="collapsible-body mt-5">
                                    <form name="FormDetalhamento" method="post" action="ProcessaEdicaoAssinatura.php">
                                        <input type="hidden" id="PkAssinatura" name="PkAssinatura" class="form-control form-control-sm" value="<?php echo $PkAssinatura ?>">

                                        <div class="row">
                                            <div class="input-field col s12 m6 l6 xl6">
                                                <input type="text" id="Assinatura1" name="Assinatura1" placeholder="https://a.imagem.app/axb5m.png" class="validate" value="<?php echo $Assinatura ?>">
                                                <label class="active" for="Assinatura1">Assinatura 1</label>
                                            </div>

                                            <div class="input-field col s12 m6 l6 xl6">
                                                <input type="text" id="Assinatura2" name="Assinatura2" placeholder="https://a.imagem.app/axb5m.png" class="validate" value="<?php echo $Assinatura2 ?>">
                                                <label class="active" for="Assinatura2">Assinatura 2</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12 m6 l6 xl6">
                                                <input type="text" id="UrlLancamentos" name="UrlLancamentos" placeholder="https://cliente.####.club/account-details.php?id=9277&action=enviados" class="validate" value="<?php echo $UrlLancamentos ?>">
                                                <label class="active" for="UrlLancamentos">Url dos Seus Lançamentos</label>
                                            </div>

                                            <div class="input-field col s12 m6 l6 xl6">
                                                <input type="text" id="TagExtra" name="TagExtra" placeholder="https://a.imagem.app/axb5m.png" class="validate" value="<?php echo $TagExtra ?>">
                                                <label class="active" for="TagExtra">Tag Extra no Início da Descrição<small class="text-link"> (Caso não queira usar essa opção deixe o campo em branco)</small></label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12 m4 l3 xl3">
                                                <small>Estilo da Fonte - Título</small>
                                                <select class="browser-default" id="TipoFonteTitulo" name="TipoFonteTitulo" required="">
                                                    <option class="" value="Arial" <?= ($TipoFonteTitulo == 'Arial') ? 'selected' : '' ?>>Arial</option>
                                                    <option value="Arial Black" <?= ($TipoFonteTitulo == 'Arial Black') ? 'selected' : '' ?>>Arial Black</option>
                                                    <option value="Comic Sans MS" <?= ($TipoFonteTitulo == 'Comic Sans MS') ? 'selected' : '' ?>>Comic Sans MS</option>
                                                    <option value="Courier New" <?= ($TipoFonteTitulo == 'Courier New') ? 'selected' : '' ?>>Courier New</option>
                                                    <option value="Georgia" <?= ($TipoFonteTitulo == 'Georgia') ? 'selected' : '' ?>>Georgia</option>
                                                    <option value="Impact" <?= ($TipoFonteTitulo == 'Impact') ? 'selected' : '' ?>>Impact</option>
                                                    <option value="Roboto Light" <?= ($TipoFonteTitulo == 'Roboto Light') ? 'selected' : '' ?>>Roboto Light</option>
                                                    <option value="Sans-Serif" <?= ($TipoFonteTitulo == 'Sans-Serif') ? 'selected' : '' ?>>Sans-Serif</option>
                                                    <option value="Serif" <?= ($TipoFonteTitulo == 'Serif') ? 'selected' : '' ?>>Serif</option>
                                                    <option value="Times New Roman" <?= ($TipoFonteTitulo == 'Times New Roman') ? 'selected' : '' ?>>Times New Roman</option>
                                                    <option value="Trebuchet MS" <?= ($TipoFonteTitulo == 'Trebuchet MS') ? 'selected' : '' ?>>Trebuchet MS</option>
                                                    <option value="Verdana" <?= ($TipoFonteTitulo == 'Verdana') ? 'selected' : '' ?>>Verdana</option>
                                                </select>
                                            </div>

                                            <div class="input-field col s12 m4 l3 xl3">
                                                <small>Estilo da Fonte - Corpo</small>
                                                <select class="browser-default" id="TipoFonteCorpo" name="TipoFonteCorpo" required="">
                                                    <option value="Arial" <?= ($TipoFonteCorpo == 'Arial') ? 'selected' : '' ?>>Arial</option>
                                                    <option value="Arial Black" <?= ($TipoFonteCorpo == 'Arial Black') ? 'selected' : '' ?>>Arial Black</option>
                                                    <option value="Comic Sans MS" <?= ($TipoFonteCorpo == 'Comic Sans MS') ? 'selected' : '' ?>>Comic Sans MS</option>
                                                    <option value="Courier New" <?= ($TipoFonteCorpo == 'Courier New') ? 'selected' : '' ?>>Courier New</option>
                                                    <option value="Georgia" <?= ($TipoFonteCorpo == 'Georgia') ? 'selected' : '' ?>>Georgia</option>
                                                    <option value="Impact" <?= ($TipoFonteCorpo == 'Impact') ? 'selected' : '' ?>>Impact</option>
                                                    <option value="Roboto Light" <?= ($TipoFonteCorpo == 'Roboto Light') ? 'selected' : '' ?>>Roboto Light</option>
                                                    <option value="Sans-Serif" <?= ($TipoFonteCorpo == 'Sans-Serif') ? 'selected' : '' ?>>Sans-Serif</option>
                                                    <option value="Serif" <?= ($TipoFonteCorpo == 'Serif') ? 'selected' : '' ?>>Serif</option>
                                                    <option value="Times New Roman" <?= ($TipoFonteCorpo == 'Times New Roman') ? 'selected' : '' ?>>Times New Roman</option>
                                                    <option value="Trebuchet MS" <?= ($TipoFonteCorpo == 'Trebuchet MS') ? 'selected' : '' ?>>Trebuchet MS</option>
                                                    <option value="Verdana" <?= ($TipoFonteCorpo == 'Verdana') ? 'selected' : '' ?>>Verdana</option>
                                                </select>
                                            </div>

                                            <div class="input-field col s12 m4 l3 xl3">
                                                <small>Tamanho da Fonte - Título</small>
                                                <select class="browser-default" id="FonteTitulo" name="FonteTitulo" required="">
                                                    <option value="1" <?= ($FonteTitulo == 1) ? 'selected' : '' ?>>1</option>
                                                    <option value="2" <?= ($FonteTitulo == 2) ? 'selected' : '' ?>>2</option>
                                                    <option value="3" <?= ($FonteTitulo == 3) ? 'selected' : '' ?>>3</option>
                                                    <option value="4" <?= ($FonteTitulo == 4) ? 'selected' : '' ?>>4</option>
                                                    <option value="5" <?= ($FonteTitulo == 5) ? 'selected' : '' ?>>5</option>
                                                </select>
                                            </div>

                                            <div class="input-field col s12 m4 l3 xl3">
                                                <small>Tamanho da Fonte - SubTítulo</small>
                                                <select class="browser-default" id="FonteSubTitulo" name="FonteSubTitulo" required="">
                                                    <option value="1" <?= ($FonteSubTitulo == 1) ? 'selected' : '' ?>>1</option>
                                                    <option value="2" <?= ($FonteSubTitulo == 2) ? 'selected' : '' ?>>2</option>
                                                    <option value="3" <?= ($FonteSubTitulo == 3) ? 'selected' : '' ?>>3</option>
                                                    <option value="4" <?= ($FonteSubTitulo == 4) ? 'selected' : '' ?>>4</option>
                                                    <option value="5" <?= ($FonteSubTitulo == 5) ? 'selected' : '' ?>>5</option>
                                                </select>
                                            </div>

                                            <div class="input-field col s12 m4 l3 xl3">
                                                <small>Tamanho da Fonte - Corpo</small>
                                                <select class="browser-default" id="FonteCorpo" name="FonteCorpo" required="">
                                                    <option value="1" <?= ($FonteCorpo == 1) ? 'selected' : '' ?>>1</option>
                                                    <option value="2" <?= ($FonteCorpo == 2) ? 'selected' : '' ?>>2</option>
                                                    <option value="3" <?= ($FonteCorpo == 3) ? 'selected' : '' ?>>3</option>
                                                    <option value="4" <?= ($FonteCorpo == 4) ? 'selected' : '' ?>>4</option>
                                                    <option value="5" <?= ($FonteCorpo == 5) ? 'selected' : '' ?>>5</option>
                                                </select>
                                            </div>

                                            <div class="input-field col s12 m4 l3 xl3">
                                                <small>Alinhamento - Tags</small>
                                                <select class="browser-default" id="AlinhamentoTag" name="AlinhamentoTag" required="">
                                                    <option value="left" <?= ($alinhamentoTag == "left") ? 'selected' : '' ?>>Esquerda</option>
                                                    <option value="center" <?= ($alinhamentoTag == "center") ? 'selected' : '' ?>>Centro</option>
                                                    <option value="right" <?= ($alinhamentoTag == "right") ? 'selected' : '' ?>>Direita</option>
                                                </select>
                                            </div>

                                            <div class="input-field col s12 m4 l3 xl3">
                                                <small>Alinhamento - Descricao</small>
                                                <select class="browser-default" id="AlinhamentoTexto" name="AlinhamentoTexto" required="">
                                                    <option value="left" <?= ($alinhamentoTexto == "left") ? 'selected' : '' ?>>Esquerda</option>
                                                    <option value="center" <?= ($alinhamentoTexto == "center") ? 'selected' : '' ?>>Centro</option>
                                                    <option value="right" <?= ($alinhamentoTexto == "right") ? 'selected' : '' ?>>Direita</option>
                                                </select>
                                            </div>

                                            <div class="input-field col s12 m4 l3 xl3">
                                                <small>Alinhamento - Assinatura</small>
                                                <select class="browser-default" id="AlinhamentoAssinatura" name="AlinhamentoAssinatura" required="">
                                                    <option value="left" <?= ($alinhamentoAssinatura == "left") ? 'selected' : '' ?>>Esquerda</option>
                                                    <option value="center" <?= ($alinhamentoAssinatura == "center") ? 'selected' : '' ?>>Centro</option>
                                                    <option value="right" <?= ($alinhamentoAssinatura == "right") ? 'selected' : '' ?>>Direita</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="input-field col s12 m6 l6 xl6">
                                            <button class="waves-effect waves-light orange darken-4 btn" type="submit" title="Clique para editar as Tags" id="BntSalvar">
                                                Salvar
                                            </button>
                                        </div>

                                        <div class="row"> </div>
                                    </form>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">image</i>Tags</div>
                                <div class="collapsible-body">
                                    <div class="card-body">
                                        <form name="FormTags" method="post" action="ProcessaEdicaoTags.php">
                                            <div class="row">
                                                <div class="input-field col s6 m6 l6 xl6 center-align">
                                                    <button class=" waves-effect waves-light blue darken-4 btn" type="button" title="Clique para editar as Tags" id="BtnAbreEdicao" onclick="fnAbreEditarTags();">
                                                        Editar Tags
                                                    </button>
                                                </div>

                                                <div id="BntSalvarTags" class="input-field col s6 m6 l6 xl6 center-align item-hide">
                                                    <button class="waves-effect waves-light red darken-4 btn" type="submit" title="Clique para editar as Tags">
                                                        Salvar Tags
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Capa">Apresenta</span><br><br>
                                                    <img src="<?php echo $linha["Features"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Apresenta" name="Apresenta" class="validate item-hide" value="<?php echo $linha["Features"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Capa">Capa</span><br><br>
                                                    <img src="<?php echo $linha["Cover"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Capa" name="Capa" class="validate item-hide" value="<?php echo $linha["Cover"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Criticas">Críticas</span><br><br>
                                                    <img src="<?php echo $linha["Reviews"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Criticas" name="Criticas" class="validate item-hide" value="<?php echo $linha["Reviews"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Descricao">Descrição</span><br><br>
                                                    <img src="<?php echo $linha["Description"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Descricao" name="Descricao" class="validate item-hide" value="<?php echo $linha["Description"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Elenco">Elenco</span><br><br>
                                                    <img src="<?php echo $linha["Cast"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Elenco" name="Elenco" class="validate item-hide" value="<?php echo $linha["Cast"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Episodios">Episódios</span><br><br>
                                                    <img src="<?php echo $linha["Episodes"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Episodios" name="Episodios" class="validate item-hide" value="<?php echo $linha["Episodes"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Faixas">Faixas</span><br><br>
                                                    <img src="<?php echo $linha["Tracks"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Faixas" name="Faixas" class="validate item-hide" value="<?php echo $linha["Tracks"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="FichaTecnica">Ficha Técnica</span><br><br>
                                                    <img src="<?php echo $linha["Datasheet"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="FichaTecnica" name="FichaTecnica" class="validate item-hide" value="<?php echo $linha["Datasheet"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Informacoes">Informações</span><br><br>
                                                    <img src="<?php echo $linha["Information"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Informacoes" name="Informacoes" class="validate item-hide" value="<?php echo $linha["Information"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Instalacao">Instalação</span><br><br>
                                                    <img src="<?php echo $linha["Installation"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Instalacao" name="Instalacao" class="validate item-hide" value="<?php echo $linha["Installation"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Requisitos">Requisitos</span><br><br>
                                                    <img src="<?php echo $linha["Requirements"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Requisitos" name="Requisitos" class="validate item-hide" value="<?php echo $linha["Requirements"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="RequisitosMinimos">Requisitos Mínimos</span><br><br>
                                                    <img src="<?php echo $linha["RequirementsMinimum"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="RequisitosMinimos" name="RequisitosMinimos" class="validate item-hide" value="<?php echo $linha["RequirementsMinimum"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="RequisitosRecomendados">Requisitos Recomendados</span><br><br>
                                                    <img src="<?php echo $linha["RequirementsRecommended"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="RequisitosRecomendados" name="RequisitosRecomendados" class="validate item-hide" value="<?php echo $linha["RequirementsRecommended"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Screens">Screens</span><br><br>
                                                    <img src="<?php echo $linha["Screens"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Screens" name="Screens" class="validate item-hide" value="<?php echo $linha["Screens"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Sinopse">Sinopse</span><br><br>
                                                    <img src="<?php echo $linha["Synopsis"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Sinopse" name="Sinopse" class="validate item-hide" value="<?php echo $linha["Synopsis"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Trailer">Trailer</span><br><br>
                                                    <img src="<?php echo $linha["TrailerTag"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Trailer" name="Trailer" class="validate item-hide" value="<?php echo $linha["TrailerTag"] ?>">
                                                </div>

                                                <div class="input-field col s12 m12 l6 xl6 center-align">
                                                    <span class="mt-4 active text-destaque" for="Agradecimento">Agradecimento</span><br><br>
                                                    <img src="<?php echo $linha["Acknowledgment"] ?>" style="max-width: 350px; margin-bottom: 20px;">
                                                    <input type="text" id="Agradecimento" name="Agradecimento" class="validate item-hide" value="<?php echo $linha["Acknowledgment"] ?>">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
            <?php
                    }
                }
            } else {
                die("Erro!");
            }
            $CONEXAO->close();
            ?>
        </div>
    </main>
</body>

<!-- SCRIPTS -->
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script type="text/javascript" src="./../../Public/JS/Script.js"></script>
<script type="text/javascript" src="Script.js"></script>

</html>