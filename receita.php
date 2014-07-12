<?php
header("Content-type: application/json; charset=utf-8");


//1 - Conexão
include("inc.conexao.php");

$json = array();
$json['dados'] = array();

if(!isset($_GET['id'])) {
	$json['status'] = FALSE;
	$json['message'] = "O id da receita não foi informado";
	echo json_encode($json);
	exit;
} 

$id = $_GET['id'];
$query = "select u.nome as 'autor', r.* from receita r, usuario u where r.email = u.email AND id = ".$id;

$resultado = mysqli_query($conexao,$query);
$totalDeResultados = mysqli_num_rows($resultado);

if($totalDeResultados > 0) {
	$json['status'] = TRUE;
	
	while($receita = mysqli_fetch_object($resultado)) {
		//4 - Apresentação do resultado

		$receita->ingredientes = array();

		$consultaIngredientes = "SELECT i.titulo, ri.quantidade 
			FROM ingrediente i, receita_ingrediente ri
			WHERE receita_id = $id AND i.id = ri.ingrediente_id";

		$resultadoIngredientes = mysqli_query($conexao, $consultaIngredientes);
		$totalDeIngredientes = mysqli_num_rows($resultadoIngredientes);
		
		if($totalDeIngredientes > 0) {
			while($ingrediente = mysqli_fetch_object($resultadoIngredientes)) {
				$receita->ingredientes[] = $ingrediente;
			}
		}

		$json['dados'][] = $receita;

	}

} else {
	$json['status'] = FALSE;
	$json['message'] = "Nenhuma receita foi encontrada";
}

echo json_encode($json);


?>