//********************************************************************************************************
//AJAX
//********************************************************************************************************
function clsFrameAjax() {
	this.responseJSON=function(oxhr) {
		var str = oxhr.responseXML.getElementsByTagName("string")[0].childNodes[0].nodeValue;
		return JSON.parse(str);
	}
	this.responseText=null;
	this.request="";
	this.async=true;
	//this.server="http://localhost:32968/Finanzas.asmx/";

	this.server="./ajaxfunciones.php?consulta=";


	var xhr= new XMLHttpRequest();

	this.send=function(func) {
		init();
		if (this.request!='') {
			xhr.onreadystatechange=function () {
				if (xhr.readyState==4 && xhr.status==200) {
					
					func(xhr);
				}
			}
			xhr.open("GET",this.server+this.request,this.async);
			
			xhr.send();
		}
	}
	this.sendPost=function(func) {
		init();
		if (this.request!='') {
			xhr.onreadystatechange=function () {
				if (xhr.readyState==4 && xhr.status==200) {
					
					func(xhr);
				}
			}
			xhr.open("POST", 'ajaxfunciones.php',this.async);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.send(this.request);		

		}
	}
	this.abort=function() {
	xhr.abort();
	}
	function init() {
		responseJSON=null;
		responseText=null;
		request="";
		async=true;
		//server="http://localhost:32968/Finanzas.asmx/";
		server="./ajaxfunciones.php?consulta=";
	}
}

//Conserva las credenciales de acceso
function clsUser() {
	this.usuario='';
	this.pass='';
}

//********************************************************************************************************
//Funciones de llenado de tablas
//********************************************************************************************************
//Esta fc recibe un objeto json y una tabla que debe existir en el html. Llena la tabla con 
var    _tr_ = document.createElement('tr'),
    _th_ = document.createElement('th'),
    _td_ = document.createElement('td');
// Builds the HTML Table out of myList json data from Ivy restful service.
function JsonToTable(arr, tabla, headers) {
 	//var _table_ = document.createElement(tabla)
 	var _table_=document.getElementById(tabla);
	var table = _table_;//.cloneNode(false),
	table.innerHTML="";
	columns = addAllColumnHeaders(arr, table, headers);

	for (var i=0, maxi=arr.length; i < maxi; ++i) {
		var tr = _tr_.cloneNode(false);
		for (var j=0, maxj=columns.length; j < maxj ; ++j) {
			var td = _td_.cloneNode(false);
			cellValue = arr[i][columns[j]];
			td.appendChild(document.createTextNode(arr[i][columns[j]] || ''));
			tr.appendChild(td);
		}
		table.appendChild(tr);
	}
	return table;
 }
 
 // Adds a header row to the table and returns the set of columns.
 // Need to do union of keys from all records as some records may not contain
 // all records
 function addAllColumnHeaders(arr, table, headers) {
    var columnSet = []
	var tr = _tr_.cloneNode(false);         
	for (var i=0, l=arr.length; i < l; i++) {
		
	 for (var key in arr[i]) {
	     if (arr[i].hasOwnProperty(key) && columnSet.indexOf(key)===-1) {
	         columnSet.push(key);
	         if (headers) {
	         	 
	             var th = _th_.cloneNode(false);
	             th.appendChild(document.createTextNode(key));
	             tr.appendChild(th);
	         }
	     }
	 }
	 if (headers)
	 	table.appendChild(tr);
	}

 return columnSet;
 }

