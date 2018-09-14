<?php
    include('../config.php');

    $data = array();
    $id = +$_POST['id'];
    $acao = $_POST['acao'];


    $data['formulario'] = 'pessoal';

    switch ($acao){
        case 'editarC':
            $func = MySql::conectar()->prepare("
                SELECT *
                FROM tb_cliente C
                INNER JOIN tb_cliente_endereco E
                ON C.idcliente = E.id_cliente
                INNER JOIN tb_cliente_telefone T
                ON C.idcliente = T.id_cliente
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