 <!DOCTYPE html> 
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta name="author" content="Rômulo"/>
	<meta name="description" content="Descrição"/>
	<meta name="keywords" content="Palavras, chaves"/>
	<title>PHP com BD</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>

	<?php include "includes/menu.php" ?>

	<div id="area-principal">
		<div id="postagem">
			<form method="post" action="" >
				<fieldset>
					<p class="centralizar">
						<!-- <label>E-mail do usuario</label> <br> -->
						<input type="email" name="email" id="email" autofocus placeholder="E-mail do usuario"/>
					</p>
					<p class="centralizar">
						<!-- <label>Senha</label> <br> -->
						<input type="password" name="senha" id="senha" placeholder="Senha"/>
					</p>
					<p class="centralizar">
						<input type="submit" value="Login"/>
						<input type="reset" value="Limpar"/>
					</p>
				</fieldset>
			</form>
			<br/> Novo por aqui? <a href="cadastro_usuario.php">Inscreva-se Agora >></a>
			<?php
				//CÓDIGO PHP AQUI
				// session_start();
				if(isset($_POST["email"])){
					$email = $_POST["email"];
					$senha = $_POST["senha"];
					$senha = md5($senha);
					include_once "conexao.php";
					$con = conecta_mysql();
					$sql = "SELECT * FROM  usuarios 
					WHERE email = '$email' and senha ='$senha'";
					$resultado_sql = mysqli_query($con,$sql);
					if($resultado_sql){
						//mysqli_fetch_assoc converte a consulta em um vetor
						$dados_usuario = mysqli_fetch_assoc($resultado_sql);
						if(isset($dados_usuario["codigo"])){
							print "e-mail e senha correto.";
							session_start();
							$_SESSION["codigo"] = $dados_usuario["codigo"];
							$_SESSION["nome"] = $dados_usuario["nome"];
							$_SESSION["email"] = $dados_usuario["email"];
							header("location:login_correto.php");
								 }
							else{
							print"<script> alert('e-mail e senha não conferem'); </script>";
								}

				 					}
									else{
										print "Erro de SQL";
										}
	
										}


			//tratando erros de direcionamento
			if(isset($_GET["erro"])){
				$erro = $_GET["erro"];
				if($erro==1){
					echo "<script> alert('Mensagem do ERRO 1'); </script>";
					print"";
							}
				if($erro==2){
					echo "<script> alert('ATENÇÃO, é necessário fazer o login'); </script>";
							}
									} //fechando isset do método GET
			?>

		</div> <!-- Fechando div Postagem -->
	</div> <!--  Fechando div principal-->
</body>
</html>
 -->
