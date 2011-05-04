<?php
// $Id: node.tpl.php,v 1.4 2008/01/25 21:21:44 goba Exp $

/**
 * @file node.tpl.php
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_user().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clear-block">


  <div class="meta">
	<?php if (in_array('Cyberaktiv',$user->roles)): ?>
	  <div><?php print l(t('Edit this page'), 'node/' . $nid . '/edit'); ?></div>
	<?php endif; ?>
	

	<?php 
	/*-----------NUeH - indgreb---------
	 * Hvis forfatteren af "Min side" er en ung -> Tillad da adgang for den unge og vejlederen, 
	 * ellers  send brugerene til "adgang nægtet"
	 * */
	$forfatter=user_load($node->uid);
	if (in_array('NUeH Ung',$forfatter->roles)):?>
	<?php
		global $user;
		$profile_uid = $forfatter->uid;
		$forbindelse=user_relationships_load(array('between' => array($user->uid, $profile_uid), 'approved' => 1), array('sort' => 'name'));
		if (array_key_exists('vejleder for', $forbindelse) || $user->uid == $profile_uid || $user->uid == '120'){
		}
	else{header('Location:http://www.cyberhus.dk/node/1898');}
	?>
	<?php endif; ?>

	<?php /*Hvis det er en NUeH-side, skal vi ikke have cyberaktive-felter ind*/?>
	<?php if ((in_array('NUeH Ung',$forfatter->roles)) == false ): ?>
	<div id="ca_main">
		<div id="ca_topbanner-kunstv">
			<div id="ca_billede_frame">
				<?php print $picture; ?></div>
			<div id="ca_beskrivelse">
				<strong>Rum: </strong><?php /* print $emne;*/?> <br />
				<strong>CyberAktiv redakt&oslash;r: </strong><?php print $name; ?><br />
				<?php print $node->field_min_side_beskrivelse[0]['value']; ?>
			</div>
			<a class="sign_link" href="http://www.cyberhus.dk/node/3379"></a>	
		</div>
		<div id="ca_content">
		<div id="ca_bar"><?php print $title; ?></div>
		<div id="ca_inside"><?php print $content; $uid = arg(1); print user_load(array('uid' => $uid))->profile_team;?></div>

		

		</div><!-- ca_content end -->
	</div><!-- ca_main end -->
	<?php endif; ?>
	<?php /*---------NUeH afsluttet--------*/?>
	
	<?php if ($links): ?>
		<div class="links"><?php print $links; ?>
		</div>
	<?php endif; ?>
	
  </div><!-- meta end -->

</div><!-- node - id end --> 
