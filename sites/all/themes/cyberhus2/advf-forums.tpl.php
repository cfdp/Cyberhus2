<?php
// $Id: advf-forums.tpl.php,v 1.1.2.5 2009/01/27 23:31:11 michellec Exp $

/**
 * @file
 * Default theme implementation to display a forum which may contain forum
 * containers as well as forum topics.
 *
 * Variables available:
 * - $links: An array of links that allow a user to post new forum topics.
 *   It may also contain a string telling a user they must log in in order
 *   to post. Empty if there are no topics on the page. (ie: forum overview)
 * - $links_orig: Same as $links but not emptied on forum overview page.
 * - $forums: The forums to display (as processed by forum-list.tpl.php)
 * - $topics: The topics to display (as processed by forum-topic-list.tpl.php)
 * - $forums_defined: A flag to indicate that the forums are configured.
 * - $forum_description: The forum's taxonomy term description, if any.
 * - $forum_root_description: The top level forum's taxonomy term description, if any.
 *
 * @see template_preprocess_forums()
 * @see advanced_forum_preprocess_forums()
 */
?>

<?php if ($forums_defined): ?>
<div id="forum">
 	<?php
 	/*
	 * Author: Daniel 23.03.2011
	 * Imlement the corresponding icon for the forum
	 * Custom variables created: $fforum_id that contains the current forum id
	 * necessary to locate and fetch the corresponding png image file.
	 * In the case of the cyberskole forums, we use the $forum_sc_topic_ids array
	 * that contains all the forum ids part of the cyberskole.
	 * The subforum icons are only printed on the topic page when $fforum_id is NOT FALSE 
	 * CAUTION : If any of these ids change or forums are added, this array has to be modified accordingly.  
	 */
 		
		
		$forum_sc_topic_ids = array(317,329,322,330,331,325,617,901,1491);
		$fforum_id = substr($links['forum']['href'],15);
		foreach($forum_sc_topic_ids as $sc_forum_id){
			if($sc_forum_id == $fforum_id){
				$fforum_id = "cs";
			}
		}
	?>
	<div id="subforum_icon">
		<?php 
			//this is also printed out on the page with all the topics for one section, forum/30 NEED FIX
			if($fforum_id){
				print "<img src=\"/sites/all/themes/cyberhus2/images/advf-forum-new-icons/".$fforum_id.".png\" width=\"50\" height=\"50\" />";
			};	 
		?>
	</div>
  <?php if ($forum_description): ?>	
  <div class="forum-description">
    <?php print $forum_description; ?>
  </div>
  <?php endif; ?>

  <div class="forum-top-links"><?php print theme('links', $links, array('class' => 'links forum-links')); ?></div>
  <?php print $forums; ?>
  <?php print $topics; ?>
</div>
<?php endif; ?>
