<?php
session_start();
if ( !isset($_SESSION["codigo"])){
	header("location:index.php?erro=2");
}
include_once "conexao.php";
$con = conecta_mysql();
$id_usuario = $_SESSION["codigo"];
$id_postagem = $_GET["id_postagem"];

$sql = "DELETE FROM postagem WHERE id_postagem = $id_postagem";
$resultado = mysqli_query($con, $sql);
if($resultado){
    print "<script>
                  alert('Mensagem excluida com sucesso!')
            </script>";
            print "<a href='excluir_postagens-2.php'>Clique aqui para voltar</a>";
}
else{
    print  "<script>
    alert('Erro ao excluir mensagem')
    </script>";
    print "<a href='excluir_postagens-2.php'>Clique aqui para voltar</a>";
}



?>