<?php
session_start();
include("classes/conexao.php");
$usu_codigo=($_SESSION["usuario"]);
$sql_code="DELETE FROM usuario WHERE usuario = '$usu_codigo'";
$sql_query=$conexao->query($sql_code) or die($conexao->error);
 if($sql_query){
    header("location:index.php");
 }else{
     echo "Não foi possível deletar seu usuário!";
    header("location:index.php");
 }
?>