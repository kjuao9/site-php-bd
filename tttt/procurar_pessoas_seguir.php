<!DOCTYPE html>
	<?php
		session_start();
		if ( !isset($_SESSION["codigo"]) ){
			header("location:index.php?erro=2");
		}
	?>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta name="author" content="Professor"/>
	<meta name="description" content="Descrição"/>
	<meta name="keywords" content="Palavras, chaves"/>
	<title>PHP com BD</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
	<?php include "includes/menu-login.php" ?>
	<div id="div-area-principal">
		<div id="postagem" class="clear">
			<?php
			//Código para seguir a pessoa aqui
			if ( isset($_GET['codigo'])){
				$id_usuario = $_SESSION['codigo'];
				$id_usuario_seguir = $_GET['codigo'];
				include_once "conexao.php";
				$conexao = conecta_mysql();
				$sql = "INSERT INTO usuarios_seguidores (id_usuario, seguindo_id_usuario)
				values ('$id_usuario','$id_usuario_seguir')";
				$resultado = mysqli_query($conexao,$sql);
				if($resultado){
					print "Agora você está seguindo este usuário";
					print "<pre><a href='procurar_pessoas.php'>Clique aqui para voltar</a>";
				}
				else{
					print "Problema ao seguir usuário, entre em contato com o administrador";
				}
			}
			?>
		</div>

	</div> <!-- Div Área principal -->
</body>
</html>
