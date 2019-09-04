<!DOCTYPE html>
	<?php
		session_start();
		if ( !isset($_SESSION["codigo"]) ){
			header("location:index.php?erro=2");
		}
		$id_usuario = $_SESSION["codigo"];
		include_once "conexao.php";
		include_once "includes/funcoes.php";
		$con = conecta_mysql();
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
			<?php print"Hoje é ".date("d/M/Y").", horário atual: ".date("H:i")?>
		</div>
		<?php
		
		//código da consulta aqui//
		
		$mensagens = listar_mensagens($con, $id_usuario);
		foreach ($mensagens as $mensagem) {
			print "<div id='postagem' class='clear'>";
			print "<span class='italico'>".$mensagem["data_formatada"]."</span>";
			print "<br><span class='negrito-maior'>".$_SESSION['nome']."</span>";
			print "<br/>".$mensagem["texto_postagem"];
			print "</div>";
			}
		
		?>
	</div> <!--  Div Área principal  -->
</body>
</html>