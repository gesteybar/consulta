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
		oAjax.request=1;
	}
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
	<h3>Agenda diaria</h3>
	<div id="divFecha">
		<input id="txtFecha" type="date">
		<button onclick="cargarProf();" class="botonok" style="font-size:0.8em">Ver</button>
	</div>
	<div id="divAgenda">
		<div id="divProf">
			<thead><tr><th>Profesionales</th></tr></thead>
			<tbody id="tbodyProf"></tbody>
		</div>
		<div id="divTurnos">
			<thead></thead>
			<tbody id="tbodyTurnos"></tbody>
		</div>
	</div>

</body>

</html>