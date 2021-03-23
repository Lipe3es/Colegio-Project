<?php
session_start();
include_once("classes/conexao.php");
$usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
	$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
    $id1 = $row_usuario["usuario_id"];
    
	$nome1 = mysqli_real_escape_string($conexao, trim($_POST['editnome']));
	$usu1 = mysqli_real_escape_string($conexao, trim($_POST['editusu']));
	$email1 = mysqli_real_escape_string($conexao, trim($_POST['editemail']));
	$tel1 = mysqli_real_escape_string($conexao, trim($_POST['edittel']));
	$end1 = mysqli_real_escape_string($conexao, trim($_POST['editend']));
	$sexo1 = mysqli_real_escape_string($conexao, trim($_POST['editsex']));

$edit_usuario="UPDATE usuario SET nome='$nome1',usuario='$usu1',telefone='$tel1',email='$email1',sexo='$sexo1',endereco='$end1' WHERE usuario_id='$id1'";
$editar_usuario=mysqli_query($conexao,$edit_usuario);

header("Location:perfil.php")
?>