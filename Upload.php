<?php

session_start();
include("classes/conexao.php");

    $usu = $_SESSION["usuario"]; 
	$consulta="SELECT * FROM usuario WHERE usuario ='$usu'";
	$resultado_usuarios=mysqli_query($conexao,$consulta);
    $row_usuario = mysqli_fetch_assoc($resultado_usuarios);
    
    $id1 = $row_usuario["usuario_id"];     

if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
    echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'arquivo' ][ 'name' ] . '</strong><br />';
    echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'arquivo' ][ 'type' ] . ' </strong ><br />';
    echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'arquivo' ][ 'tmp_name' ] . '</strong><br />';
    echo 'Seu tamanho é: <strong>' . $_FILES[ 'arquivo' ][ 'size' ] . '</strong> Bytes<br /><br />';
 
    $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
    $nome = $_FILES[ 'arquivo' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = 'imgs/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
            echo ' < img src = "' . $destino . '" />';
            $imgbd = mysqli_real_escape_string($conexao,$novoNome);
            $sql = "UPDATE usuario SET upload = '$imgbd' WHERE usuario_id = '$id1' ";

            mysqli_query($conexao,$sql);

            var_dump(mysqli_query($conexao,$sql));

            $conexao->close();

            header("location:perfil.php");
        }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
    }
    else
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
}
else
    echo 'Você não enviou nenhum arquivo!';


?>