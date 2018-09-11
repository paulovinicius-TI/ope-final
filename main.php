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
	<?php $url = isset($_GET['url']) ? $_GET['url'] : 'ListaFuncionarios';?>

	<div class="menu scrollbar" id="style-2">
      	<div class="force-overflow"></div>
    
		<div class="menu-btn"><i class="fa fa-bars"></i></div>
		<div class="foto-perfil"></div>
		<div class="informacoes-perfil">
			<p id="nome"><?php echo $_SESSION['name'];?></p>
			<p id="cargo"><?php echo $_SESSION['cargo'];?></p>
		</div>

		<div class="list-menu">
			<div class="item">
				<h2>Pedido</h2>
				<ul>
					<li>NÃO ESTÁ PRONTO</li>
					<!-- <li><a href="#">Novo Pedido</a></li> -->
					<li><a realtime="ListaPedidos" href="<?php echo INCLUDE_PATH;?>ListaPedidos">Listar Pedido</a></li>
					<!-- <li><a href="#">Finalizar Pedido</a></li> -->
				</ul>
			</div>
			<div class="item">
				<h2>Cadastro</h2>
				<ul>
					<li>NÃO ESTÁ PRONTO</li>
					<!--<li><a href="#">Cadastro de Produto</a></li>-->
				</ul>
			</div>
			<div class="item">
				<h2>Gestão</h2>
				<ul>
					<li><a realtime="ListarProdutos" href="<?php echo INCLUDE_PATH;?>ListarProdutos">Listar Produtos</a></li>
					<li><a realtime="ListaClientes" href="<?php echo INCLUDE_PATH;?>ListaClientes">Listar Cliente</a></li>

					<li><a realtime="ListaFuncionarios" href="<?php echo INCLUDE_PATH;?>ListaFuncionarios">Listar Funcionários</a></li>

					<!--<li><a realtime="ControleLucro" href="<?php echo INCLUDE_PATH;?>ControleLucro">Controle de Lucro</a></li>

					<li><a href="#">Controle de Estoque</a></li>-->
				</ul>
			</div>
			<div class="item">
				<h2>Configuração</h2>
				<ul>
					<li>NÃO ESTÁ PRONTO</li>
					<!--<li><a href="#">Editar</a></li>-->
				</ul>
			</div>
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
		            }else include('pages/ListaFuncionarios.php');
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
				itensPorPag: 3, 
				elInput: '#pesquisaSlide'
			}
		);
	</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>