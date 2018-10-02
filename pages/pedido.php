<?php
include('../config.php');
$data = array();
if(isset($_POST['cliente']) && empty($_POST['cliente']) == false)
	trocarNome($_POST['cliente'],$_POST['idpedido']);
//if(isset($_POST['idcliente']) && empty($_POST['idcliente']) == false)
function gerarPedido($idpedido,$type){
          $sql = MySql::conectar()->prepare("
            UPDATE tb_pedido
            SET status = 'A'
            WHERE idpedido = ?
          ");

          $sql->execute(array($idpedido));
          if($type == 1) return "http://localhost/ope-final/UpdatePedido?pedido=".$idpedido."&id=".$_POST['idcliente'];
          return "http://localhost/ope-final/Comanda?pedido=".$_POST['idpedido'];

}

function trocarNome($cliente,$idpedido){
          $sql = MySql::conectar()->prepare("
            UPDATE tb_pedido
            SET cliente = ?
            WHERE idpedido = ?
          ");

          $sql->execute(array($cliente,$idpedido));	
}
$data['local'] = gerarPedido($_POST['idpedido'],$_POST['type']);

die(json_encode($data));
?>
