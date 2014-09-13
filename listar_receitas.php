<?php
header("Content-type: application/json; charset=utf-8");

include("inc.conexao.php");

//Filtro de receitas
$filtro = NULL;

//Id para filtro
$id = NULL;

//Objeto de retorno
$json = array();

//Inicia falso
$json['status'] = FALSE;

//Inicial sem dados
$json['dados'] = array();


if(isset($_GET['id'])) {
	$id = $_GET['id'];
}

//Últimas receitas
//Se nenhum filtro for apresentado ou se o filtro for "ultimas"
if(!isset($_GET['filtro']) || $_GET['filtro'] == "ultimas") {
	$json['status'] = TRUE;

	$query = "SELECT r.id, r.titulo, u.nome as 'autor', c.titulo as 'categoria', IFNULL(ROUND(AVG(ur.nota),1),0) as 'media',IFNULL(SUM(ur.gostou),0) as 'gostou', IFNULL(SUM(ur.favorito),0) as 'favorita'
				FROM receita r
				INNER JOIN usuario u ON r.email = u.email 
				INNER JOIN categoria c ON r.categoria_id = c.id
				LEFT JOIN usuario_receita ur  ON r.id = ur.receita_id
				GROUP BY r.id ORDER BY r.id DESC";

} 

//Com filtro
else { $filtro = $_GET['filtro'];
	
	if($filtro=="favoritos") {

		if($id == NULL) {
			$json['mensagem'] = 'Usuário não informado';
		} else {
			$json['status'] = TRUE;

			$query = "SELECT r.id, r.titulo, u.nome AS  'autor', c.titulo AS  'categoria'
FROM receita r
INNER JOIN usuario u ON r.email = u.email
INNER JOIN categoria c ON r.categoria_id = c.id
RIGHT JOIN usuario_receita ur ON r.id = ur.receita_id
WHERE ur.email =  '$id'
AND ur.favorito =1
ORDER BY categoria, titulo";
		}

	}


	//Listar por categorias
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