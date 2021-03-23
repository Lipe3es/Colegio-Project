<?php
session_start();
include("classes/conexao.php");

$usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
	$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
	$id1 = $row_usuario["usuario_id"];

	$nomecad = mysqli_real_escape_string($conexao, trim($_POST['categoria']));


	$id1 = $row_usuario["usuario_id"];
  	$consultacad="SELECT * FROM categoria WHERE idUsuario ='$id1'";
	$resultado_categoria=mysqli_query($conexao,$consultacad);
	$row_categoria = mysqli_fetch_assoc($resultado_categoria);
	
	$sql = "INSERT INTO categoria(nome,idUsuario) VALUES ('$nomecad','$id1')";
	mysqli_query($conexao,$sql);

$conexao->close();

header("location:categoria.php");
exit;
?>