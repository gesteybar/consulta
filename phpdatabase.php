<?
	$pEntorno="consulta";

	function GetConnection() {
		$dbi=mysqli_connect('200.85.158.85', 'gustavo', '42walloby', 'consulta');
			if (!$dbi)
			  die('No se puede conectar a la base de datos');

			mysqli_query($dbi,"SET NAMES 'utf8'"); 
			
			return $dbi;
	}
	function GetConnectionObj() {
		$dbi=new mysqli('200.85.158.85', 'gustavo', '42walloby', 'consulta');
			if ($dbi->connect_errno)
			  die('No se puede conectar a la base de datos');

			$dbi->query($dbi,"SET NAMES 'utf8'"); 
			
			return $dbi;
	}
	
?>