<?php 
require_once 'classe/usuarios.php';
require_once 'config.php';
$u = new Usuario;

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
    <h1>Cadastrar </h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="nome completo"><br>
        <input type="text" name="telefone" placeholder="telefone"><br>
        <input type="email" name="email" placeholder="email"><br>
        <input type="password" name="senha" placeholder="Senha"><br>
        <input type="password" name="confSenha" placeholder="confirmar senha"><br>
        <input type="submit" value="cadastrar">

    </form>
    <?php 

        $u->doCadastrar();

    ?>
</body>
</html>