function rptInit(rpt) {
	switch (rpt) 
	{
		case '8': 
			//agenda diaria
			var f = new Date();
			setValue('txtFechaD', f.toISOString().substring(0,10));

			break;
		
		case 'RPT2':
			var f = new Date();
			setValue('txtFechaD', f.toISOString().substring(0,10));
			setValue('txtFechaH', f.toISOString().substring(0,10));
			break;
	}

}

function filtrar(rpt) {
	espera('on');

	switch (rpt) 
	{
		case '8': 
			var f=new DateTime(); f.init(getValue('txtFechaD'), 'ymd');
			var cadena="SELECT pro.Nombre Prof, t.Hora, p.Apellido, p.Nombre, p.Celular, c.Nombre Cons ";
			cadena+=" FROM turnos t INNER JOIN pacientes p ON t.idPaciente=p.idPaciente";
			cadena+=" INNER JOIN profesionales pro ON pro.idProfesional=t.idProfesional";
			cadena+=" INNER JOIN agenda a ON a.idProfesional=t.idProfesional";
			cadena+=" INNER JOIN consultorios c ON a.idConsultorio=c.idConsultorio AND a.Fecha=t.Fecha";
			cadena+=" WHERE t.Fecha='"+f.formats.compound.mySQL+"' ORDER BY t.idProfesional, t.Hora";

			break;
		case '13':
			var prof=getValue('hidProf');
			var cadena="SELECT date_format(t.Fecha, '%d/%m/%Y') Fecha, t.Hora, t.Paciente, t.ApellidoPac, p.Celular,p.DNI, p.NroSocio, t.Estado, pr.Nombre ";
			cadena+=" FROM turnos t INNER JOIN pacientes p ON t.idPaciente=p.idPaciente";
			cadena+=" LEFT JOIN prepagas pr ON pr.idPrepaga=p.idPrepaga ";
			cadena+=" WHERE t.idProfesional="+prof;
			cadena+=" ORDER BY Fecha, Hora";
			break;
	}

	oQuery.query=cadena;
	navigate('atras');

	//POST PROCESSING*************************
	switch (rpt) {
		case '8':
			AgruparTabla('tblReporte', 0, 1, '',0);
			break;
		case '13':
			AgruparTabla('tblReporte', 0, 1, '', 0);
			break;
	}
}


