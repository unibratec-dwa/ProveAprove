<?php
header("Content-type: application/json; charset=utf-8");
//Conexão com o banco de dados

$host = "localhost";
$usuario = "root";
$senha = "123456";
$banco = "ProveAprove";

$conexao = mysqli_connect($host, $usuario, $senha, $banco);
mysqli_query($conexao, "SET NAMES 'utf8';");

// if(!$conexao) {
// 	echo "Não foi possível conectar ao banco de dados"; 
// } else {
// 	echo "Conexão OK";
// }

$filtro = NULL;
$id = NULL;
$json = array();
$json['status'] = FALSE;
$json['dados'] = array();


if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = $_GET['id'];
}

if(!isset($_GET['filtro']) || $_GET['filtro'] == "ultimas") {
	$json['status'] = TRUE;
	$query = "SELECT 
				r.id, 
				r.titulo, 
				u.nome 	as 'autor', 
				c.titulo	as 'categoria', 
				IFNULL(ROUND(AVG(ur.nota),1),0)	as 'media',
				IFNULL(SUM(ur.gostou),0) 		as 'gostou', 
				IFNULL(SUM(ur.favorito),0) 	as 'favorita'
				FROM 
				receita r

				INNER JOIN usuario u 
				ON r.email = u.email 

				INNER JOIN categoria c 
				ON r.categoria_id = c.id

				LEFT JOIN usuario_receita ur 
				ON r.id = ur.receita_id

				GROUP BY r.id

				ORDER BY r.id DESC";
} else {
	$filtro = $_GET['filtro'];

	if($filtro == "categoria") {
		
		if($id == NULL) {
			$json['mensagem'] = "Nenhuma categoria foi selecionada";
		} else { 
			$json['status'] = TRUE;
			$query = "SELECT 
						r.id, 
						r.titulo, 
						u.nome 	as 'autor', 
						c.titulo	as 'categoria', 
						IFNULL(ROUND(AVG(ur.nota),1),0)	as 'media',
						IFNULL(SUM(ur.gostou),0) 		as 'gostou', 
						IFNULL(SUM(ur.favorito),0) 	as 'favorita'
					FROM 
						receita r

					INNER JOIN usuario u 
						ON r.email = u.email 

					INNER JOIN categoria c 
						ON r.categoria_id = c.id

					LEFT JOIN usuario_receita ur 
						ON r.id = ur.receita_id

					WHERE r.categoria_id = $id

					GROUP BY r.id

					ORDER BY media DESC, gostou DESC, favorita DESC";
		
		}
	}
}

if($json['status'] == TRUE) {
	$resultado = mysqli_query($conexao, $query);

	while($receita = mysqli_fetch_object($resultado)){
		$json['dados'][] = $receita;
	}
}

echo json_encode($json);
?>