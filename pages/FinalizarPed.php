<?php
include('../config.php');
$data = array();
function FinalizarPedido($idpedido,$total,$pagamento){
        $sql = MySql::conectar()->prepare("
            UPDATE tb_pedido
            SET status = 'F'
            WHERE idpedido = ?
        ");

        $sql->execute(array($idpedido));

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d');

        $sql = MySql::conectar()->prepare("
            INSERT INTO tb_pedido_finalizado
            (id_pedido,total,data,pagamento) VALUES (?,?,?,?)"
        );
        $sql->execute(array($idpedido,$total,$date,$pagamento));
        return "http://localhost/ope-final/ListaPedidos";
}
$data['local'] = FinalizarPedido($_POST['idpedido'],$_POST['total'],$_POST['pagamento']);
die(json_encode($data));
?>
