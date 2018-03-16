<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/nomenclador.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script type="text/javascript" src="./js/permisos.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript">
		var hidPrevVal='';
		var currID=0;
	</script>
	<script type="text/javascript">
		function cerrar(ventana, padre) {
			$("#"+ventana).parent().hide();
			$("#"+ventana).hide();
		}
		function mostrar(ventana, padre) {
			$("#"+ventana).parent().show();
			$("#"+ventana).show();

		}
		function cargarDatos() {
			
		}
	</script>
</head>
<body>
<? include('header.php'); ?>
	<div class="fondonegro" style="display:none;">
		<div class="ventana" id="divNuevo">
			<h2>Nueva prestación</h2>
			
			<table id="tblNewCodigo">
				<tr>
					<td>Código</td>
					<td><input type="text" id="txtNewCodigo"></td>
				</tr>
				<tr>
					<td>Descripción</td>
					<td><input type="text" id="txtNewDesc"></td>
				</tr>
				<tr>
					<td colspan="2">
						<button type="button" class="botonok" onclick="guardarCodigo()">Aceptar</button>
						<button type="button" class="botoncancel" onclick="cerrar('divNuevo', true)">Cancelar</button>
						<button id="btnBorrar" style="margin-left:100px" type="button" class="botoncancel" onclick="borrarCodigo()">Eliminar</button>
					</td>
				</tr>
			</table>
			
		</div>
	</div>

	<h3>Nomenclador de prestaciones</h3>
	<div id="wrapper1">
		<div>
			<p id="lblFecha">Paciente <input type="text" id="txtPaciente" readonly="readonly"> 
			<input type="hidden" id="hidPaciente">
			<p id="lblFecha">Profesional <input type="text" id="txtProfesional" readonly="readonly"> 
			<input type="hidden" id="hidProf">
			<p id="lblFecha">Especialidad <select id="cboEsp"></select>
			
			<button class="botonok" type="button" style="font-size:0.8em" onclick="cargarCodigos();">Mostrar</button></p>
			
			
		</div>
		<div>
			<button class="botonok" type="button" onclick="nuevo();"><img width="32" src="./imagenes/nueva.png" title="Ingresar operación"></button>
			<button class="botonok" type="button" onclick="printDiv2('wrapper1', 'Nomenclador');"><img width="32" src="./imagenes/printer.png" title="Imprimir"></button>
			<button class="botonok" type="button" onclick="exportTableToCSV($('#tblCodigos'), 'Nomenclador');"><img width="32" src="./imagenes/guardar.png" title="Descargar"></button>
		</div>
		<table id="tblCodigos" class="tabla1">
			<thead>
				<tr><th>Codigo</th><th>Prestación</th></tr>
			</thead>
			<tbody id="tbodyCodigos">
				
			</tbody>
			<tfoot>

			</tfoot>
		</table>

	</div>
	<? 	if (isset($_GET)) {?>
			<script>	
				var prof=<?= $_GET['prof']; ?>;
				var pac=<?= $_GET['pac']; ?>;
				setValue('txtProfesional', BuscarDato('select Nombre from profesionales where idProfesional='+prof));
				setValue('txtPaciente', BuscarDato('select concat(Apellido, \' \', Nombre) Nombre from pacientes where idPaciente='+pac));
				cargarDatos();

				LlenarComboSQL('cboEsp', "SELECT a.idEspecialidad, e.Nombre FROM paramagenda a INNER JOIN especialidades e ON a.idEspecialidad=e.idEspecialidad WHERE a.idProfesional="+prof, true);
			</script>
		<?} ?>
	}
	
</body>
</html>