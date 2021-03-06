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
		$cadena="select Login, idUsuario, Nombre, Perfil, ProfAsoc from Usuarios where login='".$user."' and pass=MD5('".$pass."')";
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
					$_SESSION['perfil']=$f['Perfil'];
					$_SESSION['prof']=$f['ProfAsoc'];

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
		
		$usuario='';
		if ($usuario=='' || !isset($usuario) || $usuario==null) $usuario=$_SESSION['idUsuario'];
		$db=GetConnection();
		$cadena="SELECT Pagina
				FROM permisos p INNER JOIN modulos m ON p.idModulo=m.idModulo
				INNER JOIN usuarios u ON p.idUsuario=u.idUsuario where p.idModulo=".$mod." AND p.idUsuario=".$usuario;
		echo query($cadena, "Q", $db);
		break;	
	case 'cargarConsultorios':
		$cadena="select idConsultorio, Nombre from Consultorios";

		echo query($cadena, "Q", null);

		break;
	case 'cargarProfesionales':
		$cadena="select idProfesional, Nombre from profesionales order by 2";

		echo query($cadena, "Q", null);

		break;
	case 'cargarEspecialidades':
		$cadena="select idEspecialidad, Nombre from especialidades order by 2";

		echo query($cadena, "Q", null);

		break;		
	case 'cargarReportes':
		$cadena="select idReporte, Nombre from reportes order by 2";

		echo query($cadena, "Q", null);

		break;		
	case 'cargarUsuarios':
		$cadena="select idUsuario, Nombre from usuarios order by 2";

		echo query($cadena, "Q", null);

		break;		

	case 'cargarPermisos':
		$user=$_GET['id'];
		$cadena="SELECT m.idModulo, m.Nombre ,p.idPermiso
				FROM modulos m LEFT JOIN permisos p ON p.idModulo=m.idModulo AND p.idUsuario=$user order by 1";

		echo query($cadena, "Q", null);

		break;		
	case 'grant':
		$user=$_GET['user'];
		$mod=$_GET['modulo'];
		$tipo=$_GET['tipo'];

		if ($tipo=='on') {
			$cadena="insert into permisos (idUsuario, idModulo) values ($user, $mod)";
		} else {
			$cadena="delete from permisos where idUsuario=$user and idModulo=$mod";
		}
		echo query($cadena, "E", null);
		break;
	case 'cargarPacientes':
		if (sizeof($_GET)>1) {
			
			$nom=$_GET['nom'];
			$ape=$_GET['ape'];
			$prep=$_GET['prep'];
			$dni=$_GET['dni'];
			$hc=$_GET['hc'];
			if ($nom!='' || $ape!='') 
				$cadena="CALL SP_BuscarPaciente('N', '$ape', '$nom');";

			if ($prep!='' && $dni!='')
				$cadena="CALL SP_BuscarPaciente('S', '$dni', '$prep');";

			if ($hc!='')
				$cadena="CALL SP_BuscarPaciente('H', '$hc', NULL);";

		} else {
			
			$cadena="SELECT pa.idPaciente, pa.Apellido, pa.Nombre, pr.Nombre Prepaga, pa.NroSocio, pa.Celular, pa.Mail FROM pacientes pa LEFT JOIN prepagas pr ON pa.idPrepaga=pr.idPrepaga ORDER BY FechaAlta DESC, 2 ASC LIMIT 50";
		}


		echo query($cadena, "Q", null);

		break;
	case 'ingresarModulo':
		$periodo=$_GET['periodo'];
		$fecha=$_GET['fecha'];
		$prof=$_GET['prof'];
		$mod=$_GET['mod'];
		$esp=$_GET['esp'];
		$cons=$_GET['cons'];
		$desde=$_GET['desde'];
		$hasta=$_GET['hasta'];

		/*$cadena="insert into agenda (idEspecialidad, idConsultorio, idProfesional, Turno, Fecha, Periodo) values (
		$esp, $cons, $prof, $mod, '$fecha', '$periodo')";*/
		$cadena="Call SP_InsertAgenda($esp, $prof, $cons, $mod, '$fecha', '$periodo', '$desde', '$hasta')";

		echo query($cadena, "E", null);
		break;
	case 'disponibilizar':
		$fecha=$_GET['fecha'];
		$mod=$_GET['mod'];
		$cons=$_GET['cons'];

		$cadena="delete from agenda where idConsultorio='$cons' and Turno='$mod' and Fecha=str_to_date('$fecha', '%d/%m/%Y')";

		echo query($cadena, "E", null);
		break;
	case 'copiarPeriodo':
		$base=$_GET['base'];
		$periodo=$_GET['periodo'];

		$cadena="SP_CopiarPeriodo('$base', '$periodo');";

		echo query($cadena, 'E', null);
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

		echo query($cadena, "Q", null);
		break;
	case 'guardarParamAgenda':
		$prof=$_GET['prof'];
		$espec=$_GET['espec'];
		$modulo=$_GET['modulo'];
		$sobre=$_GET['sobre'];

		$cadena="insert into paramagenda (idProfesional, idEspecialidad, Modulo, Sobreturnos) values ($prof, $espec, '$modulo', '$sobre')";

		echo query($cadena, "E", null);
		break;
	case 'profxdia':
		$fecha=$_GET['fecha'];

		$cadena="SELECT distinct a.idProfesional, p.Nombre
				FROM agenda a LEFT JOIN profesionales p ON p.idProfesional=a.idProfesional
				WHERE a.Fecha='$fecha'";

		echo query($cadena, "Q", null);
		break;
	case 'diasAtencion':
		$prof=$_GET['prof'];
		$cadena="SELECT idProfAtiende, Dia, 
				CASE Dia WHEN 1 THEN 'Lunes' WHEN 2 THEN 'Martes' WHEN 3 THEN 'Miércoles' WHEN 4 THEN 'Jueves' WHEN 5 THEN 'Viernes' WHEN 6 THEN 'Sabado' WHEN 7 THEN 'Domingo' END DiaSem,
				pa.idConsultorio, c.Nombre, pa.Modulo, CASE pa.Modulo WHEN 1 THEN 'Mañana' WHEN 2 THEN 'Tarde' END Turno
				FROM profatiende pa INNER JOIN consultorios c ON pa.idConsultorio=c.idConsultorio 
				where pa.idProfesional=$prof";

		echo query($cadena, 'Q', null);
		break;
	case 'ingresarAtencion':
		$prof=$_GET['prof'];
		$cons=$_GET['cons'];
		$mod=$_GET['mod'];
		$dia=$_GET['dia'];

		$cadena="call SP_InsertAtencion($prof, $dia, $cons, $mod)";
		echo query($cadena, "E", null);
		break;
	case 'cargarTurnos':
		$fecha=$_GET['fecha'];
		$prof=$_GET['Prof'];

		$cadena="Call SP_LeerTurnos('$fecha',$prof,1);";

		echo query($cadena, "Q", null);
		break;
	case 'ingresarTurno':
		$turno=($_GET['turno']=='' ? '0': $_GET['turno']);
		$pac=($_GET['pac']=='' ? '0': $_GET['pac']);
		$nom=$_GET['nom'];
		$ape=$_GET['ape'];
		$cel=$_GET['cel'];
		$mail=$_GET['mail'];
		$fecha=$_GET['fecha'];
		$hora=$_GET['hora'];
		$espec=$_GET['espec'];
		$prof=$_GET['prof'];
		$dni=$_GET['dni'];
		$socio=$_GET['socio'];

		$cadena="call SP_InsertTurno ($turno, $pac, $espec, $prof, '$fecha', '$hora', '$nom', '$ape', '$dni', '$socio', '$cel', 'PENDIENTE');";

		echo query($cadena, "E", null);
		break;
	case 'ingresarPaciente':
		$id=($_GET['id'] == '' ? '0' : $_GET['id']);
		$prep=($_GET['prep'] == '' ? '0' : $_GET['prep']);
		$nom=$_GET['nom'];
		$ape=$_GET['ape'];
		$dni=$_GET['dni'];
		$cel=$_GET['cel'];
		$fecNac='';
		$mail='';
		$socio='';
		
		$cadena="call SP_InsertPaciente ($id, $prep, '$ape','$nom', '$fecNac', '$cel', '$mail', '$socio', '$dni')";
		$db=GetConnection();
		$resp=query($cadena, "E", $db);

		if ($resp=='ok') {
			$lastID=mysqli_insert_id($db);
			echo '{"respuesta":"ok", "id":"'.$lastID.'"}';
		} else {
			echo '{"respuesta":"'.mysqli_error($db).'"}';
		}
		break;
	case 'cargarMovimientos':
		$desde=$_GET['desde'];
		$hasta=$_GET['hasta'];

		$cadena="SELECT idCaja, date_format(Fecha, '%d/%m/%Y') Fecha, c.idConcepto, co.Nombre Concepto, c.idMediosPago, m.Nombre Medio, c.idUsuario, u.Nombre Usuario, 
				CASE c.Tipo WHEN 'E' THEN Importe ELSE 0 END Ingresos, CASE c.Tipo WHEN 'S' THEN Importe ELSE 0 END Salidas
				FROM caja c INNER JOIN conceptos co ON c.idConcepto=co.idConcepto
				INNER JOIN usuarios u ON c.idUsuario=u.idUsuario
				INNER JOIN mediospago m ON c.idMediosPago=m.idMediosPago
				WHERE Fecha BETWEEN '$desde' AND '$hasta'";

		echo query($cadena, 'Q', null);
		break;
	case 'guardarMovimiento':
		$fecha=$_GET['fecha'];
		$con=$_GET['con'];
		$importe=$_GET['importe'];
		$medio=$_GET['medio'];
		$usu=$_SESSION['idUsuario'];
		$desc=$_GET['desc'];
		$prof=$_GET['prof'];

		if ($prof!='') $desc=$prof;

		$cadena="insert into caja (idConcepto, idMediosPago, idUsuario, Fecha, Concepto, Importe, Periodo, FechaCarga, Tipo) values 
		($con, $medio, $usu, '$fecha', '$desc', '$importe', DATE_FORMAT('$fecha', '%m/%Y'), now(), (select Tipo from conceptos where idConcepto=$con))";

		echo query($cadena, 'E', null);

		break;
	case 'borrarPeriodo':
		$id=$_GET['id'];
		$cadena="delete from agenda where Periodo='$id'";

		echo query($cadena, 'E', null);		
		break;
	case 'turnosLibres':
		$idProf=$_GET['idProf'];
		$fecha=$_GET['fecha'];

		
		$cadena="Call SP_TurnosLibres($idProf,$fecha)";
		//die($cadena);
		query($cadena,'E', null);

		$cadena="SELECT Fecha, COUNT(1) libres, Paciente FROM tmpbuffer WHERE Paciente IS NULL GROUP BY Fecha, Paciente LIMIT 5";
		echo query($cadena,'Q', null);

		break; 
	case 'horarioLibre':
		$fecha=$_GET['fecha'];

		$cadena="select Hora from tmpbuffer where Fecha='$fecha' and Paciente is null";
		echo query($cadena, "Q", null);
		break;
	case 'leerNomenclador':
		$esp=$_GET['esp'];

		$cadena="select * from nomenclador where idEspecialidad=$esp";

		echo query($cadena, "Q", null);
		break;
	case 'guardarCodigo':
		$esp=$_GET['esp'];
		$codigo=$_GET['codigo'];
		$desc=$_GET['desc'];
		$id=$_GET['id'];

		$cadena="call SP_InsertCodigo($id, $esp, '$codigo','$desc')";

		echo query($cadena, 'E', null);

		break;
	case 'leerPrestaciones':
		$pac=$_GET['pac'];

		$cadena="";
		break;

}


