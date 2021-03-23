<?php
session_start();
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
    <meta charset="UTF-8">
    <title>Registre-se</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imgs/logo.jpg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <script src="sweetalert/sweetalert.js"></script>
    <script src="https://unpkg.com/imask"></script>
</head>
<body>
<div class="main">
        <div class="frmlogin">
             <h1 class="text-center" style="margin-top: -160px;">Registre-se</h1>
             <form action="cadastrar.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome</label><br>
                    <input style="width:35vw"; name="nome" type="text" id="nome"  class="form-control"  required>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuário</label><br>
                    <input name="usuario" type="text" id="usuario" class="form-control"  required>
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo</label><br>
                    <select  name="sexo" id="sexo" class="form-control" placeholder="Escolhe uma opção" required>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outros</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="email">E-mail</label><br>
                <input name="email" type="email" id="email" class="form-control" placeholder="email@email.com" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label><br>
                    <input name="endereco" type="text" id="endereco" class="form-control" placeholder="Rua Silva" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label><br>
                    <input name="telefone" type="text" id="telefone" class="form-control" placeholder="(00)99999-9999" required>
                </div>
                <div class="form-group">
                <label for="senha">Senha</label>
                    <div style="display:flex;"><input  name="senha" type="password" id="senha" class="form-control" required>
                        <div style="font-size: 2rem; margin-left: 10px;"><i  class="far fa-eye" type="button" onclick="mostrarsenha()"></i></div>
                </div>
                <br>
                <div>
                    <button class="btn btn-success btn-lg"> <a>Salvar</a></button>
                    <a href="index.php" class="btn btn-outline-info btn-lg">Voltar</a>
                </div>
                </form>
                <br>
                <?php
                if(isset($_SESSION['status_cadastrado'])):
                alerta("success", "Oba!", "Usuário cadastrado com sucesso!","success");
                endif;
                unset($_SESSION['status_cadastrado']);
                ?>
                <?php
                if(isset($_SESSION['usuario_existe'])):
                alerta("error", "Ops!", "Usuário já cadastrado!"); 
                endif;
                unset($_SESSION['usuario_existe']);
                ?>
                <script>
                    function mostrarsenha(){
                        var senha = document.getElementById("senha");
                        if(senha.type == "password"){
                            senha.type = "text";
                        }else{
                            senha.type = "password";
                        }
                    }
                </script>
                <script>
                    var mask = IMask(
                    document.getElementById('telefone'), {
                        mask: '(00)00000-0000'
                    });
                </script>
        </div>
</div>
</body>
</html>
