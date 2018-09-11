<?php
    include('../config.php');

    $data = array();
    $id = +$_POST['id'];
    $acao = $_POST['acao'];


    $data['formulario'] = 'pessoal';

    switch ($acao){
        case 'editarF':
            $func = MySql::conectar()->prepare("
                                SELECT *
                                FROM tb_funcionario F
                                INNER JOIN tb_cargo C
                                ON F.id_cargo = C.idcargo
                                INNER JOIN tb_telefone T
                                ON F.cpf = T.cpf
                                INNER JOIN tb_endereco E
                                ON E.cpf = F.cpf
                                WHERE idfuncionario = ?
                            ");
            $func->execute(array($id));
            $func = $func->fetchAll();
            foreach ($func as $key => $value) {
                $data['acao'] = 'editarF';
                $data['cpf'] = $value['cpf'];
                $data['id'] = $value['idfuncionario'];
                $data['nome'] = $value['nome'];
                $data['sobrenome'] = $value['sobrenome'];
                $data['cargo'] = $value['idcargo'];
                $data['tel'] = $value['tel'];
                $data['endereco'] = $value['endereco'];
                $data['cidade'] = $value['cidade'];
                $data['bairro'] = $value['bairro'];
                $data['numero'] = $value['numero'];
                $data['estado'] = $value['estado'];
            }
            break;

        case 'excluirF':
            $func = MySql::conectar()->prepare("
                                SELECT *
                                FROM `tb_funcionario`
                                INNER JOIN `tb_cargo`
                                ON id_cargo = idcargo
                                WHERE idfuncionario = ?
                            ");
            $func->execute(array($id));
            $func = $func->fetchAll();
            foreach ($func as $key => $value) {
                $data['id'] = $value['idfuncionario'];
                $data['acao'] = 'excluirF';
                $data['nome'] = $value['nome'].' '.$value['sobrenome'];
                $data['formulario'] = 'pessoal';
            }
            break;

        case 'editarC':
            $func = MySql::conectar()->prepare("
                SELECT *
                FROM tb_cliente C
                INNER JOIN tb_endereco E
                ON C.cpf = E.cpf
                INNER JOIN tb_telefone T
                ON C.cpf = T.cpf
                WHERE idcliente = ?"
            );
            $func->execute(array($id));
            $func = $func->fetchAll();
            foreach ($func as $key => $value) {
                $data['acao'] = 'editarC';
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

        case 'excluirC':
            $func = MySql::conectar()->prepare("SELECT * FROM `tb_cliente` WHERE idcliente = ?");
            $func->execute(array($id));
            $func = $func->fetchAll();
            foreach ($func as $key => $value) {
                $data['id'] = $value['idcliente'];
                $data['acao'] = 'excluirC';
                $data['nome'] = $value['nome'].' '.$value['sobrenome'];
            }
            break;

    }

    die(json_encode($data));
?>