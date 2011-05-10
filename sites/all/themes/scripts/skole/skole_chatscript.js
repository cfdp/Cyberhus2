// JavaScript Document

var newwindow = '';

iCurrentScriptID = 0;

function skoleSwitchColorTo(chatstatus){

	ele = $(chatstatus);

	toffset = $("#SkolelightContent").position();

	$(ele).css({position:"absolute",

		top:0,

		left:0

		});

	if(typeof(supersleightActive) != "undefined"){
		$("#SkolelightContent").append(ele);
		supersleight.limitTo("SkolelightContent");
		supersleight.run();
	}
	else{
		$(ele).css({display:"none"});
		$("#SkolelightContent").append(ele);
		$(ele).siblings().fadeOut("def");
		$(ele).fadeIn("fast",function(){
		    $(this).siblings().remove();
		    });
        }

}

function skoleUpdateChat() {



  var main = document.getElementById("SkoleScriptContainer");

  

  // clear old scripts

  if(el = main.firstChild)

    main.removeChild(el);

  

  // Append new script elm

  oNewScript = document.createElement("script");

  oNewScript.src = 'http://onlinecyberskole.cyberhus.dk/lyskryds.php?action=checklys&date=' + new Date();

  oNewScript.id = "chatscript_" + iCurrentScriptID++;

  oCurrentScript = oNewScript;

  

  document.getElementById("SkoleScriptContainer").appendChild( oNewScript );

}



setInterval( skoleUpdateChat, 50000 );

$(function() { skoleUpdateChat(); })

