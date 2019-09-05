<!DOCTYPE html>
	<?php
		session_start();
		if ( !isset($_SESSION["codigo"])){
			header("location:index.php?erro=2");
		}
		include "includes/funcoes.php";
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
		<div id="fieldset" class="clear">
		<form method="post" action="">
			<fieldset>
				<p>
				<input type = "text" name="nome" id="nome" placeholder = "Quem você está procurando?">
				</p>
				<p>
				<input type="submit" value="Procurar"/>
				</p>
			</fieldset>
			</form>
		</div>
		<?php
		//código para procurar usuários aqui
		function verificar_se_seguidor($con, $codigo_usuario, $codigo_usuario_seguindo){
			//a consulta abaixo verifica se os dois usuario ká são amigos
			$sql = "SELECT * FROM usuarios_seguidores
			where id_usuario = '$codigo_usuario'
			and seguindo_id_usuario = $codigo_usuario_seguindo";
			$resultado = mysqli_query($con, $sql);
			$usuario_pesquisado = mysqli_fetch_assoc($resultado);
			//a linha abaixo verifica se retornou algo do banco de dados
			if(isset($usuario_pesquisado['id_usuario_seguidor'])){
				print"<span>
						<a href='procurar_pessoas_deixar_seguir.php?codigo=$codigo_usuario_seguindo'>Deixar de Seguir</a>
						</span>";
			}
			else{
				print"<span>
						<a href='procurar_pessoas_seguir.php?codigo=$codigo_usuario_seguindo'>Seguir</a>
						</span>";
			}
		}
		include_once "conexao.php";
		if( isset($_POST['nome']) ){
			$nome_usuario = $_POST['nome'];
			$codigo_usuario = $_SESSION['codigo'];
			$con = conecta_mysql();
		#procurando todos os usuários
			$sql = "SELECT codigo, nome FROM usuarios where nome LIKE '%$nome_usuario%'
			AND codigo <> $codigo_usuario";
			$resultado = mysqli_query($con,$sql);
			if($resultado){
				$usuarios = array();
				while($linha = mysqli_fetch_assoc($resultado) ){
					$usuarios[] = $linha;
				}
					foreach($usuarios as $usuario){
						print "<div id='postagem' class='clear'>";
							print "<span class='negrito-maior'>".$usuario['nome']."</span>";
							$codigo_usuario_seguindo = $usuario['codigo'];
							verificar_se_seguidor($con, $codigo_usuario, $codigo_usuario_seguindo);
						print "</div>";
					}
			}//fechando o if
		}//fechando o isset
		?>
	</div> <!-- Div Área principal -->
</body>
</html>
