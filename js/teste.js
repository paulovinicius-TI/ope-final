$(function(){
	var situacao = ($('.menu').css('left') == '-6810px') ? false : true;
	var targetWidth = $(window)[0].innerWidth;
		$('.menu-btn').click(function(){
			if(situacao){
				$('.menu').animate({'left':'0'});
				//$('.menu').animate({'width':'0','display':'none'});
				$('.content').animate({'left':'0','width':'100%'});
				$('.escurecer').css('display','block');
				situacao = false;
			} else{
				if(targetWidth <= 800){
					//$('.menu').css('display','block');
					$('.menu').animate({'left':'-1000%'});
					//$('.menu').animate({'width':'200px'});
					$('.content').animate({'left':'0','width':'100%'});
				}else{
					$('.menu').css('display','block');
					$('.menu').animate({'width':'20%','left':'0'});
					//$('.menu').animate({'width':'20%'});
					$('.content').animate({'left':'20%','width':'80%'});
				}
				$('.escurecer').css('display','none');
				situacao = true;
			}
		})
	$(window).resize(function(){
		targetWidth = $(window)[0].innerWidth;
		situacao = ($('.menu').css('left') == '-6810px') ? true : false;

		if(targetWidth > 800){
			$('.menu').css('width','20%').css('left','0');
			//$('.menu').css('width','20%');
			$('.content').css('left','20%').css('width','80%');
			situacao = true;
		}
		else if(targetWidth <= 800 && situacao == false){
			//$('.menu').css('display','block');
			$('.menu').css({'left':'-1000%','width':'200px'});
			//$('.menu').animate({'width':'200px'});
			$('.content').css('left','0').css('width','100%');
			$('.escurecer').css('display','none');
			situacao = true;
		}else situacao = true;
	})

})