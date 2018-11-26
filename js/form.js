$(function(){
	$('body').on('submit','form',function(){
		var form = $(this);
		var tipoform = form[0]['formulario']['value'];
		console.log(form.serialize());
		switch(tipoform){
			case 'pessoal':
				formulario(form,INCLUDE_PATH+'ajax/carregar-pessoal.php','');
				break;
			case 'cliente':
				formulario(form,INCLUDE_PATH+'ajax/CRUD_Cliente.php','');
				break;
			case 'funcionario':
				formulario(form,INCLUDE_PATH+'ajax/CRUD_Funcionario.php','');
				break;
			case 'produto':
				formulario(form,INCLUDE_PATH+'ajax/CRUD_Produto.php','');
				break;
			case 'pedido':
				formulario(form,INCLUDE_PATH+'ajax/CRUD_Pedido.php','');
				break;
			case 'fornecedor':
				formulario(form,INCLUDE_PATH+'ajax/CRUD_Fornecedor.php','');
				break;
			case 'categoria':
				formulario(form,INCLUDE_PATH+'ajax/CRUD_Categoria.php','');
				break;
			case 'salvar-pessoal':
				formulario(form,INCLUDE_PATH+'ajax/salvar-alteracao-pessoal.php','.btn-primary');
				break;
			case 'cadastrar-pessoal':
				formulario(form,INCLUDE_PATH+'ajax/cadastrar-pessoal.php','.btn-primary');
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
			console.log(data);
			switch(data.formulario){
				case 'read':
					pessoal(data);
					console.log(data);
					break
				case 'update':
					$(".salvar").removeAttr("disabled");
					$(".btn-primary").html("Salvar");
					if(data.situacao == 1) situacao("Formulário salvo com sucesso!",'sucess');
					$('.modal').modal('hide');
					break;
				case 'delete':
					if(data.situacao == 1) situacao("Excluído com sucesso!",'sucess');
					$('.modal').modal('hide');
					break;
				case 'cadastrar':
					if(data.situacao == 1) situacao("Cadastro efetuado com sucesso!",'sucess');
					$(sit).html("Salvar");
					$(".salvar").removeAttr("disabled");
					$('.formatar').each (function(){
  						this.reset();
					});
					break;
				case 'adicionarProd':
					if(data.situacao == 1) produto("Produto adicionado com sucesso!",'sucess');
					//$("#pedido tbody").html("<?php echo 'ESTE';?>");
					$('div.carregar').html(data.html);
					break;
				case 'removerProd':
					if(data.situacao == 1) situacao("Produto removido com sucesso!",'sucess');
					//$("#pedido tbody").html("<?php echo 'ESTE';?>");
					$('div.carregar').html(data.html);
					break;
				case 'senha':
					$(".salvar").removeAttr("disabled");
					$(".btn-primary").html("Salvar");
					if(data.situacao == 1) situacao("Senha Salva com sucesso!",'sucess');
					else situacao("Senha invalida!",'error');
					$('.modal').modal('hide');
					break;
				


			}
				
		});
}


function pessoal(data){
			switch(data.acao){
				case 'readF':
					$('.modal-body').load(INCLUDE_PATH+'pages/UpdateFuncionario.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'deleteF':
					$('.modal-body').load(INCLUDE_PATH+'pages/DeletarFuncionario.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'readC':
					$('.modal-body').load(INCLUDE_PATH+'pages/UpdateCliente.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'deleteC':
					$('.modal-body').load(INCLUDE_PATH+'pages/DeletarCliente.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'readForn':
					$('.modal-body').load(INCLUDE_PATH+'pages/UpdateFornecedor.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'deleteForn':
					$('.modal-body').load(INCLUDE_PATH+'pages/DeletarFornecedor.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'readCateg':
					$('.modal-body').load(INCLUDE_PATH+'pages/UpdateCategoria.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'deleteCateg':
					$('.modal-body').load(INCLUDE_PATH+'pages/DeletarCategoria.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'readProd':
					$('.modal-body').load(INCLUDE_PATH+'pages/UpdateProduto.php');
					pessoalExeculte(data.acao,data);
					break;

				case 'deleteProd':
					$('.modal-body').load(INCLUDE_PATH+'pages/DeletarProduto.php');
					pessoalExeculte(data.acao,data);
					break;
				/*case 'cadstrarC':
					$('.modal-body').load(INCLUDE_PATH+'forms/funcionario.php');
					pessoalExeculte(data.acao,data);
					break;*/


			}
}


function pessoalExeculte(tipo,data){
	
	switch(data['acao']){
		case 'readF':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']+' '+data['sobrenome']);
				$(".formatar input[name='id']").val(data['id']);
				$(".formatar input[name='nome']").val(data['nome']);
				$(".formatar input[name='sobrenome']").val(data['sobrenome']);
				$(".formatar input[name='cpf']").val(data['cpf']);
				$(".formatar input[name='email']").val(data['email']);
				$(".formatar input[name='senha']").val(data['senha']);
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

		case 'deleteF':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']);
				$(".formatar input[name='id']").val(data['id']);
				x++;
				if(x == 2) clearInterval(intervalo);
			},100);
			break;

		case 'readC':
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

		case 'deleteC':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']);
				$(".formatar input[name='id']").val(data['id']);
				x++;
				if(x == 2) clearInterval(intervalo);
			},100);
			break;

		case 'readForn':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']);
				$(".formatar input[name='id']").val(data['id']);
				$(".formatar input[name='nome']").val(data['nome']);
				$(".formatar input[name='cnpj']").val(data['cnpj']);
				$(".formatar input[name='email']").val(data['email']);
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

		case 'deleteForn':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']);
				$(".formatar input[name='id']").val(data['id']);
				x++;
				if(x == 2) clearInterval(intervalo);
			},100);
			break;

		case 'readCateg':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']);
				$(".formatar input[name='nome']").val(data['nome']);
				$(".formatar input[name='id']").val(data['id']);
				x++;
				if(x == 2) clearInterval(intervalo);
			},100);
			break;

		case 'deleteCateg':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']);
				$(".formatar input[name='id']").val(data['id']);
				x++;
				if(x == 2) clearInterval(intervalo);
			},100);
			break;

		case 'readProd':
			var x = 0;
			var intervalo = setInterval(function(){
				$(".modal-title").html(data['nome']);
				$(".formatar input[name='id']").val(data['id']);
				$(".formatar input[name='nome']").val(data['nome']);
				$(".formatar input[name='qtd']").val(data['qtd']);
				$(".formatar input[name='preco']").val(data['preco']);
				$(".formatar input[name='alerta_estoque']").val(data['alerta_estoque']);
				$(".formatar .categoria option[value="+data['categoria']+"]").attr("selected",'');
				$(".formatar .fornecedor > option[value="+data['categoria']+"]").attr("selected",'');
				x++;
				if(x == 2) clearInterval(intervalo);
			},100);
			break;

		case 'deleteProd':
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

function ativarCliente(){
	$(".cadastro").css("display:none;");
}

function produto(text,classe){
	var element = $('.nota');
	element.removeClass();
	element.addClass('nota');

	element.fadeIn();
	element.html(text);
	element.addClass(classe);

	setTimeout(function(){
		element.fadeOut();
	},3000)
}

function filtro(filtrar){
	if(filtrar.value == "todos") $('.table-responsive').load(INCLUDE_PATH+'pages/FiltrarTodosProdutos.php');
	else $('.table-responsive').load(INCLUDE_PATH+'pages/FiltrarEstoqueBaixo.php');
	var x = 0;
	var intervalo = setInterval(function(){
		var qtd = [];
		qtd['value'] = 5;
		pagination(qtd,'#list-thumbs','#pesquisaSlide')
		x++;
		if(x == 2) clearInterval(intervalo);
	},100);
	
}
		
