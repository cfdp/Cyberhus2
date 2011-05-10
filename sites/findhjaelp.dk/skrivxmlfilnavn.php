<?php

function writeNewName($newname)
{
	if ($newname == (null || "") ) {
		exit("Det nye xmlfilnavn er ugyldigt. Beklager.");
	}
	//vi slår op i xmlfilnavn for at se hvad den gamle xmlfil hedder
	$filename = 'xmlfilnavn.txt';
	
	$fh = fopen($filename, 'r');
	$oldfilename = fread($fh, filesize($filename));
	fclose($fh);
	
	//slet den gamle fil...
	$oldfilename = "xml_files/" . $oldfilename;
	//echo $oldfilename . "slettes...";
	unlink($oldfilename);
	
	//det nye navn skrives ind	
	if($handle = fopen($filename, 'w')){
	   if(is_writable($filename)){
		  if(fwrite($handle, $newname) === FALSE){
			 echo "Skrivxmlfilnavn.php: Cannot write to file $filename";
			 exit;
		  }
		  echo "<p>&AElig;ndringerne er udf&oslash;rt, database opdateret.</p>";
		  fclose($handle);
	   }
	   else{
		  echo "Skrivxmlfilnavn.php: The file $filename, could not be written to!";
		  exit;
	   }
	}
	else{
	   echo "The file $filename, could not be created!";
	   exit;
	}
}



?>

