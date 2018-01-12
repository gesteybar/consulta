<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/reportes.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript" src="./js/permisos.js"></script>
	<script type="text/javascript" src="./js/navegacion.js"></script>
	<script src="./js/RPT1.js?n=<?= rand(1,512); ?>"></script>
	<script type="text/javascript">
	function cargarDatos() {
		oAjax.request="cargarReportes";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				setValue('tbodyRep', '');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyRep', false);
			OcultarColumnaTabla('tbodyRep', 0);
			AgregarBotonTabla('tbodyRep', 1, '', 'verReporte', 0);
			AgregarEstiloTabla('tbodyRep','0*','1','','linkGral');
			//AgregarEstiloTabla('tbodyCons','0*','1','','linkCons');
		}		
	}
	function verReporte(id) {
		oAjax.request="customQuery&query=select idReporte, Nombre, Leyenda, Ruta, Script, idModulo from reportes where idReporte="+id+"&tipo=Q";
		//oAjax.async=false;
		oAjax.send(respReporte);

		function respReporte(data) {
			var obj =JSON.parse(data.responseText);

			if (checkAccess(obj[0].idModulo)==false) {
				alert('No posee acceso a este reporte');
				return false;
			}	


			//$("rptContainer").load(obj[0].Ruta);
			oAjax.server=obj[0].Ruta;
			oAjax.request="?id=0";
			oAjax.async=false;
			oAjax.send(respResultado);

			function respResultado(data) {
				setValue('rptContainer', data.responseText);
				setValue('rptTitulo',obj[0].Nombre);
				setValue('rptDesc', obj[0].Leyenda);

				rptInit(obj[0].idModulo);
			}
			
		}
	}
	</script>
</head>
<body>
	<div class="fondonegro" style="display:none;">
		<div id="frmNuevaEspec" class="ventana">
			<h2></h2>
		</div>

	</div>
	<? include('header.php'); ?>
	<h3>Reportes</h3>
	<div id="wrapper1">
		
		<table id="tblReportes" class="tabla1">
			<thead>
				<tr><th>Reportes disponibles</th></tr>
			</thead>
			<tbody id="tbodyRep"></tbody>
		</table>

	</div>
	<div id="abm" style="border:1px solid, green;margin-top:20px;">
		<input type="hidden" id="hidUsuario" value="<?= $_SESSION['idUsuario']; ?>">
		
		<div style="position:relative; overflow-y:auto">
			<h3  style="position:relative;display:block;margin:0;">Selección de datos</h3>
			<div id="rptMenu">
				<table id="tblMainMenu">
					<thead>
						<tr>
							<th colspan="3"></th>
						</tr>
					</thead>
					<tbody id="tblMenu"></tbody>
				</table>
				
			</div>
			<div id="rptContainer">
			
			</div>
		</div>
		
	</div>	
	<script>cargarDatos();</script>
</body>
</html>