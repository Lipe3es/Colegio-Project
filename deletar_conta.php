<?php
session_start();
include("classes/conexao.php");

$usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
	$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
	$id1 = $row_usuario["usuario_id"];

	$idconta = filter_input(INPUT_GET,'idconta',FILTER_SANITIZE_NUMBER_INT);

	$delete="DELETE FROM contas WHERE idUsuario = '$id1' AND idContas = '$idconta';";
    mysqli_query($conexao,$delete);

$conexao->close();

header("location:contas.php")

?>