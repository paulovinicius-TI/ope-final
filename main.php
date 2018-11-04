<?php 
	if(isset($_GET['logout'])){
		Painel::logout();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Painel de controle</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"/>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="css/teste.css" />
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8" />
</head>
<body>
	<base base="<?php echo INCLUDE_PATH;?>" />
	<?php $url = isset($_GET['url']) ? $_GET['url'] : 'ListaClientes';?>

	<div class="menu scrollbar" id="style-2">
      	<div class="force-overflow"></div>
    
		<div class="menu-btn"><i class="fa fa-bars"></i></div>
		<div class="foto-perfil"></div>
		<div class="informacoes-perfil">
			<p id="nome"><?php echo $_SESSION['name'];?></p>
			<p id="cargo"><?php echo $_SESSION['cargo'];?></p>
		</div>

		<div class="list-menu">
			<?php 
				if($_SESSION['cargo'] == 'Administrador') include('menu/administrador.php');
				else include('menu/funcionario.php');
			?>
		</div>
	</div>

	<div class="escurecer"></div>
	<div class="situacao"></div>
	<div class="content">
		<div class="w100 top-bar black">
			<div class="menu-btn left"><i class="fa fa-bars"></i></div>
			<div class="configuracao right"><a href="<?php echo INCLUDE_PATH;?>?logout"><i class="fas fa-sign-out-alt"></i></a></div>
			<!--<div class="configuracao right"><i class="fas fa-cog"></i></div>
			<div class="notificacao right"><i class="far fa-bell"></i></div>-->
			<div class="clear"></div>
		</div>
		<div class="estatistica">
			<div class="box w100">
		        <?php
		           if(file_exists('pages/'.$url.'.php')){
		            	include('pages/'.$url.'.php');
		            }else include('pages/ListaCliente.php');
		        ?>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/constantes.js"></script>
	<script src="js/teste.js"></script>
	<script src="js/form.js"></script>
	<script src="js/scriptGeral.js"></script>
   	<!--<script type="text/javascript">
        $(function(){
            carregarDinamico();
			function carregarDinamico(){
				$('[realtime]').click(function(){
					var pagina = $(this).attr('realtime');
					$('.estatistica .box').hide();
					$('.estatistica .box').load('http://localhost/danki_aulas/dominando_css/aula_01/pages/'+pagina+'.php');
					$('.estatistica .box').show();
					return false;
				});
			}
        })
    </script>-->
	<script type="text/javascript">
		ativaBuscaPaginacao('#list-thumbs',
		    {
				elPaginacao: '#paginacao', 
				itensPorPag: 5, 
				elInput: '#pesquisaSlide'
			}
		);
		function formatar(mascara, documento){
			  var i = documento.value.length;
			  var saida = mascara.substring(0,1);
			  var texto = mascara.substring(i)
			  
			  if (texto.substring(0,1) != saida){
			            documento.value += texto.substring(0,1);
			  }
			  
			}
	</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>