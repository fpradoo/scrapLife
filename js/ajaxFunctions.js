//Funciones Asyncronicas
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

function finalEdicion(name){
	
	$('#products').attr( "onchange", "showProductoSelect(this.value)" );
	
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
	xmlhttp.open("GET","/core/ajaxRecall.php?q="+values+"&idPadre="+$('#products').val()+"&func=2",true);
	xmlhttp.send();
	
	alertaFinal();
	
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
	xmlhttp.open("GET","/core/ajaxRecall.php?q="+str+"&idPadre="+idPadre+"&func=3",true);
	xmlhttp.send();	
}

function borrarUltimaSubcat(idPadre){
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
	xmlhttp.open("GET","/core/ajaxRecall.php?idPadre="+idPadre+"&func=4",true);
	xmlhttp.send();
}

function eliminarProducto(str){
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
	console.log(xmlhttp.responseText);
	xmlhttp.open("GET","/core/ajaxRecall.php?q="+str+"&func=5",true);
	xmlhttp.send();	
}

//Funciones no asyncronicas
function mostrarOcultar(id){
	console.log(id);
	if($("#"+id).is(':visible')){
		$("#"+id).slideUp();
	}else{
		$("#"+id).slideDown();
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

function retrocederCategoria(value,name){
	var valSig;
	
	valSig = value - 2;
	value = value - 1;
	
	$('#error').hide('slow');
	$('#'+value).hide('slow');
	$('#'+valSig).show('slow');
		
	borrarUltimaSubcat($('#products').val());
}


function alertaPersonalizada(val){
	swal({
	  title: "El armado de tu producto aun no ha finalizado.",
	  text: "¿Deseas abandonarlo? Si elegís ABANDONAR todos las opciones elegidas se perderán y deberás comenzar nuevamente.",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "ABANDONAR",
	  closeOnConfirm: true
	},
	function(){
		if(val == 'a'){
			window.location = "http://scraplife/index.php#productos"
		}else{
			showProductoSelect(val);
		}
	});		
}

function alertaFinal(){
	swal({
	  title: "Estás a punto de finalizar el armado de tu producto.",
	  text: "Podrás concluir tu pedido y dirigirte para pagarlo. Revisá que todo lo que elegiste es lo que querés y hacé click en PAGAR para terminar tu pedido. También podrás comenzar el armado de un producto nuevo para sumarlo al anterior.",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "PAGAR",
	  cancelButtonText: "COMENZAR OTRO",
	  closeOnConfirm: true,
	  closeOnCancel: true	
	},
	function(isConfirm){
	  if (isConfirm) {
		window.location = "http://scraplife/order.php"
	  } else {
		window.location = "http://scraplife/index.php#productos"
	  }
});
	
}
