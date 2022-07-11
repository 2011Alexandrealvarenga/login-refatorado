<?php 
require_once 'classe/usuarios.php';
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
        // verifica se clicou no botao/ENVIOU O VALOR NOME
        if(isset($_POST['email'])){
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
        
            // verificar se nao esta vazio/foi preenchido
            if(!empty($email) && !empty($senha)){
                $u->conectar("test","localhost","root","");
                if($u->msgErro == ""){
                    // se estiver certo envia para a pagina privada
                    if($u->logar($email, $senha)){
                        // echo 'teste123';
                        header("location: areaprivada.php");
                        echo 'apos location';
                    }else{
                        echo 'email e/ou senha incorretos';
                    }
                }else{
                    echo 'erro: '.$u->msgErro;
                }
                
            }else{
                echo 'preencha todos os campos';
            }
        }
    ?>
</body>
</html>