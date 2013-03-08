$(function() {
	$("#formulario").validate({
		// Define as regras
		rules:{
			campo_aviso:{
				// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
				required: true
			}
		},
		// Define as mensagens de erro para cada regra
		messages:{
			campo_aviso:{
				required: "Digite o seu nome"
			
			}
		}
	})
})

