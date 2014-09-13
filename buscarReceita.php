<?php
header("Content-type: application/json; charset=utf-8");


//1 - Conexão
include("inc.conexao.php");


$texto = $_GET['texto'];
$query = "select u.nome as 'autor', r.* from receita r, usuario u where r.email = u.email AND titulo LIKE '%".$texto."%'";
mysqli_query($conexao, "SET NAMES 'utf8';");
$resultado = mysqli_query($conexao,$query);
$totalDeResultados = mysqli_num_rows($resultado);

$json = array();
$json['dados'] = array();

if($totalDeResultados > 0) {
	$json['status'] = TRUE;
	
	while($receita = mysqli_fetch_object($resultado)) {
		//4 - Apresentação do resultado

		$receita->ingredientes = array();

		$consultaIngredientes = "SELECT i.titulo, ri.quantidade 
FROM ingrediente i, receita_ingrediente ri
WHERE receita_id = ".$receita->id." AND i.id = ri.ingrediente_id";

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