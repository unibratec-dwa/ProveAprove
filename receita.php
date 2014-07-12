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
$totalDeResultados = mysqli_num_rows($resultado);

$json = array();
$json['dados'] = array();

if($totalDeResultados > 0) {
	$json['status'] = TRUE;
	while($receita = mysqli_fetch_object($resultado)) {
		//4 - Apresentação do resultado
		$json['dados'][] = $receita;
	}

} else {
	$json['status'] = FALSE;
	$json['message'] = "Nenhuma receita foi encontrada";
}

echo json_encode($json);


?>