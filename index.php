<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script type="text/javascript" src="./js/permisos.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script type="text/javascript">
		function login() {
			var usuario=getValue('txtUsuario');
			var pass=getValue('txtPass');

			oAjax.request="login&usuario="+usuario+"&pass="+pass;
			oAjax.send(resp);

			function resp(data) {
				if (data.responseText!='ok') {
					alert('Credenciales no válidas');
					return false;
				}
				location.reload();
			}
		}

		function setProf(fecha) {
			var prof=getValue('cboProf');
			var pac=getValue('hidPaciente');
			location.href="diaria.php?prof="+prof+"&fecha="+fecha+"&pac="+pac;
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
				JsonToTable(obj, 'tbodyResultados', false);	
				OcultarColumnaTabla('tbodyResultados',6);
				AgregarBotonTabla('tbodyResultados', -1, '','pickPaciente',0);
				
			}
		}		
		function pickPaciente(id, obj) {
			var trs=document.getElementById('tbodyResultados').getElementsByTagName('TR');
			for (var i = 0; i < trs.length; i++) {
				trs[i].classList.remove('trClicked');
			}
			
			//obj.classList.add('trClicked');
			obj.classList.add('trClicked');
			setValue('hidPaciente', obj.cells[0].innerText);
			paso2();
		}
		function paso2() {
			$("#divProf").show();
			$("#divProf").parent().show();
		}
		function buscarHorario() {
			var f=new DateTime();f.init();
			var prof=getValue('cboProf');
			$("#gifEspera").show();
			oAjax.request="turnosLibres&idProf="+prof+"&fecha='"+f.formats.compound.mySQL+"'";
			oAjax.send(resp);

			function resp(data) {
				$("#gifEspera").hide();
				if (data.responseText.length<3) {
					alert('No hay turnos libres para este profesional');
					return false;
				}

				var obj=JSON.parse(data.responseText);
				JsonToTable(obj,'tbodyLibres', false);
				AgregarBotonTabla('tbodyLibres', -1, '', 'setProf', 0);
				$("#tblLibres").show();
			}
		}
		function altaPaciente() {
			$("#frmNuevoPaciente").parent().show();
			$("#frmNuevoPaciente").show();
			//setValue('tbodySelecPac', '');
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
				if (obj.respuesta!='ok' || obj.id==0) {
					alert(obj.respuesta);
					return false;
				}

				//cerrar('frmNuevoTurno');
				//cargarTurnos(getValue('hidProf'), null);
				setValue('hidPaciente', obj.id);
/*				setValue('txtNombrePac', nom);
				setValue('txtApellidoPac', ape);
				setValue('txtCelularPac', cel);
				setValue('txtDNIPac', dni);*/
				$('#frmNuevoPaciente').hide();		
				paso2();	
			}		
		}		
		function prestaciones() {
			var pac=getValue('hidPaciente');
			var prof=getValue('cboProf');

			location.href="prestaciones.php?pac="+pac+"&prof="+prof;
		}
	</script>
</head>
<body>
	<? if (!isset($_SESSION['idUsuario'])) {?>
	<div id="divLogin">
		<div id="header">
			<img src="./imagenes/logo1.png">
			<p id="tituloLogo">CRECER Consultorios</p>
		</div>
		<table id="tblLogin">
			<tr>
				<td>Usuario:</td>
				<td><input type="text" id="txtUsuario" placehoder="Ingrese usuario"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" id="txtPass"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><button type="submit" class="botonok" onclick="login();">Ingresar</button></td>
			</tr>
		</table>
	</div>
	<? } else {?>
	<div id="divMain">
	<? include('header.php'); ?>
		<div id="content">
		<? switch ($_SESSION['perfil']) {
			case "A":
				echo '<a href="https://docs.google.com/spreadsheets/d/1anuElaoQkGukyq_7zor5QIaTvRGjxi17BkEY61DTnFw/edit#gid=1154238927">Planilla</a>';
				break;
			case "R":?>
				<div class="fondonegro" style="display:none;">
					<div id="divProf" class="ventana" style="display:none;width:40%;position:absolute;left:30%; text-align:center">
						<h2>Seleccione profesional</h2>
						<select id="cboProf"></select>
						<button class="botonok" type="button" onclick="buscarHorario()">Buscar turnos</button>
						<button class="botonok" type="button" onclick="prestaciones()">Cargar prestaciones</button>
						<img id="gifEspera" src="./imagenes/uploading.gif" width="24" style="display:none;">
						<script>
							LlenarComboSQL('cboProf', 'select idProfesional, Nombre from profesionales order by 2', false);
						</script>
						<table id="tblLibres" class="tabla3" style="display:none; margin:10px auto">
							<thead><tr><th>Fecha</th><th>Turnos libres</th></tr></thead>
							<tbody id="tbodyLibres"></tbody>
						</table>
					</div>
				</div>
					<div id="frmNuevoTurno" class="ventanaInicio">
						<h2>Buscar Paciente</h2>
						<input type="hidden" id="hidTurno">
						<table id="tblNTur">
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
								<td colspan="2" align="center">
									<button class="botonok" type="button" onclick="ingresarTurno();">Aceptar</button>
									<button class="botoncancel" type="button" onclick="cerrar('frmNuevoTurno');">Cancelar</button>
								</td>
							</tr>
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
					<div id="divResultados" class="ventanaInicio" style="max-height:250px;overflow-y:auto;overflow-x:hide;">

						<table id="tblResultados" class="tabla3">
							<thead><tr><th>Hist. Clinica</th><th>Apellido</th><th>Nombre</th><th>Cobertura</th><th>DNI</th><th>Teléfono</th></tr></thead>
							<tbody id="tbodyResultados"></tbody>
						</table>

					</div>
		<?		break;
		}
			
			
		?>
		</div>

	</div>
	<?}?>

</body>
</html>