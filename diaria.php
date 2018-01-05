<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//Dth HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dth">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/diaria.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript">
	function cargarProf() {
		var fecha=getValue('txtFecha');
		oAjax.request="profxdia&fecha="+fecha;
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				alert(data.responseText);
				return false;
			}
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyProf', false);
			OcultarColumnaTabla('tbodyProf', 0);
			AgregarBotonTabla('tbodyProf', 1, '', 'cargarTurnos', 0, false, 'profUnSelected');
		}
	}
	function cargarTurnos(id, obj) {
		espera('on');
		var fecha=getValue('txtFecha');
		var prof=id;
		setValue('hidProf', id);
		if (obj!=null) {
			var tbl=document.getElementById('tbodyProf');
			var as=tbl.getElementsByTagName('a');
			for (var i = 0; i < as.length; i++) {
				as[i].className="profUnSelected";
			}
			obj.className='profSelected';
		}
		oAjax.request="cargarTurnos&fecha="+fecha+"&Prof="+prof;
		oAjax.send(resp);

		function resp(data) {
			espera('off');
			if (data.responseText.length<3) {
				setValue('tbodyTurnos', '');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyTurnos', false);
			AgregarEstiloTabla('tbodyTurnos', '-1', '-1', 'color:red', '', 'AUSENTE', 8);
			AgregarEstiloTabla('tbodyTurnos', '-1', '-1', 'color:blue', '', 'TOMADO', 8);
			OcultarColumnaTabla('tbodyTurnos', 0);
			OcultarColumnaTabla('tbodyTurnos', 2);
			OcultarColumnaTabla('tbodyTurnos', 4);
			OcultarColumnaTabla('tbodyTurnos', 8);
			AgregarBotonTabla('tbodyTurnos', 1, '', 'mostrarAsignarTurno', 0);
			AgregarBotonTabla('tbodyTurnos', 1, 'menu2.png', 'showMenu', 0, true, 'icono');

		}
	}
	function mostrarAsignarTurno(id, obj) {
		setValue('txtHora', obj.innerText);

		if (obj.parentNode.parentNode.cells[0].innerText!="") {
			setValue('txtNombrePac', obj.parentNode.parentNode.cells[3].innerText);
			setValue('txtCelularPac', obj.parentNode.parentNode.cells[7].innerText);
			//setValue('txtMailPac', obj.parentNode.parentNode.cells[5].innerText);
			setValue('hidPaciente', obj.parentNode.parentNode.cells[2].innerText);
			setValue('hidTurno',obj.parentNode.parentNode.cells[0].innerText);
		}
		$("#frmNuevoTurno").parent().show();
		$("#frmNuevoTurno").show();
	}
	function buscarPaciente() {
		var tipo=getValue('cboDoc');
		var nro=getValue('txtDNI');
		var nom="";
		if (tipo=='N' && nro.indexOf(",")>0) {
			var s=nro.split(',');
			nro=s[0].trim();
			nom=s[1].trim();
		}

		oAjax.request="customQuery&query=Call SP_BuscarPaciente('"+tipo+"', '"+nro+"', '"+nom+"')&tipo=Q";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				if (confirm('Paciente no encontrado. Desea dar de alta al paciente?')) {
					altaPaciente();
				}
				return false;
			}			
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodySelecPac', false);	
			OcultarColumnaTabla('tbodySelecPac',6);
			AgregarBotonTabla('tbodySelecPac', -1, '','pickPaciente',0);
			$("#frmListaPacientes").show();
		}
	}

	function pickPaciente(id, obj) {
		//alert(obj.innerHTML);
		setValue('hidPaciente', id);
		setValue('txtNombrePac', obj.parentNode.parentNode.cells[1].innerText+" " +obj.parentNode.parentNode.cells[2].innerText);
		setValue('txtCelularPac', obj.parentNode.parentNode.cells[5].innerText);
		setValue('txtDNIPac', obj.parentNode.parentNode.cells[4].innerText);
		$('#frmListaPacientes').hide();

	}
	function cerrar(ventana) {
		$("#"+ventana).parent().hide();
		$("#"+ventana).hide();

	}
	function ingresarTurno() {
		var turno=getValue('hidTurno');
		var pac=getValue('hidPaciente');
		var nom=getValue('txtNombrePac');
		var ape=getValue('txtApellidoPac');
		var cel=getValue('txtCelularPac');
		var mail='';
		var fecha=getValue('txtFecha');
		var hora=getValue('txtHora');
		var espec='0';
		var prof=getValue('hidProf');
		var dni=getValue('txtDNIPac');
		var socio='';


		oAjax.request="ingresarTurno&turno="+turno+"&pac="+pac+"&nom="+nom+"&ape="+ape+"&cel="+cel+"&mail="+mail+"&fecha="+fecha+"&hora="+hora+"&espec="+espec+"&prof="+prof+"&dni="+dni+"&socio="+socio;
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText!='ok') {
				alert(data.responseText);
				return false;
			}
			cerrar('frmNuevoTurno');
			cargarTurnos(getValue('hidProf'), null);
		}

	}
	function altaPaciente() {
		$("#frmNuevoPaciente").parent().show();
		$("#frmNuevoPaciente").show();
		setValue('tbodySelecPac', '');
	}
	function ingresarPaciente() {
		var nom=getValue('txtNewNombre');
		var ape=getValue('txtNewApellido');
		var dni=getValue('txtNewDNI');
		var cel=getValue('txtNewCel');
		var prep='0';

		oAjax.request="ingresarPaciente&id=0&nom="+nom+"&ape="+ape+"&dni="+dni+"&cel="+cel+"&prep="+prep;
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText!='ok') {
				alert(data.responseText);
				return false;
			}
			//cerrar('frmNuevoTurno');
			//cargarTurnos(getValue('hidProf'), null);
			
		}		
	}
	function anularTurno(id) {
		if (!confirm("Confirma eliminar este turno de manera permanente?")) return false;

		oAjax.request="customQuery&query=delete from turnos where idTurno="+id+"&tipo=E";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText!='ok') {
				alert(data.responseText);
				return false;
			}
			
			cargarTurnos(getValue('hidProf'), null);
		}	
	}
	function marcarTurno(id, asistio) {
		if (!confirm("Confirma marcar estado de asistencia para este turno?")) return false;

		var estado=(asistio ? 'TOMADO' : 'AUSENTE');
		oAjax.request="customQuery&query=update turnos set Estado='"+estado+"' where idTurno="+id+"&tipo=E";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText!='ok') {
				alert(data.responseText);
				return false;
			}
			$("#ctxMenu").hide();
			cargarTurnos(getValue('hidProf'), null);
		}	

	}
	function fichaPaciente(id) {
		var idPac=BuscarDato('select idPaciente from turnos where idTurno='+id);
		location.href="./pacientes.php?id="+idPac;


	}
	</script>

