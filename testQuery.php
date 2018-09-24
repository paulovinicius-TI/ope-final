<pre>
<?php 
$id = 6;
                            include("config.php");
                            $funcionarios = MySql::conectar()->prepare("
                                SELECT *
                                FROM tb_funcionario F
                                INNER JOIN tb_cargo C
                                ON F.id_cargo = C.idcargo
                                WHERE F.status != 0
                            ");
                            $funcionarios->execute();
                            $funcionarios = $funcionarios->fetchAll();

                            print_r($funcionarios);
       
?>
</pre>