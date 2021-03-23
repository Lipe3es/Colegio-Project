<?php
session_start();
include("classes/conexao.php");

$usu = $_SESSION["usuario"]; 
$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
$resultado_usuarios=mysqli_query($conexao,$consulta);
$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
$id1 = $row_usuario["usuario_id"];

$valor = mysqli_real_escape_string($conexao, trim($_POST['valor']));
$conta = mysqli_real_escape_string($conexao, trim($_POST['conta']));

$consultacontas="SELECT * FROM contas WHERE idUsuario ='$id1' AND nome='$conta'";
$resultado_contas=mysqli_query($conexao,$consultacontas);
$row_contas = mysqli_fetch_assoc($resultado_contas);

$tipo=$row_contas['tipo'];

	$sql = "INSERT INTO lancamentos(conta,valor,data,tipo,idusuario) VALUES ('$conta','$valor',NOW(),'$tipo','$id1')";
	mysqli_query($conexao,$sql);

$conexao->close();

header("location:lancamentos.php");

?>