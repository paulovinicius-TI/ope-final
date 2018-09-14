<pre>
<?php 
$id = 6;
include("config.php");
             $func = MySql::conectar()->prepare("
SELECT idcliente from tb_cliente ORDER by idcliente DESC limit 1");

            $func->execute();
            $func = $func->fetch();
            echo($func['idcliente']+1);
            print_r($func);

           /* foreach ($func as $key => $value) {
                            }*/
       
?>
</pre>