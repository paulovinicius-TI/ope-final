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

    die(json_encode($data));
?>