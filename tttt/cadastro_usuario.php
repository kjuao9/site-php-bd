<!DOCTYPE html!>
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

	<?php include "includes/menu.php" ?>

	<div id="area-principal">
		<div id="postagem">
			<form method="post" action="">
				<fieldset>
					<p class="centralizar">
						<input type="text" name="nome" id="nome" placeholder="nome"/>
					</p>
					<p class="centralizar">
						<input type="email" name="email" id="email" placeholder="email"/>
					</p>
					<p class="centralizar">
						<input type="password" name="senha" id="senha" placeholder="senha"/>
					</p>
					<p class="centralizar">
						<input type="password" name="senha2" id="senha2" placeholder="Repita a senha"/>
					</p> <br>
					<p class="centralizar">
						<input type="submit" value="Realizar Cadastro"/>
						<input type="reset" value="Limpar"/>
					</p>
				</fieldset>
			</form>
		</div>
			<?php
			//código PHP aqui!
			if(isset($_POST["nome"])){
				$nome = $_POST["nome"];
				$email = $_POST["email"];
				$senha =  $_POST["senha"];
				$senha2 = $_POST["senha2"];
				// print "$nome, $email, $senha, $senha2";
					if($senha == $senha2){
						$senha = md5($senha);
						include_once "conexao.php";
						$con = conecta_mysql();
							if($con){
							// verificar email;
							include "includes/funcoes.php";
							if(verificar_email($con, $email)){
							$sql = "INSERT INTO usuarios (nome, email, senha)
							values('$nome', '$email', '$senha')";
							$resultado = mysqli_query($con, $sql);
								if($resultado){
									print "<script>
									alert('Usuário Inserido');
									window.location.href=window.location.href;
								</script>";
											  }
									
					else{
						print "erro de SQL";
						}#else da conexão
							}//if que verifica email
							else{
								print"Este e-mail já existe, escolha outro e-mail.";
							}
				    }#if da conexão
				else{
										
					print "<script>
					alert('Suas senhas são diferentes')
					</script>";
				}#else do if que verifica as senhas
			}#if que verifica as senhas
		}#isset
			
			//MODELO DE MENSAGEM APÓS QUALQUER CADASTRO NO BANCO DE DADOS.
			/*
			print "<script>
				alert('MENSAGEM...');
				window.location.href=window.location.href;
			</script>";
			*/
			?>
	</div>
</body>
</html>
