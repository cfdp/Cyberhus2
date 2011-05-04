<html>
  <head>
    <title>Parsed Data</title>
  </head>
  <body>
  <?php
       if(isset($_POST['create_dom_file'])){
        echo "<p>Parsed Employee Data</p>";
        $xmlfileName = $_POST['inputfile'];
        $default_dir = "xml_files/";
        $default_dir .=   $xmlfileName;

        $myDOM = domxml_open_file($default_dir);
        $root = $myDOM->document_element();
        //print
        $s = simplexml_import_dom($dom);
        echo "Element Name";
        echo   $s->employeename[0];
        }
        if(isset($_POST['simple_xml_load_file'])){
        echo "<p><B>Usage of simplexml_load_file</B></p>";
        $xmlfileName = $_POST['inputFile'];
        $default_dir = "E:/topxml/person.xml";

        $Persons = simplexml_load_file($default_dir);

        //var_dump($Persons);
        foreach($Persons->Person as $person_key => $person_val){
            echo "The root element <B>Persons</B> contains an element named
                  <B>$person_key</B><BR>";

        }

        }
  ?>
  </body>
</html>
