// Funktionen der definerer topbannerets baggrund afhængig af tidspunktet.
// Emil Ellerbek

<!-- Start
function getCSS()
{
datetoday = new Date();
timenow=datetoday.getTime();
datetoday.setTime(timenow);
thehour = datetoday.getHours();

if (thehour < 13)
display = "http://www.cyberhus.dk/sites/all/themes/cyberhus_test/1400.css";
else if (thehour > 14)
display = "http://www.cyberhus.dk/sites/all/themes/cyberhus_test/1500.css";
else
display = "http://www.cyberhus.dk/sites/all/themes/cyberhus_test/xx00.css";

var css = '<';  css+='link rel="stylesheet" href=' + display + ' \/';  css+='>';

document.write(css);
// Slut prut -->
}