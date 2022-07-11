<?php 

class Usuario{
    private $pdo;
    public $msgErro="";

    public function conectar($nome, $host, $usuario, $senha){
        global $pdo;
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage(); 
        }
    }

    public function cadastrar($nome, $telefone, $email, $senha){
        global $pdo;
        // verificar se ja existe o email cadastrado
        $sql = $pdo->prepare("SELECT id FROM usuario WHERE email = :e");
        $sql->bindValue(':e', $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return false; //esta cadastrado
        }else{
            $sql = $pdo->prepare('INSERT INTO usuario (
                nome, telefone, email, senha
            )VALUES(
                :n, :t, :e, :s
            )');

            $sql->bindValue(':n',$nome);   
            $sql->bindValue(':t',$telefone);   
            $sql->bindValue(':e',$email);   
            $sql->bindValue(':s',md5($senha));
            $sql->execute();   
            return true;

        }

        // caso nao, cadastrar
    }
    public function logar($email, $senha){        
        global $pdo;

        // verificar se o email e senha estao cadastrados, se sim
        $sql = $pdo->prepare("SELECT id FROM USUARIO WHERE (email = :e AND senha = :s)");
        $sql->bindValue(':e', $email);
        $sql->bindValue(':s', md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0){
            // entrar no sistema
            $dado = $sql->fetch();
            // iniciar sessao
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true;
        }else{
            return false; //nao foi possivel localizar
        }

    }
}