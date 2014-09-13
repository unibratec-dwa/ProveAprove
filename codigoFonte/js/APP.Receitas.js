var APP = APP || {};
APP.Receitas = {
	_url: "listar_receitas.php",

	setUp: function() {

	},

	favoritos: function(usuario) {
		this.carregar('favoritos', usuario);
	},

	categoria: function(categoria) {
		this.carregar('categoria', categoria);
	},

	carregar: function(filtro, id) {
		jQuery.ajax({
			url: this._url,
			data: {
				filtro: filtro,
				id: id
			},
			beforeSend: this.carregando,
			error: this.naoCarregou,
			success: this.carregou
		});
	},

	naoCarregou: function() {

	},

	carregando: function() {

	},

	carregou: function(resposta) {

	}
}