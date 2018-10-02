<div class="card-title mt-5 text-center">
   <h1>Cadastro de Pedido</h1>
   <table class="container-fluid">
   <tbody>
      <tr>
         <td>
            <?php 
              date_default_timezone_set('America/Sao_Paulo');
              $date = date('Y-m-d');
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


            $pedido = MySql::conectar()->prepare("
                SELECT *
                FROM tb_pedido
                WHERE status = 'C' AND id_funcionario = ?" // Não Alocado
            );
            $pedido->execute(array(+$_SESSION['id']));

            if($pedido->rowCount() == 1){
              $pedido = $pedido->fetch();
              
              $sql = MySql::conectar()->prepare("
                                UPDATE tb_pedido P
                                INNER JOIN tb_aux_pedido AP
                                ON P.idpedido = AP.id_pedido
                                SET
                                    P.clienteCad = 1,
                                    P.cliente = ?,
                                    AP.id_cliente = ?
                                WHERE idpedido = ?
                            ");

              $sql->execute(array(
                $client['nome'].' '.$client['sobrenome'],
                +$_GET['id'],
                +$pedido['idpedido']
              ));
            }else{
              $sql = MySql::conectar()->prepare("  
                  INSERT INTO tb_pedido(cliente,id_funcionario,status,clienteCad,total) VALUES (?,?,'C',1,0);
                  ");

              $sql->execute(array(
                  $client['nome'].' '.$client['sobrenome'],
                  $_SESSION['id']));

              $pedido = MySql::conectar()->prepare("  
                    SELECT *
                    FROM tb_pedido
                    WHERE status = 'C' AND id_funcionario = ?
                  ");

              $pedido->execute(array(
                  +$_SESSION['id']));

              $pedido = $pedido->fetch();

              $p = MySql::conectar()->prepare("  
                  INSERT INTO tb_aux_pedido(id_pedido,id_cliente) VALUES (?,?);
                  ");

              $p->execute(array(
                  $pedido['idpedido'],
                  $client['idcliente']));
            }
            ?>
            <form method="post" class="formatar">
               <input type="hidden" name="formulario" value="cliente">
               <input type="hidden" name="acao" value="cadastrarC">
               <fieldset>
                  <table>
                     <tr>
                        <td>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Nº Pedido</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Nome" name="nome" class="form-control" type="text" disabled value="<?php echo $pedido['idpedido'];?>"></div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Cliente</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Nome" name="nome" class="form-control" type="text" disabled value="<?php echo $client['nome'];?>"></div>
                           </div>
                        <td>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Atende</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Endereço" name="endereco" class="form-control" type="text" disabled value="<?php echo $func['nome'];?>"></div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label">CPF</label>
                              <div class="col-md-8 inputGroupContainer" >
                              <input placeholder="CPF" name="cpf" class="form-control" type="text" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" value="<?php echo $client['cpf'];?>" disabled></div>
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

<div class="w100 left" style="margin-top: 50px;">
   <table class="table" id="pedido">
     <thead class="thead-dark">
       <tr>
         <th scope="col">Cod</th>
         <th scope="col">Produto</th>
         <th scope="col">Quantidade</th>
         <th scope="col">Valor Unit.</th>
       </tr>
     </thead>
     <tbody>
      <?php 
         $produto = MySql::conectar()->prepare("
              SELECT *
              FROM tb_produto_pedido PED
              INNER JOIN tb_produto PROD
              ON PROD.idproduto = PED.id_produto
              WHERE id_pedido = ? AND PED.status != 0"
          );
          $produto->execute(array($pedido['idpedido']));
          $sql = MySql::conectar()->prepare("
            UPDATE tb_pedido P
            SET total = ?
            WHERE idpedido = ?
          ");
          $total = 0;
          $data = [];
          $produto = $produto->fetchAll();
          foreach ($produto as $key => $value):
            $total += $value['qtd'] * $value['preco_unit'];
            $data[$value['idproduto']] = $value['qtd'];
        ?>
        <tr>
         <th scope="row"><?php echo $value['idproduto']?></th>
         <td><?php echo $value['nome']?>
           <form method="post" style="display: inline-block;">
         </td>
         <td><?php echo $value['qtd']?>
              <input type="hidden" name="qtd" value=<?php echo $value['qtd'];?>>
         </td>
         <td><?php echo $value['preco_unit']?></td>
                  <td>
                    
                      <input type="hidden" name="idproduto" value="<?php echo $value['idproduto']; ?>"/>
                      <input type="hidden" name="idpedido" value="<?php echo $pedido['idpedido']; ?>"/>

                      <input type="hidden" name="acao" value="remover">
                      <input type="hidden" name="formulario" value="pedido">

                      <button class="btn btn-xs" title="Remover" type="submit">
                          x
                      </button>
                  </form>
                </td>
       </tr>
     <?php endforeach;
     $json_php = json_encode($data);
    $sql->execute(array($total, $pedido['idpedido']));
    ?>
     </tbody>
   </table>
   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"  >+ Produto</button>
   <?php if($total != 0):?>
     <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalCancelarPed"  >Desistir do Pedido</button>
     <button type="button" class="btn" onclick="gerarPedido(<?php echo $pedido['idpedido'].','.$_GET['id'];?>)">Gerar Pedido</button>
     <?php endif;?>
   <p class="right">Total: R$ <?php echo $total;?></p>
</div>
<div class="clear"></div>
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
          <h1>Lista de produtos</h1>
          <input id="pesquisaSlide" class="form-control left" placeholder="Pesquisar Produto" />
          <a href="<?php echo INCLUDE_PATH;?>CadastroProduto"><button type="button" class="btn btn-info right">+ Novo</button></a>
          <div class="clear"></div>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="list-thumbs">
              <thead>
                <tr>
                    <th>Cod</th>
                    <th>Nome</th>
                    <th>Estoque</th>
                    <th>Quantidade</th>
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
                    <th><form method="post" style="display: inline-block;">
                      <?php echo $value['idproduto'];?>
                    </th>
                    <td><?php echo $value['nome']?></td>
                    <td><?php echo $value['estoque'];?></td>
                    <td><input type="number" name="qtd"></td>
                    <td><?php echo $value['preco_unit'];?></td>
                    <td>
                      
                        <input type="hidden" name="idproduto" value="<?php echo $value['idproduto']; ?>"/>
                        <input type="hidden" name="idpedido" value="<?php echo $pedido['idpedido']; ?>"/>

                        <input type="hidden" name="acao" value="adicionar">
                        <input type="hidden" name="formulario" value="pedido">

                        <button class="btn btn-xs" title="Adicionar" type="submit">
                            <span class="glyphicon glyphicon-plus"></span>
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
      </div>
      <div id="paginacao" class="w100">
        <ul class="pagination"></ul>
      </div>
      <style type="text/css">
        .nota{width:30%;color:#fff;border: 0px solid green; padding: 10px;border-top-right-radius: 25px;}
      </style>
    <div class="nota"></div>
    </div>
  </div>   
</div>

<div class="modal fade" id="ModalCancelarPed" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h1>Desistir do pedido</h1>
      </div>
      <div class="modal-body">
        <p>Tem Certeza que deseja desistir deste pedido?</p>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalCancelarPed" onClick='cancelarPedido(<?php echo($pedido['idpedido'].','.$json_php);?>)'>Sim</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalCancelarPed">Não</button>
      </div>
    </div>
  </div>   
</div>

<script type="text/javascript">
  function cancelarPedido(idpedido,produtos){
    console.log(idpedido);
      $.ajax({
        url:'<?php echo INCLUDE_PATH;?>pages/DesistirPedido.php',
        method:'post',
        dataType: 'json',
        data: {'idpedido':idpedido,'produtos':produtos}
      }).done(function(data){
        alert("Pedido não gerado!");
        window.location.href = data.local;
      });
  }

  function gerarPedido(idpedido,idcliente){
      $.ajax({
        url:'<?php echo INCLUDE_PATH;?>pages/pedido.php',
        method:'post',
        dataType: 'json',
        data: {'idpedido':idpedido,'idcliente':idcliente,'type':1}
      }).done(function(data){
        alert("Pedido gerado com sucesso!");
        window.location.href = data.local;
      });
  }
</script>