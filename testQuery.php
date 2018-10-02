<pre>
<?php 
$id = 6;
                            include("config.php");
                            $funcionarios = MySql::conectar()->prepare("
                    UPDATE tb_produto
                    SET estoque = 5
                    WHERE idproduto = 1
                            ");
                            $funcionarios->execute();
                            //$funcionarios = $funcionarios->fetchAll();

                            //print_r($funcionarios);
       
?>
</pre>