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
	<script type="text/javascript" src="./js/permisos.js"></script>
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
			cargarEspec();
			diasAtencion();
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
	function cargarEspec() {
		var prof=getValue('txtID');
		oAjax.async=false;
		oAjax.request="customQuery&query=select a.idParamAgenda, e.idEspecialidad, e.Nombre, a.Modulo, a.Sobreturnos from Especialidades e inner join paramagenda a on e.idEspecialidad=a.idEspecialidad and a.idProfesional="+prof+" order by 2&tipo=Q";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				setValue('tbodyEspec','');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyEspec', false);
			OcultarColumnaTabla('tbodyEspec',0);
			OcultarColumnaTabla('tbodyEspec',1);
			AgregarBotonTabla('tbodyEspec', 2, 'redalert.png', 'borrarEspec', 0, true);
		}
	}
	function borrarEspec(id) {
		oAjax.request="customQuery&query=delete from paramagenda where idParamAgenda="+id+"&tipo=E";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText!='ok') {
				alert(data.responseText);
				return false;
			}
			cargarEspec();

		}
	}
	function showAddEspec(ventana) {
		var padre=document.getElementById(ventana).parentNode;
		$(padre).show();	
		$("#"+ventana)	.show();
		var prof=getValue('txtID');
		LlenarComboSQL('cboEspec', 'select idEspecialidad, Nombre from Especialidades where idEspecialidad not in (select idEspecialidad from paramagenda where idProfesional='+prof+')', false );

	}
	function cerrar(ventana) {
		var padre=document.getElementById(ventana).parentNode;
		$(padre).hide();
	}	
	function ingresarEspec() {
		var espec=getValue('cboEspec');
		var prof=getValue('txtID');
		var modulo=getValue('txtDuracion');
		var sobre=getValue('txtSobreturnos');

		oAjax.request="guardarParamAgenda&prof="+prof+"&espec="+espec+"&modulo="+modulo+"&sobre="+sobre;
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText!='ok') {
				alert(data.responseText);
				return false;
			}
			cargarEspec();
			cerrar('frmNuevaEspec');

		}

	}
	function diasAtencion(id) {
		if (id==undefined || id=='')
			id=getValue('txtID');

		oAjax.request="diasAtencion&prof="+id;
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				setValue('tbodyAtiende', '');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyAtiende', false);
			
			OcultarColumnaTabla('tbodyAtiende',0);
			OcultarColumnaTabla('tbodyAtiende',1);
			OcultarColumnaTabla('tbodyAtiende',3);
			OcultarColumnaTabla('tbodyAtiende',5);
			AgregarBotonTabla('tbodyAtiende', 2, 'redalert.png', 'borrarAtiende', 0, true);
		}

	}

	function borrarAtiende(id) {
		oAjax.request="customQuery&query=delete from profatiende where idProfAtiende="+id+"&tipo=E";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText!='ok') {
				alert(data.responseText);
				return false;
			}
			diasAtencion();

		}		
	}

	function showAddAtiende() {
		var padre=document.getElementById('frmNuevaAtiende').parentNode;
		$(padre).show();		
		$("#frmNuevaAtiende").show();

	}

	function ingresarAtencion() {
		var dia=getValue('cboAtDia');
		var mod=getValue('cboAtModulo');
		var cons=getValue('cboAtCons');
		var prof=getValue('txtID');

		oAjax.request="ingresarAtencion&prof="+prof+"&mod="+mod+"&dia="+dia+"&cons="+cons;
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText!='ok') {
				alert(data.responseText);
				return false;
			}
			diasAtencion();
			cerrar('frmNuevaAtiende');

		}		
	}
	</script>
</head>
<body>
	<div class="fondonegro" style="display:none;">
		<div id="frmNuevaEspec" class="ventana" style="display:none">
			<h2>Agregar especialidad</h2>
			<table id="tblNEspec">
				<tr>
					<td>Especialidad a agregar:</td>
					<td><select id="cboEspec"></select></td>
				</tr>
				<tr>
					<td>Duración del turno:</td>
					<td><input type="number" id="txtDuracion"></td>
				</tr>
				<tr>
					<td>Sobreturnos permitidos:</td>
					<td><input type="number" id="txtSobreturnos"></td>
				</tr>

				<tr>
					<td colspan="2" align="center">
						<button class="botonok" type="button" onclick="ingresarEspec();">Aceptar</button>
						<button class="botoncancel" type="button" onclick="cerrar('frmNuevaEspec');">Cancelar</button>
					</td>
				</tr>
			</table>
		</div>
		<div id="frmNuevaAtiende" class="ventana" style="display:none">
			<h2>Agregar día de atención</h2>
			<table id="tblNAtencion">
				<tr>
					<td>Día de atención:</td>
					<td><select id="cboAtDia">
						<option value="1">Lunes</option>
						<option value="2">Martes</option>
						<option value="3">Miércoles</option>
						<option value="4">Jueves</option>
						<option value="5">Viernes</option>
						<option value="6">Sábado</option>
						<option value="7">Domingo</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Módulo:</td>
					<td><select id="cboAtModulo"><option value="1">Mañana</option><option value ="2">Tarde</option></select></td>
				</tr>
				<tr>
					<td>Consultorio:</td>
					<td><select id="cboAtCons"></select></td>
					<script type="text/javascript">
						LlenarComboSQL('cboAtCons', 'select idConsultorio, Nombre from consultorios order by 2', false);
					</script>
				</tr>

				<tr>
					<td colspan="2" align="center">
						<button class="botonok" type="button" onclick="ingresarAtencion();">Aceptar</button>
						<button class="botoncancel" type="button" onclick="cerrar('frmNuevaAtiende');">Cancelar</button>
					</td>
				</tr>
			</table>
		</div>

	</div>
	<? include('header.php'); ?>
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
		<table id="tblEspec"  style="float:right;">
			<thead><col width="60%"><tr><th>Especialidades</th><th></th><th><a href="javascript:vodi(0);" onclick="showAddEspec('frmNuevaEspec');"><img src="./imagenes/nueva.png" width="24"></a></th></tr>
				<tr><th>Especialidad</th><th>Min x módulo</th><th>Sobreturnos</th></tr>
			</thead>

			<tbody id="tbodyEspec"></tbody>
		</table>
		<table id="tblAtiende">
			<thead>
				<col width="40%"><col width="30%"><col width="30%">
				<tr><th colspan="10">Días de atención</th></tr>
				<tr><th>Dia</th><th>Consultorio</th><th>Turno</th><th><a href="javascript:vodi(0);" onclick="showAddAtiende();"><img src="./imagenes/nueva.png" width="24"></a></th></tr>
			</thead>
			<tbody id="tbodyAtiende"></tbody>
		</table>
	</div>
	<script>cargarDatos();</script>
</body>
</html>