<?php 
	$sql = MySql::conectar()->prepare("
	SELECT *
	FROM tb_fornecedor F
	WHERE F.status != 0
	");
	$sql->execute();
	$qtd = $sql->rowCount();
?>
<div style="width: 100%;">
	<div class="left" style="width: 50%;float: left;">
		<input id="pesquisaSlide" class="form-control left" placeholder="Pesquisar Fornecedor" />
		<a href="<?php echo INCLUDE_PATH;?>CadastroFornecedor"><button type="button" class="btn btn-info right">+ Novo</button></a>
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
<h1 class="page-header">Lista de Fornecedor</h1>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="list-thumbs">
			      	<thead>
				        <tr>
				          	<th>CNPJ</th>
				          	<th>Nome</th>
				          	<th>Telefone</th>
				          	<th>Ação</th>
				        </tr>
			      	</thead>
			  		<tbody>
			  			<?php 
			  				$sql = MySql::conectar()->prepare("
								SELECT *
								FROM tb_fornecedor F
                                INNER JOIN tb_fornecedor_telefone T
                                ON idfornecedor = T.id_fornecedor
								WHERE F.status != 0
			  				");
			  				$sql->execute();
			  				$sql = $sql->fetchAll();

			  				foreach ($sql as $key => $value):
			  			?>
			    		<tr>
				          	<th><?php echo $value['cnpj'];?></th>
				          	<td><?php echo $value['fornecedor'];?></td>
				          	<td><?php echo $value['tel'];?></td>
				          	<td>
				          		<form method="post" style="display: inline-block;">
				          			<input type="hidden" name="id" value="<?php echo $value['idfornecedor']; ?>"/>

				          			<input type="hidden" name="acao" value="editarF">
				          			<input type="hidden" name="formulario" value="fornecedor">

						            <button class="btn btn-warning btn-xs" title="Alterar" data-toggle="modal" data-target="#myModal" type="submit">
					              		<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						            </button>
						        </form>
						        <form method="post" style="display: inline-block;">
				          			<input type="hidden" name="id" value="<?php echo $value['idfornecedor']; ?>"/>

				          			<input type="hidden" name="acao" value="readDeleteF">
				          			<input type="hidden" name="formulario" value="fornecedor">

						            <button class="btn btn-danger btn-xs" title="Remover" type="submit" data-toggle="modal" data-target="#myModal" type="submit">
						              	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						            </button>
					            </form>
			      			</td>
			    		</tr>
			    		<?php endforeach;?>
				       	<tr class="nenhum-registro">
							<td colspan="6" style="text-align: center;">Nenhum fornecedor encontrado...</td>
						</tr>
			  		</tbody>
				</table>
			</div>
			<div id="paginacao" class="w100">
				<ul class="pagination"></ul>
			</div>
			<div class="carregar">
				
			</div>
    	</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
	    <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title"></h4>
	        </div>
	        <div class="modal-body">
	        	
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	        </div>
		</div>    
	</div>
</div>
