<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/profesionales.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript">
	function cargarDatos() {
		oAjax.request="cargarProfesionales";
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
		oAjax.request="customQuery&query=select * from profesionales where idProfesional="+id+"&tipo=Q";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				alert('No existe ese profesional');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			setValue('txtID', obj[0].idProfesional);
			setValue('txtNombre', obj[0].Nombre);
			setValue('txtMat', obj[0].Matricula);
			setValue('txtVenc', obj[0].FechaVenc);
			setValue('cboDocComp', obj[0].DocCompleta);
			$("#abm").show();
			$("#cmdBorrar").show();

		}
	}
	function nuevoDato() {
		setValue('txtMat','');
		setValue('txtID','0');
		setValue('txtNombre','');
		setValue('txtVenc','');
		setValue('cboDocComp','');
		$("#abm").show();
		$("#cmdBorrar").hide();

	}
	function borrarDato() {
		var id=getValue('txtID');
		if (!confirm('Confirma eliminar este profesional y sus turnos?')) return false;

		oAjax.request="customQuery&query=delete from profesionales where idProfesional="+id+"&tipo=E";
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
		var mat=getValue('txtMat');
		var venc=getValue('txtVenc');
		var f=new DateTime; f.init(venc, 'ymd');
		var doccomp=getValue('cboDocComp');

		oAjax.request="customQuery&query=call SP_InsertProf("+id+", '"+nombre+"', '"+mat+"', '"+f.formats.compound.mySQL+"', '"+doccomp+"')&tipo=E";
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
	<h3>Profesionales</h3>
	<div id="wrapper1">
		<button class="botonok" onclick="nuevoDato();">Agregar</button>
		<table id="tblConsultorios" class="tabla1">
			<thead>
				<tr><th>Profesionales</th></tr>
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
				<td>Matrícula</td>
				<td><input type="text" id="txtMat"></td>
			</tr>
			<tr>
				<td>Fecha venc. Contrato</td>
				<td><input type="date" id="txtVenc"></td>
			</tr>
			<tr>
				<td>Documentación</td>
				<td><select id="cboDocComp"><option value="0">Ausente</option><option value="1">Incompleta</option><option value="2">Completa</option></select></td>
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