<?php
    include('../config.php');
    $data = array();
    $id = +$_POST['id'];
    $acao = addslashes(trim($_POST['acao']));
    sleep(1);
    $data['formulario'] = 'salvar-pessoal';
    $data['id'] = $_POST['id'];
    switch($acao){
        case 'alterF':
            $func = MySql::conectar()->prepare("
                                UPDATE tb_funcionario F
                                INNER JOIN tb_cargo C
                                ON F.id_cargo = C.idcargo
                                INNER JOIN tb_telefone T
                                ON F.cpf = T.cpf
                                INNER JOIN tb_endereco E
                                ON F.cpf = E.cpf
                                SET
                                    F.nome = ?,
                                    F.sobrenome = ?,
                                    F.cpf = ?,
                                    F.id_cargo = ?,
                                    T.tel = ?,
                                    E.endereco = ?,
                                    E.numero = ?,
                                    E.cidade = ?,
                                    E.estado = 'SP',
                                    E.bairro = ?
                                WHERE F.idfuncionario = ?
                            ");
            $func->execute(array(
                trim($_POST['nome']),
                trim($_POST['sobrenome']),
                trim($_POST['cpf']),
                +$_POST['cargo'],
                trim($_POST['telefone']),
                trim($_POST['endereco']),
                trim($_POST['numero']),
                trim($_POST['cidade']),
                trim($_POST['bairro']),
                +$_POST['id']
            ));
            $data['situacao'] = 1;
            break;

        case 'alterC':
            $func = MySql::conectar()->prepare("
                                UPDATE tb_cliente C
                                INNER JOIN tb_endereco E
                                ON C.cpf = E.cpf
                                INNER JOIN tb_telefone T
                                ON C.cpf = T.cpf
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
                                WHERE C.idcliente = ?
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
            $data['situacao'] = 1;
            break;
    }

    die(json_encode($data));
?>