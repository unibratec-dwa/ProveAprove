<?php
//Define o retorno como JSON
header("Content-type: application/json; charset=utf-8");

//Inicia uma conexão com o banco de dados
include("inc.conexao.php");

//Inicia as variáveis com valores nulos
$receita = NULL;
$nota = NULL;
$usuario = NULL;

//Objeto de retorno
$json = array();
$json['status'] = FALSE;

//Gestão de erros
if(isset($_POST['receita']) && is_numeric($_POST['receita'])) {
	$receita = $_POST['receita'];
} else {
	$json['mensagem'] = 'Receita não informada';
	echo json_encode($json); exit;
}

if(isset($_POST['nota']) && is_numeric($_POST['nota'])) {
	$nota = $_POST['nota'];
} else {
	$json['mensagem'] = 'Nota não definida';
	echo json_encode($json); exit;
}

if(isset($_POST['usuario'])) {
	$usuario = $_POST['usuario'];
} else {
	$json['mensagem'] = 'Usuário não informado';
	echo json_encode($json); exit;
}


//Verificar se existe alguma interação do usuário
$query = "SELECT * from usuario_receita WHERE email = '$usuario' AND receita_id = $receita;";
$resultado = mysqli_query($conexao, $query);
$total = mysqli_num_rows($resultado);

if($total == 0) {
	//Insert
	$query = "INSERT INTO  usuario_receita (email,receita_id,favorito,gostou,nota) 
	VALUES ('$usuario',  '$receita', NULL , NULL ,  '$nota')";
} else {
	//Update
	$query = "UPDATE usuario_receita SET nota =  '$nota' 
				WHERE  email = '$usuario' 
				AND receita_id = $receita";
}

$resultado = mysqli_query($conexao, $query);
if($resultado) {
	$json['status']=TRUE;
} else {
	$json['mensagem']="A nota não pôde ser gravada.";
}

echo json_encode($json);


?>