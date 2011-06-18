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
			//DANIEL 16.06.2011
			$("#ccep_status img:last").attr('src','/sites/all/modules/custom/cyberchatep/images/arrows_min_up.jpg');
			
			function dothis(){
				var n = $("[name='guest_navn']").val();
				var a = $("[name='guest_age']").val();
				var	s = $("#ccep :checked").val();
				if(s == undefined){s= 'none';}				
				var i=1;
				var ni = n.charCodeAt(0);
				var ai = a.charCodeAt(0);
				var si = s.charCodeAt(0);
				ni += '_';
				ai += '_';
				si += '_';
				for(i=1; i <= n.length-1; i++){
					ni += n.charCodeAt(i);
					ni += '_';
				}
				for(i=1; i <= a.length-1; i++){
					ai += a.charCodeAt(i);
					ai += '_';
				}
				for(i=1; i <= s.length-1; i++){
					si += s.charCodeAt(i);
					si += '_';
				}
				
				var url ="action=openchat&n="+ni+"&a="+ai+"&s="+si;
				window.open( "http://chat.cybhus.dk/client.php?"+url,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=600, height=400");
				//
			}
			$("#l").click(function () {
				dothis();
			});
			//Clear text fields on click event
			$("[name='guest_navn']").click(
				function(){	$(this).val(''); }
			).blur(
				function(){	$(this).val('Anonym'); }
			)
			$("[name='guest_age']").click(
				function(){	$(this).val(''); }
			).blur(
				function(){	$(this).val('Alder'); }
			);
			//
        },
        function(){
            $("#ccep_panel").slideUp();
			//DANIEL 16.06.2011
			$("#ccep_status img:last").attr('src','/sites/all/modules/custom/cyberchatep/images/arrows_min.jpg');
			//
        }
     );
	if (chat_update_url == undefined) {
		chat_update_url = Drupal.settings.cyberchatep.baseurl+"/cyberchatep/returntext"; 
	}
	
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
	
	//look for the chat status every 10th second
	setInterval(updateChat, 10000);
	//
	
});
