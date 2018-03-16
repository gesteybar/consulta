<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/pacientes.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script type="text/javascript" src="./js/permisos.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript">
	function cargarDatos(conFiltro) {
		
		if (conFiltro) {
			var nom=getValue('txtFilNombre');
			var ape=getValue('txtFilApellido');
			var dni=getValue('txtFilDNI');
			var prep=getValue('cboPrepaga');
			var hc=getValue('txtHC');
			oAjax.request="cargarPacientes&nom="+nom+"&ape="+ape+"&prep="+prep+"&dni="+dni+"&hc="+hc;
		} else {
			oAjax.request="cargarPacientes";
		}

		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				setValue('tbodyPaci', '');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyPaci', false);
			OcultarColumnaTabla('tbodyPaci', 0);
			OcultarColumnaTabla('tbodyPaci', 3);
			OcultarColumnaTabla('tbodyPaci', 4);
			OcultarColumnaTabla('tbodyPaci', 5);
			OcultarColumnaTabla('tbodyPaci', 6);
			AgregarBotonTabla('tbodyPaci', 1, '', 'editarDato', 0);
			AgregarBotonTabla('tbodyPaci', 2, '', 'editarDato', 0);
			AgregarEstiloTabla('tbodyPaci','0*','1','','linkGral');
			//AgregarEstiloTabla('tbodyCons','0*','1','','linkCons');
		}
	}
	function cancel() {
			setValue('txtID', 0);
			setValue('txtNombre', '');
			setValue('txtApellido', '');
			setValue('txtCelular', '');
			setValue('txtMail', '');
			setValue('txtNroDoc', '');
			setValue('txtSocio', '');
			setValue('cboPrepaga', '');
			setValue('txtFechaNac', '');
			setValue('txtFicha', '');
		$("#abm").hide();
	}

	function editarDato(id) {
		oAjax.request="customQuery&query=select * from pacientes where idPaciente="+id+"&tipo=Q";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				alert('No existe ese paciente');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			setValue('txtID', obj[0].idPaciente);
			setValue('txtNombre', obj[0].Nombre);
			setValue('txtApellido', obj[0].Apellido);
			setValue('txtCelular', obj[0].Celular);
			setValue('txtMail', obj[0].Mail);
			setValue('txtNroDoc', obj[0].DNI);
			setValue('txtSocio', obj[0].NroSocio);
			setValue('cboPrepaga', obj[0].idPrepaga);
			setValue('txtFechaNac', obj[0].FechaNac);
			setValue('txtFicha', obj[0].NroFicha);


			$("#abm").show();
			$("#cmdBorrar").show();

		}
	}
	function nuevoDato() {
		setValue('txtApellido','');
		setValue('txtNombre','');
		setValue('txtCelular','');
		setValue('txtMail','');
		setValue('txtID','0');
		setValue('txtNroDoc','');
		setValue('txtSocio','');
		setValue('txtFechaNac','');
		setValue('txtFicha','');
		$("#abm").show();
		$("#cmdBorrar").hide();

	}
	function borrarDato() {
		var id=getValue('txtID');
		if (!confirm('Confirma eliminar este paciente y sus turnos?')) return false;

		oAjax.request="customQuery&query=delete from pacientes where idPaciente="+id+"&tipo=E";
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
		var nom=getValue('txtNombre');
		var ape=getValue('txtApellido');
		var dni=getValue('txtNroDoc');
		var cel=getValue('txtCelular');
		var mail=getValue('txtMail');
		var fechaNac=getValue('txtFechaNac');
		var prep=getValue('cboPrepaga');
		var socio=getValue('txtSocio');
		var ficha=getValue('txtFicha');

		oAjax.request="customQuery&query=call SP_InsertPaciente("+id+", "+prep+", '"+ape+"', '"+nom+"','"+fechaNac+"','"+cel+"','"+mail+"','"+socio+"','"+dni+"', '"+ficha+"')&tipo=E";
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
	function mostrar(ventana) {
		var padre=document.getElementById(ventana).parentNode;
		$(padre).show();	
		$("#"+ventana).show();	
	}
	function cerrar(ventana, padre) {
		var p=document.getElementById(ventana).parentNode;
		if (padre)
			$(p).hide();		
		$("#"+ventana).hide();	
	}

	</script>
</head>
<body>
	<div class="fondonegro" style="display:none;">
		<div id="frmFiltrar" class="ventana">
			<h2>Filtrar pacientes<a href="javascript:void(0)" onclick="cerrar('frmFiltrar', true)"><img src="./imagenes/redalert.png" style="float:right;"></a></h2>
			<input type="hidden" id="hidTurno">
			<table>
				<tr>
					<td>Por Historia clínica</td>
					<td><input type="number" id="txtHC"></td>
				</tr>
				<tr>
					<td>Por apellido y nombre</td>
				</tr>
				<tr>
					<td><input type="text" id="txtFilApellido" placeholder="Apellido"><input type="text" id="txtFilNombre" placeholder="Nombre"></td>
				</tr>
				<tr>
					<td>Por Cobertura y Nro de socio</td>
				</tr>
				<tr>
					<td><select id="cboFilPrepaga"></select><input type="text" id="txtFilDNI" placeholder="Nro socio / DNI"></td>
					<script type="text/javascript">
						LlenarComboSQL('cboFilPrepaga', "select idPrepaga, Nombre from prepagas order by Nombre", true);
					</script>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<button class="botonok" id="cmdFilAceptar" type="button" onclick="cargarDatos(true);">Filtrar</button>
						<button class="botoncancel" id="cmdFilCancelar" type="button" onclick="cerrar('frmFiltrar',true)">Cancelar</button>
					</td>
				</tr>
			</table>
		</div>
	</div>

<? include('header.php'); ?>
	<h3>Pacientes</h3>
	<div id="wrapper1">
		<button class="botonok" onclick="nuevoDato();">Agregar</button>
		<button class="botonok" onclick="mostrar('frmFiltrar');">Filtrar</button>
		<table id="tblPacientes" class="tabla1">
			<thead>
				<tr><th colspan="2">Pacientes</th></tr>
			</thead>
			<tbody id="tbodyPaci"></tbody>
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
				<td>Apellido</td>
				<td><input type="text" id="txtApellido"></td>
			</tr>
			<tr>
				<td>Nro Ficha</td>
				<td><input type="text" id="txtFicha"></td>
			</tr>
			<tr>
				<td>Nro Doc.</td>
				<td><input type="text" id="txtNroDoc"></td>
			</tr>
			<tr>
				<td>Cobertura</td>
				<td><select id="cboPrepaga"></select></td>
				<script type="text/javascript">
					LlenarComboSQL('cboPrepaga', "select idPrepaga, Nombre from prepagas order by Nombre", false);
				</script>
			</tr>
			<tr>
				<td>Nro socio</td>
				<td><input type="text" id="txtSocio"></td>
			</tr>
			<tr>
				<td>Fecha Nac.</td>
				<td><input type="date" id="txtFechaNac"></td>
			</tr>
			<tr>
				<td>Celular</td>
				<td><input type="text" id="txtCelular"></td>
			</tr>
			<tr>
				<td>Mail</td>
				<td><input type="email" id="txtMail"></td>
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
	<script>
		<? if (!isset($_GET['id'])) {?>
			cargarDatos();
			<? } else {?>
				setValue('txtHC', '<?= $_GET['id'] ?>');
				cargarDatos(true);
			<?}?>

	</script>
</body>
</html>