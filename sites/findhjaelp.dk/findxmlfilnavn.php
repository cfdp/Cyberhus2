<?php

//kigger i xmlfilnavn.txt og finder navnet p� den aktuelle xml-fil
//herefter �bnes findhjaelp.html med navnet p� xmlfilen sendt med som variabel i url'en...
$myFile = "xmlfilnavn.txt";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);
//echo $theData;
//echo "http://ny.cyberhus.dk/files/findhjaelp.html?filnavn=".$theData;
//$handle = fopen("http://ny.cyberhus.dk/files/findhjaelp/findhjaelp.html", "r");

header( 'Location: http://www.cyberhus.dk/sites/findhjaelp.dk/findhjaelp.html?filnavn='.$theData );

//?filnavn=".$theData
?>
