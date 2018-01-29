<? session_name('cons');
session_start();?>
<div id="divLoading" class="fondogris" style="display:none;">
	<div id="divMensaje">
		<p>Procesando solicitud</p>
		<img src="./imagenes/uploading.gif" width="48">
	</div>
</div>

<p id="rptTitulo"></p>
<p id="rptDesc"></p>
<div id="divReporte">
	<div id="divFiltroRPT">
		<table id="tblFiltroRPT">
			<tr>

				<td>Emitir agendas de profesional:</td>
				<td colspan="6">
					
				</td>
				<input type="hidden" id="hidProf" value="<?= $_SESSION['prof'] ?>">
				<script type="text/javascript">
					oMaxReg.maxcant=10000;

				</script>
				<td valign="top" rowspan="3"><button class="botonok" onclick="filtrar('13');">Mostrar datos</button></td>
			</tr>
			<tr>
				
			</tr>
		</table>
		<div id="divExportRPT">
			<a href="javascript:void(0);" id="botonExcel" onclick="exportar();"><img src="./imagenes/guardar.png" title="Export to Excel" width="24" style="margin:5px;"></a>
			<a href="javascript:void(0);" id="Imprimir" onclick="printdiv('divReporte', getValue('rptTitulo'));"><img src="./imagenes/printer.png" title="Print results" width="24" style="margin:5px;"></a>
			<div style="float:right;margin-top:10px;">
				<a id="btnAnt" href="#" onclick="navigate('atras');"><img src="./imagenes/izquierda.png" width="24" style="vertical-align:middle"></a>
				<span id="spanCant" style="color:white;"></span>
				<a id="btnSig" href="#" onclick="navigate('sig');"><img src="./imagenes/derecha.png" width="24" style="vertical-align:middle"></a>
			</div>			
			<table id="tblReporte" >

				
			</table>
			<script type="text/javascript">
				/*OcultarColumnaTabla('tblReporte', 1);
				OcultarColumnaTabla('tblReporte', 5);
				OcultarColumnaTabla('tblReporte', 7);*/
			</script>
		</div>
	</div>
</div>	