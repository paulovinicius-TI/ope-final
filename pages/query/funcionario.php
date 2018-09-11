							<?php
								include('../../config.php'); 
								$clientes = MySql::conectar()->prepare("
									SELECT * FROM `tb_cliente` WHERE status != 0"
								);
								$clientes->execute();
								$clientes = $clientes->fetchAll();

								foreach ($clientes as $key => $value):
							?>
				        <tr>
				          <th><?php echo $value['cpf'] ?></th>
				          <td><?php echo $value['nome'] ?></td>
				          <td>
				          		<form method="post" style="display: inline-block;" class="teste">
				          			<input type="hidden" name="id" value="<?php echo $value['idcliente']; ?>"/>

				          			<input type="hidden" name="acao" value="editarC">
				          			<input type="hidden" name="formulario" value="pessoal">

						            <button class="btn btn-warning btn-xs" title="Alterar" data-toggle="modal" data-target="#myModal" type="submit">
					              		<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						            </button>
						        </form>
						        <form method="post" style="display: inline-block;" class="teste">
				          			<input type="hidden" name="id" value="<?php echo $value['idcliente']; ?>"/>

				          			<input type="hidden" name="acao" value="excluirC">
				          			<input type="hidden" name="formulario" value="pessoal">
				          			
						            <button class="btn btn-danger btn-xs" title="Remover" type="submit" data-toggle="modal" data-target="#myModal" type="submit">
						              	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						            </button>
					            </form>
				          </td>
				        </tr>
				    <?php endforeach;?>
				       	<tr class="nenhum-registro">
							<td colspan="6" style="text-align: center;">Nenhum cliente encontrado...</td>
						</tr>