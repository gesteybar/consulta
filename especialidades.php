<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/especialidades.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript">
	function cargarDatos() {
		oAjax.request="cargarEspecialidades";
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
		setValue('txtCosto','0');
		setValue('txtID','0');
		setValue('txtNombre','');
		$("#abm").hide();
	}

	function editarDato(id) {
		oAjax.request="customQuery&query=select * from especialidades where idEspecialidad="+id+"&tipo=Q";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				alert('No existe esa especialidad');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			setValue('txtID', obj[0].idEspecialidad);
			setValue('txtNombre', obj[0].Nombre);
			setValue('txtCosto', obj[0].CostoMod);
			$("#abm").show();
			$("#cmdBorrar").show();

		}
	}
	function nuevoDato() {
		setValue('txtCosto','0');
		setValue('txtID','0');
		setValue('txtNombre','');
		$("#abm").show();
		$("#cmdBorrar").hide();

	}
	function borrarDato() {
		var id=getValue('txtID');
		if (!confirm('Confirma eliminar esta especialidad?')) return false;

		oAjax.request="customQuery&query=delete from especialidades where idEspecialidad="+id+"&tipo=E";
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
		var costo=getValue('txtCosto');

		oAjax.request="customQuery&query=call SP_InsertEspec("+id+", '"+nombre+"', '"+costo+"')&tipo=E";
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
	<h3>Especialidades</h3>
	<div id="wrapper1">
		<button class="botonok" onclick="nuevoDato();">Agregar</button>
		<table id="tblConsultorios" class="tabla1">
			<thead>
				<tr><th>Especialidades</th></tr>
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
				<td>Costo del módulo</td>
				<td><input type="number" id="txtCosto"></td>
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