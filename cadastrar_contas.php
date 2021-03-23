<?php
session_start();
include("classes/conexao.php");

$usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
	$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
	$id1 = $row_usuario["usuario_id"];

	$nomecad = mysqli_real_escape_string($conexao, trim($_POST['conta']));
    $tipo = mysqli_real_escape_string($conexao, trim($_POST['tipo']));
    $categoria = mysqli_real_escape_string($conexao, trim($_POST['categorias']));
	$id1 = $row_usuario["usuario_id"];

	$sql = "INSERT INTO contas(nome,tipo,idUsuario,categoria) VALUES ('$nomecad','$tipo','$id1','$categoria')";
	mysqli_query($conexao,$sql);

$conexao->close();

header("location:contas.php");

?>