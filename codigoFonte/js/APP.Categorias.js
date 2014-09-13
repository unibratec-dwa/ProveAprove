var APP = APP || {};
APP.Categorias = {

	setUp: function() {
		this.registrarEventos();
		this.carregarDados();
		console.log('Iniciando categorias');
	},


	registrarEventos: function() {

	},

	carregarDados: function() {
		//Ajax
		jQuery.ajax({
			url: "categorias.php",

			success: function(resposta) {
				if(resposta.status === true){
					APP.Categorias.escreverDados(resposta.dados);
				} else {
					console.log("Resposta: ",resposta);
				}
				
			}
		})
	},

	escreverDados: function(dados) {

		var fragmento = document.createDocumentFragment();

		$(dados).each(function(indice, dado){

			var li = $("<li>")
						.addClass('item-categorias');

			$("<a>")
				.addClass('link-categorias')
				.attr('href', "#categoria-"+dado.id)
				.text(dado.titulo)
				.appendTo(li);


			fragmento.appendChild(li.get(0));
		});


		$(".lista-categorias")
			.find(".item-categorias").remove()
			.end().get(0).appendChild(fragmento);

	}

}
