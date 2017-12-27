<? session_name('cons'); session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//Dth HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dth">
<html>
<head>
	<title>Consulta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/gral.css">
	<link rel="stylesheet" type="text/css" href="./css/agenda.css">
	<link rel="shortcut icon" type="image/x-icon" href="./imagenes/logo.ico">
	<script type="text/javascript" src="./js/frame.js"></script>
	<script src="./js/jquery-1.10.2.js"></script>
	<script src="./js/jquery-ui-1.10.4.custom.min.js"></script>  	
	<script type="text/javascript">
	function mostrarNuevo(ventana) {
		var padre=document.getElementById(ventana).parentNode;
		$(padre).show();

	}
	function armarGrilla(periodo) {
		var mes=periodo.substring(0,2);
		var anio=periodo.substring(3,7);
		var f=new DateTime; f.init('01/'+mes+'/'+anio,'dmy');
		var oF=new Date(f.date);
		var dias=0;dia=0;

		switch (mes) {
			case '01','03','05','07','08','10','12':
				dias=31;
				break;
			case '02':
				dias=28;
				break;
			default:
				dias=30;
				break;
			break;
		}

		var tbl=document.getElementById('tbodyAgenda');
		//var tdDemo=document.getElementById('tdDemo');
		tbl.innerHTML='';
		for (var i = 0; i < 7; i++) {
			var tr=document.createElement('tr');
			for (var j = 0; j < 8; j++) {
				var td=document.createElement('td');
				td.id="td"+dia;
				if (j>0) {
					
					if (dia<dias) 
					if (oF.getDay()==j && dia==0)
						dia++;

					if (dia>0 && dia<=dias) {
						var a =document.createElement('a');
						a.id="a"+dia;
						a.innerHTML=dia;
						td.appendChild(a);	

						var mod1=document.createElement('a');
						mod1.id="mod1_"+dia;
						//mod1.href="#";
						mod1.onclick=function () {addProf(this)};
						mod1.style.display="block";
						mod1.style.color="#0077cc";
						mod1.innerHTML="Mod 1: Disponible";

						var mod2=mod1.cloneNode(false);
						mod2.id="mod2_"+dia;
						mod2.innerHTML="Mod 2: Disponible";
						mod2.onclick=function () {addProf(this)};

						td.appendChild(mod1);
						td.appendChild(mod2);
						dia++;
					}
				} else {
					td.appendChild(document.createTextNode('Semana '+(i+1)));
				}
				tr.appendChild(td);
			}
			
			if (tr.getElementsByTagName('a').length>0)
				tbl.appendChild(tr);
		}
		AgregarBotonTabla('tbodyAgenda', 0, 'menu2.png', 'showMenu', 0, true, 'icono');
		
	}
	function addProf(obj) {
		var periodo=getValue('hidPeriodo');

		var fecha= pad(obj.id.replace('mod1_', '').replace('mod2_', '')+"/"+periodo,10, '0');
		var mod=obj.id.substring(3,4);
		mostrarNuevo('frmAgregarProf');
		setValue('cboModulo', mod);
		setValue('txtFecha', fecha);
		setValue('hidMod', obj.id);

	}
	function cargarProf() {
		var periodo=getValue('hidPeriodo');

		var fecha= getValue('txtFecha');
		var mod=getValue('cboModulo');
		var prof=getValue('cboProf');
		var esp=getValue('cboEsp');
		var cons=getValue('cboConsultorio');

		var link=document.getElementById(getValue('hidMod'));

		oAjax.request="ingresarModulo&prof="+prof+"&fecha="+fecha+"&mod="+mod+"&periodo="+periodo+"&esp="+esp+"&cons="+cons;
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText!="ok") {
				alert("Error: "+data.responseText);
				return false;
			}

			link.innerHTML=getValue('cboProf')+" - "+textoCombo('cboProf');
			link.style.color="green";
			cerrar('frmAgregarProf');

		}
		
	}
	function cargarPeriodos() {
		oAjax.request="customQuery&query=select distinct Periodo from agenda order by Fecha desc&tipo=Q";
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				setValue('tbodyCons','');
				return false;
			}
			var obj=JSON.parse(data.responseText);
			JsonToTable(obj, 'tbodyCons', false);
			AgregarBotonTabla('tbodyCons', 0, '', 'cargarGrilla',0);
		}

	}
	function cerrar(ventana) {
		var padre=document.getElementById(ventana).parentNode;
		$(padre).hide();
	}
	function ingresarPeriodo() {
		var periodo=getValue('txtNuevoPeriodo');
		AgregarFila('tbodyCons', 0, periodo, [periodo]);
		AgregarBotonTabla('tbodyCons', 0, '', 'cargarGrilla',0,'','',periodo, 0);
		cerrar('frmNuevoPeriodo');
		cargarGrilla(periodo);
	}
	function cargarGrilla(periodo) {
		setValue('hidPeriodo', periodo);
		armarGrilla(periodo);
		var cons=getValue('cboConsultorio');

		setValue('lblPeriodo', 'Período seleccionado: ' + periodo);
		oAjax.request="leerAgenda&periodo="+periodo+"&cons="+cons;
		oAjax.send(resp);

		function resp(data) {
			if (data.responseText.length<3) {
				//setValue('tblPeriodo','');
				return false;
			}

			var obj=JSON.parse(data.responseText);
			for (var i = 0; i < obj.length; i++) {
				var f=new DateTime();f.init(obj[i].Fecha, 'ymd');
				var dia=f.date.getDate();
				var mod="mod"+obj[i].Turno+"_"+dia;

				var link=document.getElementById(mod);
				link.innerHTML=obj[i].idProfesional+' - '+obj[i].Profesional;
				link.style.color="green";

/*				var tbl=document.getElementById("tbodyAgenda").getElementsByTagName('a');
				for (var i = 0; i < tbl.length; i++) {
					if (tbl[i].id==mod) {
						tbl[i].innerHTML=obj[i].idProfesional+' - '+obj[i].Profesional;
						tbl[i].color="green";
					}
				}
*/				
			}
		}

	}
	function copiarAgenda() {
		
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
	<div class="fondonegro" style="//display:none;">
		<div id="frmNuevoPeriodo" class="ventana">
			<h2>Nuevo período</h2>
			<table id="tblNPer">
				<tr>
					<td>Período a crear:</td>
					<td><input type="text" id="txtNuevoPeriodo" placeholder="MM/AAAA" value="11/2017"></td>
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
	<div class="fondonegro" style="//display:none;">
		<div id="frmAgregarProf" class="ventana">
			<h2>Agregar profesional a agenda</h2>
			<input type="hidden" id="hidMod">
			<table id="tblNProf">
				<tr>
					<td>Fecha</td>
					<td><input id="txtFecha" type="text" readonly="readonly"></input></td>
				</tr>
				<tr>
					<td>Profesional:</td>
					<td><select id="cboProf"></select></td>
					<script>LlenarComboSQL('cboProf', 'select idProfesional, Nombre from profesionales order by 2');</script>
				</tr>
				<tr>
					<td>Especialidad</td>
					<td><select id="cboEsp"></select></td>
					<script>LlenarComboSQL('cboEsp', 'select idEspecialidad, Nombre from especialidades order by 2');</script>
				</tr>
				<tr>
					<td>Módulo</td>
					<td><select id="cboModulo"><option value="1">Módulo 1 (Mañana)</option><option value="2">Módulo 2 (Tarde)</option></select></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<button class="botonok" type="button" onclick="cargarProf();">Aceptar</button>
						<button class="botoncancel" type="button" onclick="cerrar('frmAgregarProf');">Cancelar</button>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="contextMenu" id="ctxMenu" style="display:none;">
		<input type="hidden" id="hidDoc">
		<ul>
			<li><a href="javascript:void(0);" onclick="evaluar('A')">Copiar semana</a></li>
			<li><a href="javascript:void(0);" onclick="evaluar('R')">Rechazar</a></li>
			<li><a href="javascript:void(0);" onclick="$('#ventana1').show();setValue('spanTituloVer',getValue('txtArchivo'));">Reenviar para aprobar</a></li>
			<li><a href="javascript:void(0);" onclick="">Subir correcciones y aprobar</a></li>
		</ul>
	</div>	
	<h3>Agenda</h3>
	<div id="wrapper1">
		<button class="botonok" onclick="mostrarNuevo('frmNuevoPeriodo');">Abrir nuevo Período</button>
		<table id="tblPeriodo" class="tabla1">
			<thead>
				<tr><th>Período</th></tr>
			</thead>
			<tbody id="tbodyCons"></tbody>
		</table>
		
	</div>
	<input type="hidden" id="hidPeriodo">
	<div id="wrapper2">
		<select id="cboConsultorio" onchange="cargarGrilla(getValue('hidPeriodo'));"></select>
		<h3 style="display:inline-block;margin:0 10px;" id="lblPeriodo"></h3>
		<script>LlenarComboSQL('cboConsultorio', 'select idConsultorio, Nombre from consultorios')</script>
		<table id="tblAgenda" class="tabla1">
			<thead>
				<col width="12%"><col width="12%"><col width="12%"><col width="12%"><col width="12%"><col width="12%"><col width="12%"><col width="12%">
				<tr>
					<th>Fecha</th><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th><th>Domingo</th>
				</tr>
			</thead>
			<tbody id="tbodyAgenda">
	<td id="tdDemo">
		<a id="aDemo" href="" onclick="asignar(this)"></a>
	</td>
				
			</tbody>
		</table>
	</div>
	<script type="text/javascript">cargarPeriodos();</script>
</body>
</html>