<!--//
var dom = (document.getElementById) ? true : false;
if (!dom || document.layers){ alert("Denne webside fungerer kun \ni moderne browsere.") }
function mover(nr,on,clLeft,clTop,clRight,clBot) {
 menupunkt = document.getElementById('menuon').style 
 if (!on) { menupunkt.visibility = "hidden";return; }
 menupunkt.clip = "rect(" + clTop + " " + clRight + " " + clBot + " " + clLeft + ")";
 menupunkt.visibility = "visible" 
}
//-->