function AgregarBotonTabla(tabla, col, imagen, funcion, refcol,prefijo, clase,condicion, colcond, title) {
	var tbl=document.getElementById(tabla);
	var tr=tbl.getElementsByTagName("tr");

	if (title== undefined) title='';
	
	if (refcol==="" || refcol==undefined || refcol==null)
		refcol=col;

	if (colcond==undefined || colcond=='') colcond=0;

	if (clase!='')
		var addClass="class='"+clase+"'";
	else
		var addClass='';
	
	for (var i = 0; i < tr.length; i++) {
		if (col<0) {
			for (var j = 0; j < tr[i].cells.length; j++) {
				
				tr[i].cells[j].innerHTML ='<a '+addClass+' href="javascript:void(0)" onclick="'+funcion+'(\''+tr[i].cells[refcol].innerText+'\', this);">'+tr[i].cells[j].innerHTML+'</a>';
				
			}
		} else {
			var td=tr[i].cells;
			if (td.length>0)
				if (td[colcond].innerText==condicion || condicion=='' || condicion==undefined) {
					if (imagen!='')
						if (prefijo)
							td[col].innerHTML='<a '+addClass+' href="javascript:void(0)" onclick="'+funcion+'(\''+td[refcol].innerHTML+'\', this);"><img src="./imagenes/'+imagen+'" width="16" title="'+title+'"></a>'+td[col].innerHTML;	
						else
							td[col].innerHTML+='<a '+addClass+' href="javascript:void(0)" onclick="'+funcion+'(\''+td[refcol].innerHTML+'\', this);"><img src="./imagenes/'+imagen+'" width="16" title="'+title+'"></a>';
					else
						td[col].innerHTML ='<a '+addClass+' href="javascript:void(0)" onclick="'+funcion+'(\''+td[refcol].innerHTML+'\', this);">'+td[col].innerHTML+'</a>';
				}
		}
	}
}

function AgruparTabla (tabla, col, firstRow, condicion, colCond) {
	var tbl=document.getElementById(tabla);
	var tr=tbl.getElementsByTagName("tr");

	if (firstRow==undefined || firstRow==null || firstRow=='') {
		firstRow=0;
	}

	if (colCond==undefined || colCond=='') colCond=0;

	var ant="";
	for (var i = firstRow; i < tr.length; i++) {
		if (ant!=tr[i].cells[col].innerText) {
			ant=tr[i].cells[col].innerText;
			
			var th=document.createElement('th');
			th.colSpan=tr[i].cells.length;
			th.innerText=tr[i].cells[col].innerText;
			var trg=tbl.insertRow(i);
			trg.appendChild(th);
		}
	}

}

function AgregarFila(tabla, enFila, idTr, params) {
	if (enFila=='') enFila=-1;
	var tbl=document.getElementById(tabla);
	var tr=tbl.insertRow(enFila);
	tr.id="tr"+idTr;
	for (var i = 0; i < params.length; i++) {
		var td=tr.insertCell(i);
		td.innerHTML=params[i];
	}
	if (enFila==-1) {
		return tbl.getElementsByTagName('tr').length;
	} else {
		return enFila;
	}
}

function OcultarColumnaTabla(tabla, columna) {
	var tbl=document.getElementById(tabla);
	var tr=tbl.getElementsByTagName("tr");

	for (var i = 0; i < tr.length; i++) {
		var td=tr[i].cells;
		if (td.length>0 )
			td[columna].style.display='none';
	}

}

function AgregarEstiloTabla(tabla, row, col, estilo, clase, condicion, colcond) {
	//valores row:-1 todas las filas | -2 fila por medio | N* todas las filas a partir de N | *N todas hasta N | N fila unica | N-N desde hasta fila
	//valores col:-1 todas las columnas | -2 col por medio | N* todas las col a partir de N | *N todas hasta N | N col unica | N-N desde hasta col

	var tbl=document.getElementById(tabla);
	var tr=tbl.getElementsByTagName("tr");

	var dRow=0;var hRow=0;var dCol=0;var hCol=0;var rowInter=false;var colInter=false;
	switch (row) {
		case '-1': dRow=1;hRow=tr.length;break;
		case '-2': dRow=1;hRow=tr.length;rowInter=true; break;
		default: 
				if (row.indexOf('*')==0) {dRow=1;hRow=row.replace('*','');}
				if (row.indexOf('*')>0) {hRow=tr.length;dRow=row.replace('*','');}
				if (row.indexOf('-')>0) {var vec=row.split('-');dRow=vec[0];hRow=vec[1];}
				if (!isNaN(row)) {dRow=row;hRow=row;}

	}

	switch (col) {
		case '-1': dCol=0;hCol=tr[1].cells.length-1;break;
		case '-2': dCol=0;hCol=tr[1].cells.length-1;colInter=true; break;
		default: 
				if (col.indexOf('*')==0) {dCol=0;hCol=col.replace('*','');}
				if (col.indexOf('*')>0) {hCol=tr[1].cells.length-1;dCol=col.replace('*','');}
				if (col.indexOf('-')>0) {var vec=col.split('-');dCol=vec[0];hCol=vec[1];}
				if (!isNaN(col)) {dCol=col;hCol=col;}

	}

	if (colcond=='' || colcond== undefined) colcond=0;

	for (var i = dRow; i < hRow; i++) {
		if (!rowInter || (i % 2 == 0)) {
			var td=tr[i].cells;
			for (var j = dCol; j <= hCol; j++) {
				if (!colInter || (j % 2 != 0)) {
					if (td[colcond].innerHTML==condicion || condicion=='' || condicion==undefined) {
						if (estilo!='') {
							td[j].setAttribute("style", estilo);
						}
						td[j].className+=clase;
					}
				}
			}
		}
			
	}
	
}

