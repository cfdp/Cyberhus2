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
 * - $changed - vi tester om den kan sendes med...
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

<!-- print picture fjernet*/-->
  <div class="meta">
  <?php if ($submitted): ?>
    <span class="submitted"><?php print $submitted ?></span>
  <?php endif; ?>

<div class="created">

      <?php print("Oprettet den: ".format_date($node->created, $format = 'custom' , 'd.m.Y')); ?> 

  </div>
  
  <div class="content">
    <?php if (!$page): ?>
      <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php endif; ?>
    
      <!-- content rightside-->
      <?php if ($content_rightside): ?>
        <div id="content-rightside">
          <?php print $content_rightside; ?>
        </div> <!-- /#content rightside -->
      <?php endif; ?>
      
    <?php print $content ?>
  </div>

<?php print $links; ?>

<!-- ----Terms virker ikke på FAQs----

  <?php if ($terms): ?>
    
	
   	<div class="termsbeskrivelse">
	  <?php print("Tags: ");?>
	  <div class="terms terms-inline">
    	<?php print $terms ?>
	</div>
    </div>
	
  <?php endif;?>  -->
</div>
<div class="addthislinks"> 	
  <!-- AddThis Button BEGIN -->
  <div class="addthis_toolbox addthis_default_style">
	<a class="addthis_button_email"></a>
	<script type="text/javascript">
	  	  var addthis_config = {
    	  ui_language: "da",
		  data_use_flash: false
		  }
    </script>
  </div>
  <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js?pub=xa-4a926ebb5df9df40"></script>
  <!-- AddThis Button END -->	
</div>
<div class="socbookmarks">
  Del denne side: 
</div>
</div>