<?
session_name('cons');
session_start();

$consulta=$_GET['consulta'] or $_POST['consulta'];
$dateformat='%d/%m/%Y';
header('Access-Control-Allow-Origin: *');

include("phpdatabase.php");

function GrabarAccion($usuario, $pi, $accion) {
    $cadena="insert into Historial (Fecha, Usuario, PI, Accion) values (";
    $cadena.="NOW(), '".$usuario."', '".$pi."', '".$accion."');";
	
	$dbi=GetConnection();
    mysql_query($dbi,$cadena);
}
function nombreArchivo($archivo) {
	$ult=strrpos($archivo, '/');
	if (!$ult) 
		$nombre=substr($archivo, $ult);	
	else
		$nombre=substr($archivo, $ult+1);
	return $nombre;
}
function extensionArchivo($archivo) {
	$ult=strrpos($archivo, '.');
	if (!$ult) 
		$nombre=substr($archivo, $ult);	
	else
		$nombre=substr($archivo, $ult+1);
	return $nombre;
}
function toJSON($r) {
	if (mysqli_num_rows($r)==0) return '{}';

	$resp='[';

	$campos=mysqli_fetch_fields($r);
	
	while ($f=mysqli_fetch_array($r)) {
		$resp.='{';
		$i=0;
		foreach ($campos as $campo) {
			$resp.='"'.$campo->name.'":"'.$f[$i].'",';
			$i++;
		}
		
		
		$resp=substr($resp,0,strlen($resp)-1);
		$resp.="},";
		}
 	$resp=substr($resp,0,strlen($resp)-1);
 	$resp.="]";


	return $resp;

}
function query($q, $t, $db) {
		if (!isset($db) || $db=='' || $db == null)
			$db=GetConnection();

		//tipos: Q: query | E:Execution
		if ($t=='Q') {
			
			$r=mysqli_query($db,$q);
			if (mysqli_errno($db)!=0) 
				$resp='error: '.mysqli_error($db);
			else
				$resp=toJSON($r);

			
		} else {
			mysqli_query($db,$q);
			if (mysqli_errno($db)!=0) 
				$resp='error: '.mysqli_error($db);
			else
				$resp='ok';
		}

		return $resp;

}

switch ($consulta) {
	case 'customQuery':
		
		if (sizeof($_GET)>0) {
			$query=$_GET['query'];
			$tipo=$_GET['tipo'];
		} else {
			$query=$_POST['query'];
			$tipo=$_POST['tipo'];			
		}
		
		$resp=query($query, $tipo, null);
		echo $resp;
		break;
	case 'login':
		$user=$_GET['usuario'];
		$pass=$_GET['pass'];
		$cadena="select Login, idUsuario, Nombre from Usuarios where login='".$user."' and pass=MD5('".$pass."')";
		//die($cadena);
		$db=GetConnection();
		$r=mysqli_query($db, $cadena);
		if (mysqli_num_rows($r)==0) 
			echo 'error '.mysqli_error($db);
		else
			if ($f=mysqli_fetch_assoc($r)) {
					$_SESSION['idUsuario']=$f['idUsuario'];
					$_SESSION['login']=$f['Login'];
					$_SESSION['nombre']=$f['Nombre'];

					echo 'ok';
			}
				
		break;
	case 'logoff':
		session_unset();
		session_destroy();
		echo 'ok';
		break;
	case 'cambiarPass':
		$usuario=$_GET['usuario'];
		$pass=$_GET['pass'];
		$idUsuario=$_GET['idUsuario'];

		if ($idUsuario=='')
			$cadena="update Usuarios set Pass=md5($pass), activo=1 where Login='$usuario'";
		else 
			$cadena="update Usuarios set Pass=md5($pass), activo=1 where idUsuario='$idUsuario'";

		echo query($cadena, 'E');

		break;
	case 'acceso':
		$mod=$_GET['modulo'];
		$nivel=$_GET['nivel'];
		$usuario=$_GET['usuario'];
		if ($usuario=='' || !isset($usuario) || $usuario==null) $usuario=$_SESSION['idUsuario'];
		$db=GetConnection();
		$cadena="select m.Pagina, FC_Permisos(".$usuario.",".$mod.") permiso, conv(FC_Permisos(".$usuario.",".$mod."),2,10) valor from Permisos p inner join Modulos m ON p.idModulo=m.idModulo WHERE p.idModulo=".$mod." AND idUsuario=".$usuario;
		$r=mysqli_query($db, $cadena);
		$f=mysqli_fetch_assoc($r);
		if (mysqli_errno($db)>0) 
			echo '{"respuesta":"'.mysqli_error($db).' - '. $cadena.'"}';
		else
			echo '{"respuesta":"'.$f['permiso'].'","decimal":"'.$f['valor'].'","ruta":"'.$f['Pagina'].'"}';
		break;	
	case 'cargarConsultorios':
		$cadena="select idConsultorio, Nombre from Consultorios";

		echo query($cadena, "Q", null);

		break;
	case 'cargarProfesionales':
		$cadena="select idProfesional, Nombre from profesionales";

		echo query($cadena, "Q", null);

		break;
	case 'cargarEspecialidades':
		$cadena="select idEspecialidad, Nombre from especialidades";

		echo query($cadena, "Q", null);

		break;		
	case 'ingresarModulo':
		$periodo=$_GET['periodo'];
		$fecha=$_GET['fecha'];
		$prof=$_GET['prof'];
		$mod=$_GET['mod'];
		$esp=$_GET['esp'];
		$cons=$_GET['cons'];

		/*$cadena="insert into agenda (idEspecialidad, idConsultorio, idProfesional, Turno, Fecha, Periodo) values (
		$esp, $cons, $prof, $mod, '$fecha', '$periodo')";*/
		$cadena="Call SP_InsertAgenda($esp, $prof, $cons, $mod, '$fecha', '$periodo')";

		echo query($cadena, "E");
		break;
	case 'leerAgenda':
		$periodo=$_GET['periodo'];
		$cons=$_GET['cons'];

		$cadena="SELECT a.Fecha, a.idAgenda, a.idEspecialidad, e.Nombre Especialidad, a.idProfesional,p.Nombre Profesional, a.Turno
				FROM agenda a
				INNER JOIN profesionales p ON a.idProfesional=p.idProfesional
				INNER JOIN especialidades e ON a.idEspecialidad=e.idEspecialidad
				WHERE a.idConsultorio=$cons
				AND a.Periodo='$periodo'";

		echo query($cadena, "Q");
		break;

}


