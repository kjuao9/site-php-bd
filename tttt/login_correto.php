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
		<div id="div-pessoal" class="borda-arredondada">
			<span class="negrito-maior"><?php print$_SESSION["nome"]?></span>
			<br/>
			<span class="italico"><?php print$_SESSION["email"]?></span> <br/><br/>
			<hr/><br/>
				<table>
					<tr>
						<td width="100px" >TWEETS <br/><?php
						$mensagens = listar_mensagens($con, $id_usuario);
						print count($mensagens);
						
						 ?>
						 </td>
						<td width="100px">SEGUIDORES <br/><?php $sql = "SELECT id_usuario from usuarios_seguidores
						where id_usuario=$id_usuario";
						$result = mysqli_query($con, $sql);
						if($result){
							$seg = array();
							while($abc = mysqli_fetch_assoc($result)){
								$seg[] = $abc;
							}
							print count($seg);
						}
						 ?></td>
					</tr>
				</table>
		</div>
		<div id="div-postagem" class="borda-arredondada">
			<form method="post" action="">
				<p class="centralizar">
					<textarea id="mensagem" name="mensagem" required maxlength="140" cols="50" rows="4"
					placeholder="<?php print "O que você vai postar hoje?"?>"></textarea>
				</p>
				<input type="submit" value="Postar"/>
				<input type="reset" value="Cancelar"/>
			</form>
			<?php
	if(isset($_POST["mensagem"])){
		$mensagem = $_POST["mensagem"];
			if(strlen($mensagem) > 1){
	
					if($con){
	                                                                        
					$sql = "INSERT INTO postagem (texto_postagem, id_usuario)
					values('$mensagem', '$id_usuario')";
					if(mysqli_query($con, $sql)){
						print "<script> alert('Postagem Realizada!') </script>";
					}
					else{
						print "<script> alert('Erro ao postar a mensagem')</script>";
					}
				}
			}
		}
			?>
		</div>
		<div id="div-procurar-pessoa" class="borda-arredondada">
			<br/>
			<a href="procurar_pessoas.php">Procurar pessoas</a>
			<br/><br/>
		</div>
		<div id="postagem" class="clear">
			<?php print"Hoje é ".date("d/M/Y").", horário atual: ".date("H:i");
$mensagens = listar_mensagens3($con, $id_usuario);
foreach ($mensagens as $mensagem) {
	print "<div id='postagem' class='clear'>";
	print "<span class='italico'>".$mensagem["data_formatada"]."</span>";
	print "<br><span class='negrito-maior'>".$mensagem['nome']."</span>";
	print "<br/>".$mensagem["texto_postagem"];
	print "</div>";
	}
			
			?>
		</div>
	</div> <!--  Div Área principal  -->
</body>
</html>