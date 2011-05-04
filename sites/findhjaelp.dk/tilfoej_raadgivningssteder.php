<html>
  <head>
    <title>Rådgivningssteder - data</title>
  </head>
  <body>
  <?php
      if(isset($_POST['create_employee'])){
        echo "Rådgivningssted data postet";
        $xmlfileName = $_POST['xmlfileName'];
        $navn = $_POST['navn'];
        $adresse = $_POST['adresse'];
        $lat = 56.1525;
		$lng = 10.3094;
        $kategori = $_POST['kategori'];
		$beskrivelse = $_POST['beskrivelse'];
        $xml_dec = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
        $rootELementStart = "<markers>";
        $rootElementEnd = "</markers>";
        $xml_doc =  $xml_dec;
        $xml_doc .=  $rootELementStart;
        $xml_doc .=  "<marker>";
		$xml_doc .=  "<navn><![CDATA[";
        $xml_doc .=  $navn;
		$xml_doc .=  "]]></navn>";
		$xml_doc .=  "<adresse><![CDATA[";
        $xml_doc .=  $adresse;
		$xml_doc .=  "]]></adresse>";
		$xml_doc .=  "<lat>";
        $xml_doc .=  $lat;
		$xml_doc .=  "</lat>";
		$xml_doc .=  "<lng>";
        $xml_doc .=  $lng;
		$xml_doc .=  "</lng>";
		$xml_doc .=  "<kategori>";
        $xml_doc .=  $kategori;
		$xml_doc .=  "</kategori>";
		$xml_doc .=  "<beskrivelse><![CDATA[";
        $xml_doc .=  $beskrivelse;
		$xml_doc .=  "]]></beskrivelse>";
        $xml_doc .=  "</marker>";
        $xml_doc .=  $rootElementEnd;
		$xml_doc = xmlIndent($xml_doc);
        $default_dir = "xml_files/";
        $default_dir .=   $xmlfileName .".xml";
        echo  $default_dir;
		echo 'Hi!  This is PHP version ' . phpversion();
        $fp = fopen($default_dir,'w');
        $write = fwrite($fp,$xml_doc);
      }
	  function xmlIndent($str){
    $ret = "";
    $indent = 0;
    $indentInc = 3;
    $noIndent = false;
    while(($l = strpos($str,"<",$i))!==false){
        if($l!=$r && $indent>0){ $ret .= "\n" . str_repeat(" ",$indent) . substr($str,$r,($l-$r)); }
        $i = $l+1;
        $r = strpos($str,">",$i)+1;
        $t = substr($str,$l,($r-$l));
        if(strpos($t,"/")==1){
            $indent -= $indentInc;
            $noIndent = true;
        }
        else if(($r-$l-strpos($t,"/"))==2 || substr($t,0,2)=="<?"){ $noIndent = true; }
        if($indent<0){ $indent = 0; }
        if($ret){ $ret .= "\n"; }
        $ret .= str_repeat(" ",$indent);
        $ret .= $t;
        if(!$noIndent){ $indent += $indentInc; }
        $noIndent = false;
    }
    $ret .= "\n";
    return($ret);
}
  ?>
  </body>
</html>
