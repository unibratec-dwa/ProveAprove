var APP = APP || {};
APP.Busca = {
	setUp: function() {
		this.registrarEventos();
		console.log('Iniciando busca');
	},
	registrarEventos: function() {
		$("#form-receitas").on('submit', function(event){
			event.preventDefault();

		})
	}
}