<?php
    include('../config.php');

    $data = array();
    //$id = +$_POST['id'];
    $acao = $_POST['acao'];

    switch ($acao){
        case 'editarC':
            $data['formulario'] = 'read';
            $data['acao'] = 'readCateg';
            $func = MySql::conectar()->prepare("
                                SELECT *
                                FROM tb_categoria 
                                WHERE idcategoria = ?
                            ");
            $func->execute(array(+$_POST['id']));
            $func = $func->fetchAll();
            foreach ($func as $key => $value) {
                $data['id'] = $value['idcategoria'];
                $data['nome'] = $value['categoria'];
            }
            break;

        case 'updateC':
            $data['formulario'] = 'update';
            $data['situacao'] = 1;
            $func = MySql::conectar()->prepare("
                                UPDATE tb_categoria C
                                SET
                                    C.categoria = ?
                                WHERE idcategoria = ?
                            ");

            $func->execute(array(
                trim($_POST['nome']),
                +$_POST['id']
            ));
            break;

        case 'readDeleteC':
            $data['formulario'] = 'read';
            $data['acao'] = 'deleteCateg';
            $func = MySql::conectar()->prepare("
                                SELECT idcategoria,categoria FROM `tb_categoria`
                                WHERE idcategoria = ?
                            ");
            $func->execute(array(+$_POST['id']));
            $func = $func->fetch();
            $data['id'] = $func['idcategoria'];
            $data['nome'] = $func['categoria'];
            break;

        case 'deleteC':
            $data['formulario'] = 'delete';
            $data['situacao'] = 1;
            $func = MySql::conectar()->prepare("
                UPDATE `tb_categoria`
                SET `status` = 0
                WHERE `idcategoria` = ?
            ");
            $func->execute(array(+$_POST['id']));
            break;

        case 'cadastrarC':
            $data['formulario'] = 'cadastrar';
            $data['situacao'] = 1;
            $id = MySql::conectar()->prepare("
                SELECT idcategoria from tb_categoria ORDER by idcategoria DESC limit 1");

            $id->execute();
            $id = $id->fetch();
            $func = MySql::conectar()->prepare("  
                INSERT INTO tb_categoria (categoria,status) VALUES (?,1);
                ");

            $func->execute(array(
                $_POST['nome']
            ));
            $data['situacao'] = 1;
            break;

    }

    die(json_encode($data));
?>                