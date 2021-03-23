<?php
session_start();
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SYNC Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imgs/logo.jpg">
</head>
<body>
<div class="main">
        <div class="frmlogin">
            <h1 class="text-center">Faça o Login</h1>
            <br>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="text">Usuário</label><br>
                    <input name="usuario" type="text" class="form-control" autofocus="" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input name="senha" type="password" class="form-control" required>
                </div>
                <br>
                <div>
                    <button class="btn btn-success btn-lg">Entrar</button>
                    <a href="registrar.php" class="btn btn-outline-info btn-lg">Registre-se</a>
                </div>
                <?php
                if(isset($_SESSION["nao_autenticado"])):
                ?>
                <div>
                <div class="error">
                    <h4>Usuário ou senha incorreto(s).</h4>
                </div>
                </div>
                <?php
                unset($_SESSION["nao_autenticado"]);
                endif;
                ?>
            </form>
        </div>
</div>
</body>
</html>
