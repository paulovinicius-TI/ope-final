	<!-- Modal -->
				  <input id="pesquisaSlide" class="form-control left" placeholder="Pesquisar (Mês ou Ano)" />
				  <button type="submit" class="btn btn-primary salvar">Salvar</button>
				  <div class="clear"></div>
				  <h1 class="page-header">Controle de Lucro</h1>
				  <div class="table-responsive">
				    <table class="table table-striped table-bordered table-hover" id="list-thumbs">
				      	<thead>
					        <tr>
					          	<th>Fluxo</th>
					          	<th>Janeiro</th>
					          	<th>Fevereiro</th>
					          	<th>Março</th>
					          	<th>Abril</th>
					          	<th>Maio</th>
					          	<th>Junho</th>
					          	<th>Julho</th>
					          	<th>Agosto</th>
					          	<th>Setembro</th>
					          	<th>Outubro</th>
					          	<th>Novembro</th>
					          	<th>Dezembro</th>
					        </tr>
				      	</thead>
				      	<?php for ($i=0; $i < 10; $i++) { 
				      	echo '<tbody class="teste">
				        <tr>
				        	<th>Saldo Inicial</th>';
				      	for ($x = 0; $x <= 11; $x++) {
				          echo '<td><input type="number" name="SI'.$i.''.$x.'"></td>';
				        }  

				        echo '</tr>

				        <tr>
				        	<th>Receitas</th>';
				      	for ($x = 0; $x <= 11; $x++) {
				          echo '<td><input type="number" name="Re'.$i.''.$x.'"></td>';
				        }
				        
				        echo '</tr>

				        <tr>
				        	<th>Despezas</th>';
				      	for ($x = 0; $x <= 11; $x++) {
				          echo '<td><input type="number" name="De'.$i.''.$x.'"></td>';
				        }
				        echo '</tr>

				        <tr>
				        	<th>Lucro/Preju</th>';
				      	for ($x = 0; $x <= 11; $x++) {
				          echo '<td><input type="number" name="LP'.$i.''.$x.'"></td>';
				        };
				      }?>
				        
				        </tr>
				       	<tr class="nenhum-registro">
							<td colspan="6" style="text-align: center;">Nenhum Mês ou Ano encontrado...</td>
						</tr>
				      </tbody>
				    </table>
				</div>
				<div id="paginacao" class="w100">
					<ul class="pagination"></ul>
				</div>