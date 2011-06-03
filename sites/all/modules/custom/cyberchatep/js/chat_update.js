/**
 * @authors Daniel Mois and Benjamin Christensen
 * 
 */
$(document).ready(function (){
	
	//the url of the menu item defined by the cyberchatep module, that returns the json object with the markup for the panel
	var chat_update_url;
	
	 //Chat entry point panel slide down
    $("#ccep_panel").hide();
    $("#ccep_status").toggle(
        function(){
            $("#ccep_panel").slideDown();
        },
        function(){
            $("#ccep_panel").slideUp();
        }
     );
	if (chat_update_url == undefined) {
		chat_update_url = Drupal.settings.cyberchatep.baseurl+"/cyberchatep/returntext"; 
	}

	//alert(chat_update_url);
	
	function updateChat(){
		//alert('hey');
		var chatUpdated = function (data){
			//update the chat panel divs
			$('#ccep_status').html(data.login_message);
			$('#ccep_desc').html(data.welcome_message);
			//alert(data.welcome_message);
			chat_update_url = Drupal.settings.cyberchatep.baseurl+"/cyberchatep/returntext/"+data.status;

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
	
	//we look for news every 40th second
	setInterval(updateChat, 10000);
	
});
