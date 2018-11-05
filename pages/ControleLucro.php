<?php 
	$historico = MySql::conectar()->prepare("
		SELECT SUM(total) as total, data FROM tb_pedido_finalizado GROUP BY data
		");
	$historico->execute();
	$qtd = $historico->rowCount();
?>
<div style="width: 100%;">
	<div class="left" style="width: 50%;float: left;">
		<input id="pesquisaSlide" class="form-control left" placeholder="Pesquisar por data" />
	</div>
	<div class="right" style="width: 15%;float: right">
		<label for="sel1">Resultados por página:</label> 
		<select class="form-control" id="sel1" onchange="pagination(this,'#list-thumbs','#pesquisaSlide')">
			
				<option value="5">5</option>
				<?php if($qtd > 5):?>
					<option value="10">10</option>
				<?php endif;?>
		
		</select>
	</div>
	<div class="clear"></div>
</div>
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
				<th>Data</th>
				<th>Total R$</th>
			</tr>
		</thead>
		<tbody>
				<?php 
				$historico = $historico->fetchAll();
				foreach ($historico as $key => $value):
					?>

					<tr>
						<td><?php echo date('d/m/Y',strtotime($value['data']));?></td>
						<td><?php echo $value['total'];?></td>
					</tr>
					<?php endforeach;?>
		       	<tr class="nenhum-registro">
					<td colspan="6" style="text-align: center;">Nenhuma data encontrada...</td>
				</tr>
		</tbody>
	</table>
</div>
<div id="paginacao" class="w100">
	<ul class="pagination"></ul>
</div>
<div class="carregar">
	
</div>