<?php
    session_start();
    include("classes/conexao.php");
    include("verifica_login.php");
    $usu = $_SESSION["usuario"]; 
    $consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
    $resultado_usuarios=mysqli_query($conexao,$consulta);
    $row_usuario = mysqli_fetch_assoc($resultado_usuarios);
    $id1 = $row_usuario["usuario_id"];

    $consultalan="SELECT * FROM lancamentos WHERE idusuario ='$id1'";
    $resultado_lan=mysqli_query($conexao,$consultalan);


    $consultalancamentos="SELECT * FROM lancamentos WHERE idusuario ='$id1'";
    $resultado_lancamentos=mysqli_query($conexao,$consultalancamentos);

    $despesas = array();
    $receitas = array();
    $receita = 0;
    $despesa = 0;
	$saldo = 0;
	$nome1 = $row_usuario["nome"];

    while($row_lancamentos = mysqli_fetch_assoc($resultado_lancamentos)){
      if($row_lancamentos['tipo'] == "R"){
        $valor = $row_lancamentos['valor'];
        $conta = $row_lancamentos['conta'];
        $receitas[] = $conta . " : R$ " . $valor; 
        $receita = $receita + $valor;
      }else{
        $valor = $row_lancamentos['valor'];
        $conta = $row_lancamentos['conta'];
        $despesas[] = $conta . " : R$ " . $valor; 
        $despesa = $despesa + $valor;
      }
  }
    $con = 0;
    $con2 = 0;

    $saldo = $receita - $despesa;    
    $_SESSION['receita'] = $receita;
    $_SESSION['despesa'] = $despesa;
    $_SESSION['saldo'] = $saldo;
    

    ?>
	<html lang="pt-br">

	<head>
		<meta charset="utf-8">
		<title>SYNC 2.0</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
		<link rel="shortcut icon" href="imgs/logo.jpg">
		<script src="sweetalert/sweetalert.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
		google.charts.load("current", {
			packages: ["corechart"]
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Contas', 'Valor'],
				['Receitas', <?php echo $receita?>],
        		['Despesas', <?php echo $despesa?>],
			]);
			var options = {colors: ['#28a745','#dc3545',],
			backgroundColor: '#e8eae9', 
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
		}
		</script>
		 <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
		var data = google.visualization.arrayToDataTable([
         ['Element', 'Density', { role: 'style' }],
         ['Despesas', <?php echo $despesa?>, '#dc3545'],            
         ['Receitas', <?php echo $receita?>, '#28a745'],            
      ]);
        var options = {
          legend: { position: 'none' },
          bar: { groupWidth: "95%" },
		  backgroundColor: '#e8eae9', 
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>
	<?php if($usu == "temoteo"){	
	$existe = 1;
	}?>
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
				<div class="bemvindo">
					<h1>Bem vindo(a): <?php echo $nome1;?>.</h1>
				</div><br>
				<div class="homemid">
					<div class="boxhome">
						<div class="fluflu">						
							<h1>Receitas</h1>
							<hr>
							<ul class="list-group list-group-flush">
								<?php while($con2 < count($receitas)){ ?>
									<li>
										<?php echo $receitas[$con2]; ?>
											<?php $con2++?>
									</li>
									<hr>
									<?php } ?>
							</ul>
							<hr>
							<h1>Receita Total</h1>
							<h2>R$ <?php echo $receita?></h2> </div>
							<br> <a class="btn btn-success btn-lg" href="lancamentos.php"><i class="fas fa-arrow-right"></i>   Adicionar Receitas</a> </div>
							<div class="boxhome">
							<div class="fluflu">
							<h1>Despesas</h1>
							<hr>
							<ul class="list-group list-group-flush">
								<?php while($con < count($despesas)){ ?>
									<li>
										<?php echo $despesas[$con]; ?>
											<?php $con++?>
									</li>
									<hr>
									<?php } ?>
							</ul>
							<hr>
							<div>
								<h1>Despesa Total</h1>
								<h2>R$ <?php echo $despesa?></h2> </ul>
								<br> <a class="btn btn-danger btn-lg" href="lancamentos.php"><i class="fas fa-arrow-right"></i>   Adicionar Despesas</a> </div>
						</div>
						</div>
						<div class="boxsaldo">
						<div class="fluflu">
							<h1>Saldo: R$<?php echo $saldo?></h1> </div>
						<div class="boxgraf">
							<div id="piechart_3d" style="width:100%;height:100%;"></div>
						</div>
						<div class="boxgraf">
							<div id="top_x_div" style="width:100%;height:100%;"></div>
						</div>
						<div><?php if($usu == "temoteo") { echo "
								<audio src='imgs/ba.mp3' autoplay controls>
								Seu Browser não suporta a tag audio
								</audio>";
						}
								?>
						</div>
					</div>
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