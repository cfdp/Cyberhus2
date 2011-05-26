/**
 * @author Daniel Mois
 * 
 */
$(document).ready(function (){
	//$('#green, #yellow, #red').hide();
});
function updateChat(){

	/* if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
		var xmlhttp;
		xmlhttp = new XMLHttpRequest();
	}else{
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState < 4){
			//document.getElementById('feedback'+id).innerHTML = "<img src=\"images/ajax_loader.gif\" alt=\"loader\" width=\"16\" height=\"16\" />";
		}
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			var response = xmlhttp.responseText;
			var chat = jQuery.parseJSON(response);
			var state = chat.state;
			var tab_link = chat.link;
			

			
			if(state == 'red'){
				$('#green, #yellow, #red').hide();
				$('#red').show();
				$('.link').attr('href',tab_link);
			}
			if(state == 'green'){
				$('#green, #yellow, #red').hide();
				$('#green').show();
			}
			if(state == 'yellow'){
				$('#green, #yellow, #red').hide();
				$('#yellow').show();
				$('.link').attr('href',tab_link);
			}
		}
	}
	*/
	


			//debugging
			var state = 'red';
			//alert(state);
			//debugging
			
			if(state == 'red'){
				$('#green, #yellow, #red').hide();
				$('#red').show();
				$('.link').attr('href',tab_link);
			}
			if(state == 'green'){
				$('#green, #yellow, #red').hide();
				$('#green').show();
			}
			if(state == 'yellow'){
				$('#green, #yellow, #red').hide();
				$('#yellow').show();
				$('.link').attr('href',tab_link);
			}

	//debugging
	/*
	xmlhttp.open("GET", "http://chat.cybhus.dk/chat_status.php", true);
	xmlhttp.send();
	*/
}
updateChat();
setInterval(updateChat, 40000);