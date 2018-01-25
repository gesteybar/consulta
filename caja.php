<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/caja.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script type="text/javascript" src="./js/permisos.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript">
	</script>
	<script type="text/javascript">
		function cerrar(ventana, padre) {
			$("#"+ventana).parent().hide();
			$("#"+ventana).hide();
		}
		function mostrar(ventana, padre) {
			$("#"+ventana).parent().show();
			$("#"+ventana).show();

		}
		function guardarMov() {
			var fecha=getValue('txtFecha');
			var con=getValue('cboConcepto');
			var importe=getValue('txtImporte');
			var desc=getValue('txtDesc');
			var prof=getValue('cboProf');
			var medio=1;
			var usaDesc=BuscarDato('select Adicional from conceptos where idConcepto='+con);

			if (importe<=0) {
				alert("El importe debe ser mayor que cero");
				return false;
			}
			if (usaDesc=='S' && desc=='')  {
				alert('Ingrese un detalle para este gasto');
				$("#txtDesc").focus();
				return false;
			}
			if (usaDesc=='P' && prof=='') {
				alert('Debe seleccionar el profesional que genera el movimiento');
				$("#cboProf").focus();
				return false;				
			}

			oAjax.request="guardarMovimiento&fecha="+fecha+"&con="+con+"&medio="+medio+"&importe="+importe+"&desc="+desc+"&prof="+prof;
			oAjax.send(resp);

			function resp(data) {
				if (data.responseText!='ok') {
					alert("Error: "+data.responseText);
					return false;
				}
				cargarMovimientos();
			}
		}
		function leerConcepto(combo) {
			var con=getValue(combo.id);
			var ad=BuscarDato('select Adicional from conceptos where idConcepto='+con);

			if (ad=='S') {
				$("#trProf").hide();
				$("#trDesc").show();
				$("#txtDesc").value="";
			}
			if (ad=='P') {
				$("#trProf").show();
				$("#trDesc").hide();
			}
			if (ad=='N') {
				$("#trDesc").hide();
				$("#trProf").hide();
				
			}

		}
		function cargarMovimientos() {
			var desde=getValue('txtDesde');
			var hasta=getValue('txtHasta');

			oAjax.request="cargarMovimientos&desde="+desde+"&hasta="+hasta;
			oAjax.send(resp);

			function resp(data) {
				if (data.responseText.length<3) {
					setValue('tbodyGastos', '');
					return false;
				}

				var obj=JsonParser(data.responseText);
				JsonToTable(obj,'tbodyGastos', false);
				OcultarColumnaTabla('tbodyGastos', 0);
				OcultarColumnaTabla('tbodyGastos', 2);
				OcultarColumnaTabla('tbodyGastos', 4);
				OcultarColumnaTabla('tbodyGastos', 6);
				OcultarColumnaTabla('tbodyGastos', 7);
				
				AgregarEstiloTabla('tbodyGastos', '-1', '8-9', 'text-align:right;');
				AgruparTabla('tbodyGastos', 1);

				calcularTotales();

			}

		}

		function calcularTotales() {
			var tr=document.getElementById('tbodyGastos').rows;
			var subt=0;
			var total=0;
			var last=-1;
			for (var i = 0; i < tr.length; i++) {
				if (tr[i].cells[0].tagName=='TH') {
					if (last==-1) {
						last=i;
					} else {
						tr[last].cells[0].innerText=tr[last+1].cells[1].innerText+" - Total: $ "+subt;
						last=i;
						subt=0;
					}
				} else {
					subt+=1*tr[i].cells[8].innerText;
					subt-=1*tr[i].cells[9].innerText;
					total+=1*tr[i].cells[8].innerText;
					total-=1*tr[i].cells[9].innerText;

				}

			}
			tr[last].cells[0].innerText=tr[i-1].cells[1].innerText+" - Total: $ "+subt;
			setValue('lblTotal', '$ '+total);
		}
	</script>
</head>
<body>
<? include('header.php'); ?>
	<div class="fondonegro">
		<div class="ventana" id="divNuevo">
			<h2>Nuevo movimiento de caja</h2>
			<table class="tablaForm" id="tblForm">
				<tr>
					<th>Fecha movimiento:</th>
					<td><input type="date" id="txtFecha"></td>
					<script type="text/javascript">
						var f=new DateTime();f.init();
						setValue('txtFecha', f.formats.compound.mySQL);
					</script>
				</tr>
				<tr>
					<th>Concepto:</th>
					<td><select id="cboConcepto" onchange="leerConcepto(this)"></select></td>
					<script type="text/javascript">
						LlenarComboSQL('cboConcepto', 'select idConcepto, Nombre from conceptos order by 2', false);
					</script>
				</tr>
				<tr id="trDesc" style="display:none">
					<th>Descripción adicional:</th>
					<td><textarea id="txtDesc" placeholder="Descripción adicional para detalle del movimiento"></textarea></td>
				</tr>
				<tr id="trProf" style="display:none">
					<th>Profesional:</th>
					<td><select id="cboProf"></select></td>
					<script type="text/javascript">
						LlenarComboSQL('cboProf', 'select idProfesional, Nombre from profesionales order by 2', false);
					</script>
				</tr>
				<tr>
					<th>Importe:</th>
					<td><input type="number" step="0.01" id="txtImporte"></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<button type="button" class="botonok" onclick="guardarMov();">Aceptar</button>
						<button type="button" class="botoncancel" onclick="cerrar('divNuevo', true)">Cancelar</button>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<h3>Operaciones de caja</h3>
	<div id="wrapper1">
		<div>
			<p id="lblFecha">Mostrar movimientos del <input type="date" id="txtDesde"> al <input type="date" id="txtHasta">  <button class="botonok" type="button" style="font-size:0.8em" onclick="cargarMovimientos();">Mostrar</button></p>
			<script type="text/javascript">
				var f=new DateTime();f.init();
				setValue('txtDesde', f.formats.compound.mySQL);
				setValue('txtHasta', f.formats.compound.mySQL);
			</script>			
		</div>
		<div>
			<button class="botonok" type="button" onclick="mostrar('divNuevo', true);"><img width="32" src="./imagenes/nueva.png" title="Ingresar operación"></button>
			<button class="botonok" type="button" onclick="printDiv2('wrapper1', 'Reporte de caja');"><img width="32" src="./imagenes/printer.png" title="Imprimir"></button>
			<button class="botonok" type="button" onclick="exportTableToCSV($('#tblGastos'), 'Exportacion_Caja');"><img width="32" src="./imagenes/guardar.png" title="Descargar"></button>
		</div>
		<table id="tblGastos" class="tabla1">
			<thead>
				<tr><th>Fecha</th><th>Concepto</th><th>Medio de pago</th><th>Ingreso</th><th>Salida</th></tr>
			</thead>
			<tbody id="tbodyGastos">
				
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" align="right">Total:</td>
					<td align="right"><span id="lblTotal"></span></td>
				</tr>
			</tfoot>
		</table>

	</div>
	<script>cargarMovimientos();</script>
</body>
</html>