	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog" style="">
	    <div class="modal-dialog">
	    <!-- Modal content-->
		    <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Janeiro/2018</h4>
		        </div>
		        <div class="modal-body">
					<div class="box w100">
						  <div class="table-responsive">
						    <table class="table table-striped table-bordered table-hover">
						      	<thead>
							        <tr>
							          	<th>Dia</th>
							          	<th>Mês</th>
							          	<th>Total em R$</th>
							          	<!--<th>Ação</th>-->
							        </tr>
						      	</thead>
						      	<tbody>
						        <tr>
						          <th>01</th>
						          <td>Janeiro</td>
						          <td>R$ 5.000,30</td>
						          <!--<td>
						            <button type="button" class="btn btn-black btn-xs" title="Visualizar">
										<i class="fas fa-eye"></i>
						            </button>
						          </td>-->
						        </tr>
						      </tbody>
						    </table>
						</div>
					</div>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		        </div>
			</div>    
		</div>
	</div>




				


				  <input id="pesquisaSlide" class="form-control left" placeholder="Pesquisar (Mês ou Ano)" />
				  <div class="clear"></div>
				  <h1 class="page-header">Controle de Lucro</h1>
				  <div class="table-responsive">
				    <table class="table table-striped table-bordered table-hover" id="list-thumbs">
				      	<thead>
					        <tr>
					          	<th>Ano</th>
					          	<th>Mês</th>
					          	<th>Total em R$</th>
					          	<th>Ação</th>
					        </tr>
				      	</thead>
				      	<tbody>
				        <tr>
				          <th>2018</th>
				          <td>Janeiro</td>
				          <td>R$ 5.000,30</td>
				          <td>
				            <button type="button" class="btn btn-black btn-xs" title="Visualizar" data-toggle="modal" data-target="#myModal">
								<i class="fas fa-eye"></i>
				            </button>
				          </td>
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