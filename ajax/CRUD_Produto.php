<?php
    include('../config.php');

    $data = array();
    $acao = $_POST['acao'];

    switch ($acao){
        case 'editarP':
            $data['formulario'] = 'read';
            $data['acao'] = 'readProd';
            $func = MySql::conectar()->prepare("
                SELECT *
                FROM tb_produto P
                INNER JOIN tb_categoria C
                ON idcategoria = P.id_categoria
                INNER JOIN tb_fornecedor F
                ON idfornecedor = P.id_fornecedor
                WHERE idproduto = ?"
            );
            $func->execute(array(+$_POST['id']));
            $func = $func->fetchAll();

            foreach ($func as $key => $value) {
                $data['id'] = $value['idproduto'];
                $data['categoria'] = $value['id_categoria'];
                $data['nome'] = $value['nome'];
                $data['qtd'] = $value['estoque'];
                $data['preco'] = $value['preco_unit'];
                $data['alerta_estoque'] = $value['alerta_estoque'];
                $data['fornecedor'] = $value['id_fornecedor'];
            }
            break;

        case 'updateP':
            $data['formulario'] = 'update';
            $data['situacao'] = 1;
            $func = MySql::conectar()->prepare("
                                UPDATE tb_produto P
                                INNER JOIN tb_categoria C
                                ON idcategoria = P.id_categoria
                                INNER JOIN tb_fornecedor F
                                ON idfornecedor = P.id_fornecedor
                                SET
                                    P.nome = ?,
                                    P.estoque = ?,
                                    P.id_fornecedor = ?,
                                    P.preco_unit = ?,
                                    P.alerta_estoque = ?,
                                    P.id_categoria = ?
                                WHERE idproduto = ?
                            ");
            $func->execute(array(
                trim($_POST['nome']),
                trim($_POST['qtd']),
                +$_POST['fornecedor'],
                trim($_POST['preco']),
                trim($_POST['alerta_estoque']),
                +$_POST['categoria'],
                +$_POST['id']
            ));
            break;

        case 'readDeleteP':
            $data['formulario'] = 'read';
            $data['acao'] = 'deleteProd';
            $func = MySql::conectar()->prepare("
                SELECT idproduto,nome
                FROM tb_produto
                WHERE idproduto = ?"
            );
            $func->execute(array(+$_POST['id']));
            $func = $func->fetch();
            $data['nome'] = $func['nome'];
            $data['id'] = $func['idproduto'];
            break;

        case 'deleteP':
            $data['formulario'] = 'delete';
            $data['situacao'] = 1;
            $func = MySql::conectar()->prepare("
                UPDATE tb_produto
                SET status = 0
                WHERE idproduto = ?
            ");
            $func->execute(array(+$_POST['id']));
            break;

        case 'cadastrarP':
            $data['formulario'] = 'cadastrar';
            $data['situacao'] = 1;
            /*$id = MySql::conectar()->prepare("
                SELECT idcliente from tb_cliente ORDER by idcliente DESC limit 1");

            $id->execute();
            $id = $id->fetch();*/
            $func = MySql::conectar()->prepare("  
                INSERT INTO tb_produto (nome,estoque,preco_unit,alerta_estoque,id_fornecedor,id_categoria, status) VALUES (?,?,?,?,?,?,1);
                ");
            $func->execute(array(
                trim($_POST['nome']),
                trim($_POST['qtd']),
                trim($_POST['preco']),
                trim($_POST['alerta_estoque']),
                +$_POST['fornecedor'],
                +$_POST['categoria']
            ));
            break;

    }

    die(json_encode($data));
?>