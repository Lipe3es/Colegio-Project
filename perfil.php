<?php
	session_start();
	include_once("classes/conexao.php");
	include("verifica_login.php");
	$usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
	$row_usuario = mysqli_fetch_assoc($resultado_usuarios);
	
	$nome1 = $row_usuario["nome"];
	$usuario1 = $row_usuario["usuario"];
	$sexo1 = $row_usuario["sexo"];  
	$email1 = $row_usuario["email"];
	$telefone1 = $row_usuario["telefone"];
	$endereco1 = $row_usuario["endereco"];
	$img1 = $row_usuario["upload"];

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
		<script src="sweetalert/sweetalert.js"></script>
		<script src="https://unpkg.com/imask"></script>
	</head>
	<body class="fixed-nav" id="page-top">
		<nav class="navbar navbar-expand-lg navbar-dark  fixed-top" id="mainNav">
			<a class="navbar-brand" href="Home.php">SYNC</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
					<li class="nav-item" title="Home">
						<a class="nav-link" href="home.php">
						<i class= "fas fa-house-user"></i>
						<span class="nav-link-text">Home</span>
						</a>
					</li>
					<li class="nav-item" title="Categoria">
						<a class="nav-link" href="categoria.php">
						<i class="fas fa-table"></i>
						<span class="nav-link-text">Categoria</span>
						</a>
					</li>
					<li class="nav-item" title="Contas">
						<a class="nav-link" href="contas.php">
						<i class="fas fa-dollar-sign"></i>
						<span class="nav-link-text">Contas</span>
						</a>
					</li>
					<li class="nav-item" title="Lançamentos">
						<a class="nav-link" href="lancamentos.php">
						<i class="far fa-lightbulb"></i>
						<span class="nav-link-text">Lançamentos</span>
						</a>
					</li>
					<li class="nav-item" title="Perfil">
						<a class="nav-link" href="perfil.php">
						<i class="fas fa-user"></i>
						<span class="nav-link-text">Perfil</span>
						</a>
					</li>
					<li class="nav-item" title="Info">
					    <a class="nav-link" href="info.php"> <i class="far fa-question-circle"></i> <span class="nav-link-text">Info</span> </a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="javascript:if(confirm('Tem certeza que deseja sair?')) location.href='logout.php'">
						<i class="fa fa-fw fa-sign-out"></i>
						<span class="nav-link-text">Sair</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="content-wrapper">
		<div class="container-fluid">
		<div class="perfil" >
			<div class="col-xs-12">
			<div class="mainperfil" >
				<br>
				<center>
					<h1>Seus Dados <i class="fas fa-user"></i></h1>
					<img src="<?php  if ($img1){echo 'imgs/'.$img1;} else {echo 'imgs/usuario.png';} ?>" class="imgperfil">

					<form method="post" enctype="multipart/form-data" action="Upload.php">
					<i class="fas fa-camera" type="file"></i>
					  <input name="arquivo" type="file" />
					   <br/>
					   <input type="submit" value="Salvar" />
					</form>

				</center>
				<br>
				<form action="proc_edit_usuario.php" method="POST">
					<div class="mudarperfil">
						<h4 style="font-weight: bold;">Nome: </h4>
						<h4  id="nome1" style="display:block; margin-left: 5px""> <?php echo $nome1?></h4>
						<input name="editnome" type="text" id="editnome" class="" value="<?php echo $nome1?>"style="display:none;margin-right:5%;margin-left:5%;">
						<i class="fas fa-pencil-alt" style="margin-left: 3%; margin-top: 1%" id="bt1" onclick="mostra3('editnome','nome1')"></i>
						<script src="js/jquery-3.5.1.min.js"></script>
						<script>
							$("#bt1").click(function (){
								document.getElementById('editnome').focus();
							});
						</script>
					</div>
					<br>
					<div class="mudarperfil">
						<h4 style="font-weight: bold;">Usuário: </h4>
						<h4  id="usuario1" style="display:block; margin-left: 5px""> <?php echo $usuario1?></h4>
						<input name="editusu" type="text" id="editusu" class="" value="<?php echo $usuario1?>"style="display:none;margin-right:5%;margin-left:5%;">
						<i class="fas fa-pencil-alt" style="margin-left: 3%; margin-top: 1%" id="bt2" onclick="mostra3('editusu','usuario1')"></i>
						<script src="js/jquery-3.5.1.min.js"></script>
						<script>
							$("#bt2").click(function (){
								document.getElementById('editusu').focus();
							});
						</script>
					</div>
					<br>
					<div class="mudarperfil">
						<h4 style="font-weight: bold;">Sexo:</h4>
						<h4 id="sexo1" name="sexo1" style="display:block; margin-left: 5px">
							<?php
								if($sexo1 == "M"){
								    echo "Masculino";
								}else if($sexo1 == "F"){
								    echo "Feminino";
								}else{
									echo "Outro";}?>
						</h4>
						<select name="editsex" type="text" id="editsex" class="" value="<?php echo $sexo1?>"style="display:none;margin-right:5%;margin-left:5%;">
						<option value="M">Masculino</option>
						<option value="F">Feminino</option>
						<option value="O">Outro</option>
						</select>
						<i class="fas fa-pencil-alt" style="margin-left: 3%; margin-top: 1%" id="" onclick="mostra3('editsex','sexo1')"></i>	
					</div>
					<br>
					<div class="mudarperfil">
						<h4 style="font-weight: bold;">Email: </h4>
						<h4  id="email1" style="display:block; margin-left: 5px"> <?php echo $email1?></h4>
						<input name="editemail" type="text" id="editemail" class="" value="<?php echo $email1?>"style="display:none;margin-right:5%;margin-left:5%;">
						<i class="fas fa-pencil-alt" style="margin-left: 3%; margin-top: 1%" id="bt3" onclick="mostra3('editemail','email1')"></i>					
						<script src="js/jquery-3.5.1.min.js"></script>
						<script>
							$("#bt3").click(function (){
								document.getElementById('editemail').focus();
							});
						</script>
					</div>
					<br>
					<div class="mudarperfil">
						<h4 style="font-weight: bold">Telefone: </h4>
						<h4  id="tel1" style="display:block; margin-left: 5px"> <?php echo $telefone1?></h4>
						<input name="edittel" type="text" id="edittel" class="" value="<?php echo $telefone1?>"style="display:none;margin-right:5%;margin-left:5%;">
						<i class="fas fa-pencil-alt" style="margin-left: 3%; margin-top: 1%" id="bt4" onclick="mostra3('edittel','tel1')"></i>
						<script src="js/jquery-3.5.1.min.js"></script>
						<script>
							$("#bt4").click(function (){
								document.getElementById('edittel').focus();
							});
						</script>
					</div>
					<br>
					<div class="mudarperfil">
						<h4 style="font-weight: bold;">Endereço: </h4>
						<h4  id="end1" style="display:block; margin-left: 5px"> <?php echo $endereco1?></h4>
						<input name="editend" type="text" id="editend" class="" value="<?php echo $endereco1?>"style="display:none;margin-right:5%;margin-left:5%;">
						<i class="fas fa-pencil-alt" style="margin-left: 3%; margin-top: 1%" id="bt5" onclick="mostra3('editend','end1')"></i>
						<script src="js/jquery-3.5.1.min.js"></script>
						<script>
							$("#bt5").click(function (){
								document.getElementById('editend').focus();
							});
						</script>												
					</div>
					<br>
					<div style="float:right;margin-right:5%;display:flex;">
						<button class="btn btn-success btn-lg" id="btn_salvar" name="btn_salvar" type="submit" style="display:none;">Salvar Alterações</button>
						<a class="btn btn-danger btn-lg" style="margin-left: 15px" href="javascript:if(confirm('Tem certeza que deseja deletar sua conta?')) location.href='deletar.php'">Deletar conta  <i class='far fa-trash-alt'></i></a>
					</div>
				</form>
			</div>
			</div>
			<div class="col-xs-12">
			<div class="secondperfil">
				<center>
					<br>
					<h1>Redefinir Senha <i class="fas fa-key"></i></h1>
				</center>
				<br>
				<form action="proc_edit_senha.php" method="POST">
					<div class="form-group" style="margin-left: 6em">
						<label class="mudarperfil_2" for="senha: ">Senha</label>
						<div style="display:flex;margin-left:5%;">
							<input  name="senha" style="width:25vw;" type="password" id="senha" class="form-control" required>
						</div>
						<br>
						<label class="mudarperfil_2" for="senha_confirmar">Confirmar senha</label>
						<div style="display:flex;margin-left:5%;">
							<input  name="senha_confirmar" style="width:25vw;" type="password" id="senha_confirmar" class="form-control" required>
						</div>
						<br>
						<div class="alteracoesperfil"style="display: flex;margin-left: 5%">
						
							<button class="btn btn-success btn-lg" onclick="mudar()">Salvar Alterações  <i class="fas fa-save"></i></button>
							<button type="reset" onclick="limpar()" class="btn btn-info btn-lg" style="margin-left: 15px">Limpar  <i class="fas fa-broom"></i></button>
							<div style="font-size: 2rem; margin-left:3%;"><i  class="far fa-eye" type="button" onclick="mostrarsenha()"></i></div>
						
				</form>	
			<script>	
				function mudar(){			
                  		var senha = document.getElementById('senha');
						var senhaConfirma  = document.getElementById('senha_confirmar');	
        			if (senha.Text == "") {
            			alert("Senha não foi alterada!");
        			} else if (senha.Text == senhaConfirma.Text) {
						alert("A senha foi alterada!");
        			} else {
            			alert("As senhas não conferem!");
        			}      								
				}
			</script>
				</div>
				</div>
			</div>
			</div>
			<script>
				function mostrarsenha(){
                        var senha = document.getElementById('senha');
						var senhaConfirma = document.getElementById('senha_confirmar');

                        if(senha.type == "password" || senhaConfirma.type == "password"){
                            senha.type = "text";
							senhaConfirma.type = "text";
                        }else{
                            senha.type = "password";
							senhaConfirma.type = "password";
                        }
                    }
				function limpar() {
				    document.getElementById('nome').value = "";
				    document.getElementById('email').value = "";
				    document.getElementById('endereco').value = "";
				    document.getElementById('telefone').value = "";
				    document.getElementById('senha').value = "";
				    document.getElementById('confirmarsenha').value = "";
				    document.getElementById('sexo').value = "M";
				    }   
			</script>
			<script src="https://kit.fontawesome.com/c1dede4bca.js" crossorigin="anonymous"></script>
			<script src="vendor/jquery/jquery.min.js"></script>
			<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
			<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
			<script src="vendor/chart.js/Chart.min.js"></script>
			<script src="vendor/datatables/jquery.dataTables.js"></script>
			<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
			<script src="js/sb-admin.min.js"></script>
			<script src="js/sb-admin-datatables.min.js"></script>
			<script src="js/sb-admin-charts.min.js"></script>
			<script>
				const btnSalvar = document.getElementById('btn_salvar')
				
				function alternarVisibilidade(elemento) {
					console.log(elemento, elemento.style.display)
					if(elemento.style.display === "none"){
						elemento.style.display = "block";
					}else{
						elemento.style.display = "none";
					}
				}
				function mostra(id){
					alternarVisibilidade(btnSalvar)
					alternarVisibilidade(document.getElementById(id))
				}
				function mostra2(id){
					if(document.getElementById(id).style.display === "block"){
						document.getElementById(id).style.display = "none";
					}else{
						document.getElementById(id).style.display = "block";
					}
				}
				function mostra3(id,id2){
					mostra(id)
					mostra2(id2)
				}
			</script>
			<script>
                    var mask = IMask(
                    document.getElementById('edittel'), {
                        mask: '(00)00000-0000'
                    });
                </script>
		</div>
	</body>
</html>