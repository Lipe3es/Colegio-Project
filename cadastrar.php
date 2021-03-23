<?php
session_start();
include("classes/conexao.php");

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
$telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
$sexo = mysqli_real_escape_string($conexao, trim($_POST['sexo']));
$senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));


$sql = "select count(*) as total from usuario where usuario = '$usuario'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
	$_SESSION['usuario_existe'] = true;
	header('Location: registrar.php');
	exit;
}

$sql = "INSERT INTO usuario (nome,usuario,senha,telefone,email,sexo,endereco) VALUES ('$nome','$usuario','$senha','$telefone','$email','$sexo','$endereco')";
mysqli_query($conexao,$sql);

if(mysqli_insert_id($conexao)){
	$_SESSION['status_cadastrado'] = true;
	header('Location: registrar.php');
}else{
	header('Location: registrar.php');
}

$conexao->close();


exit;
?>