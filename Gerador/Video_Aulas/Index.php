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
    <title>Vídeo Aula</title>
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
                <span class="breadcrumb grey-text lighten-5">Vídeo Aula</span>

            </div>
        </nav>
    </header>

    <main>
        <div Class="row center-align">
            <?php
            if ($idUsuario == 1) {
                $query = "SELECT V.Pk, V.Capa, V.Titulo, U.NomeUsuario, U.Pk As 'PkUsuario' 
                FROM videoaulas V Join usuarios U ON V.FkUsuario = U.Pk 
                Order By U.Pk, V.Titulo";

                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
            ?>
                            <div class="col s6 m4 l3" style="justify-content: center;display: flex;">
                                <div class="card small tooltipped" data-position="top" data-tooltip="<?php echo $linha["Titulo"] ?>" style="width: 250px;height: 200;background-image: url('<?php echo $linha["Capa"] ?>'); background-size: cover; background-repeat: round;  background-color: black">
                                    <?php if ($linha["PkUsuario"] == 1) { ?>
                                        <div class="card-content" style="justify-content: space-around;position: absolute;bottom: 0;width: 100%;display: flex;">
                                            <a href="VideoAula.php?idInserido=<?php echo $linha["Pk"]; ?>" data-position="top" data-tooltip="Ver Bbcode" class="btn-floating halfway-fab waves-effect waves-light green darken-4 tooltipped"><i class="material-icons">visibility</i></a>
                                            <a href="Editar.php?idInserido=<?php echo $linha["Pk"]; ?>" data-position="top" data-tooltip="Editar Descrição" class="btn-floating halfway-fab waves-effect waves-light blue darken-4 tooltipped"><i class="material-icons">mode</i></a>
                                            <a onclick="fnDeletaLancamento(<?php echo $linha['Pk']; ?>)" data-position="top" data-tooltip="Excluir Descrição" class="btn-floating halfway-fab waves-effect waves-light red darken-4 tooltipped"><i class="material-icons btn-excluir-item">delete</i></a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="card-content" style="justify-content: space-around;position: absolute;bottom: 0;width: 100%;display: flex;">
                                            <div class="d-flex align-content-between flex-wrap bntLancamentos">
                                                <a href="VideoAula.php?idInserido=<?php echo $linha["Pk"]; ?>" data-position="top" data-tooltip="Ver Bbcode" class="tooltipped">
                                                    <button style="width: 160px; font-size: 12px;" class="waves-effect waves-light red btn truncate"><?php echo $linha['NomeUsuario']; ?></button>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="valign-wrapper" style="height:70vh;">
                            <div class=" valign" style="width:100%;">
                                <img class="mb-5" style="max-width: 350px" src="../../Public/IMG/no_data.png">
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $query = " SELECT * 
                FROM videoaulas 
                WHERE FkUsuario = $idUsuario";

                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                        ?>
                            <div class="col s6 m4 l3" style="justify-content: center;display: flex;">
                                <div class="card small tooltipped" data-position="top" data-tooltip="<?php echo $linha["Titulo"] ?>" style="width: 250px;height: 200;background-image: url('<?php echo $linha["Capa"] ?>'); background-size: contain; background-repeat: round;  background-color: black">
                                    <div class="card-content" style="justify-content: space-around;position: absolute;bottom: 0;width: 100%;display: flex;">
                                        <a href="VideoAula.php?idInserido=<?php echo $linha["Pk"]; ?>" data-position="top" data-tooltip="Ver Bbcode" class="btn-floating halfway-fab waves-effect waves-light green darken-4 tooltipped"><i class="material-icons">visibility</i></a>
                                        <a href="Editar.php?idInserido=<?php echo $linha["Pk"]; ?>" data-position="top" data-tooltip="Editar Descrição" class="btn-floating halfway-fab waves-effect waves-light blue darken-4 tooltipped"><i class="material-icons">mode</i></a>
                                        <a onclick="fnDeletaLancamento(<?php echo $linha['Pk']; ?>)" data-position="top" data-tooltip="Excluir Descrição" class="btn-floating halfway-fab waves-effect waves-light red darken-4 tooltipped"><i class="material-icons btn-excluir-item">delete</i></a>
                                    </div>
                                </div>
                            </div>
                        <?php   }
                    } else {
                        ?>
                        <div class="valign-wrapper" style="height:70vh;">
                            <div class=" valign" style="width:100%;">
                                <img class="mb-5" style="max-width: 350px" src="../../Public/IMG/no_data.png">
                            </div>
                        </div>
            <?php
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }  ?>
        </div>
        <div class="fixed-action-btn click-to-toggle tooltipped" data-position="left" data-tooltip="Adicionar Descrição" style="bottom: 25px; right: 25px;">
            <a href="./NovaVideoAula.php" class="btn-floating btn-large green accent-4 waves-effect waves-light">
                <i class="large material-icons">add</i>
            </a>
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