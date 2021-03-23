<?php
session_start();
include("classes/conexao.php");
$id2 = $_SESSION['idlancamentos'];
$usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
	$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
    $id1 = $row_usuario["usuario_id"];
    
    $valor = mysqli_real_escape_string($conexao, trim($_POST['valor']));
    $conta= mysqli_real_escape_string($conexao, trim($_POST['contas']));

    $consultacontas="SELECT * FROM contas WHERE idUsuario ='$id1' AND nome='$conta'";
    $resultado_contas=mysqli_query($conexao,$consultacontas);
    $row_contas = mysqli_fetch_assoc($resultado_contas);
    $tipo=$row_contas['tipo'];


    
    
	$sql = "UPDATE lancamentos SET valor='$valor',conta='$conta',data = NOW(),tipo='$tipo' WHERE idUsuario ='$id1' AND idlancamentos='$id2'";
	mysqli_query($conexao,$sql);

$conexao->close();

header("Location:lancamentos.php");
exit;
?>