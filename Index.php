<?php

session_start();
require_once 'Login/functions.php';

if (!isLoggedIn()) {
    $Redireciona = 'Login/Index.php';
} else {
    $Redireciona = 'Gerador/Index.php';
}
header("refresh: 0;$Redireciona");
?>

</html>