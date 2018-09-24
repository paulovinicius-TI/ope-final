<div class="card-title mt-5 text-center">
   <h1>Cadastro de Pedido</h1>
   <table class="container-fluid">
   <tbody>
      <tr>
         <td>
            <?php 
            $client = MySql::conectar()->prepare("
                SELECT *
                FROM tb_cliente
                WHERE idcliente = ?"
            );
            $client->execute(array(+$_GET['id']));
            $func = MySql::conectar()->prepare("
                SELECT idfuncionario,nome
                FROM tb_funcionario
                WHERE idfuncionario = ?"
            );
            $func->execute(array(+$_SESSION['id']));
            $client = $client->fetch();
            $func = $func->fetch();
            ?>
            <form method="post" class="formatar">
               <input type="hidden" name="formulario" value="cliente">
               <input type="hidden" name="acao" value="cadastrarC">
               <fieldset>
                  <table>
                     <tr>
                        <td>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Cliente</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Nome" name="nome" class="form-control" type="text" disabled value="<?php echo $client['nome'];?>"></div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Atende</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Endereço" name="endereco" class="form-control" type="text" disabled value="<?php echo $func['nome'];?>"></div>
                           </div>
                        <td>
                           <div class="form-group">
                              <label class="col-md-4 control-label">CPF</label>
                              <div class="col-md-8 inputGroupContainer" >
                              <input placeholder="CPF" name="cpf" class="form-control" type="text" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" value="<?php echo $client['cpf'];?>" disabled></div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Total R$</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="valor" name="valor" class="form-control" type="text" disabled value="00,00"></div>
                           </div>
                        <td>
                     </tr>
                  </table>
               </fieldset>
            </form>
         </td>
      </tr>
   </tbody>
   </table>
</div>

<div class="w48 left" style="margin-top: 50px;">

   </div>
   <div class="w48 right"  style="margin-top: 50px;">
   <input id="pesquisaSlide" class="form-control left" placeholder="Pesquisar Produto" />
<div class="clear"></div>
<h1>Lista de produtos</h1>
         <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="list-thumbs">
                  <thead>
                    <tr>
                        <th>Cod</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preço em R$</th>
                        <th>Ação</th>
                    </tr>
                  </thead>
               <tbody>
                  <?php 
                     $produtos = MySql::conectar()->prepare("
                        SELECT idproduto, nome, qtd, preco_unit, status
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
                        <td><?php echo $value['qtd'];?></td>
                        <td><?php echo $value['preco_unit'];?></td>
                        <td>
                           <form method="post" style="display: inline-block;">
                              <input type="hidden" name="id" value="<?php echo $value['idproduto']; ?>"/>

                              <input type="hidden" name="acao" value="add">
                              <input type="hidden" name="formulario" value="produto">

                              <button class="btn btn-warning btn-xs" title="Adicionar produto" data-toggle="modal" data-target="#myModal" type="submit">
                                 A</span>
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
   <div class="clear"></div>