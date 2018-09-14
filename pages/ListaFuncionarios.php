<input id="pesquisaSlide" class="form-control left" placeholder="Pesquisar Funcionário" />
<a href="<?php echo INCLUDE_PATH;?>CadastroFuncionario"><button type="button" class="btn btn-info right">+ Novo</button></a>
<div class="clear"></div>
<h1 class="page-header">Lista de Funcionários</h1>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="list-thumbs">
			      	<thead>
				        <tr>
				          	<th>CPF</th>
				          	<th>Nome</th>
				          	<th>Cargo</th>
				          	<th>Ação</th>
				        </tr>
			      	</thead>
			  		<tbody>
			  			<?php 
			  				$funcionarios = MySql::conectar()->prepare("
								SELECT *
								FROM tb_funcionario F
								INNER JOIN tb_cargo C
								ON F.id_cargo = C.idcargo
								WHERE F.status != 0
			  				");
			  				$funcionarios->execute();
			  				$funcionarios = $funcionarios->fetchAll();

			  				foreach ($funcionarios as $key => $value):
			  			?>
			    		<tr>
				          	<th><?php echo $value['cpf'];?></th>
				          	<td><?php echo $value['nome'].' '.$value['sobrenome'];?></td>
				          	<td><?php echo $value['cargo'];?></td>
				          	<td>
				          		<form method="post" style="display: inline-block;">
				          			<input type="hidden" name="id" value="<?php echo $value['idfuncionario']; ?>"/>

				          			<input type="hidden" name="acao" value="editarF">
				          			<input type="hidden" name="formulario" value="funcionario">

						            <button class="btn btn-warning btn-xs" title="Alterar" data-toggle="modal" data-target="#myModal" type="submit">
					              		<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						            </button>
						        </form>
						        <form method="post" style="display: inline-block;">
				          			<input type="hidden" name="id" value="<?php echo $value['idfuncionario']; ?>"/>

				          			<input type="hidden" name="acao" value="readDeleteF">
				          			<input type="hidden" name="formulario" value="funcionario">

						            <button class="btn btn-danger btn-xs" title="Remover" type="submit" data-toggle="modal" data-target="#myModal" type="submit">
						              	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						            </button>
					            </form>
			      			</td>
			    		</tr>
			    		<?php endforeach;?>
				       	<tr class="nenhum-registro">
							<td colspan="6" style="text-align: center;">Nenhum funcionário encontrado...</td>
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
