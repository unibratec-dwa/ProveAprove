var APP = APP || {};
APP.Receita = {
	_url: "receita.php",
	setUp: function() {

	},
	carregar: function(id) {
		jQuery.ajax({
			url: this._url,
			data: {
				id: id
			},
			error: this.naoCarregou,
			beforeSend: this.carregando,
			success: this.carregou
		})
	},
	naoCarregou: function() {
		console.log("Não carregou");
	},
	carregando: function() {
		console.log('Carregando receita');
	},
	carregou: function(resposta) {
		if(resposta.status === true) {
			console.log('carregou receita: ', resposta)
		} else {
			console.log("Não foi possível carregar a receita. Mensagem do servidor: ", resposta.message);
		}
	}
}