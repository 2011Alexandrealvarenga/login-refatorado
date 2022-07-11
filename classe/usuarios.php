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
    public function ifLogar(){
        // verifica se clicou no botao/ENVIOU O VALOR NOME
        if(isset($_POST['email'])){
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
        
            // verificar se nao esta vazio/foi preenchido
            if(!empty($email) && !empty($senha)){
                if($this->msgErro == ""){
                    // se estiver certo envia para a pagina privada
                    if($this->logar($email, $senha)){
                        // echo 'teste123';
                        header("location: areaprivada.php");
                    }else{
                        echo 'email e/ou senha incorretos';
                    }
                }else{
                    echo 'erro: '.$this->msgErro;
                }
                
            }else{
                echo 'preencha todos os campos';
            }
        }
    }
    public function doCadastrar(){
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
                $this->conectar("test","localhost","root","");
                if($this->msgErro == ""){
                    if($senha == $confirmarSenha){
                        if($this->cadastrar($nome, $telefone, $email, $senha)){
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
                    echo "erro: ".$this->msgErro;
                }
            }else{
                echo 'Preencha todos os campos';
            }
        };
    }
}