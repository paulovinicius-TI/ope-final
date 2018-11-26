<?php
    include('../config.php');

    $data = array();
    //$id = +$_POST['id'];
    $acao = $_POST['acao'];

    switch ($acao){
        case 'adicionar':
            $data['formulario'] = 'adicionarProd';
            $produto = MySql::conectar()->prepare("
                SELECT estoque
                FROM tb_produto
                WHERE idproduto = ?"
            );
            $produto->execute(array($_POST['idproduto']));
            $produto = $produto->fetch();

            if($produto['estoque'] >= +$_POST['qtd']){
                $sql = MySql::conectar()->prepare("
                    UPDATE tb_produto
                    SET estoque = ?
                    WHERE idproduto = ?"
                );
                $sql->execute(array($produto['estoque'] - +$_POST['qtd'],$_POST['idproduto']));

                $prod = MySql::conectar()->prepare("
                    SELECT id_produto, id_pedido, qtd FROM tb_produto_pedido WHERE id_pedido = ? AND id_produto = ?"
                );
                $prod->execute(array(+$_POST['idpedido'],+$_POST['idproduto']));

                if($prod->rowCount() == 1){
                    $prod = $prod->fetch();
                    $addQtd = MySql::conectar()->prepare("
                        UPDATE tb_produto_pedido
                        SET 
                                qtd = ?,
                                status = 1
                        WHERE id_pedido = ? AND id_produto = ?"
                    );
                    
                    $addQtd->execute(array($prod['qtd'] + +$_POST['qtd'],+$_POST['idpedido'],+$_POST['idproduto']));
                }else{
                    $prod = $prod->fetch();
                    $addQtd = MySql::conectar()->prepare("
                        INSERT INTO tb_produto_pedido
                        (qtd,id_pedido,id_produto,status) VALUES (?,?,?,1)"
                    );
                    $addQtd->execute(array($_POST['qtd'], +$_POST['idpedido'],+$_POST['idproduto']));
                }

                $data['situacao'] = 1;
            }

            break;

        case 'remover':
            $data['formulario'] = 'removerProd';
            $produto = MySql::conectar()->prepare("
                SELECT estoque
                FROM tb_produto
                WHERE idproduto = ?"
            );
            $produto->execute(array($_POST['idproduto']));
            $produto = $produto->fetch();

                $sql = MySql::conectar()->prepare("
                    UPDATE tb_produto
                    SET estoque = ?
                    WHERE idproduto = ?"
                );
                $sql->execute(array($produto['estoque'] + +$_POST['qtd'],+$_POST['idproduto']));

                $sql = MySql::conectar()->prepare("
                    UPDATE tb_produto_pedido
                    SET 
                        status = 0,
                        qtd = 0
                    WHERE id_pedido = ? AND id_produto = ?"
                );
                $sql->execute(array(+$_POST['idpedido'],+$_POST['idproduto']));
            $data['situacao'] = 1;

    }




$html = "        <div class='w100 left' style='margin-top: 50px;'>
          <table class='table' id='pedido'>
            <thead class='thead-dark'>
                <tr>
                  <th scope='col'>Cod</th>
                  <th scope='col'>Produto</th>
                  <th scope='col'>Quantidade</th>
                  <th scope='col'>Valor Unit.</th>
                </tr>
              </thead>
              <tbody>
        ";
                 $produto = MySql::conectar()->prepare('
                      SELECT *
                      FROM tb_produto_pedido PED
                      INNER JOIN tb_produto PROD
                      ON PROD.idproduto = PED.id_produto
                      WHERE id_pedido = ? AND PED.status != 0'
                  );
                  $produto->execute(array(+$_POST['idpedido']));

                  $sql = MySql::conectar()->prepare('
                    UPDATE tb_pedido P
                    SET total = ?
                    WHERE idpedido = ?
                  ');

                  $total = 0;
                  $produtos_add = array();

                  $produto = $produto->fetchAll();
                  foreach ($produto as $key => $value){
                    $total += $value['qtd'] * $value['preco_unit'];
                    $produtos_add[$value['idproduto']] = $value['qtd'];
            $html .= "
                <tr>
                  <th scope='row'>".$value['idproduto']."</th>
                  <td>".$value['nome']."
                  </td>
                  <td>".$value['qtd']."
                  </td>
                  <td>".$value['preco_unit']."</td>
                  <td>
                  <form method='post' style='display: inline-block;'>
                        <input type='hidden' name='qtd' value=".$value['qtd'].">    
                      <input type='hidden' name='idproduto' value='".$value['idproduto']."'/>
                      <input type='hidden' name='idpedido' value='".$_POST['idpedido']."'/>

                      <input type='hidden' name='acao' value='remover'>
                      <input type='hidden' name='formulario' value='pedido'>";

                      if($_POST['gerado'] == 1)
                        $html .= "<input type='hidden' name='gerado' value='1'>";
                      else if ($_POST['gerado'] == 2)
                        $html .= "<input type='hidden' name='gerado' value='2'>";
                      else
                        $html .= "<input type='hidden' name='gerado' value='0'>";
                      
                  $html .= "
                      <button class='btn btn-xs' title='Remover' type='submit'>
                         x
                      </button>
                    </form>
                  </td>
               </tr>";
                }
                  $json_php = json_encode($produtos_add);
                  $sql->execute(array($total, +$_POST['idpedido']));
             $html .= "
              </tbody>
           </table>
           <button type='button' class='btn btn-info' data-toggle='modal' data-target='#myModal'  >+ Produto</button>
           ";
           if($total != 0 && $_POST['gerado'] == 1){

            $html .= "
             <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#ModalCancelarPed'  >Cancelar Pedido</button>
             <button type='button' class='btn btn-success' data-toggle='modal' data-target='#fecharCompra' onclick='FinalizarCompra()'>Fechar compra</button>";
            }else if ($total != 0 && $_POST['gerado'] == 2){

              $html .= "
             <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#ModalCancelarPed'  >Desistir do Pedido</button>
             <button type='button' class='btn' onclick='gerarPedido(".$_POST['idpedido'].','.$_POST['cliente'].")'>Gerar Pedido</button>";

            }else if ($total != 0 && $_POST['gerado'] == 0) {
              $html .= "
     <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#ModalCancelarPed'  >Desistir do Pedido</button>
     <button type='button' class='btn' onclick='gerarPedido(".$_POST['idpedido'].")'>Gerar Pedido</button>";
            }
           

           $html .= "<p class='right'>Total: R$ <span class='total'>".$total."</span></p>
        </div>
        <div class='clear'></div>
      </div>
  </div>
</div>";

$data['html'] = $html;
die(json_encode($data));
?>