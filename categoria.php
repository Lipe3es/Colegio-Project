<?php
    session_start();
    include("classes/conexao.php");
    include("verifica_login.php");
    $usu = $_SESSION["usuario"]; 
    $consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
    $resultado_usuarios=mysqli_query($conexao,$consulta);
    $row_usuario = mysqli_fetch_assoc($resultado_usuarios);
     
    $id1 = $row_usuario["usuario_id"];
     
    $consultacad="SELECT * FROM categoria WHERE idUsuario ='$id1'";
    $resultado_categoria=mysqli_query($conexao,$consultacad);
    function alerta($type, $title, $msg,$success){
        echo "<script type='text/javascript'>
        Swal.fire({
          type: '$type',
          title: '$title',
          text: '$msg',
          icon: '$success',
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
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="sweetalert/sweetalert.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="imgs/logo.jpg">
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
            <form action="cadastrar_categoria.php" method="POST">
                <div class="categoria">
                    <br>
                    <div>
                        <center>
                            <h1>Cadastro de Categorias  <i class="fas fa-table"></i></h1>
                        </center>
                    </div>
                    <br>
                    <div style="display: flex;margin-right: 1vw;">
                        <label style="margin-left: 1%" for="categoria">Nome:   </label><br>
                        <input type="text" id="categoria" type="text" name="categoria" class="form-control" autofocus="" required>
                        <button class="btn btn-success btn-lg" style="margin-left:2%;margin-right:2%;">Salvar</button>
                    </div>
                </div>
            </form>
			
            <div class="variavel">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                        </tr>
                    </thead>
					 
                        <?php while($row_categoria = mysqli_fetch_assoc($resultado_categoria)){  ?>   
						                                                                                 
                        <div>
						<form action="proc_edit_categoria.php" method="POST">
							<tr>
							<th> 
                            <h5 style="display:flex;">
                                <h5><span id="span_categoria" name="span_categoria" style="display:block;"><?php echo $row_categoria['nome'];?></span>          
							</h5>
							</th>
							<th>
							<?php echo "<a class='btn btn-danger' style='float:right;' href='deletar_categoria.php?id=" . $row_categoria['idcategoria'] . "'>Apagar  <i class='far fa-trash-alt'></i></a> "?>
                            <?php echo "<a class='btn btn-info' style='float:right;margin-right:2%;' href='edit_categoria.php?nomeid=" . $row_categoria['nome']  . "'>Editar   <i class='fas fa-pencil-alt'></i></a> "?>
							<th> 
							</tr>
						</form>  			
                        </div>
                        <?php } ?>
                </table>
				
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
            </div>
        </div>
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
    </body>
</html>