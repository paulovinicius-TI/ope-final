<?php
    include('../config.php');

    $data = array();
    //$id = +$_POST['id'];
    $acao = $_POST['acao'];

    switch ($acao){
        case 'editarF':
            $data['formulario'] = 'read';
            $data['acao'] = 'readForn';
            $func = MySql::conectar()->prepare("
                                SELECT *
                                FROM tb_fornecedor F
                                INNER JOIN tb_fornecedor_telefone T
                                ON idfornecedor = T.id_fornecedor
                                INNER JOIN tb_fornecedor_endereco E
                                ON idfornecedor = E.id_fornecedor
                                WHERE idfornecedor = ?
                            ");
            $func->execute(array(+$_POST['id']));
            $func = $func->fetchAll();
            foreach ($func as $key => $value) {
                $data['cnpj'] = $value['cnpj'];
                $data['id'] = $value['idfornecedor'];
                $data['nome'] = $value['fornecedor'];
                $data['email'] = $value['email'];
                $data['tel'] = $value['tel'];
                $data['endereco'] = $value['endereco'];
                $data['cidade'] = $value['cidade'];
                $data['bairro'] = $value['bairro'];
                $data['numero'] = $value['numero'];
                $data['estado'] = $value['estado'];
            }
            break;

        case 'updateF':
            $data['formulario'] = 'update';
            $data['situacao'] = 1;
            $func = MySql::conectar()->prepare("
                                UPDATE tb_fornecedor F
                                INNER JOIN tb_fornecedor_telefone T
                                ON idfornecedor = T.id_fornecedor
                                INNER JOIN tb_fornecedor_endereco E
                                ON idfornecedor = E.id_fornecedor
                                SET
                                    F.fornecedor = ?,
                                    F.cnpj = ?,
                                    F.email = ?,
                                    T.tel = ?,
                                    E.endereco = ?,
                                    E.numero = ?,
                                    E.cidade = ?,
                                    E.estado = 'SP',
                                    E.bairro = ?
                                WHERE idfornecedor = ?
                            ");

            $func->execute(array(
                trim($_POST['nome']),
                trim($_POST['cnpj']),
                trim($_POST['email']),
                trim($_POST['telefone']),
                trim($_POST['endereco']),
                trim($_POST['numero']),
                trim($_POST['cidade']),
                trim($_POST['bairro']),
                +$_POST['id']
            ));
            break;

        case 'readDeleteF':
            $data['formulario'] = 'read';
            $data['acao'] = 'deleteForn';
            $func = MySql::conectar()->prepare("
                                SELECT idfornecedor,fornecedor FROM `tb_fornecedor`
                                WHERE idfornecedor = ?
                            ");
            $func->execute(array(+$_POST['id']));
            $func = $func->fetch();
            $data['id'] = $func['idfornecedor'];
            $data['nome'] = $func['fornecedor'];
            break;

        case 'deleteF':
            $data['formulario'] = 'delete';
            $data['situacao'] = 1;
            $func = MySql::conectar()->prepare("
                UPDATE `tb_fornecedor`
                SET `status` = 0
                WHERE `idfornecedor` = ?
            ");
            $func->execute(array(+$_POST['id']));
            break;

        case 'cadastrarF':
            $data['formulario'] = 'cadastrar';
            $data['situacao'] = 1;
            $id = MySql::conectar()->prepare("
                SELECT idfornecedor from tb_fornecedor ORDER by idfornecedor DESC limit 1");

            $id->execute();
            $id = $id->fetch();
            $func = MySql::conectar()->prepare("  
                INSERT INTO tb_fornecedor (fornecedor,cnpj,email,status) VALUES (?,?,?,1);
                INSERT INTO tb_fornecedor_telefone (tel,id_fornecedor) VALUES (?,?);
                INSERT INTO tb_fornecedor_endereco (endereco,numero,cidade,estado,bairro,id_fornecedor) VALUES (?,?,?,'SP',?,?);
                ");

            //                INSERT INTO tb_fornecedor (nome,sobrenome,cpf,email,senha,id_cargo,status) VALUES (?,?,?,?,?,?,1);
            $func->execute(array(
                $_POST['nome'],
                $_POST['cnpj'],
                $_POST['email'],
                $_POST['telefone'],
                $id['idfornecedor']+1,
                $_POST['endereco'],
                $_POST['numero'],
                $_POST['cidade'],
                $_POST['bairro'],
                $id['idfornecedor']+1
            ));
            $data['situacao'] = 1;
            break;

    }

    die(json_encode($data));
?>                