var APP = APP || {};

APP.Categorias = {
	_extend: ["Once", "Ajax"],


	_url: "categorias.php",
	_id: "#modulo-categorias",
	_attrStatus: "data-ajax-status",
	_classCarregando: "ajax-carregando",
	_classErro: "ajax-erro",
	_carregando: "Carregando categorias...",
	_erroAjax: "O seu dispositivo parece não estar conectado a internet. Tente novamente quando estiver online.",

	setUp: function() {
		this.registrarEventos();
		this.carregar();
		console.log('Iniciando categorias');
	},


	registrarEventos: function() {
		$("#modulo-categorias, #modulo-receitas").on("click", "a[href^='#receitas-categoria']", function(){
			var id = $(this).attr('href').split("receitas-categoria-")[1];
			APP.Receitas.categoria(id)
		});
	},

	carregar: function() {
		var dadosLocalStorage, carregando, carregou, naoCarregou;

		if(localStorage.getItem(this._id) !== null) {
			dadosLocalStorage = localStorage.getItem(this._id);
			this.escreverDados(JSON.parse(dadosLocalStorage))

		} 
		//else {
			carregou = APP.delegate(this, this.carregou);
			carregando = APP.delegate(this, this.carregando);
			naoCarregou = APP.delegate(this, this.naoCarregou);


			console.log('carregar')
			//Ajax
			jQuery.ajax({
				url: this._url,
				beforeSend: carregando,
				success: carregou,
				error: naoCarregou
			})
		//}
	},

	carregando: function() {
		$(this._id)
			.attr(this._attrStatus,this._carregando)
			.removeClass(this._classErro)
			//.addClass(this._classCarregando);
			//
			console.log('carregando')
	},
	naoCarregou: function() {
		$(this._id)
			.attr(this._attrStatus, this._erroAjax)
			.removeClass(this._classCarregando)
			.addClass(this._classErro)
	},

	carregou: function(resposta){
		$(this._id)
			.removeClass(this._classErro)
			.removeClass(this._classCarregando)

			console.log('carregou')

		if(resposta.status === true){
			this.escreverDados(resposta.dados);
			localStorage.setItem(this._id, JSON.stringify(resposta.dados));
		} else {
			$(this._id)
				.attr(this._attrStatus, resposta.message)
				.addClass(this._classErro)
		}
		$(this._id)
			.removeClass(this._classCarregando);
	},

	

	escreverDados: function(dados) {

		var fragmento = document.createDocumentFragment();

		$(dados).each(function(indice, dado){

			var li = $("<li>")
						.addClass('item-categorias');

			$("<a>")
				.addClass('link-categorias')
				.attr('href', "#receitas-categoria-"+dado.id)
				.text(dado.titulo)
				.appendTo(li);


			fragmento.appendChild(li.get(0));
		});


		$(".lista-categorias")
			.find(".item-categorias").remove()
			.end().get(0).appendChild(fragmento);

	}

}
