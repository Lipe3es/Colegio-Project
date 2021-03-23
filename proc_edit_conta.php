<?php
session_start();
include("classes/conexao.php");
$id2 = $_SESSION['idconta'];
$usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
	$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
	$id1 = $row_usuario["usuario_id"];
	
    $edicon = mysqli_real_escape_string($conexao, trim($_POST['contas']));
	$tipo = mysqli_real_escape_string($conexao, trim($_POST['tipo']));
	$categoria = mysqli_real_escape_string($conexao, trim($_POST['categorias']));
	
	$sql = "UPDATE contas SET nome='$edicon',tipo='$tipo',categoria='$categoria' WHERE idUsuario ='$id1' AND idContas='$id2'";
	mysqli_query($conexao,$sql);

$conexao->close();

header("Location:contas.php");
exit;
?>