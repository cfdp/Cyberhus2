/**
 * @author Daniel Mois
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
     var counter = "hej";
     

     
	//$('#green, #yellow, #red').hide();
	function updateChat(){
		var response = "<h1>Velkommen :)</h1><p>Chatrågivningen i Cyberhus er sikker chat. Så snart du er logget ind bliver chatten spærret, og der kan ikke komme andre ind. Du kan anonymt og i fortrolighed chatte med os.<br />Vi har tavshedspligt - Du behøver ikke at opgive navn og adresse.</p><p>	Log på og hils på os...</p>";
		counter = "hej".counter;
		//alert('que pasa?');

		$('#chat_desc').html(response);
		
		var link = "<li><p>Chatrådgivningen ÅBEN</p></li><li><a href=\"#\">Log på</a></li>";
		$('#ccep_login').html(link);
		
		
		
		 //make AJAX call
		 /*
		 $.ajax({
		 	type: 'POST',
		 	url: this.href,
		 	datatype: 'json',
		 	success: chatUpdated,
		 	data: 'js=1'
		});
		*/
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