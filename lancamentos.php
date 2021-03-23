<?php
    session_start();
    include("classes/conexao.php");
    include("verifica_login.php");
    $usu = $_SESSION["usuario"]; 
    $consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
    $resultado_usuarios=mysqli_query($conexao,$consulta);
    $row_usuario = mysqli_fetch_assoc($resultado_usuarios);
    $id1 = $row_usuario["usuario_id"];

    $consultacontas="SELECT * FROM contas WHERE idUsuario ='$id1'";
    $resultado_contas=mysqli_query($conexao,$consultacontas);

    $consultalan="SELECT * FROM lancamentos WHERE idusuario ='$id1'";
    $resultado_lancamentos=mysqli_query($conexao,$consultalan);
    
    $consultalancamentos="SELECT * FROM lancamentos WHERE idusuario ='$id1'";
    $resultado_lan=mysqli_query($conexao,$consultalancamentos);


    $receita = 0;
    $despesa = 0;
    $saldo = 0;
    while($row_lancamentos = mysqli_fetch_assoc($resultado_lancamentos)){
        if($row_lancamentos['tipo'] == "R"){
            $valor = $row_lancamentos['valor'];
            $receita = $receita + $valor;
        }else{
            $valor = $row_lancamentos['valor'];
            $despesa = $despesa + $valor;
        }
    }
    $saldo = $receita - $despesa;    
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
        <meta charset="utf-8" />
        <title>SYNC 2.0</title>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/main.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
        <link rel="shortcut icon" href="imgs/logo.jpg"/>
        <script src="sweetalert/sweetalert.js"></script>
    </head>
    <body class="fixed-nav" id="page-top">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <a class="navbar-brand" href="Home.php">SYNC</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                    <li class="nav-item" title="Home">
                        <a class="nav-link" href="home.php">
                        <i class="fas fa-house-user"></i>
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
                        <a class="nav-link" href="">
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
            <div style="display: flex;">
                <div class="box">
                    <div class="boxsaldo-semfundo">
                        <div>
                            <h1 style="font-weight: bold; color: white; font-size: 35px;">MOVIMENTAÇÃO  <i class="far fa-money-bill-alt"></i></h1>
                            <hr>
                        </div>
                        <div class="estilo-div-saldo">
                            <div style="">
                                <h1 style="font-size: 25px;color:green">Receita: R$<?php echo $receita?></h1>
                                <hr>
                            </div>
                        </div>
                        <div class="estilo-div-saldo">
                            <div style="">
                                <h1 style="font-size: 25px;color:red">Despesas: R$<?php echo $despesa?></h1>
                                <hr>
                            </div>
                        </div>
                        <div class="estilo-div-saldo">
                            <div style="">
                                <h1 style="font-size: 25px;">Saldo: R$<?php echo $saldo?></h1>
                                <hr>
                            </div>
                        </div>
                        <div class="estilo-div-saldo">
                            <center>
                            <form action="cadastrar_lancamentos.php" method="POST">
                            <h1 style="font-weight: bold; color: white; font-size: 25px;">Contas</h1>
                            <select name="conta" id="conta" class="form-control" style="width: 80%;" required >
                            <?php while($row_contas = mysqli_fetch_assoc($resultado_contas)){
                                $option1 = $row_contas['nome'];  
                                echo "<option>$option1</option>";
                                }?>
                            </select>
                            <center>
                            <hr>
                        </div>
                        <div class="estilo-div-saldo">
                            <h1 style="font-weight: bold; color: white; font-size: 25px;">Valor</h1>
                                <input name="valor" id="valor" type="number" class="lancamento" style="width: 80%; margin-top: 1em;" required />
                            <hr>
                            <button style="margin-top: 1em;" class="btn btn-success btn-lg">Salvar  <i class="fas fa-save"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="lanc" style="margin-top: -532px; margin-left: 500px">
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Conta</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Data</th>
                                </tr>
                            </thead>
                            <?php while($row_lancamentos = mysqli_fetch_assoc($resultado_lan)){  ?>  
                            <tr>
                                <th>
                                <h5><?php echo $row_lancamentos['conta'];?></h5>
                                </th>
                                <th>
                                    <h5>R$ <?php echo $row_lancamentos['valor'];?></h5>
                                </th>
                                <th>
                                <h5><?php echo $row_lancamentos['data'];?></h5>
                                </th>
                                <th>
                                    <?php echo "<a class='btn btn-info' style='float:right;margin-left:2%' href='edit_lancamentos.php?idlancamentos=" . $row_lancamentos['idlancamentos'] . "'>Editar   <i class='fas fa-pencil-alt'></i></a> "?>    
                                    <?php echo "<a class='btn btn-danger' style='float:right;' href='deletar_lancamentos.php?idlancamentos=" . $row_lancamentos['idlancamentos'] . "'>Apagar  <i class='far fa-trash-alt'></i></a> "?>
                                </th>
                            </tr>
                            <?php }?>
                        </table>
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