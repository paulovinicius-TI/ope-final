<?php
include('../config.php');
$data = array();
function cancelarPedido($idpedido){

         $produto = MySql::conectar()->prepare("
              SELECT *
              FROM tb_produto_pedido PED
              INNER JOIN tb_produto PROD
              ON PROD.idproduto = PED.id_produto
              WHERE id_pedido = ? AND PED.status != 0"
          );
          $produto->execute(array($idpedido));
          $prod = [];

          foreach ($produto as $key => $value){
            $prod[$value['idproduto']] = $value['qtd'];
            }

          foreach ($prod as $key => $value) {
            $produto = MySql::conectar()->prepare("
                SELECT estoque
                FROM tb_produto
                WHERE idproduto = ?"
            );
            $produto->execute(array($key));
            $produto = $produto->fetch();
            	$sql = MySql::conectar()->prepare("
                    UPDATE tb_produto
                    SET estoque = ?
                    WHERE idproduto = ?"
            	);
                $sql->execute(array($produto['estoque'] + +$value,+$key));

                $sql = MySql::conectar()->prepare("
                    UPDATE tb_produto_pedido
                    SET 
                        status = 0,
                        qtd = 0
                    WHERE id_pedido = ? AND id_produto = ?"
                );
                $sql->execute(array(+$idpedido,+$key));
	      }

         return "http://localhost/ope-final/ListaClientes";
}
$data['local'] = cancelarPedido($_POST['idpedido']);
die(json_encode($data));
?>
