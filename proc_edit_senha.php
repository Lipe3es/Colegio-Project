<?php
session_start();
include_once("classes/conexao.php");
$usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
	$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
    $id1 = $row_usuario["usuario_id"];
    
	$senha1 = mysqli_real_escape_string($conexao, trim($_POST['senha']));

$result_usuario="UPDATE usuario SET senha='$senha1' WHERE usuario_id='$id1'";
$resultado_usuario=mysqli_query($conexao,$result_usuario);

header("Location:perfil.php")
?>