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
	</script>
</head>
<body>
	<? if (!isset($_SESSION['idUsuario'])) {?>
	<div id="header">
		<img src="./imagenes/logo1.png">
		<p id="tituloLogo">CRECER Consultorios</p>
	</div>
	<div id="divLogin">
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

		</div>
	</div>
	<?}?>

</body>
</html>