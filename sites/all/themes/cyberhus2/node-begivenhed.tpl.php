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
	<?php 
	/*-----------NUeH - indgreb---------
	 * Hvis forfatteren af "Begivened" er en ung -> Tillad da adgang for den unge og vejlederen, 
	 * ellers  send brugerene til "adgang nægtet"
	 * Hvis forfatteren af "Begivened" er en vejleder -> Tillad da adgang for den unge hvis kalender den er tilknyttet og vejlederen
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
	<?php if (in_array('NueH Vejleder',$forfatter->roles)):?>
		<?php 
		global $user;
		$profile_uid = $forfatter->uid;
		if($user->uid==$node->field_bruger['0']['uid'] || $user->uid == $profile_uid || $user->uid == '120'){
		
		}
		else{header('Location:http://www.cyberhus.dk/node/1898');}
		?>
	<?endif; ?>
	
	<?php /*---------NUeH afsluttet--------*/?>

	<?php print $picture ?>
  <div class="meta">
  <?php if ($submitted): ?>
    <span class="submitted"><?php print $submitted ?></span>
  <?php endif; ?>


  <div class="content">
    <?php if (!$page): ?>
      <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php endif; ?>
    <?php print $content ?>
  </div>

<!--terms del fjernet*/-->
  </div>

  <?php print $links; ?>
</div>