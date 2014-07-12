<?php
header("Content-type: application/json; charset=utf-8");


//1 - Conexão
include("inc.conexao.php");

//2 - Consulta/Query
if(!is_numeric($_GET['id'])) {
	echo "Consulta inválida"; 
	exit;
}

$id = $_GET['id'];
$query = "select * from receita where id = ".$id;
$resultado = mysqli_query($conexao,$query);

$campo = 'titulo';

if(mysqli_num_rows($resultado) == 0) {
	echo "Nenhuma receita foi encontrada com esse id.";
	exit;
}

//3 - Exploração do resultado
while($receita = mysqli_fetch_object($resultado)) {
	//4 - Apresentação do resultado
	echo json_encode($receita);
}

?>