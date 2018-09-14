<?php
    include('../config.php');

    $data = array();
    //$id = +$_POST['id'];
    $acao = $_POST['acao'];

    switch ($acao){
        case 'editarF':
            $data['formulario'] = 'read';
            $data['acao'] = 'readF';
            $func = MySql::conectar()->prepare("
                                SELECT *
                                FROM tb_funcionario F
                                INNER JOIN tb_cargo C
                                ON F.id_cargo = C.idcargo
                                INNER JOIN tb_funcionario_telefone T
                                ON idfuncionario = T.id_funcionario
                                INNER JOIN tb_funcionario_endereco E
                                ON idfuncionario = E.id_funcionario
                                WHERE idfuncionario = ?
                            ");
            $func->execute(array(+$_POST['id']));
            $func = $func->fetchAll();
            foreach ($func as $key => $value) {
                $data['cpf'] = $value['cpf'];
                $data['id'] = $value['idfuncionario'];
                $data['nome'] = $value['nome'];
                $data['sobrenome'] = $value['sobrenome'];
                $data['email'] = $value['email'];
                $data['senha'] = $value['senha'];
                $data['cargo'] = $value['idcargo'];
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
            $data['TESTE'] = 'TESTE';
            $data['situacao'] = 1;
            $func = MySql::conectar()->prepare("
                                UPDATE tb_funcionario F
                                INNER JOIN tb_cargo C
                                ON F.id_cargo = C.idcargo
                                INNER JOIN tb_funcionario_telefone T
                                ON idfuncionario = T.id_funcionario
                                INNER JOIN tb_funcionario_endereco E
                                ON idfuncionario = E.id_funcionario
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
                                WHERE idfuncionario = ?
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
            break;

        case 'readDeleteF':
            $data['formulario'] = 'read';
            $data['acao'] = 'deleteF';
            $func = MySql::conectar()->prepare("
                                SELECT idfuncionario,nome,sobrenome FROM `tb_funcionario`
                                WHERE idfuncionario = ?
                            ");
            $func->execute(array(+$_POST['id']));
            $func = $func->fetch();
            $data['id'] = $func['idfuncionario'];
            $data['nome'] = $func['nome'].' '.$func['sobrenome'];
            break;

        case 'deleteF':
            $data['formulario'] = 'delete';
            $data['situacao'] = 1;
            $func = MySql::conectar()->prepare("
                UPDATE `tb_funcionario`
                SET `status` = '0'
                WHERE `idfuncionario` = ?
            ");
            $func->execute(array(+$_POST['id']));
            break;

        case 'cadastrarF':
            $data['formulario'] = 'cadastrar';
            $data['situacao'] = 1;
            $id = MySql::conectar()->prepare("
                SELECT idfuncionario from tb_funcionario ORDER by idfuncionario DESC limit 1");

            $id->execute();
            $id = $id->fetch();
            $func = MySql::conectar()->prepare("  
                INSERT INTO tb_funcionario (nome,sobrenome,cpf,email,senha,id_cargo,status) VALUES (?,?,?,?,?,?,1);
                INSERT INTO tb_funcionario_telefone (tel,id_funcionario) VALUES (?,?);
                INSERT INTO tb_funcionario_endereco (endereco,numero,cidade,estado,bairro,id_funcionario) VALUES (?,?,?,'SP',?,?);
                ");
            $func->execute(array(
                $_POST['nome'],
                $_POST['sobrenome'],
                $_POST['cpf'],
                $_POST['email'],
                $_POST['senha'],
                +$_POST['cargo'],
                $_POST['telefone'],
                $id['idfuncionario']+1,
                $_POST['endereco'],
                $_POST['numero'],
                $_POST['cidade'],
                $_POST['bairro'],
                $id['idfuncionario']+1
            ));
            $data['situacao'] = 1;
            break;

    }

    die(json_encode($data));
?>                