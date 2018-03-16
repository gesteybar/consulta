<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/nomenclador.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script type="text/javascript" src="./js/permisos.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript">
		var hidPrevVal='';
		var currID=0;
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
		function cargarCodigos() {
			var esp=getValue('cboEspecialidad');

			oAjax.request="leerNomenclador&esp="+esp;
			oAjax.send(resp);

			function resp(data) {
				if (data.responseText.length<3) {
					setValue('tbodyCodigos', '');
					return false;
				}

				var obj=JSON.parse(data.responseText);
				JsonToTable(obj, 'tbodyCodigos', false);
				OcultarColumnaTabla('tbodyCodigos', 0);
				OcultarColumnaTabla('tbodyCodigos', 1);
				AgregarBotonTabla('tbodyCodigos', -1, '', 'editarCodigo', 0);
				



			}
		}

		function editarCodigo(id, obj) {
/*			cancelEdit();
			var cont="";
			cont='<input type="text" id="txtAT" value="'+obj.innerText+'"><button type="submit" class="botonok" onclick="guardarCodigo(this)"><img src="imagenes/ok.png" width="24"></button><button type="submit" class="botonok" onclick="cancelEdit()"><img src="imagenes/redalert.png" width="24"></button>';
			hidPrevVal= obj.parentNode.innerHTML;
			obj.parentNode.innerHTML=cont;
			$("#txtAT").focus();*/

			mostrar('divNuevo',true);
			$("#btnBorrar").show();
			setValue('txtNewCodigo', obj.childNodes[2].childNodes[0].textContent);
			setValue('txtNewDesc', obj.childNodes[3].innerText);
			currID=obj.childNodes[0].innerText;
		}

		function cancelEdit() {
			var objAnt=document.getElementById('txtAT');
			if (objAnt!=undefined) {
				objAnt.parentNode.innerHTML=hidPrevVal;
			}			
		}
		function guardarCodigo(obj) {
			var cod=getValue('txtNewCodigo');
			var desc=getValue('txtNewDesc');
			var esp=getValue('cboEspecialidad');
			var id=currID;

			oAjax.request="guardarCodigo&id="+id+"&codigo="+cod+"&desc="+desc+"&esp="+esp;
			oAjax.send(resp);

			function resp(data) {
				if (data.responseText!='ok') {
					alert('Error: '+data.responseText);
					return false;
				}

				cargarCodigos();
				cerrar('divNuevo', true);


			}
		}
		function nuevo() {
			currID=0;
			setValue('txtNewDesc','');
			setValue('txtNewCodigo', '');
			mostrar('divNuevo', true);
			$("#btnBorrar").hide();
			$("#txtNewCodigo").focus();
		}
		function borrarCodigo() {
			if (!confirm('Confirma eliminar este código?')) return false;

			oAjax.request="customQuery&query=delete from Nomenclador where idNomenclador="+currID+"&tipo=E";
			oAjax.send(resp);

			function resp(data) {
				if (data.responseText!='ok') {
					alert('Error: '+data.responseText);
					return false;
				}
				cargarCodigos();
				cerrar('divNuevo', true);
			}
		}
	</script>
</head>
<body>
<? include('header.php'); ?>
	<div class="fondonegro" style="display:none;">
		<div class="ventana" id="divNuevo">
			<h2>Códigos de nomenclador</h2>
			
			<table id="tblNewCodigo">
				<tr>
					<td>Código</td>
					<td><input type="text" id="txtNewCodigo"></td>
				</tr>
				<tr>
					<td>Descripción</td>
					<td><input type="text" id="txtNewDesc"></td>
				</tr>
				<tr>
					<td colspan="2">
						<button type="button" class="botonok" onclick="guardarCodigo()">Aceptar</button>
						<button type="button" class="botoncancel" onclick="cerrar('divNuevo', true)">Cancelar</button>
						<button id="btnBorrar" style="margin-left:100px" type="button" class="botoncancel" onclick="borrarCodigo()">Eliminar</button>
					</td>
				</tr>
			</table>
			
		</div>
	</div>

	<h3>Nomenclador de prestaciones</h3>
	<div id="wrapper1">
		<div>
			<p id="lblFecha">Especialidad <select onchange="cargarCodigos();" id="cboEspecialidad"></select>  
			<button class="botonok" type="button" style="font-size:0.8em" onclick="cargarCodigos();">Mostrar</button></p>
			<script type="text/javascript">
				LlenarComboSQL('cboEspecialidad', 'select idEspecialidad, Nombre from especialidades order by 2', true);
			</script>			
		</div>
		<div>
			<button class="botonok" type="button" onclick="nuevo();"><img width="32" src="./imagenes/nueva.png" title="Ingresar operación"></button>
			<button class="botonok" type="button" onclick="printDiv2('wrapper1', 'Nomenclador');"><img width="32" src="./imagenes/printer.png" title="Imprimir"></button>
			<button class="botonok" type="button" onclick="exportTableToCSV($('#tblCodigos'), 'Nomenclador');"><img width="32" src="./imagenes/guardar.png" title="Descargar"></button>
		</div>
		<table id="tblCodigos" class="tabla1">
			<thead>
				<tr><th>Codigo</th><th>Prestación</th></tr>
			</thead>
			<tbody id="tbodyCodigos">
				
			</tbody>
			<tfoot>

			</tfoot>
		</table>

	</div>
	
</body>
</html>