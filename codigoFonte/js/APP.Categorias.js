var APP = APP || {};
APP.Categorias = {

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
		$(".lista-categorias").on("click", '.item-categorias a', function(){
			var id = $(this).attr('href').split("-")[1];
			APP.Receitas.categoria(id)
		});
	},

	carregar: function() {
		var carregando, carregou, naoCarregou;

		carregou = APP.delegate(this, this.carregou);
		carregando = APP.delegate(this, this.carregando);
		naoCarregou = APP.delegate(this, this.naoCarregou);

		//Ajax
		jQuery.ajax({
			url: this._url,
			beforeSend: carregando,
			success: carregou,
			error: naoCarregou
		})
	},

	carregando: function() {
		$(this._id)
			.attr(this._attrStatus,this._carregando)
			.removeClass(this._classErro)
			.addClass(this._classCarregando);
	},

	carregou: function(resposta){
		$(this._id)
			.removeClass(this._classErro)
			.removeClass(this._classCarregando)

		if(resposta.status === true){
			this.escreverDados(resposta.dados);
		} else {
			$(this._id)
				.attr(this._attrStatus, resposta.message)
				.addClass(this._classErro)
		}
		$(this._id)
			.removeClass(this._classCarregando);
	},

	naoCarregou: function() {
		$(this._id)
			.attr(this._attrStatus, this._erroAjax)
			.removeClass(this._classCarregando)
			.addClass(this._classErro)
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
