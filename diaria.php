<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//Dth HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dth">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/diaria.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript" src="./js/frame.js"></script>
	<script type="text/javascript" src="./js/permisos.js"></script>
	<script type="text/javascript">
	function cargarProf() {
		var fecha=getValue('txtFecha');
		oAjax.request="profxdia&fecha="+fecha;
		oAjax.async=false;
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
			AgregarBotonTabla('tbodyProf', 1, 'doctor.png', 'turnosLibres', 0, true, 'icono');
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
				$(as[i]).removeClass('profSelected');
				$(as[i]).addClass("profUnSelected");
			}
			$(obj).removeClass('profUnSelected');
			$(obj).addClass('profSelected');
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
			OcultarColumnaTabla('tbodyTurnos', 9);
			if (getValue('hidPaciente')=='')
				AgregarBotonTabla('tbodyTurnos', 1, '', 'mostrarAsignarTurno', 0);
			else 
				AgregarBotonTabla('tbodyTurnos', 1, '', 'asignarTurnoRapido', 1);
			AgregarBotonTabla('tbodyTurnos', 1, 'menu2.png', 'showMenu', 0, true, 'icono');

		}
	}
	function asignarTurnoRapido(id, obj) {
		var turno=getValue('hidTurno');
		var pac=getValue('hidPaciente');
		var nom="";
		var ape="";
		var cel="";
		var mail='';
		var fecha=getValue('txtFecha');
		var hora=id;
		var espec='0';
		var prof=getValue('hidProf');
		var dni="";
		var socio='';

		oAjax.request="ingresarTurno&turno="+turno+"&pac="+pac+"&nom="+nom+"&ape="+ape+"&cel="+cel+"&mail="+mail+"&fecha="+fecha+"&hora="+hora+"&espec="+espec+"&prof="+prof+"&dni="+dni+"&socio="+socio;
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText!='ok') {
				alert(data.responseText);
				return false;
			}
			//cerrar('frmNuevoTurno');
			setValue('hidPaciente', '');
			setValue('pPaciente', '');
			cargarTurnos(getValue('hidProf'), null);
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
		if (tipo=='N') {
				if (nro.indexOf(",")>0) {
					var s=nro.split(',');
					nro=s[0].trim();
					nom=s[1].trim();

				}
				if (nro.indexOf(" ")>0) {
					var s=nro.split(' ');
					nro=s[0].trim();
					nom=s[1].trim();					
				}
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
		setValue('txtNombrePac', obj.cells[2].innerText);
		setValue('txtApellidoPac', obj.cells[1].innerText);
		setValue('txtCelularPac', obj.cells[5].innerText);
		setValue('txtDNIPac', obj.cells[4].innerText);
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
			setValue('hidPaciente', '');
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
			if (data.responseText.length<3) {
				alert('dato vacío');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			if (obj.respuesta!='ok') {
				alert(obj.respuesta);
				return false;
			}

			//cerrar('frmNuevoTurno');
			//cargarTurnos(getValue('hidProf'), null);
			setValue('hidPaciente', obj.id);
			setValue('txtNombrePac', nom);
			setValue('txtApellidoPac', ape);
			setValue('txtCelularPac', cel);
			setValue('txtDNIPac', dni);
			$('#frmNuevoPaciente').hide();			
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
	function turnosLibres(idProf) {
		$("#divTurnosLibres").parent().show();
		$("#divTurnosLibres").show();
		setValue('hidProf', idProf);
		espera('on');
		oAjax.request="turnosLibres&idProf="+idProf+"&fecha="+getValue('txtFecha');
		oAjax.send(resp);

		function resp(data) {
			espera('off');
			if (data.responseText.length<3) {
				setValue('tbodyFechasLibres', '');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyFechasLibres', false);
			AgregarBotonTabla('tbodyFechasLibres', 0, '', 'mostrarHorarioLibre', 0);
		}
	}
	function mostrarHorarioLibre(fecha) {
		setValue('hidFechaLibre', fecha);
		oAjax.request="horarioLibre&fecha="+fecha;
		oAjax.send(resp);

		function resp(data) {
			
			if (data.responseText.length<3) {
				setValue('tbodyFechasLibres', '');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyHorariosLibres', false);
			AgregarBotonTabla('tbodyHorariosLibres', 0, '', 'setHorario', 0);
		}

	}
	function setHorario(id) {
		var fecha=getValue('hidFechaLibre');
		setValue('txtFecha', fecha);
		cargarProf();
		cargarTurnos(getValue('hidProf'), null);
		cerrar('divTurnosLibres');
		
	}
	</script>

<script type="text/javascript">

/*	function showMenu(id,obj) {
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
*/
function showMenu(id, objOrigen) {
	var rect = objOrigen.getBoundingClientRect();
	//console.log(rect.top, rect.right, rect.bottom, rect.left);	
	var jason=[{"Op":"Anular turno","Fc":"anularTurno("+id+")", "img":"redalert.png"},{"Op":"Marcar asistencia", "Fc":"marcarTurno('"+id+"', true)", "img":"on.png"},{"Op":"Marcar inasistencia", "Fc":"marcarTurno('"+id+"', false)", "img":"off.png"},{"Op":"Ficha paciente", "Fc":"fichaPaciente("+id+")", "img":"user.png"}];
	showPopup(jason, rect.left-100, rect.top, '','classPopup',document.getElementsByTagName('body')[0]);
}
</script>	
</head>
<body>
	<div class="fondonegro" style="display:none;">
		<div id="frmNuevoTurno" class="ventana" style="z-index:10000;display:none;">
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
					
					
						<select id="cboDoc"><option value="N">Apellido y Nombre</option><option value="D">DNI</option><option value="S">Socio</option><option value="H">Hist. Clínica</option></select>
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
					<td><input class="label"t type="text" id="txtApellidoPac"></td>
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
		<div id="divTurnosLibres" class="ventana" style="z-index:10000;display:none;">
			<h2>Buscar turnos libres</h2>
			<table class="tabla1" id="tblFechasLibres">
				<thead><col width="50%"><col width="50%"><tr><th>Fecha</th><th>Turnos libres</th></tr></thead>
				<tbody id="tbodyFechasLibres"></tbody>
			</table>
			<input type="hidden" id="hidFechaLibre">
			<table class="tabla1" id="tblHorariosLibres">
				<thead><col width="100%"><tr><th>Horario</th></tr></thead>
				<tbody id="tbodyHorariosLibres"></tbody>

			</table>
			<div style="text-align:center"><button class="botoncancel" type="button" onclick="cerrar('divTurnosLibres')">Cerrar</button></div>
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
	<? include('header.php'); ?>
	<h3>Agenda diaria</h3>
	<input type="hidden" id="hidProf">
	<div id="divFecha">
		<input id="txtFecha" type="date">
		<button onclick="cargarProf();" class="botonok" style="font-size:1em">Ver</button>
		<p class="texto" id="pPaciente" style="float:right;margin:0">Paciente: <span id="idPaciente"></span> - <span id="nomPaciente"></span></p>
	</div>
	<div id="divAgenda">
		<div id="divProf">
			<table id="tblProf" class="tabla2">
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

<? if (isset($_GET['fecha'])) {?>
		var fecha='<?= $_GET['fecha'] ?>';
		setValue('txtFecha', fecha);
		cargarProf();
		setValue('hidPaciente', '<?= $_GET['pac'] ?>');
		setValue('idPaciente', '<?= $_GET['pac'] ?>');
		var nombre=BuscarDato("select concat(Nombre, ' ', Apellido) nom from pacientes where idPaciente=<?= $_GET['pac'] ?>");
		setValue('nomPaciente', nombre);
		cargarTurnos(<?= $_GET['prof'] ?>, null);

<?}
?>
</script>
</body>

</html>