<?
	$pEntorno="consulta";

	function GetConnection() {
		$dbi=mysqli_connect('localhost', 'root', '', 'consulta');
			if (!$dbi)
			  die('No se puede conectar a la base de datos');

			mysqli_query($dbi,"SET NAMES 'utf8'"); 
			
			return $dbi;
	}
	function GetConnectionObj() {
		$dbi=new mysqli('localhost', 'root', '', 'consulta');
			if ($dbi->connect_errno)
			  die('No se puede conectar a la base de datos');

			$dbi->query($dbi,"SET NAMES 'utf8'"); 
			
			return $dbi;
	}
	
?>