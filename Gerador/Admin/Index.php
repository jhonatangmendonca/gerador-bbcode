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
    <title>Usuários</title>
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

        <ul class="collapsible" data-collapsible="accordion">
            <li id="dash_brands">
                <div id="dash_brands_header" class="collapsible-header"><b>Configurações</b>
                    <i style="float: right;" class="material-icons">keyboard_arrow_down</i>
                </div>
                <div id="dash_brands_body" class="collapsible-body">
                    <ul>
                        <li id="brands_brand">
                            <a style="text-decoration: none;" href="./Configuracoes/Index.php">Conf. de Usuário</a>
                        </li>

                        <li id="brands_brand">
                            <a style="text-decoration: none;" href="./Configuracao/Index.php">Conf. de Descrição</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

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
                <span class="breadcrumb grey-text lighten-5">Usuários</span>
            </div>
        </nav>
    </header>

    <main>
        <div class="row">
            <?php
            $query = "SELECT U.Pk, U.NomeUsuario, L.DataHora, U.Senha, U.Email FROM usuarios U Left Join login L ON U.Pk = L.FkUsuario Where U.Pk != 1 And U.Pk != 4 Order By L.DataHora Desc";
            $resultado = $CONEXAO->query($query);
            if ($resultado) {
                if ($resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_assoc()) {
            ?>
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <div class="card-content">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span data-position="top" data-tooltip="<?php echo $linha["NomeUsuario"]; ?>" class="card-title indigo-text text-darken-2 truncate tooltipped"><?php echo $linha["NomeUsuario"]; ?></span>
                                        <!-- <i class="activator material-icons right" style="cursor: pointer;">more_vert</i> -->
                                    </div>
                                    <a class="activator btn-floating halfway-fab waves-effect waves-light blue darken-4"><i class="material-icons btn-ver-detalhes">remove_red_eye</i></a>

                                    <p class="collection-item right-align indigo-text text-darken-2">Acesso: <?php echo $linha["DataHora"] <> '' ? date("d/m/Y - H:i", strtotime($linha["DataHora"])) : '00/00/0000 - 00:00'  ?></p>
                                </div>

                                <div class=" card-reveal">
                                    <span class="card-title indigo-text text-darken-2"><i class="material-icons right">close</i></span>
                                    <p class="indigo-text text-darken-2"><?php echo $linha["Email"]; ?></p>
                                    <p class="indigo-text text-darken-2"><?php echo base64_decode($linha["Senha"]) ?></p>

                                </div>
                            </div>
                        </div>
            <?php }
                } else {
                    echo "<div class='col-12 h5 center-align text-destaque'>Sem Usuários Cadastrados!</div>";
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

</html>