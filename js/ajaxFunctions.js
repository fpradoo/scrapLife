function showProductoSelect(str) {
    if (str == "") {
        document.getElementById("productoCompleto").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("productoCompleto").innerHTML = xmlhttp.responseText;
            }
        }
		console.log(xmlhttp.responseText);
        xmlhttp.open("GET","/core/ajaxRecall.php?q="+str+"&func=1",true);
        xmlhttp.send();
    }
}

function changeImagenCategoria(str, imgId, checkState, type) {
    if (str == "") {
        document.getElementById(imgId).innerHTML = "";
        return;
    } else {
		var viejoCodigo = document.getElementById(imgId).innerHTML;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(imgId).innerHTML = xmlhttp.responseText;
            }
        }
		console.log(xmlhttp.responseText);
        xmlhttp.open("GET","/core/ajaxRecall.php?q="+str+"&func=3&viejoCod="+viejoCodigo+"&checkState="+checkState+"&type="+type,true);
        xmlhttp.send();
    }
}

function cambiarCategoria(value,name){
	var valSig;
	valSig = value - 1;
	
	if($('input[name="'+name+'"]:checked').length == 0){
		$('#error').show('fast');
	}else{
		$('#error').hide('slow');
		$('#'+valSig).hide('slow');
		$('#'+value).show('slow');
		
		var values = $('input[name="'+name+'"]:checked').map(function () {
			return this.value;
		}).get();
		
		cargarOpcion(values, $('#products').val());
	}
}

function cargarOpcion(str, idPadre){
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("carrito-compras").innerHTML = xmlhttp.responseText;
		}
	}
	console.log(xmlhttp.responseText);
	xmlhttp.open("GET","/core/ajaxRecall.php?q="+str+"&idPadre="+idPadre+"&func=5",true);
	xmlhttp.send();	
}

function finalEdicion(name){
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("submain").innerHTML = xmlhttp.responseText;
		}
	}
	
	var values = $('input[name="'+name+'"]:checked').map(function () {
			return this.value;
		}).get();
	
	console.log(xmlhttp.responseText);
	xmlhttp.open("GET","/core/ajaxRecall.php?q="+values+"&idPadre="+$('#products').val()+"&func=4",true);
	xmlhttp.send();
	
}