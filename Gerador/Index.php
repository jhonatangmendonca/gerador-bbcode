<?php
session_start();
require '../Login/check.php';

$usuario = $_SESSION['nome_usuario'];
$idUsuario = $_SESSION['PkUsuario'];

if (($idUsuario != 1) && ($idUsuario != 0)) {
    $ExisteLogin = 0;
    date_default_timezone_set('America/Sao_Paulo');
    date('Y-m-d');

    include "../Config/Config.php";
    $query = "SELECT * FROM login  Where FkUsuario = $idUsuario";
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
        include "../Config/Config.php";
        $query = "UPDATE login SET DataHora = '" . $DataHoraLogin . "'  Where FkUsuario = $idUsuario";
        $resultado = $CONEXAO->query($query);
        if ($resultado) {
        } else {
            die("ERRO Update Login");
        }
    } else {
        $DataHoraLogin = date('Y-m-d H:i:s');
        include "../Config/Config.php";
        $query = "INSERT INTO login(FkUsuario, DataHora) VALUES('" . $idUsuario . "','" . $DataHoraLogin . "');";
        $resultado = $CONEXAO->query($query);
        if ($resultado) {
        } else {
            die("ERRO Insert Login");
        }
    }
}

$contMensagem = 0;

include "../Config/Config.php";
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
    <title>Meu Gerador</title>
    <meta charset="utf-8">
    <meta name="theme-color" content="#000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">
    <meta name="msapplication-navbutton-color" content="#000">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- FAVICON  -->
    <link rel="shortcut icon" href="./../Public/IMG/favicon.png" type="image/x-icon" />
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="./../Public/CSS/Menu.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./../Public/CSS/Classes.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./../Public/SCSS/buttons.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./../Public/SCSS/layout.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./../Public/CSS/spacing.css" media="screen,projection" />
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
                    <img style="margin-top: 15%;" width="100" height="100" src="./../Public/IMG/logo.png" class="responsive-img" />
                </div>
                <span class="white-text name"> <?php echo $usuario; ?></span>
            </div>
        </li>

        <li id="dash_users">
            <a href="./Index.php" style="padding-right: 32px;"><b>Página Inicial</b>
                <i style="float: right; line-height: 64px;" class="material-icons">home</i>
            </a>
        </li>

        <li id="dash_users">
            <a href="./Mensagem/Index.php" style="padding-right: 32px;"><b>Mensagens</b>
                <i style="float: right; line-height: 64px;" class="material-icons">chat</i>
                <span class="red-text text-destaque" style="right: 87px; float: right;line-height: 62px; position: absolute;"><?php echo $contMensagem; ?></span>
            </a>
        </li>

        <?php if ($idUsuario == 1) { ?>
            <li id="dash_users">
                <a href="./Admin/Index.php" style="padding-right: 32px;"><b>Usuários</b>
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
            <a href="./Configuracoes/Index.php" style="padding-right: 32px;"><b>Configurações</b>
                <i style="float: right; line-height: 64px;" class="material-icons">settings</i>
            </a>
        </li>

        <li id="dash_users">
            <a onclick="fnFazLogoutDash();" style="padding-right: 30px;"><b>Sair</b>
                <i style="float: right; line-height: 64px; padding-left: 10px;" class="material-icons">logout</i>
            </a>
        </li>
    </ul>
    <header style="position: fixed; height: 56px !important; z-index: 10; width: 100vw; top:0">
        <nav style="background-color: transparent; box-shadow: none;">
            <a style="margin-left: 15px;" href="#" data-target="slide-out" data-activates="slide-out" class="sidenav-trigger  button-collapse"><i class="mdi-navigation-menu"></i></a>

            <div class="black darken-2">
                <a style="margin-left: 20px;" class="breadcrumb white-text" href="./Index.php">Página Inicial</a>
            </div>
        </nav>
    </header>

    <main>
        <div Class="row center-align">
            <?php
            $QuantidadeLancamentos = 0;

            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM animes Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM animes";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();

                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM animes D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>
            <div class="col s12 m6 l4">
                <a href="Animes/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/Animes.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="ANIMES" class="card-title truncate tooltipped text-destaque black-text text-darken-2">ANIMES</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM aplicativos Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM aplicativos";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();

                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM aplicativos D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>
            <div class="col s12 m6 l4">
                <a href="Aplicativos/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/App.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="APLICATIVOS" class="card-title truncate tooltipped text-destaque black-text text-darken-2">APLICATIVOS</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM filmes Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM filmes";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();

                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM filmes D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>
            <div class="col s12 m6 l4">
                <a href="Filmes/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/Filmes.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="FILMES" class="card-title truncate tooltipped text-destaque black-text text-darken-2">FILMES</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM jogos Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM jogos";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();

                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM jogos D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>

            <div class="col s12 m6 l4">
                <a href="Jogos/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/Jogos.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="JOGOS" class="card-title truncate tooltipped text-destaque black-text text-darken-2">JOGOS</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM livros Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM livros";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();

                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM livros D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>

            <div class="col s12 m6 l4">
                <a href="Livros/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/Livros.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="LIVROS/REVISTAS/HQ's" class="card-title truncate tooltipped text-destaque black-text text-darken-2">LIVROS/REVISTAS/HQ's</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM musicas Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM musicas";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();


                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM musicas D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>

            <div class="col s12 m6 l4">
                <a href="Musicas/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/Musicas.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="MÚSICAS" class="card-title truncate tooltipped text-destaque black-text text-darken-2">MÚSICAS</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col s12 m6 l4">
                <a href="#">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/Series.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="SÉRIES" class="card-title truncate tooltipped text-destaque black-text text-darken-2">SÉRIES</span>
                            </div>
                            <?php
                            if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2">Descrições Geradas: 0</p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2">Ultima Geração: 00/00/0000 - 00:00</p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2">Usuário da Ultima Geração: XXXXX</p>
                            <?php
                            } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2">Descrições Geradas: 0</p>
                            <?php } ?>

                            <!--     <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2">Usuário da Ultima Geração: <?php echo  $NomeUsuario ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?> -->
                        </div>
                    </div>
                </a>
            </div>

            <?php
            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM shows Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM shows";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();

                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM shows D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>

            <div class="col s12 m6 l4">
                <a href="Shows/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/Show.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="SHOWS" class="card-title truncate tooltipped text-destaque black-text text-darken-2">SHOWS</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM tv Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM tv";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();


                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM tv D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>

            <div class="col s12 m6 l4">
                <a href="TV/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/Tv.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="TV" class="card-title truncate tooltipped text-destaque black-text text-darken-2">TV</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM videoaulas Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM videoaulas";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();


                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM videoaulas D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>

            <div class="col s12 m6 l4">
                <a href="Video_Aulas/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/Video_Aula.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="VÍDEO AULAS" class="card-title truncate tooltipped text-destaque black-text text-darken-2">VÍDEO AULAS</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM adultos Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM adultos";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();

                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM adultos D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>
            <div class="col s12 m6 l4">
                <a href="XXX/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/XXX.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="ADULTOS" class="card-title truncate tooltipped text-destaque black-text text-darken-2">ADULTOS</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM diversos Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM diversos";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();

                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM diversos D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>
            <div class="col s12 m6 l4">
                <a href="Diversos/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/Diversos.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="DIVERSOS" class="card-title truncate tooltipped text-destaque black-text text-darken-2">DIVERSOS</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            if ($idUsuario != 1) {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM fotosxxx Where FkUsuario = $idUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            } else {
                $Lancamentos = 0;
                include "../Config/Config.php";
                $query = "SELECT Count(Pk) Pk FROM fotosxxx";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $Lancamentos = $linha["Pk"];
                            $QuantidadeLancamentos = $QuantidadeLancamentos + $Lancamentos;
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();

                $DataGeracao = '';
                include "../Config/Config.php";
                $query = "SELECT D.DataGeracao, U.NomeUsuario  
                FROM fotosxxx D Join usuarios U on (D.Fkusuario = U.Pk)
                Order BY D.Pk DESC
                LIMIT 1";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $DataGeracao  = $linha["DataGeracao"];
                            $NomeUsuario  = $linha["NomeUsuario"];
                        }
                    } else {
                        $DataGeracao  = '01/01/1970 - 01:00';
                        $NomeUsuario  = '';
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
            }
            ?>
            <div class="col s12 m6 l4">
                <a href="Fotos_XXX/Index.php">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../Public/IMG/Categorias/Fotos_XXX.jpg">
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span data-position="top" data-tooltip="FOTOS XXX" class="card-title truncate tooltipped text-destaque black-text text-darken-2">FOTOS XXX</span>
                            </div>
                            <?php if ($idUsuario == 1) { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Data Ultima Geração: <?php echo date("d/m/Y - H:i", strtotime($DataGeracao)) == '01/01/1970 - 01:00' ? '00/00/0000 - 00:00' : date("d/m/Y - H:i", strtotime($DataGeracao)); ?></p>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate tooltipped" data-position="top" data-tooltip="<?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?>">Usuário da Ultima Geração: <?php echo  $NomeUsuario  == '' ? 'Sem Lançamento' :  $NomeUsuario  ?></p>
                            <?php } else { ?>
                                <p class="collection-item right-align text-destaque black-text text-darken-2 truncate">Descrições Geradas: <?php echo $Lancamentos ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </main>
    <footer class="page-footer" style="background-color: transparent; box-shadow: none;">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <p class="grey-text text-lighten-4">No total você gerou <?php echo $QuantidadeLancamentos; ?> descrições.</p>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © <?php echo date("Y"); ?> Meu Gerador
                <a class="grey-text text-lighten-4 right" target="_blank" href="https://www.facebook.com/jhonatangmendonca">by Jhonatan</a>
            </div>
        </div>
    </footer>
</body>

<!-- SCRIPTS -->
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script type="text/javascript" src="./../Public/JS/Script.js"></script>

</html>