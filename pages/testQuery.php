			  			
<pre>
			  			<?php
			  				include('../config.php');
			  				$funcionarios = MySql::conectar()->prepare("
                                SELECT *
                                FROM tb_funcionario F
                                INNER JOIN tb_cargo C
                                ON F.id_cargo = C.idcargo
                                INNER JOIN tb_telefone T
                                ON F.cpf = T.cpf
                                INNER JOIN tb_endereco E
                                ON E.cpf = F.cpf
                                WHERE idfuncionario = 1
			  				");
			  				$funcionarios->execute();
			  		
			  				$funcionarios = $funcionarios->fetchall();
			  				print_r($funcionarios);
			  			?>
</pre>