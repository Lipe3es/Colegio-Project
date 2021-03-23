<?php
session_start();
include("classes/conexao.php");

$usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
	$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
	$id1 = $row_usuario["usuario_id"];

	$id1 = $row_usuario["usuario_id"];
  	$consultacad="SELECT * FROM categoria WHERE idUsuario ='$id1'";
	$resultado_categoria=mysqli_query($conexao,$consultacad);
	$row_categoria = mysqli_fetch_assoc($resultado_categoria);
	
	$idcategoria = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

	$delete="DELETE FROM categoria WHERE idUsuario = '$id1' AND idcategoria = '$idcategoria'; ";
    mysqli_query($conexao,$delete);

$conexao->close();

header("location:categoria.php")

?>