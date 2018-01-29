<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/usuarios.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script type="text/javascript" src="./js/permisos.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript">
	function cargarDatos() {
		oAjax.request="cargarUsuarios";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				setValue('tbodyUsu', '');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyUsu', false);
			OcultarColumnaTabla('tbodyUsu', 0);
			AgregarBotonTabla('tbodyUsu', 1, '', 'editarDato', 0);
			AgregarEstiloTabla('tbodyUsu','0*','1','','linkGral');
			//AgregarEstiloTabla('tbodyCons','0*','1','','linkCons');
		}
	}
	function cancel() {
		setValue('txtLogin','0');
		setValue('txtPass','0');
		setValue('txtID','0');
		setValue('txtNombre','');
		$("#abm").hide();
	}

	function editarDato(id) {
		oAjax.request="customQuery&query=select * from usuarios where idUsuario="+id+"&tipo=Q";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				alert('No existe ese usuario');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			setValue('txtID', obj[0].idUsuario);
			setValue('txtNombre', obj[0].Nombre);
			setValue('txtLogin', obj[0].Login);
			setValue('txtPass', '******');
			setValue('cboPerfil', obj[0].Perfil);
			$("#trProf").hide();
			if (obj[0].ProfAsoc!='') {
				setValue('cboProf', obj[0].ProfAsoc);
				$("#trProf").show();
			}

			cargarPermisos(obj[0].idUsuario);
			$("#abm").show();
			$("#cmdBorrar").show();

		}
	}
	function nuevoDato() {
		setValue('txtLogin','');
		setValue('txtID','0');
		setValue('txtNombre','');
		setValue('txtPass','');
		setValue('cboPerfil', 'A');
		$("#trProf").hide();
		$("#abm").show();
		$("#cmdBorrar").hide();

	}
	function borrarDato() {
		var id=getValue('txtID');
		if (!confirm('Confirma eliminar este usuario?')) return false;

		oAjax.request="customQuery&query=delete from usuarios where idUsuario="+id+"&tipo=E";
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
		var login=getValue('txtLogin');
		var pass=getValue('txtPass');
		var perfil=getValue('cboPerfil');
		var prof=getValue('cboProf');

		oAjax.request="customQuery&query=call SP_InsertUser("+id+", '"+nombre+"', '"+login+"', '"+pass+"', '"+perfil+"', '"+prof+"')&tipo=E";
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
	function cargarPermisos(id) {
		oAjax.request="cargarPermisos&id="+id;
		oAjax.send(resp);

		function resp(data) {
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyPermisos', false);
			OcultarColumnaTabla('tbodyPermisos', 0);
			var tr=document.getElementById('tbodyPermisos').getElementsByTagName('tr');
			for (var i = 0; i < tr.length; i++) {
				var td=tr[i].cells[2];
				if (td.innerText=='') {
					td.innerHTML='<a onclick="grant(this,\'on\');" href="javascript:void(0);"><img src="./imagenes/off.png"></a>';
				} else {
					td.innerHTML='<a onclick="grant(this,\'off\');" href="javascript:void(0);"><img src="./imagenes/on.png"></a>';
				}
			}
		}
	}
	function grant(obj,tipo) {
		var user=getValue('txtID');
		var mod=obj.parentNode.parentNode.cells[0].innerText;
		oAjax.request="grant&user="+user+"&modulo="+mod+"&tipo="+tipo;
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText!='ok') {
				alert("Error: "+data.responseText);
				return false;
			}
			//cargarPermisos(user);
			obj.childNodes[0].src="./imagenes/"+tipo+".png";
			if (tipo=='on')
				obj.onclick=function() {grant(this,'off')};
			else 
				obj.onclick=function() {grant(this,'on')};
		}
	}
	</script>
</head>
<body>
<? include('header.php'); ?>
	<h3>Usuarios</h3>
	<div id="wrapper1">
		<button class="botonok" onclick="nuevoDato();">Agregar</button>
		<table id="tblUsuarios" class="tabla1">
			<thead>
				<tr><th>Usuarios</th></tr>
			</thead>
			<tbody id="tbodyUsu"></tbody>
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
				<td>Login</td>
				<td><input type="text" id="txtLogin"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" id="txtPass"></td>
			</tr>
			<tr>
				<td>Tipo de cuenta</td>
				<td><select id="cboPerfil" onchange="if (getValue(this.id)=='P') $('#trProf').show(); else $('#trProf').hide();"><option value="A">Administrador</option><option value="P">Profesional</option><option value="R">Recepcionista</option></select></td>
			</tr>
			<tr id="trProf" style="display:none;">
				<td>Profesional asociado</td>
				<td><select id="cboProf"></select></td>
				<script type="text/javascript">
					LlenarComboSQL('cboProf', 'select idProfesional, Nombre from profesionales order by 2', true);
				</script>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<button id="cmdAceptar" class="botonok" type="button" onclick="guardar();">Aceptar</button>
					<button id="cmdCancel" class="botonok" type="button" onclick="cancel();">Cancelar</button>
					<button id="cmdBorrar" class="botonok" onclick="borrarDato();">Eliminar</button>
				</td>
			</tr>
		</table>
		<div id="divPermisos">
			<table id="tblPermisos" class="tabla1">
				<thead><tr><th colspan="3">Permisos</th></tr></thead>
				<tbody id="tbodyPermisos">
					
				</tbody>
			</table>
		</div>
	</div>
	<script>cargarDatos();</script>
</body>
</html>