<input id="pesquisaSlide" class="form-control left" placeholder="Pesquisar Pedido" />
<a href="<?php echo INCLUDE_PATH;?>CadastroPedido"><button type="button" class="btn btn-info right">+ Novo</button></a>
<div class="clear"></div>
<h1 class="page-header">Pedidos em Andamento</h1>
			  <div class="table-responsive">
			    <table class="table table-striped table-bordered table-hover" id="list-thumbs">
			      	<thead>
				        <tr>
				          	<th>Nº</th>
				          	<th>Cliente</th>
				          	<th>Atendente</th>
				          	<th>Status</th>
				          	<th>Total em R$</th>
				          	<th>Ação</th>
				        </tr>
			      	</thead>
			      	<tbody>
			  			<?php
			  				$pedido = MySql::conectar()->prepare("
			  					SELECT idpedido, cliente, nome, sobrenome, tb_pedido.status, total
			  					FROM `tb_pedido` 
			  					INNER JOIN `tb_funcionario`
			  					ON id_funcionario = idfuncionario
			  					WHERE tb_pedido.status != 'F'
			  				");
			  				$pedido->execute();
			  				$pedido = $pedido->fetchAll();

			  				foreach ($pedido as $key => $value):
			  			?>
			        <tr>
			          <th><?php echo $value['idpedido'];?></th>
			          <td><?php echo $value['cliente'];?></td>
			          <td><?php echo $value['nome'].' '.$value['sobrenome'];?></td>
			          <td>
			          	<?php if($value['status'] == 'E'){?>
				            <button type="button" class="btn btn-success btn-xs">
				            	<span>ENTREGUE</span>
				            </button>
				        <?php }else if($value['status'] == 'I'){?>

				            <button type="button" class="btn btn-danger btn-xs" title="Remover">
				              	<span>NÃO INICIADO</span>
				            </button>

				        <?php } else{?>
				            <button type="button" class="btn btn-warning btn-xs" title="Alterar" data-toggle="modal" data-target="#myModal">
				              	<span>EM ANDAMENTO</span>
				            </button>
				        <?php }?>
			          </td>
			          <td><?php echo $value['total'];?></td>
			          <td>
			            <button type="button" class="btn btn-warning btn-xs" title="Alterar" data-toggle="modal" data-target="#myModal">
			              	<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			            </button>
			            <button type="button" class="btn btn-danger btn-xs" title="Remover">
			              	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			            </button>
			            <button type="button" class="btn btn-success btn-xs">
			            	<span class="glyphicon glyphicon-usd"></span>
			            </button>
			          </td>
			        </tr>
			        <?php endforeach;?>
			       	<tr class="nenhum-registro">
						<td colspan="6" style="text-align: center;">Nenhum pedido encontrado...</td>
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