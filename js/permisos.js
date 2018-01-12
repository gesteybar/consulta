function go (modulo, args) {
	if (modulo=='' || modulo.length==0) return false;

  var resp=false;
      var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  var resp=xmlhttp.responseText;
                  
                  if (resp=="{}") 
                    alert("error returning user permission"); 
                  else 
                    {
                    var Jo=JSON.parse(resp);
                    if (Jo[0].respuesta=='0' || Jo[0].respuesta=="") {
                    	alert('Access denied to this module');
                      resp=false;
                    } else {
                    	var link =Jo[0].Pagina;
                    	if (args!='') {
                    		link+='?'+args;
                    	}
                    	window.location.href=link;
                      resp=true;
                    }
                  }
                }
            }
        xmlhttp.open("GET","./ajaxfunciones.php?consulta=acceso&modulo="+modulo,true);
        xmlhttp.send();
  return resp;
}

function checkAccess (modulo) {

  if (modulo=='' || modulo.length==0) return false;

  r=false;
  oAjax.request="acceso&modulo="+modulo;
  oAjax.async=false;
  oAjax.send(resp);

  return r;

  function resp(data) {
    if (data.responseText.length<3) {
      alert("Acceso restringido a esta función"); 
      r=false;
      return false;
    } else {
      r=true;
    }

  }
      
                    

}

