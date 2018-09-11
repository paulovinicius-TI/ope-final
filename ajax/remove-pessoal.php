<?php
    include('../config.php');

    $data = array();
    $id = +$_POST['id'];
    $acao = $_POST['acao'];

    $data['formulario'] = 'remove-pessoal';

    switch ($acao){
        case 'removeF':
			$func = MySql::conectar()->prepare("
				UPDATE `tb_funcionario`
				SET `status` = '0'
				WHERE `idfuncionario` = ?
			");
    		$func->execute(array($id));
    		$data['situacao'] = 1;
            break;

        case 'removeC':
            $func = MySql::conectar()->prepare("
                UPDATE `tb_cliente`
                SET `status` = '0'
                WHERE `idcliente` = ?
            ");
            $func->execute(array($id));
            $data['situacao'] = 1;
            break;
    }

    die(json_encode($data));
?>