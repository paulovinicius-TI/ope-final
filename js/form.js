$(function(){
	$('body').on('submit','form',function(){
		var form = $(this);
		var tipoform = form[0]['formulario']['value'];
		console.log(form.serialize());
		switch(tipoform){
			case 'pessoal':
				formulario(form,INCLUDE_PATH+'ajax/carregar-pessoal.php','');
				break;
			case 'salvar-pessoal':
				formulario(form,INCLUDE_PATH+'ajax/salvar-alteracao-pessoal.php','.btn-primary');
				break;
			case 'remove-pessoal':
				formulario(form,INCLUDE_PATH+'ajax/remove-pessoal.php','');
				break;
		}
		
		return false;
	})
})

function formulario(form,ajax,sit){
		$.ajax({
			beforeSend:function(){
				$(sit).html("Enviando...");
				$(".salvar").attr("disabled",'');
			},
			url: ajax,
			method:'post',
			dataType: 'json',
			data:form.serialize()
		}).done(function(data){
			switch(data.formulario){
				case 'pessoal':
					pessoal(data);
					break
				case 'salvar-pessoal':
					$(".salvar").removeAttr("disabled");
					$(".btn-primary").html("Salvar");
					if(data.situacao == 1) situacao("Formulário salvo com sucesso!",'sucess');
					$('.modal').modal('hide');
					break;
				case 'remove-pessoal':
					if(data.situacao == 1) situacao("Excluído com sucesso!",'sucess');
					$('.modal').modal('hide');
					break;
			}
				
		});
}


function pessoal(data){
			switch(data.acao){
				case 'editarF':
					$('.modal-body').load(INCLUDE_PATH+'forms/funcionario.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'excluirF':
					$('.modal-body').load(INCLUDE_PATH+'forms/excluir-pessoa.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'editarC':
					$('.modal-body').load(INCLUDE_PATH+'forms/cliente.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'excluirC':
					$('.modal-body').load(INCLUDE_PATH+'forms/excluir-cliente.php');
					pessoalExeculte(data.acao,data);
					break;

			}
}


function pessoalExeculte(tipo,data){
	
	switch(data['acao']){

		case 'editarF':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']+' '+data['sobrenome']);
				$(".formatar input[name='id']").val(data['id']);
				$(".formatar input[name='nome']").val(data['nome']);
				$(".formatar input[name='sobrenome']").val(data['sobrenome']);
				$(".formatar input[name='cpf']").val(data['cpf']);
				$(".formatar input[name='telefone']").val(data['tel']);
				$(".formatar input[name='endereco']").val(data['endereco']);
				$(".formatar input[name='cidade']").val(data['cidade']);
				$(".formatar input[name='bairro']").val(data['bairro']);
				$(".formatar input[name='numero']").val(data['numero']);
				$(".formatar input[name='estado']").val(data['estado']);
				$(".formatar .form-control > option[value="+data['cargo']+"]").attr("selected",'');
				x++;
				if(x == 2) clearInterval(intervalo);
			},100);
			break;

		case 'excluirF':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']);
				$(".formatar input[name='id']").val(data['id']);
				x++;
				if(x == 2) clearInterval(intervalo);
			},100);
			break;

		case 'editarC':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']+' '+data['sobrenome']);
				$(".formatar input[name='id']").val(data['id']);
				$(".formatar input[name='nome']").val(data['nome']);
				$(".formatar input[name='sobrenome']").val(data['sobrenome']);
				$(".formatar input[name='cpf']").val(data['cpf']);
				$(".formatar input[name='telefone']").val(data['tel']);
				$(".formatar input[name='endereco']").val(data['endereco']);
				$(".formatar input[name='cidade']").val(data['cidade']);
				$(".formatar input[name='bairro']").val(data['bairro']);
				$(".formatar input[name='numero']").val(data['numero']);
				$(".formatar input[name='estado']").val(data['estado']);
				x++;
				if(x == 2) clearInterval(intervalo);
			},100);
			break;

		case 'excluirC':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']);
				$(".formatar input[name='id']").val(data['id']);
				x++;
				if(x == 2) clearInterval(intervalo);
			},100);
			break;
	}
}

function situacao(text,classe){
	var element = $('.situacao');
	element.removeClass();
	element.addClass('situacao');

	element.fadeIn();
	element.html(text);
	element.addClass(classe);

	setTimeout(function(){
		element.fadeOut();
	},3000)
}