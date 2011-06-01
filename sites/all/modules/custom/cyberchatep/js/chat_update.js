/**
 * @authors Daniel Mois and Benjamin Christensen
 * 
 */
$(document).ready(function (){
	
	 //Chat entry point panel slide down
    $("#ccep_panel").hide();
    $("#ccep_status").toggle(
        function(){
            $("#ccep_panel").slideDown();
        },
        function(){
            $("#ccep_panel").slideUp();
        }
     )

	//on this url the chatep-module has a menu callback that delivers the json-data
	var chat_update_url = "http://cyberhus.devel:8082/cyberchatep/returntext"; 

	function updateChat(){
		//alert('hey');
		var chatUpdated = function (data){
			//update the chat
			$('#ccep_status').html(data.login_message);
			$('#ccep_desc').html(data.welcome_message);
			chat_update_url = data.path+"/cyberchatep/returntext/"+data.status;

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