function convertirAControl(tabla, fila, celda, tipoControl, className, style) {
	if (fila==undefined || fila==-1 || fila==null || fila=='') {
		var inicio=0; var fin=Filas(tabla);
	} else {
		var inicio=fila; var fin =fila+1;
	}

	for (var i = inicio; i < fin; i++) {
		var tr=document.getElementById(tabla).getElementsByTagName('tr')[i];
		var td=tr.cells[celda];
		switch (tipoControl) {
			case 'text':
				var o=document.createElement('input');o.type="text";o.id="ctr"+tipoControl+i;o.value=td.innerText;o.addClass(className);
				break;
			case 'checkbox':
				var o=document.createElement('input');o.type="checkbox";o.id="ctr"+tipoControl+i;
				if (td.innerText=='1') o.checked=true; else o.checked=false;
				o.value=td.innerText;
				break;

		}
		td.innerHTML="";
		td.appendChild(o);
		
	}
}

function Filas(tabla) {
	var tr=document.getElementById(tabla).getElementsByTagName('tr');
	return tr.length;
}

function infoFila(tabla, col, id) {
	var tr=document.getElementById(tabla).getElementsByTagName('tr');
	for (var i = 0; i < tr.length; i++) {
		if (tr[i].cells[col].innerText==id) {
			return tr[i];
		}
	}
}

function TableToJson(table, titulos) {
    var data = [];
    if (titulos) {
    	var thead=table.getElementsByTagName('thead')[0];
	    // first row needs to be headers
	    var headers = [];
	    var inicio=1;
	    for (var i=0; i<thead.rows[0].cells.length; i++) {
	        headers[i] = thead.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi,'');
	    }
	} else {
		var headers=[];
		var inicio=0;
		for (var i = 0; i < table.rows[0].cells.length; i++) {
			headers[i]="dato"+i;
		}
	}

    // go through cells
    for (var i=inicio; i<table.rows.length; i++) {

        var tableRow = table.rows[i];
        var rowData = {};

        for (var j=0; j<tableRow.cells.length; j++) {
        	var obj=tableRow.cells[j].childNodes[0];
        	rowData[ headers[j] ] = tableRow.cells[j].innerHTML;
        	if (obj.tagName=="INPUT") {
        		if (obj.type=='text')
        			rowData[ headers[j] ] = obj.value;
        		if (obj.type=='checkbox')
        			rowData[ headers[j] ] = (obj.checked ? '1' : '0');
        	}
        	if (obj.tagName=="A") {
            	rowData[ headers[j] ] = obj.parentNode.innerText;
        	}
        	if (obj.tagName=="SELECT") {
            	rowData[ headers[j] ] = getValue(obj.id);
        	}

        }

        data.push(rowData);
    }       

    return data;
}
function setValue(ctrl, valor) {
	var control=document.getElementById(ctrl);
	if (control.type=="text" || control.type=="password" || control.type=="textarea" || control.type=="hidden" || control.type=='time' || control.type=='number' || control.type=="checkbox")
		{control.value=valor;return true;}
	if (control.type=="select-one") 
		{setComboItem(ctrl, valor);return true;}
	if (control.type=="date") 
		{var dt=new DateTime();dt.init(valor,"ymd");control.value=dt.formats.compound.mySQL;return true;}

	control.innerHTML=valor;
	return true;


}
function getValue(ctrl) {
	var control=document.getElementById(ctrl);
	if (control.type=="text" || control.type=="password" || control.type=="textarea" || control.type=="date" || control.type=='time' || control.type=="hidden" || control.type=='time' || control.type=="checkbox" || control.type=="number")
		return control.value;
	if (control.type=="select-one") 
		return valorCombo(ctrl);

	return control.innerHTML;

}
//********************************************************************************************************
//Funciones de llenado de combos
//********************************************************************************************************
//Esta Fc recibe un nombre de combo y una query y lo llena con el resultado
function LlenarComboSQL(combo, query, blanco) {
	var cbo=document.getElementById(combo);
	
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	var resp=xmlhttp.responseText;
        	
        	obj=JSON.parse(resp);
        	cbo.innerHTML='';
        	if (obj.length==0) {
        		alert("Error finding data: "+obj.respuesta);
        	}
        	else {
        		JsonToCombo(obj, combo, blanco);
        	}
        }
    }
	xmlhttp.open("GET","ajaxfunciones.php?consulta=customQuery&query="+query+"&tipo=Q",false);
	xmlhttp.send();		
}

