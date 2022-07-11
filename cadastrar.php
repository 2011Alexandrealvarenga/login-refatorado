<?php 
require_once 'classe/usuarios.php';
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
    // verifica se clicou no botao/ENVIOU O VALOR NOME
    if(isset($_POST['nome'])){
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha = addslashes($_POST['confSenha']);
    
        // verificar se nao esta vazio/foi preenchido
        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha)){
            // conectar o banco
            $u->conectar("test","localhost","root","");
            if($u->msgErro == ""){
                if($senha == $confirmarSenha){
                    if($u->cadastrar($nome, $telefone, $email, $senha)){
                        echo 'cadastrado com sucesso, acesse para entrar <br>';
                        ?>
                        <a href="index.php">logar</a>
                        <?php
                    }else{
                        echo 'email ja cadastrado<br>';
                        ?>
                        <a href="index.php">logar</a>
                        <?php
                    }                    
                }else{
                    echo "senha e confirmar senha não correspondem";
                }
            }else{
                echo "erro: ".$U->msgErro;
            }
        }else{
            echo 'Preencha todos os campos';
        }
    };


    ?>
</body>
</html>