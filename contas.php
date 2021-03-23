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
    
      $consultacontas="SELECT * FROM contas WHERE idUsuario ='$id1'";
      $resultado_contas=mysqli_query($conexao,$consultacontas);
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
                <div class="categoria">
                    <br>
                    <div>
                        <center>
                            <h1>Cadastro de Contas  <i class="fas fa-wallet"></i></h1>
                        </center>
                    </div>
                    <br>
                    <form action="cadastrar_contas.php" method="POST">
                        <div style="display: flex;margin-right: 1vw;">
                            <label style="margin-left: 1%; margin-right: 1%; ; font-size: 20px;" for="categorias">Nome:   </label>
                            <input type="text" id="conta" name="conta" class="form-control"  required>
                            <label style="margin-left: 0,1%; font-size: 20px;" for="categorias">Tipo:  </label>
                            <select style="margin-left: 1%; margin-right: 1%;" name="tipo"  id="tipo" class="form-control" required>
                                <option value="R">Receitas</option>
                                <option value="D">Despesas</option>
                            </select>
                            <label style="margin-left: 1% ; margin-right: 1%; font-size: 20px;" for="categorias">Categoria:  </label>
                            <select style="margin-left: 1%; margin-right: 1%;" name="categorias"  id="categorias" class="form-control" required>
                            <?php while($row_categoria = mysqli_fetch_assoc($resultado_categoria)){
                                $option1 = $row_categoria['nome'];  
                                echo "<option>$option1</option>";
                                }?>
                            </select>
                            <button style="margin-left: 1,5%"  class="btn btn-success btn-sm" >Salvar</button>
                    </form>
                    </div>
                </div>
                <div class="variavel">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Categoria</th>
                            </tr>
                        </thead>
                        <?php while($row_contas = mysqli_fetch_assoc($resultado_contas)){  ?>  
                        <tr>
                            <th>
                            <h5><?php echo $row_contas['nome'] ;?>     </h5> 
                            </th>
                            <th>
                            <h5><?php if($row_contas['tipo'] == 'D'){
                                    echo "Despesa"; 
                                    }else{
                                      echo "Receita"; 
                                    }?></h5>
                            </th>
                            <th>
                            <h5><?php echo $row_contas['categoria'] ;?></h5>
                            </th>
                            <th>
                                <?php echo "<a class='btn btn-danger' style='float:right;' href='deletar_conta.php?idconta=" . $row_contas['idContas'] . "'>Apagar  <i class='far fa-trash-alt'></i></a> "?>
                                <?php echo "<a class='btn btn-info' style='float:right;margin-right:2%;' href='edit_conta.php?idconta=" . $row_contas['idContas'] . "'>Editar  <i class='fas fa-pencil-alt'></i></a> "?>
                            </th>
                        </tr>
                        <?php }?>
                    </table>
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