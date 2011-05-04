<?php
$filename = 'xmlfilnavn.txt';
$Content = "SAVE.xml";

echo "open";
$handle = fopen($filename, 'x+');
echo " write";
fwrite($handle, $Content);
echo " close";
fclose($handle);


/*
if($handle = fopen($filename, 'a')){
   if(is_writable($filename){
      if(fwrite($handle, $content) === FALSE){
         echo "Cannot write to file $filename";
         exit;
      }
      echo "The file $filename was created and written successfully!";
      fclose($handle);
   }
   else{
      echo "The file $filename, could not written to!";
      exit;
   }
}
else{
   echo "The file $filename, could not be created!";
   exit;
}*/
?>

