<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/consultorios.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript">
	function cargarDatos() {
		oAjax.request="cargarConsultorios";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				setValue('tbodyCons', '');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyCons', false);
			OcultarColumnaTabla('tbodyCons', 0);
			AgregarBotonTabla('tbodyCons', 1, '', 'editarDato', 0);
			AgregarEstiloTabla('tbodyCons','0*','1','','linkGral');
			//AgregarEstiloTabla('tbodyCons','0*','1','','linkCons');
		}
	}
	function cancel() {
		setValue('txtSup','');
		setValue('txtID','0');
		setValue('txtNombre','');
		$("#abm").hide();
	}

	function editarDato(id) {
		oAjax.request="customQuery&query=select * from Consultorios where idConsultorio="+id+"&tipo=Q";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				alert('No existe ese consultorio');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			setValue('txtID', obj[0].idConsultorio);
			setValue('txtNombre', obj[0].Nombre);
			setValue('txtSup', obj[0].m2);
			$("#abm").show();
			$("#cmdBorrar").show();

		}
	}
	function nuevoDato() {
		setValue('txtSup','');
		setValue('txtID','0');
		setValue('txtNombre','');
		$("#abm").show();
		$("#cmdBorrar").hide();

	}
	function borrarDato() {
		var id=getValue('txtID');
		if (!confirm('Confirma eliminar este consultorio y sus turnos?')) return false;

		oAjax.request="customQuery&query=delete from Consultorios where idConsultorio="+id+"&tipo=E";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText=="ok") {
				cargarDatos();
				$("#abm").hide();
			} else {
				alert(data.responseText);
			}
		}
	}
	function guardar() {
		var id=getValue('txtID');
		var nombre=getValue('txtNombre');
		var sup=getValue('txtSup');

		oAjax.request="customQuery&query=call SP_InsertConsultorio("+id+", '"+nombre+"', '"+sup+"')&tipo=E";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText=="ok") {
				cargarDatos();
				$("#abm").hide();
			} else {
				alert(data.responseText);
			}
		}

	}
	</script>
</head>
<body>
	<h3>Consultorios</h3>
	<div id="wrapper1">
		<button class="botonok" onclick="nuevoDato();">Agregar</button>
		<table id="tblConsultorios" class="tabla1">
			<thead>
				<tr><th>Consultorios</th></tr>
			</thead>
			<tbody id="tbodyCons"></tbody>
		</table>
		
	</div>
	<div id="abm" style="display:none;">
		<div>
			
			
		</div>
		<table id="tblABM">
			<tr>
				<td>Código</td>
				<td><input type="text" id="txtID" readonly="readonly"></td>
			</tr>
			<tr>
				<td>Nombre</td>
				<td><input type="text" id="txtNombre"></td>
			</tr>
			<tr>
				<td>Superficie</td>
				<td><input type="number" id="txtSup"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<button id="cmdAceptar" class="botonok" type="button" onclick="guardar();">Aceptar</button>
					<button id="cmdCancel" class="botonok" type="button" onclick="cancel();">Cancelar</button>
					<button id="cmdBorrar" class="botonok" onclick="borrarDato();">Eliminar</button>
				</td>
			</tr>
		</table>
	</div>
	<script>cargarDatos();</script>
</body>
</html>