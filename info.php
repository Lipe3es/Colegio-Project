<?php
	session_start();
	include_once("classes/conexao.php");
	include("verifica_login.php");
	$usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
	$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
	
    $nome1 = $row_usuario["nome"];
    
	function alerta($type, $title, $msg){
		echo "<script type='text/javascript'>
		Swal.fire({
		  type: '$type',
		  title: '$title',
		  text: '$msg',
		  showConfirmButton: false,
		  timer: 1500
		});
		</script>";
	}
	?>

<html lang="pt-br">
<head>
<meta charset="utf-8">
		<title>SYNC 2.0</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/main.css">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
		<link rel="shortcut icon" href="imgs/logo.jpg">
</head>
<body class="fixed-nav" id="page-top">
		<nav class="navbar navbar-expand-lg navbar-dark  fixed-top" id="mainNav"> <a class="navbar-brand" href="Home.php">SYNC</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
					<li class="nav-item" title="Home">
						<a class="nav-link" href="home.php"> <i class="fas fa-house-user"></i> <span class="nav-link-text">Home</span> </a>
					</li>
					<li class="nav-item" title="Categoria">
						<a class="nav-link" href="categoria.php"> <i class="fas fa-table"></i> <span class="nav-link-text">Categoria</span> </a>
					</li>
					<li class="nav-item" title="Contas">
						<a class="nav-link" href="contas.php"> <i class="fas fa-dollar-sign"></i> <span class="nav-link-text">Contas</span> </a>
					</li>
					<li class="nav-item" title="Lançamentos">
						<a class="nav-link" href="lancamentos.php"> <i class="far fa-lightbulb"></i> <span class="nav-link-text">Lançamentos</span> </a>
					</li>
					<li class="nav-item" title="Perfil">
						<a class="nav-link" href="perfil.php"> <i class="fas fa-user"></i> <span class="nav-link-text">Perfil</span> </a>
					</li>					
					<li class="nav-item" title="Info">
					    <a class="nav-link" href="info.php"> <i class="far fa-question-circle"></i> <span class="nav-link-text">Info</span> </a>
					</li>					
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="javascript:if(confirm('Tem certeza que deseja sair?')) location.href='logout.php'"> <i class="fa fa-fw fa-sign-out"></i> <span class="nav-link-text">Sair</span> </a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="homemid">
					<div class="boxe" style="margin-left: 200px;">
						<div class="fluflu">						
						<h1 style="font-weight: bolder;">Desenvolvedores <i class="far fa-file-code"></i></h1>
							<hr>
							<hr>
							<div class="dev">
							<ul class="list-group list-group-flush" style="margin-left: 1em;">
								<li>Arthur Aráujo - 04</li>
								<li>Diego Drumond - 10</li>
								<li>Felipe Martins - 13</li>
								<li>Guilherme Brito - 21</li>
								<li>João Vitor Temoteo - 29</li>
								<li>Luiz Henrique - 36</li>
							<ul>
								</div>	
							</div>
							<br></div>
							<div class="boxe" style="margin-left: 400px;">
							<div class="fluflu">
							<h1 style="font-weight: bolder;">Professores <i class="fas fa-chalkboard-teacher"></i></h1>
							<hr><hr>
							<div class="dev">
							<ul class="list-group list-group-flush"  style="margin-left: 1em;">
								<li>Paulo Henrique - Artes</li>
								<li>Farlen Geraldo - BD/DEV</li>
								<li>Thiago Alexandre - TEP</li>
							<ul>
								</div>	

						</div>
					</div>
				</div>
			</div>
</body>
</html>