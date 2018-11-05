	<!-- Modal -->
	<div class="clear"></div>
	<h1 class="page-header">Controle de Lucro</h1>
<!-- 				  <div class="table-responsive">
						<iframe width="700" height="400" frameborder="0" scrolling="no" src="https://onedrive.live.com/embed?resid=AECE3BFA79D316B%21387&authkey=%21AFr2uH23mkuRPjA&em=2&wdHideGridlines=True&wdHideHeaders=True&wdDownloadButton=True&wdInConfigurator=True"></iframe>
				</div>
				<div id="paginacao" class="w100">
					<ul class="pagination"></ul>
				</div> -->
<!-- 				<?php 
				$sql = MySql::conectar()->prepare("
					SELECT SUM(total) as receita, data from tb_pedido_finalizado
					GROUP BY data
					");
				$sql->execute();
				$sql = $sql->fetchAll();
				foreach ($sql as $key => $value):
					?>
					<th><?php echo $value['receita'];?></th>
				<?php endforeach;?> -->


<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="list-thumbs">
		<thead>
			<tr>
				<th>Total</th>
				<th>Data</th>
			</tr>
				<?php 
				$historico = MySql::conectar()->prepare("
					SELECT SUM(total) as total, data FROM tb_pedido_finalizado GROUP BY data
					");
				$historico->execute();
				$historico = $historico->fetchAll();

				foreach ($historico as $key => $value):
					?>

					<tr>
						<td><?php echo $value['total'];?></td>
						<td><?php echo $value['data'];?></td>
						</tr>
					<?php endforeach;?>
