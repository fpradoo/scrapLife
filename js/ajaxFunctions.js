function showProductoSelect(str) {
    if (str == "") {
        document.getElementById("main").innerHTML = "";
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
                document.getElementById("main").innerHTML = xmlhttp.responseText;
            }
        }
		console.log(xmlhttp.responseText);
        xmlhttp.open("GET","/core/ajaxRecall.php?q="+str+"&func=1",true);
        xmlhttp.send();
    }
}


function showCategoriasDeProducto(str) {
    if (str == "") {
        document.getElementById("categoria").innerHTML = "";
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
                document.getElementById("categoria").innerHTML = xmlhttp.responseText;
            }
        }
		
		var idProductoPadre = document.getElementById("products").value;
		console.log(xmlhttp.responseText);
        xmlhttp.open("GET","/core/ajaxRecall.php?q="+str+"&func=2&idpadre="+idProductoPadre,true);
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