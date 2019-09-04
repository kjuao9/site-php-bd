<?php
include "../conexao.php";
$con = conecta_mysql();

include "../includes/funcoes.php";
verificar_email($con, "nome@email.com");
print"<br />";


$sql = "SELECT * FROM usuarios";
$con = conecta_mysql();
$resultado = mysqli_query($con, $sql);
if($resultado){
    $usuarios = array();
    //todo bd q tiver mais de um valor pode fazer isso pra mostrar os valoresss
    while( $linha = mysqli_fetch_assoc($resultado) ){
        $usuarios[] = $linha;
    }
    

//abaixo mostra tudo
print "<pre>";
    print_r($usuarios);
print "</pre>";

//abaixo mostra só o nome
foreach($usuarios as $usuario){
    print "Nome: ";
    print $usuario["nome"];
    print "<br/>";
}

}
//////////////////////////////////////////////////////////



?>
