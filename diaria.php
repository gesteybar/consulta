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
			AgregarBotonTabla('tbodyProf', 1, '', 'cargarTurnos', 0);
		}
	}
	function cargarTurnos(id) {
		espera('on');
		var fecha=getValue('txtFecha');
		var prof=id;
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
			OcultarColumnaTabla('tbodyTurnos', 0);
			OcultarColumnaTabla('tbodyTurnos', 2);
			OcultarColumnaTabla('tbodyTurnos', 4);
			AgregarBotonTabla('tbodyTurnos', 1, 'menu2.png', 'showMenu', 0, true, 'icono');

		}
	}

	</script>

<script type="text/javascript">

	function showMenu(id,obj) {
		setValue('hidDoc', id);
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
		<div id="frmNuevoPeriodo" class="ventana">
			<h2>Nuevo período</h2>
			<table id="tblNPer">
				<tr>
					<td>Período a crear:</td>
					<td><input type="text" id="txtNuevoPeriodo" placeholder="MM/AAAA"></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<button class="botonok" type="button" onclick="ingresarPeriodo();">Aceptar</button>
						<button class="botoncancel" type="button" onclick="cerrar('frmNuevoPeriodo');">Cancelar</button>
					</td>
				</tr>
			</table>
		</div>

	</div>
	<div class="contextMenu" id="ctxMenu" style="display:none;">
		<input type="hidden" id="hidDoc">
		<ul>
			<li><a href="javascript:void(0);" onclick="">Mover turno</a></li>
			<li><a href="javascript:void(0);" onclick="">Anular turno</a></li>
			<li><a href="javascript:void(0);" onclick="">Marcar asistencia</a></li>
			<li><a href="javascript:void(0);" onclick="">Ficha Paciente</a></li>
		</ul>
	</div>		
	<h3>Agenda diaria</h3>
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

</body>

</html>