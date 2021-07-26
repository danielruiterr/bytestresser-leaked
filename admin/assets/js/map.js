function AttackMap(content) {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			$('#AttackMap').html(xmlhttp.responseText);
		}
	}
	xmlhttp.open("GET",content,true);
	xmlhttp.send();
}

AttackMap('map.php');

// setInterval(function(){ AttackMap('map.php'); }, 5000);