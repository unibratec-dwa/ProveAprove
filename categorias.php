<?php

//Definir o tipo de conteúdo no cabeçalho como JSON
header("Content-type: application/json; charset=utf-8");

// Iniciar a conexão
$host = "localhost";
$usuario = "root";
$senha = "123456";
$banco = "ProveAprove";

$conexao = mysqli_connect($host, $usuario, $senha, $banco);
mysqli_query($conexao, "SET NAMES 'utf8';");

//Definir a consulta por todas as categorias em ordem alfabética decrescente
$consulta = "SELECT * FROM categoria ORDER BY titulo ASC";

$resultados = mysqli_query($conexao, $consulta);
$totalDeResultados = mysqli_num_rows($resultados);

//Apresentar os resultados em JSON
$json = array();
$json['dados'] = array();
$json['status'] = FALSE;

if($totalDeResultados == 0) {
	$json['message'] = "Nenhuma categoria cadastrada";
} else {
	while($categoria = mysqli_fetch_object($resultados)){
		$json['status'] = TRUE;
		$json['dados'][] = $categoria;
	}
}

/**
 * Lembrar de apresentar a propriedade status, message (se o status for FALSE) e a propriedade dados como array
 */


echo json_encode($json);


?>