<?php
    session_start();
    include("classes/conexao.php");
    include("verifica_login.php");
    $usu = $_SESSION["usuario"]; 
    $consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
    $resultado_usuarios=mysqli_query($conexao,$consulta);
    $row_usuario = mysqli_fetch_assoc($resultado_usuarios);
     
    $id1 = $row_usuario["usuario_id"];
    $banana = filter_input(INPUT_GET,'nomeid');
    
    $consultacad="SELECT * FROM categoria WHERE idUsuario ='$id1' AND nome='$banana'";
	$resultado_categoria=mysqli_query($conexao,$consultacad);
    $row_categoria = mysqli_fetch_assoc($resultado_categoria);
    $id2 = $row_categoria["idcategoria"];
    $_SESSION['idcad'] = $id2;

    ?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Editar Categoria</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="imgs/logo.jpg">
    </head>
    <body>
    <form action="proc_edit_categoria.php" method="POST">
        <h1 style="text-align: center; position: center; margin-top: 8%; font-weight: bold; font-size: 60px"> Editar <?php echo $banana ?></h1>
         <div class="edit_categoria" style="display: flex;margin-right: 1vw;">
                        <label style="margin-left: 1%; margin-top: 35px; font-size: 25px" for="categoria">Nome:   </label><br>
                        <input type="text" id="categoria" type="text" name="categoria" value="<?php echo $banana ?> "class="txt_edit_categoria" style="margin-top: 36px"autofocus="" required>
                        <button class="btn btn-success btn-lg" style="margin: 1%; margin-left: 3%; margin-top: 2%; height: 50px" type="submit">Salvar</button>
                        <a class="btn btn-light btn-lg" style="margin: 1%;margin-top: 2%; height: 50px" href="categoria.php">Voltar</a>
        </div>
    </form>
    </body>
</html>