<script type="text/javascript">

	function showMenu(id,obj) {
		setValue('hidMenuTurno', id);
		var rect = obj.getBoundingClientRect();
		//alert(rect.left);
		var div=document.getElementById('ctxMenu');
		div.style.position="absolute";
		div.style.display="inline-block";
		div.style.left=rect.left+"px";
		div.style.top=rect.top+"px";
		div.style.zIndex="10000";
		div.width="150px";
		div.height="auto";
		
		
	}
	$(document).mouseup(function(e) 
	{
	    var container = $("#ctxMenu");

	    // if the target of the click isn't the container nor a descendant of the container
	    if (!container.is(e.target) && container.has(e.target).length === 0) 
	    {
	        container.hide();
	    }
	});

</script>	
</head>
<body>
	<div class="fondonegro" style="display:none;">
		<div id="frmNuevoTurno" class="ventana">
			<h2>Nuevo turno</h2>
			<input type="hidden" id="hidTurno">
			<table id="tblNTur">
				<tr>
					<td>Hora:</td>
					<td><input type="time" id="txtHora" ></td>
				</tr>
				<tr>
					<td>Paciente:</td>
					<td colspan="4">
						<input type="hidden" id="hidPaciente">
					
					
						<select id="cboDoc"><option value="N">Nombre</option><option value="D">DNI</option><option value="S">Socio</option></select>
						<input id="txtDNI" type="text">
						<button id="cmdBuscarPaciente" type="button" class="botonok" onclick="buscarPaciente();"><img src="./imagenes/lupa.png"></button>
						<button id="cmdNuevoPaciente" type="button" class="botonok" onclick="altaPaciente();"><img src="./imagenes/nueva.png" width="16"></button>

					</td>
					</td>
				</tr>
				<tr>
					<td>Nombre:</td>
					<td><input class="label" type="text" id="txtNombrePac"></td>
					<td>Apellido:</td>
					<td><inpu class="label"t type="text" id="txtApellidoPac"></td>
				</tr>
				<tr>
					<td>Celular:</td>
					<td colspan="2"><input class="label" type="text" id="txtCelularPac"></td>
				</tr>
				<tr>
					<td>DNI/Nro Socio:</td>
					<td colspan="2"><input class="label" type="text" id="txtDNIPac"></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<button class="botonok" type="button" onclick="ingresarTurno();">Aceptar</button>
						<button class="botoncancel" type="button" onclick="cerrar('frmNuevoTurno');">Cancelar</button>
					</td>
				</tr>
			</table>
		</div>
		<div id="frmListaPacientes" class="ventana" style="z-index:10000;display:none;">
			<h2>Seleccionar paciente <a href="javascript:void(0)" onclick="$('#frmListaPacientes').hide();"><img src="./imagenes/redalert.png" style="float:right;"></a></h2>
			<table class="tabla1" id="tblSelecPac">
				<thead><tr><th>H. Clínica</th><th>Apellido</th><th>Nombre</th><th>Cobertura</th><th>Socio</th><th>Celular</th></tr></thead>
				<tbody id="tbodySelecPac"></tbody>
			</table>
		</div>
		<div id="frmNuevoPaciente" class="ventana" style="z-index:10000;display:none;">
			<h2>Ingresar paciente <a href="javascript:void(0)" onclick="$('#frmNuevoPaciente').hide();"><img src="./imagenes/redalert.png" style="float:right;"></a></h2>
			<table class="tabla1" id="tblNewPac">
				<tr>
					<td>Nombre</td><td>Apellido</td>
				</tr>
				<tr>
					<td><input type="text" id="txtNewNombre"></td>
					<td><input type="text" id="txtNewApellido"></td>
				</tr>
				<tr>
					<td>Celular</td><td>DNI/Socio</td>
				</tr>
				<tr>
					<td><input type="text" id="txtNewCel"></td>
					<td><input type="text" id="txtNewDNI"></td>					
				</tr>
				<tr>
					<td>
						<button id="cmdAceptarNC" class="botonok", onclick="ingresarPaciente()">Aceptar</button>
						<button class="botoncancel" onclick="$('#frmNuevoPaciente').hide();"">Cancelar</button>
					</td>
				</tr>
			</table>
		</div>		

	</div>
	<div class="contextMenu" id="ctxMenu" style="display:none;">
		<input type="hidden" id="hidMenuTurno">
		<ul>
			<li><a href="javascript:void(0);" onclick="anularTurno(getValue('hidMenuTurno')); ">Anular turno</a></li>
			<li><a href="javascript:void(0);" onclick="marcarTurno(getValue('hidMenuTurno'), true);">Marcar asistencia</a></li>
			<li><a href="javascript:void(0);" onclick="marcarTurno(getValue('hidMenuTurno'), false);">Marcar inasistencia</a></li>
			<li><a href="javascript:void(0);" onclick="fichaPaciente(getValue('hidMenuTurno'));">Ficha Paciente</a></li>
		</ul>
	</div>		
	<h3>Agenda diaria</h3>
	<input type="hidden" id="hidProf">
	<div id="divFecha">
		<input id="txtFecha" type="date">
		<button onclick="cargarProf();" class="botonok" style="font-size:0.8em">Ver</button>
	</div>
	<div id="divAgenda">
		<div id="divProf">
			<table id="tblProf">
			<thead><tr><th>Profesionales</th></tr></thead>
			<tbody id="tbodyProf"></tbody>
			</table>
		</div>
		<div id="divTurnos">
			<table id="tblTurnos" class="tabla1">
			<thead><tr><th>Hora</th><th>Paciente</th><th>Especialidad</th><th>DNI</th><th>Celular</th></tr></thead>
			<tbody id="tbodyTurnos"></tbody>
			</table>
		</div>
	</div>

<script type="text/javascript">
	var hoy=new DateTime();hoy.init();
	setValue('txtFecha',hoy.formats.compound.mySQL);

</script>
</body>

</html>