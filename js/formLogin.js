$(function(){
	$('body').on('submit','form',function(){
		var form = $(this);
		$.ajax({
			beforeSend:function(){
				$('.overlay-load').fadeIn();
			},
			url: 'http://localhost/ope-final/ajax/formLogin.php',
			method:'post',
			dataType: 'json',
			data:form.serialize()
		}).done(function(data){
				$('.overlay-load').fadeOut();
					if(data.situacao == 1){
						situacao('Logado com sucesso!','sucess');
						setTimeout(function(){ 
    						window.location.href = "index.php";
						}, 2000);
						
					}
					else if(data.situacao == 2) situacao('Usuario ou senha incorreto!','interromped');

					else situacao('Campos vázios não são permitidos!','error');
						
		});
		return false;
	})
})

function situacao(text,classe){
	var element = $('.sitLogin');
	element.removeClass();
	element.addClass('sitLogin');

	element.fadeIn();
	element.html(text);
	element.addClass(classe);

	setTimeout(function(){
		element.fadeOut();
	},3000)
}