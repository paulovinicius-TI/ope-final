<!DOCTYPE html>
<html>
<head>
	<title>Painel de controle</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"/>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="css/teste.css" />
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8" />
</head>
<body>
	<?php $url = isset($_GET['url']) ? $_GET['url'] : 'teste'; ?>
	<div class="menu scrollbar" id="style-2">
      	<div class="force-overflow"></div>
    
		<div class="menu-btn"><i class="fa fa-bars"></i></div>
		<div class="foto-perfil"></div>
		<div class="informacoes-perfil">
			<p id="nome">Vinicius Oliveira</p>
			<p id="cargo">Administrador</p>
		</div>

		<div class="list-menu">
			<div class="item">
				<h2>Pedido</h2>
				<ul>
					<li><a href="#">Novo Pedido</a></li>
					<li><a href="#">Listar Pedido</a></li>
					<li><a href="#">Finalizar Pedido</a></li>
				</ul>
			</div>
			<div class="item">
				<h2>Cadastro</h2>
				<ul>
					<li><a href="#">Cadastro de Produto</a></li>
				</ul>
			</div>
			<div class="item">
				<h2>Gestão</h2>
				<ul>
					<li><a href="#">Listar Produtos</a></li>
					<li><a href="#">Listar Cliente</a></li>
					<li><a href="http://localhost/danki_aulas/dominando_css/aula_01/ListaFuncionarios">Listar Funcionários</a></li>
					<li><a href="#">Controle de Lucro</a></li>
					<li><a href="#">Controle de Estoque</a></li>
				</ul>
			</div>
			<div class="item">
				<h2>Administração</h2>
				<ul>
					<li><a href="#">Editar Úsuarios</a></li>
					<li><a href="#">Adicionar Úsuarios</a></li>
				</ul>
			</div>
			<div class="item">
				<h2>Configuração Geral</h2>
				<ul>
					<li><a href="#">Editar</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="escurecer"></div>

	<div class="content">
		<div class="w100 top-bar black">
			<div class="menu-btn left"><i class="fa fa-bars"></i></div>
			<div class="configuracao right"><i class="fas fa-cog"></i></div>
			<div class="notificacao right"><i class="far fa-bell"></i></div>
			<div class="clear"></div>
		</div>
		<div class="estatistica">
	        <?php 
	        	print_r($url);
	            if(file_exists('pages/'.$url.'.php')) include('pages/'.$url.'.php');
	            else include('bemVindo.php');
	        ?>
		</div>
	</div>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/teste.js"></script>
	<script src="js/scriptGeral.js"></script>
    <script type="text/javascript">
        $(function () {
            // aplica a paginação e a busca
            ativaBuscaPaginacao('#list-thumbs',
                {
					elPaginacao: '#paginacao', 
					itensPorPag: 3, 
					elInput: '#pesquisaSlide'
				}
            );
        });
    </script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>