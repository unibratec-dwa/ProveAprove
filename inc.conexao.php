<?php
//nestas variáveis guardamos os dados necesssários para a conexão
$host = "localhost"; // aqui é o endereço onde está o banco
$usuario = "root";  // aqui é o usuário cadastrado do banco
$senha = "123456";      // neste campo é a senha, neste caso é vazio
$banco = "ProveAprove"; // por último é o nome do banco

// pedimos a função para nos dar uma conexão e guardamos em uma variável $conexao
$conexao = mysqli_connect($host, $usuario, $senha, $banco);

// Se acontecer um erro, escreve a mensagem.
if (mysqli_connect_errno($conexao)) {
	echo "Aconteceu o seguinte erro: " . mysqli_connect_error();
}
?>
