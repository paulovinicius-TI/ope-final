<pre>
<?php 
$id = 6;
include("config.php");
             $func = MySql::conectar()->prepare("SELECT *
                SELECT *
                FROM tb_produto P
                INNER JOIN tb_categoria C
                ON idcategoria = P.id_categoria
                INNER JOIN tb_fornecedor F
                ON idfornecedor = P.id_fornecedor
                WHERE idproduto = 1");

            $func->execute();
            $func = $func->fetch();
            //echo($func['idcliente']+1);
            print_r($func);

           /* foreach ($func as $key => $value) {
                            }*/
       
?>
</pre>