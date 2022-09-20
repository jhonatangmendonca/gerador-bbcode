<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../Public/IMG/favicon.png" type="image/x-icon">
    <meta name="theme-color" content="#345D7E">
    <meta name="apple-mobile-web-app-status-bar-style" content="#345D7E">
    <meta name="msapplication-navbutton-color" content="#345D7E">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../Public/CSS/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../Public/CSS/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="../Public/SCSS/login.css">
    <title>Meu Gerador - Cadastro</title>
</head>

<body>
    <div class="new-form">
        <main>
            <form action="cadastro.php" method="post">
                <div>
                    <img src="../Public/IMG/cadastrar.png">
                    <?php
                    if (isset($_GET['email-duplicado']) && empty($_GET['email-duplicado'])) {
                        echo '<div class="alert alert-danger" role="alert">E-mail já cadastrado!</div>';
                    }
                    if (isset($_GET['usuario-duplicado']) && empty($_GET['usuario-duplicado'])) {
                        echo '<div class="alert alert-danger" role="alert">Usuario já cadastrado!</div>';
                    }
                    if (isset($_GET['senhas-diferentes']) && empty($_GET['senhas-diferentes'])) {
                        echo '<div class="alert alert-danger" role="alert">As senhas não coincidem!</div> ';
                    }
                    ?>
                    <div class="form-group">
                        <input type="text" name="nome" placeholder="Digite o nome de usuário" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Digite o nome de usuário'" required class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" placeholder="Digite seu e-mail" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Digite seu e-mail'" required class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <input type="password" name="senha" maxlength="16" size="16" minlength="8" placeholder="Digite sua senha" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Digite sua senha'" required class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <input type="password" name="senha2" maxlength="16" size="16" minlength="8" placeholder="Digite novamente sua senha" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Digite novamente sua senha'" required class="form-control form-control-sm">
                    </div>

                    <div class="mb-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-sucesso">Salvar</button>
                    </div>
                </div>
                <div class="container mt-5 h4 text-danger center-align text-uppercase"> <span>Atenção: Para sua segurança, não utilize a mesma senha do Amigos-Share ou de qualquer outro tracker!!!</span>
                </div>
            </form>
        </main>
    </div>
</body>

</html>