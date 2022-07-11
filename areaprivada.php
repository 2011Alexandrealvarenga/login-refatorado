<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("location: index.php");
    exit;
}
?>
seja bem vindo
<br>
<a href="sair.php">sair</a>