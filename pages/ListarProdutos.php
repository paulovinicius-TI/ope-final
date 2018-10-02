<input id="pesquisaSlide" class="form-control left" placeholder="Pesquisar Produto" />
<a href="<?php echo INCLUDE_PATH;?>CadastroProduto"><button type="button" class="btn btn-info right">+ Novo</button></a>
<div class="clear"></div>
<h1 class="page-header">Lista de produtos</h1>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="list-thumbs">
			      	<thead>
				        <tr>
				          	<th>Cod</th>
				          	<th>Nome</th>
				          	<th>estoque</th>
				          	<th>Preço em R$</th>
				          	<th>Ação</th>
				        </tr>
			      	</thead>
			  		<tbody>
			  			<?php 
			  				$produtos = MySql::conectar()->prepare("
								SELECT idproduto, nome, estoque, preco_unit, status
								FROM tb_produto
								WHERE status != 0
			  				");
			  				$produtos->execute();
			  				$produtos = $produtos->fetchAll();

			  				foreach ($produtos as $key => $value):
			  			?>
			    		<tr>
				          	<th><?php echo $value['idproduto'];?></th>
				          	<td><?php echo $value['nome']?></td>
				          	<td><?php echo $value['estoque'];?></td>
				          	<td><?php echo $value['preco_unit'];?></td>
				          	<td>
				          		<form method="post" style="display: inline-block;">
				          			<input type="hidden" name="id" value="<?php echo $value['idproduto']; ?>"/>

				          			<input type="hidden" name="acao" value="editarP">
				          			<input type="hidden" name="formulario" value="produto">

						            <button class="btn btn-warning btn-xs" title="Alterar" data-toggle="modal" data-target="#myModal" type="submit">
					              		<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						            </button>
						        </form>
						        <form method="post" style="display: inline-block;">
				          			<input type="hidden" name="id" value="<?php echo $value['idproduto']; ?>"/>


				          			<input type="hidden" name="acao" value="readDeleteP">
				          			<input type="hidden" name="formulario" value="produto">

						            <button class="btn btn-danger btn-xs" title="Remover" type="submit" data-toggle="modal" data-target="#myModal" type="submit">
						              	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						            </button>
					            </form>
			      			</td>
			    		</tr>
			    		<?php endforeach;?>
				       	<tr class="nenhum-registro">
							<td colspan="6" style="text-align: center;">Nenhum produto encontrado...</td>
						</tr>
			  		</tbody>
				</table>
			</div>
			<div id="paginacao" class="w100">
				<ul class="pagination"></ul>
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
