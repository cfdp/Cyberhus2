/**
 * @authors Daniel Mois and Benjamin Christensen
 * 
 */
$(document).ready(function (){
	
	 //Chat entry point panel slide down
    $("#ccep_panel").hide();
    $("#ccep_login").toggle(
        function(){
            $("#ccep_panel").slideDown();
        },
        function(){
            $("#ccep_panel").slideUp();
        }
     )

	//on this url the chatep-module has a menu callback that delivers the json-data
	var chat_update_url = "cyberchatep/returntext"; 

	//$('#green, #yellow, #red').hide();
	function updateChat(){
		//alert('hey');

		var chatUpdated = function (data){
			//update the chat
			$('#ccep_login').html(data.login_message);
			$('#chat_desc').html(data.welcome_message);		
		}
		 //make AJAX call
		 $.ajax({
		 	type: 'POST',
		 	url: chat_update_url,
		 	dataType: 'json',
		 	success: chatUpdated,
		 	data: 'js=1'
		});
		
	};
	
	updateChat();
	setInterval(updateChat, 4000);
	
});

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
	
	xmlhttp.open("GET", "http://chat.cybhus.dk/chat_status.php", true);
	xmlhttp.send();
	*/