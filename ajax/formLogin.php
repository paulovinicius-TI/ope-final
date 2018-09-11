<?php

    include('../config.php');

    $data = array();
    $user = $_POST['email'];
    $password = $_POST['password'];

    $sql = Mysql::conectar()->prepare("
        SELECT *
        FROM tb_funcionario F
        INNER JOIN tb_cargo C
        ON F.id_cargo = C.idcargo
        WHERE email = ? AND senha = ?");

    $sql->execute(array($user,$password));

    if($sql->rowCount() == 1){
        $info = $sql->fetch();
        $_SESSION['login'] = true;
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $password;
        $_SESSION['name'] = $info['nome'].' '.$info['sobrenome'];
        $_SESSION['cargo'] = $info['cargo'];
        $data['situacao'] = 1;

    } else if($user == '' || $password == '') $data['situacao'] = 0;
      
      else $data['situacao'] = 2;

    die(json_encode($data));
?>