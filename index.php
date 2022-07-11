<?php 
require_once 'classe/usuarios.php';
require_once 'config.php';

$u = new Usuario();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cadastro</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Entrar </h1>
    <form method="POST">
        <input type="email" placeholder="Usuario" name="email"><br>
        <input type="password" placeholder="Senha" name="senha"><br>
        <input type="submit" value="Acessar"><br>
        <a href="cadastrar.php">Ainda não é inscrito? cadastre-se</a>
    </form>
    <?php 
        $u->ifLogar();
    ?>
</body>
</html>