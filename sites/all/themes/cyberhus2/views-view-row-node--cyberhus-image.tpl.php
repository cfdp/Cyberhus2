<?php
// $Id: views-view-row-node.tpl.php,v 1.3 2008/07/09 18:31:26 merlinofchaos Exp $
/**
 * @file views-view-row-node.tpl.php
 * Default simple view template to display a single node.
 *
 * Rather than doing anything with this particular template, it is more
 * efficient to use a variant of the node.tpl.php based upon the view,
 * which will be named node-view-VIEWNAME.tpl.php. This isn't actually
 * a views template, which is why it's not used here, but is a template
 * 'suggestion' given to the node template, and is used exactly
 * the same as any other variant of the node template file, such as
 * node-NODETYPE.tpl.php
 *
 * @ingroup views_templates
 */
/*der er noget bøvl med cck felternes tid i forhold til systemets - derfor +1-hacket*/
?>

<?php $k1 = node_load($row->nid); ?>
<?php $start = $k1->field_time[0]['value']; /*print("før cast to int".$start_corrected); $start_corrected = (int)$start_corrected; print("efter cast to int".$start_corrected); $start_corrected = (string)$start_corrected; */ ?>
<?php $start_corrected = strtotime($start." +1 hour");?>
<?php $end = $k1->field_time[0]['value2']; ?>
<?php $end_corrected = strtotime($end." +1 hour");?>
<?php /*debugging: print "fieldstart_corrected: ".date('H:i:s',$start_corrected)."fieldslut_corrected: ".date('H:i:s',$end_corrected)."systemdate: ".date('H:i:s');*/ ?>
<?php if ((date('H:i:s') >= date('H:i:s',$start_corrected)) AND (date('H:i:s') <= date('H:i:s',$end_corrected))){

   $cyberimage_class = $k1->field_season[0]['value']."-".$k1->field_day_night[0]['value'];
   print("<div id='cyberhus-image' class='".$cyberimage_class."'>");
     print $node;
   print("</div>"); 
   print("<div class='cyberflash_beskrivelse_tekstfelt'><span class='cyberflash_tekst'>");
     global $base_url; 
     global $user;
     print($k1->field_cyberflash_beskrivelse[0]['value']);
   
     $loggedin_user_access = (in_array('Superadmin',$user->roles));
     /*hvis brugeren er superadmin må der redigeres...*/
     if ($loggedin_user_access) {
	  print("<a class='laes_mere' href='".$base_url."/node/".$k1->nid."/edit'> Redigér</a>"); 
     }
   print("</span></div>");
   
   print("<div class='cyberflash_fanlink_tekstfelt'><span class='cyberflash_tekst'>");
     print($k1->field_fanlink[0]['value']);
   print("</span></div>"); 
   

   } 
   ?>



<?php if ($comments): ?>
  <?php print $comments; ?>
<?php endif; ?>