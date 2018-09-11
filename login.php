<!DOCTYPE html>
<html>
<head>
	<title>Painel de controle</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH;?>css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<div class="box-login">
		<h2>Efetue o login</h2>
		<form method="post" id="login">
			<input type="text" name="email" placeholder="Login..."/>
			<input type="password" name="password" placeholder="Senha..." />
			<input type="submit" name="acao"/>
		</form>
	</div>

    <div class="sitLogin"></div><!--sucess-->
    <div class="overlay-load">
        <img src="<?php echo INCLUDE_PATH;?>images/loading.gif" />
    </div><!--overlay-load-->
    <script src="<?php echo INCLUDE_PATH;?>js/constantes.js"></script>
    <script src="<?php echo INCLUDE_PATH;?>js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo INCLUDE_PATH;?>js/formLogin.js"></script>
</body>
</html>