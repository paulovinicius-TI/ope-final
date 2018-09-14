<?php
    include('../config.php');

    $data = array();
    $acao = $_POST['acao'];

    switch ($acao){
        case 'editarC':
            $data['formulario'] = 'read';
            $data['acao'] = 'readC';
            $func = MySql::conectar()->prepare("
                SELECT *
                FROM tb_cliente C
                INNER JOIN tb_cliente_endereco E
                ON idcliente = E.id_cliente
                INNER JOIN tb_cliente_telefone T
                ON idcliente = T.id_cliente
                WHERE idcliente = ?"
            );
            $func->execute(array(+$_POST['id']));
            $func = $func->fetchAll();

            foreach ($func as $key => $value) {
                $data['id'] = $value['idcliente'];
                $data['cpf'] = $value['cpf'];
                $data['nome'] = $value['nome'];
                $data['sobrenome'] = $value['sobrenome'];
                $data['tel'] = $value['tel'];
                $data['endereco'] = $value['endereco'];
                $data['cidade'] = $value['cidade'];
                $data['bairro'] = $value['bairro'];
                $data['numero'] = $value['numero'];
                $data['estado'] = $value['estado'];
            }
            break;

        case 'updateC':
            $data['formulario'] = 'update';
            $data['situacao'] = 1;
            $func = MySql::conectar()->prepare("
                                UPDATE tb_cliente C
                                INNER JOIN tb_cliente_endereco E
                                ON idcliente = E.id_cliente
                                INNER JOIN tb_cliente_telefone T
                                ON idcliente = T.id_cliente
                                SET
                                    C.nome = ?,
                                    C.sobrenome = ?,
                                    C.cpf = ?,
                                    T.tel = ?,
                                    E.endereco = ?,
                                    E.numero = ?,
                                    E.cidade = ?,
                                    E.estado = 'SP',
                                    E.bairro = ?
                                WHERE idcliente = ?
                            ");
            $func->execute(array(
                trim($_POST['nome']),
                trim($_POST['sobrenome']),
                trim($_POST['cpf']),
                trim($_POST['telefone']),
                trim($_POST['endereco']),
                trim($_POST['numero']),
                trim($_POST['cidade']),
                trim($_POST['bairro']),
                +$_POST['id']
            ));
            break;

        case 'readDeleteC':
            $data['formulario'] = 'read';
            $data['acao'] = 'deleteC';
            $func = MySql::conectar()->prepare("
                SELECT idcliente,nome,sobrenome
                FROM tb_cliente
                WHERE idcliente = ?"
            );
            $func->execute(array(+$_POST['id']));
            $func = $func->fetch();
            $data['nome'] = $func['nome'].' '.$func['sobrenome'];
            $data['id'] = $func['idcliente'];
            break;

        case 'deleteC':
            $data['formulario'] = 'delete';
            $data['situacao'] = 1;
            $func = MySql::conectar()->prepare("
                UPDATE `tb_cliente`
                SET `status` = '0'
                WHERE `idcliente` = ?
            ");
            $func->execute(array(+$_POST['id']));
            break;

        case 'cadastrarC':
            $data['formulario'] = 'cadastrar';
            $data['situacao'] = 1;
            $id = MySql::conectar()->prepare("
                SELECT idcliente from tb_cliente ORDER by idcliente DESC limit 1");

            $id->execute();
            $id = $id->fetch();
            $func = MySql::conectar()->prepare("  
                INSERT INTO tb_cliente (nome,sobrenome,cpf,status) VALUES (?,?,?,1);
                INSERT INTO tb_cliente_telefone (tel,id_cliente)
                VALUES (?,?);
                INSERT INTO tb_cliente_endereco (endereco,numero,cidade,estado,bairro,id_cliente) VALUES (?,?,?,'SP',?,?);
                ");
            $func->execute(array(
                trim($_POST['nome']),
                trim($_POST['sobrenome']),
                trim($_POST['cpf']),
                trim($_POST['telefone']),
                $id['idcliente']+1,
                trim($_POST['endereco']),
                trim($_POST['numero']),
                trim($_POST['cidade']),
                trim($_POST['bairro']),
                $id['idcliente']+1
            ));
            break;

    }

    die(json_encode($data));
?>