//Esta fc recibe un objeto json y un combo. Se llena en base a campos de json
function JsonToCombo(j, cbo, blanco) {
	var combo=document.getElementById(cbo);
	
	if (blanco) {
		var op = document.createElement("option");
		
		op.value="";
		op.text="";
		combo.options.add(op);
	}

	for (var i=0, l=j.length; i < l; i++) {
		var keys=Object.keys(j[i]);
		var op = document.createElement("option");
		
		op.value=j[i][keys[0]];
		op.text=j[i][keys[1]];

		combo.options.add(op);
    }
}
function setComboItem(cbo,valor) {
	var o=document.getElementById(cbo);
	for (var i = 0; i < o.options.length; i++) {
		if (o.options[i].value==valor) {
			o.selectedIndex=i;
		}
	}
	return false;
}
function toggle(control, tipo, estado) {
	var o=document.getElementById(control);
	switch (tipo) {
		case 'visible':

			if (estado==null)
				if (o.style.display=="")
					o.style.display="none";
				else
					o.style.display="";
			else
				if (estado) 
					o.style.display="";
				else 
					o.style.display="none";

			break;
		case 'disabled':
			if (estado==null)
				if (o.disabled)
					o.disabled=false;
				else
					o.disabled=true;
			else
				if (estado) 
					o.disabled=false;
				else 
					o.disabled=true;

			break;
		case 'enabled':
			if (estado==null)
				o.disabled=!o.disabled;
			else
				o.disabled=!estado;
			break;
		case 'table-row':

			if (estado==null)
				if (o.style.display=="table-row")
					o.style.display="none";
				else
					o.style.display="table-row";
			else
				if (estado) 
					o.style.display="table-row";
				else 
					o.style.display="none";

			break;

	}
}
function valorCombo(combo) {
  var cbo=document.getElementById(combo);
  if (cbo.selectedIndex==-1)
  	return '';
  
  var valor=cbo.options[cbo.selectedIndex].value;
  return valor;
}

function textoCombo(combo) {
  var cbo=document.getElementById(combo);
  if (cbo==null) {
  	return '';
  }
  if (cbo.selectedIndex==-1)
  	return '';

  var valor=cbo.options[cbo.selectedIndex].text;
  return valor;
}

