<pre>
<?php 
$id = 6;
include("config.php");
             $func = MySql::conectar()->prepare("
                                SELECT * 
                                FROM tb_cliente C
                                INNER JOIN tb_endereco E
                                ON C.cpf = E.cpf
                                INNER JOIN tb_telefone T
                                ON C.cpf = T.cpf
                                WHERE C.idcliente = 2");

            $func->execute();
            $func = $func->fetchAll();
            foreach ($func as $key => $value) {
                print_r($value);
            }
       
?>
</pre>