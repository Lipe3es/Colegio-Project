<?php
    session_start();
    include("classes/conexao.php");
    include("verifica_login.php");
    $usu = $_SESSION["usuario"]; 
    $consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
    $resultado_usuarios=mysqli_query($conexao,$consulta);
    $row_usuario = mysqli_fetch_assoc($resultado_usuarios);
     
    $id1 = $row_usuario["usuario_id"];
    $idconta = filter_input(INPUT_GET,'idconta');
    $_SESSION['idconta'] = $idconta;
    
    $consultacad="SELECT * FROM categoria WHERE idUsuario ='$id1'";
    $resultado_categoria=mysqli_query($conexao,$consultacad);
    
    $consultacontas="SELECT * FROM contas WHERE idUsuario ='$id1' AND idContas ='$idconta'";
    $resultado_contas=mysqli_query($conexao,$consultacontas);
    $row_contas = mysqli_fetch_assoc($resultado_contas);
    $nomeconta = $row_contas['nome'];
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
        <form action="proc_edit_conta.php" method="POST">
            <h1 style="text-align: center; position: center; margin-top: 8%; font-weight: bold; font-size: 60px"> Editar <?php echo $nomeconta ?></h1>
            <div class="edit_categoria" style="display: flex;margin-right: 1vw;">
                <label style="margin-left: 1%; margin-top: 35px; font-size: 25px" for="categoria">Nome:   </label><br>
                <input type="text" id="contas" type="text" name="contas" value="<?php echo $nomeconta ?> "class="txt_edit_categoria" style="margin-top: 36px"autofocus="" required>
                <label style="margin-left: 0,1%; margin-top: 35px;font-size: 25px;" for="categorias">Tipo:  </label>
                <select style="margin-left: 1%; margin-right: 1%; margin-top: 35px;" name="tipo"  id="tipo" class="form-control" required>
                    <option value="R">Receitas</option>
                    <option value="D">Despesas</option>
                </select>
                <label style="margin-left: 1% ; margin-right: 1%; margin-top: 35px;font-size: 25px;" for="categorias">Categoria:  </label>
                <select style="margin-left: 1%; margin-right: 1%; margin-top: 35px;" name="categorias"  id="categorias" class="form-control" required>
                <?php while($row_categoria = mysqli_fetch_assoc($resultado_categoria)){
                    $option1 = $row_categoria['nome'];  
                    echo "<option>$option1</option>";
                    }?>
                </select>
                <button class="btn btn-success btn-lg" style="margin: 1%; margin-left: 3%; margin-top: 2%; height: 50px" type="submit">Salvar</button>
                <a class="btn btn-light btn-lg" style="margin: 1%;margin-top: 2%; height: 50px" href="contas.php">Voltar</a>
            </div>
        </form>
    </body>
</html>