function DateTime() {
    function getDaySuffix(a) {
        var b = "" + a,
            c = b.length,
            d = parseInt(b.substring(c-2, c-1)),
            e = parseInt(b.substring(c-1));
        if (c == 2 && d == 1) return "th";
        switch(e) {
            case 1:
                return "st";
                break;
            case 2:
                return "nd";
                break;
            case 3:
                return "rd";
                break;
            default:
                return "th";
                break;
        };
    };

    this.init=function(nDate, formato) {
      if (nDate==undefined)
        this.date =  new Date();
      else {
      	if (formato=="dmy") {
      		var dia=nDate.substring(0,2);var mes=nDate.substring(3,5);anio=nDate.substring(6,10);
      		this.date=new Date(Number(anio), Number(mes)-1, Number(dia));
      	}
      	if(formato=="ymd") {
      		var anio=nDate.substring(0,4);var mes=nDate.substring(5,7);dia=nDate.substring(8,10);
      		this.date=new Date(Number(anio), Number(mes)-1, Number(dia));
      	}
      	if(formato=="ymdhms") {
      		var anio=nDate.substring(0,4);var mes=nDate.substring(5,7);var dia=nDate.substring(8,10);
      		var hora=nDate.substring(11,13);var minute=nDate.substring(14,16);var sec=nDate.substring(17,19);
      		this.date=new Date(Number(anio), Number(mes)-1, Number(dia),Number(hora), Number(minute), Number(sec));
      	}

      	if (formato=='obj')
      		this.date=nDate;
      	
      }
        

      this.getDoY = function(a) {
          var b = new Date(a.getFullYear(),0,1);
      return Math.ceil((a - b) / 86400000);
      }
      this.addDays =function(days) {
      	this.date.setDate(this.date.getDate() + days);

      }
      this.weekdays = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
      this.months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
      this.daySuf = new Array( "st", "nd", "rd", "th" );

      this.day = {
          index: {
              week: "0" + this.date.getDay(),
              month: (this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate()
          },
          name: this.weekdays[this.date.getDay()],
          of: {
              week: ((this.date.getDay() < 10) ? "0" + this.date.getDay() : this.date.getDay()) + getDaySuffix(this.date.getDay()),
              month: ((this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate()) + getDaySuffix(this.date.getDate())
          }
      }

      this.month = {
          index: (this.date.getMonth() + 1) < 10 ? "0" + (this.date.getMonth() + 1) : this.date.getMonth() + 1,
          name: this.months[this.date.getMonth()]
      };

      this.year = this.date.getFullYear();

      this.time = {
          hour: {
              meridiem: (this.date.getHours() > 12) ? (this.date.getHours() - 12) < 10 ? "0" + (this.date.getHours() - 12) : this.date.getHours() - 12 : (this.date.getHours() < 10) ? "0" + this.date.getHours() : this.date.getHours(),
              military: (this.date.getHours() < 10) ? "0" + this.date.getHours() : this.date.getHours(),
              noLeadZero: {
                  meridiem: (this.date.getHours() > 12) ? this.date.getHours() - 12 : this.date.getHours(),
                  military: this.date.getHours()
              }
          },
          minute: (this.date.getMinutes() < 10) ? "0" + this.date.getMinutes() : this.date.getMinutes(),
          seconds: (this.date.getSeconds() < 10) ? "0" + this.date.getSeconds() : this.date.getSeconds(),
          milliseconds: (this.date.getMilliseconds() < 100) ? (this.date.getMilliseconds() < 10) ? "00" + this.date.getMilliseconds() : "0" + this.date.getMilliseconds() : this.date.getMilliseconds(),
          meridiem: (this.date.getHours() > 12) ? "PM" : "AM"
      };

      this.sym = {
          d: {
              d: this.date.getDate(),
              dd: (this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate(),
              ddd: this.weekdays[this.date.getDay()].substring(0, 3),
              dddd: this.weekdays[this.date.getDay()],
              ddddd: ((this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate()) + getDaySuffix(this.date.getDate()),
              m: this.date.getMonth() + 1,
              mm: (this.date.getMonth() + 1) < 10 ? "0" + (this.date.getMonth() + 1) : this.date.getMonth() + 1,
              mmm: this.months[this.date.getMonth()].substring(0, 3),
              mmmm: this.months[this.date.getMonth()],
              yy: (""+this.date.getFullYear()).substr(2, 2),
              yyyy: this.date.getFullYear()
          },
          t: {
              h: (this.date.getHours() > 12) ? this.date.getHours() - 12 : this.date.getHours(),
              hh: (this.date.getHours() > 12) ? (this.date.getHours() - 12) < 10 ? "0" + (this.date.getHours() - 12) : this.date.getHours() - 12 : (this.date.getHours() < 10) ? "0" + this.date.getHours() : this.date.getHours(),
              hhh: this.date.getHours(),
              m: this.date.getMinutes(),
              mm: (this.date.getMinutes() < 10) ? "0" + this.date.getMinutes() : this.date.getMinutes(),
              s: this.date.getSeconds(),
              ss: (this.date.getSeconds() < 10) ? "0" + this.date.getSeconds() : this.date.getSeconds(),
              ms: this.date.getMilliseconds(),
              mss: Math.round(this.date.getMilliseconds()/10) < 10 ? "0" + Math.round(this.date.getMilliseconds()/10) : Math.round(this.date.getMilliseconds()/10),
              msss: (this.date.getMilliseconds() < 100) ? (this.date.getMilliseconds() < 10) ? "00" + this.date.getMilliseconds() : "0" + this.date.getMilliseconds() : this.date.getMilliseconds()
          }
      };

      this.formats = {
          compound: {
              commonLogFormat: this.sym.d.dd + "/" + this.sym.d.mmm + "/" + this.sym.d.yyyy + ":" + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              exif: this.sym.d.yyyy + ":" + this.sym.d.mm + ":" + this.sym.d.dd + " " + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              esmu: this.sym.d.mm + "/" +this.sym.d.dd + "/" +this.sym.d.yyyy + " " + this.sym.t.hh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              esmuDate: this.sym.d.mm + "/" +this.sym.d.dd + "/" +this.sym.d.yyyy,
              esmuDateSpanish: this.sym.d.dd +"/"+ this.sym.d.mm + "/"  +this.sym.d.yyyy+ " " + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              fechaArg: this.sym.d.dd +"/"+ this.sym.d.mm + "/"  +this.sym.d.yyyy,
              /*iso1: "",
              iso2: "",*/
              Totvs: this.sym.d.yyyy + this.sym.d.mm + this.sym.d.dd,
              mySQL: this.sym.d.yyyy + "-" + this.sym.d.mm + "-" + this.sym.d.dd,
              mySQLTime: this.sym.d.yyyy + "-" + this.sym.d.mm + "-" + this.sym.d.dd + " " + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              postgreSQL1: this.sym.d.yyyy + "." + this.getDoY(this.date),
              postgreSQL2: this.sym.d.yyyy + "" + this.getDoY(this.date),
              soap: this.sym.d.yyyy + "-" + this.sym.d.mm + "-" + this.sym.d.dd + "T" + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss + "." + this.sym.t.mss,
              //unix: "",
              xmlrpc: this.sym.d.yyyy + "" + this.sym.d.mm + "" + this.sym.d.dd + "T" + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              xmlrpcCompact: this.sym.d.yyyy + "" + this.sym.d.mm + "" + this.sym.d.dd + "T" + this.sym.t.hhh + "" + this.sym.t.mm + "" + this.sym.t.ss,
              wddx: this.sym.d.yyyy + "-" + this.sym.d.m + "-" + this.sym.d.d + "T" + this.sym.t.h + ":" + this.sym.t.m + ":" + this.sym.t.s
          },
          constants: {
              atom: this.sym.d.yyyy + "-" + this.sym.d.mm + "-" + this.sym.d.dd + "T" + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              cookie: this.sym.d.dddd + ", " + this.sym.d.dd + "-" + this.sym.d.mmm + "-" + this.sym.d.yy + " " + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              iso8601: this.sym.d.yyyy + "-" + this.sym.d.mm + "-" + this.sym.d.dd + "T" + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              rfc822: this.sym.d.ddd + ", " + this.sym.d.dd + " " + this.sym.d.mmm + " " + this.sym.d.yy + " " + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              rfc850: this.sym.d.dddd + ", " + this.sym.d.dd + "-" + this.sym.d.mmm + "-" + this.sym.d.yy + " " + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              rfc1036: this.sym.d.ddd + ", " + this.sym.d.dd + " " + this.sym.d.mmm + " " + this.sym.d.yy + " " + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              rfc1123: this.sym.d.ddd + ", " + this.sym.d.dd + " " + this.sym.d.mmm + " " + this.sym.d.yyyy + " " + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              rfc2822: this.sym.d.ddd + ", " + this.sym.d.dd + " " + this.sym.d.mmm + " " + this.sym.d.yyyy + " " + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              rfc3339: this.sym.d.yyyy + "-" + this.sym.d.mm + "-" + this.sym.d.dd + "T" + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              rss: this.sym.d.ddd + ", " + this.sym.d.dd + " " + this.sym.d.mmm + " " + this.sym.d.yy + " " + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss,
              w3c: this.sym.d.yyyy + "-" + this.sym.d.mm + "-" + this.sym.d.dd + "T" + this.sym.t.hhh + ":" + this.sym.t.mm + ":" + this.sym.t.ss
          },
          pretty: {
              a: this.sym.t.hh + ":" + this.sym.t.mm + "." + this.sym.t.ss + this.time.meridiem + " " + this.sym.d.dddd + " " + this.sym.d.ddddd + " of " + this.sym.d.mmmm + ", " + this.sym.d.yyyy,
              b: this.sym.t.hh + ":" + this.sym.t.mm + " " + this.sym.d.dddd + " " + this.sym.d.ddddd + " of " + this.sym.d.mmmm + ", " + this.sym.d.yyyy
          }
      };
    }
};
var oAjax=new clsFrameAjax;
var oUser = new clsUser();

function exportTableToCSV($table, filename) {
    var $headers = $table.find('tr:has(th)')
        ,$rows = $table.find('tr:has(td)')

        // Temporary delimiter characters unlikely to be typed by keyboard
        // This is to avoid accidentally splitting the actual contents
        ,tmpColDelim = String.fromCharCode(11) // vertical tab character
        ,tmpRowDelim = String.fromCharCode(0) // null character

        // actual delimiter characters for CSV format
        ,colDelim = '";"'
        ,rowDelim = '"\r\n"';

        // Grab text from table into CSV formatted string
        var csv = '"';
        csv += formatRows($headers.map(grabRow));
        csv += rowDelim;
        csv += formatRows($rows.map(grabRow)) + '"';

        // Data URI
        var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

    // For IE (tested 10+)
    if (window.navigator.msSaveOrOpenBlob) {
        var blob = new Blob([decodeURIComponent(encodeURI(csv))], {
            type: "text/csv;charset=utf-8;"
        });
        navigator.msSaveBlob(blob, filename);
    } else {
        $(this)
            .attr({
                'download': filename
                ,'href': csvData
                //,'target' : '_blank' //if you want it to open in a new window
        });
    }

    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    // Format the output so it has the appropriate delimiters
    function formatRows(rows){
        return rows.get().join(tmpRowDelim)
            .split(tmpRowDelim).join(rowDelim)
            .split(tmpColDelim).join(colDelim);
    }
    // Grab and format a row from the table
    function grabRow(i,row){
         
        var $row = $(row);
        //for some reason $cols = $row.find('td') || $row.find('th') won't work...
        var $cols = $row.find('td'); 
        if(!$cols.length) $cols = $row.find('th');  

        return $cols.map(grabCol)
                    .get().join(tmpColDelim);
    }
    // Grab and format a column from the table 
    function grabCol(j,col){
        var $col = $(col),
            $text = $col.text();

        return $text.replace('"', '""'); // escape double quotes

    }
}

function printdiv(printpage, titulo) {
	var headstr = '<html><head><title>'+titulo+'</title><link rel="stylesheet" type="text/css" href="../css/gral.css"></head><body>';
	var footstr = "</body>";
	var newstr = document.all.item(printpage).innerHTML;
	var oldstr = document.body.innerHTML;
	document.body.innerHTML = headstr+newstr+footstr;
	window.print();
	document.body.innerHTML = oldstr;
	return false;
}
function printDiv2(printObj, titulo) {
	var div=document.createElement('div');
	div.id="__tmpDiv__";
	div.style.height="100vh";
	div.style.width="100vw";
	div.style.position="absolute";
	div.style.left="0";div.style.top="0";
	div.style.zorder="10000";
	div.style.backgroundColor="white";

	var p=document.createElement('h3');
	p.innerText=titulo;
	div.appendChild(p);
	div.innerHTML+=document.getElementById(printObj).innerHTML;
	document.body.appendChild(div);
	//$("#swimbi").hide();
	window.print();
	document.body.removeChild(div);
	//$("#swimbi").show();
}

function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}
function msgbox(mensaje, icono, duracion, cmd1,fc1, cmd2,fc2) {
	var fondo=document.createElement('div');
	var div=document.createElement('div');
	var img=document.createElement('img');
	var p=document.createElement('p');
	
	var body=document.getElementsByTagName('body')[0];
	fondo.classList.add('fondonegro');
	fondo.id="fondoMsgBox";
	div.id="ventana";
	div.classList.add('msgboxClass');
	img.src="imagenes/"+icono;
	img.style.width="32px";
	img.style.height="32px";
	p.innerText=mensaje;

	fondo.appendChild(div);
	div.appendChild(p);
	div.appendChild(img);

	if (cmd1!='' && cmd1!=undefined) {
		var btn1=document.createElement('button');
		btn1.classList.add('botoncancel');
		btn1.innerText=cmd1;
		btn1.style.display='block';
		btn1.addEventListener( "click", new Function(fc1));
		div.appendChild(btn1);
	}

	if (cmd2!='' && cmd2!=undefined) {
		var btn2=document.createElement('button');
		btn2.classList.add('botoncancel');
		btn2.innerText=cmd2;
		btn2.style.display='block';
		btn2.addEventListener( "click", new Function(fc2));
		div.appendChild(btn2);
	}
	
	body.appendChild(fondo);
	div.style.display="";
	fondo.style.display="";
	$('ventana').fadeIn(1200);
	if (duracion!=undefined && duracion>0)
		setTimeout(function() {$('ventana').fadeOut();fondo.parentNode.removeChild(fondo);}, duracion);

	if (btn1!=undefined)
		btn1.focus();
}

function closeMSG() {
	var fondo=document.getElementById('fondoMsgBox');fondo.parentNode.removeChild(fondo);	
}
function BuscarDato(consulta) {
	oAjax.server="ajaxfunciones.php?consulta=";
	oAjax.request="customQuery&query="+consulta+"&tipo=Q";
	oAjax.async=false;
	var resp="";
	oAjax.send(respBuscar);

	
	function respBuscar(data) {
		if (data.responseText.length<3) {
			resp= "";
			return false;
		}

		var obj=JSON.parse(data.responseText);
		for (var key in obj[0]) {
			resp= obj[0][key];
			return false;
		}
	}
	return resp;

}

function espera(estado) {
var body=document.getElementsByTagName('body')[0];
	if (estado=='on') {
		var div=document.createElement('div');
		var msg=document.createElement('div');
		var p=document.createElement('p');
		var img=document.createElement('img');

		div.id='divLoading';
		img.id="divMensaje";
		p.innerHTML="Procesando";
		div.classList.add('fondonegro');
		img.src="./imagenes/uploading.gif";
		
		msg.classList.add('clsMensaje');
		msg.appendChild(p);
		msg.appendChild(img);
		div.appendChild(msg);
		body.appendChild(div);

		$("#divLoading").show();
		$("#divMensaje").show();
	}
	else {
		var fondo=document.getElementById('divLoading');
		fondo.parentNode.removeChild(fondo);	
		$("#divLoading").hide();
		$("#divMensaje").hide();
	}
}
function logoff() {
	oAjax.request="logoff";
	oAjax.send(resp);

	function resp(data) {
		location.href="./index.php";
		
	}
}
function JsonParser(str) {
	str=str.replace(/\t/g, '');
	str=str.replace(/\&/g, '');
	//str=str.replace(/\"/g, '´´');
	//str=str.replace(/\'/g, "´");

	return JSON.parse(str);
}
