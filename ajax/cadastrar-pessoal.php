<?php
    include('../config.php');

    $data = array();
    $acao = $_POST['acao'];

    $data['formulario'] = 'cadastrar-pessoal';
    $nome = trim($_POST['nome']);
    $sobrenome = trim($_POST['sobrenome']);
    $cpf = trim($_POST['cpf']);
    $tel = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);
    $numero = trim($_POST['numero']);
    $cidade = trim($_POST['cidade']);
    $bairro = trim($_POST['bairro']);

    switch ($acao){
        case 'cadastrarF':
            $email = trim($_POST['email']);
            $senha = trim($_POST['senha']);
            $cargo = +$_POST['cargo'];
            $func = MySql::conectar()->prepare("  
                INSERT INTO tb_funcionario (nome,sobrenome,cpf,email,senha,id_cargo,status) VALUES (?,?,?,?,?,?,1);
                INSERT INTO tb_telefone (tel,cpf) VALUES (?,?);
                INSERT INTO tb_endereco (endereco,numero,cidade,estado,bairro,cpf) VALUES (?,?,?,'SP',?,?);
                ");
            $func->execute(array(
                $nome,
                $sobrenome,
                $cpf,
                $email,
                $senha,
                $cargo,
                $tel,
                $cpf,
                $endereco,
                $numero,
                $cidade,
                $bairro,
                $cpf
            ));
            $data['situacao'] = 1;
            break;
        case 'cadastrarC':
            $func = MySql::conectar()->prepare("  
                INSERT INTO tb_cliente (nome,sobrenome,cpf,status) VALUES (?,?,?,1);
                INSERT INTO tb_telefone (tel,cpf) VALUES (?,?);
                INSERT INTO tb_endereco (endereco,numero,cidade,estado,bairro,cpf) VALUES (?,?,?,'SP',?,?);
                ");
            $func->execute(array(
                $nome,
                $sobrenome,
                $cpf,
                $tel,
                $cpf,
                $endereco,
                $numero,
                $cidade,
                $bairro,
                $cpf
            ));
            $data['situacao'] = 1;
            break;
    }

    die(json_encode($data));
?>