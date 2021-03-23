<?php
session_start();
include("classes/conexao.php");
$id2 = $_SESSION['idcad'];
$usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
	$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
	$id1 = $row_usuario["usuario_id"];
	
    $edicad = mysqli_real_escape_string($conexao, trim($_POST['categoria']));
	
	$sql = "UPDATE categoria SET nome='$edicad' WHERE idUsuario ='$id1' AND idcategoria='$id2'";
	mysqli_query($conexao,$sql);

$conexao->close();

header("Location:categoria.php");
exit;
?>