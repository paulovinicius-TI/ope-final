<?php 
	session_start();
	$autoload = function($class){

		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	define('INCLUDE_PATH','http://localhost/ope-final/');
	
	//Conectar com banco de dados
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE', 'ope');


	//Funções
	function getCargo($cargo){
		$arr = ['1' => 'Administrador'];
		$arr['2'] = 'Atendente';
		$arr['3'] = 'Cozinheiro';
		
		return $arr[$cargo];
	}
?>