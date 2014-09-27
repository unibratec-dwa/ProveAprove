var APP = APP || {};
APP.Receitas = {
	_url: "listar_receitas.php",
	_id: "#modulo-receitas",
	_attrStatus: "data-ajax-status",
	_classCarregando: "ajax-carregando",
	_classErro: "ajax-erro",
	_carregando: "Carregando categorias...",
	_erroAjax: "O seu dispositivo parece não estar conectado a internet. Tente novamente quando estiver online.",


	setUp: function() {

	},
	favoritos: function(usuario) {
		this.load('favoritos', usuario);
	},
	categoria: function(categoria) {
		this.load('categoria', categoria);
	},
	
	load: function(filtro, id) {
		var delegate, loading, loaded, error;
			delegate = APP.delegate;

			loading = APP.delegate(this, this.loading);
			loaded = APP.delegate(this, this.loaded);
			error = APP.delegate(this, this.error);

		jQuery.ajax({
			url: this._url,
			data: {
				filtro: filtro,
				id: id
			},
			beforeSend: loading,
			error: error,
			success: loaded
		});
	},

	loading: function() {
		$(this._id)
			.attr(this._attrStatus,this._carregando)
			.removeClass(this._classErro)
			.addClass(this._classCarregando);
	},
	error: function() {
		$(this._id)
			.attr(this._attrStatus, this._erroAjax)
			.removeClass(this._classCarregando)
			.addClass(this._classErro)
	},

	loaded: function(resposta) {
		if(resposta.status === true) {
			$(this._id)
				.removeClass(this._classCarregando)
				.removeClass(this._classErro)

			this.escreverDados(resposta.dados)
		} else {
			$(this._id)
				.attr(this._attrStatus, resposta.message)
				.removeClass(this._classCarregando)
				.addClass(this._classErro)
		}
	},

	escreverDados: function(receitas) {
		var receitas, li, h2, a, categoria;

		receitasUl = $("#modulo-receitas .feeds-preview").empty();


		$(receitas).each(function(indice, receita){
			

			li = $("<li>")
					.addClass('feeds-item')
					.appendTo(receitasUl)

			h2 = $("<h2>")
					.addClass('titulo-item')
					.appendTo(li)

			a = $("<a>")
				.addClass('feeds-link')
				.attr('href', "#")
				.text(receita.titulo)
				.appendTo(h2)

			categoria = $("<a>")
							.addClass('categoria')
							.attr("href", "#receitas-categoria-"+receita.categoriaId)
							.text(receita.categoria)
							.appendTo(li)

		})
	}
}