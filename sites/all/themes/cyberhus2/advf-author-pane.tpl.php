<?php
// $Id: advf-author-pane.tpl.php,v 1.1.2.11 2009/03/30 15:33:50 michellec Exp $

/**
 * @file
 * Theme implementation to display information about the post/profile author.
 *
 * See author-pane.tpl.php in Author Pane module for a full list of variables.
 */
?>

<div class="author-pane">
 <div class="author-pane-inner">
    <div class="author-pane-name-status author-pane-section">
      <div class="author-pane-line author-name"> 
      <?php 
      global $user;
      if(!in_array('NUeH Ung',$account->roles) && !in_array('NUeH Ung Net',$account->roles)){	
      print $account_name;}?> </div>

      <?php /*if (!empty($facebook_status_status)): ?>
        <div class="author-pane-line author-facebook-status"><?php print $facebook_status_status;  ?></div>
      <?php endif; */?>

	  
	  <!-- hvis brugeren er vejleder eller koordinator, må billedet vises   (NUeH: Hvis det er en ven må billedet vises-->
	  <?php if ((in_array('Vejleder',$account->roles) || in_array('Koordinator',$account->roles)) && !empty($picture)) : ?>
	  
	   <?php print $picture; ?>

	  <?php endif; ?>
	  
	  <!-- NUeH: Friends should be able to see each other
	  This feature is not yet implemented and the loop below is NOT working as intended, hence grayed out.
	  Creates a loop running through all authors 'ven' relationships. If a 'ven' relationship exists between author and current user, it prints $picture and $account_name
	  The iteration runs to 500, hence supporting no more than 500 friends in the network. This number can be incresed below if need be.
	  <?php if (in_array('NueH Vejleder',$user>roles) || in_array('NUeH Ung',$user->roles)|| in_array('NUeH Ung Net',$user->roles)) : ?>
	  			<?php
	  				$ur=user_relationships_load(array('user' => $account->uid), array('sort' => 'name'));
	  				if(array_key_exists('ven',$ur)){
	  				for ( $i = 0; $i <= 500; $i=$i + 1) {
	  					if ($ur['ven'][$i]->requester_id == $user->uid || $ur['ven'][$i]->requestee_id ==$user->uid){
	  					print $account_name;	
	   					print $picture;
	  				}
	  			}
	  		}
	  			?>
	  <?php endif; ?>-->
	  
	  <!-- 
      <div class="author-pane-line author-pane-online">
        <span class="author-pane-online-icon"><?php print $online_icon; ?></span>
        <span class="author-pane-online-status"><?php print $online_status; ?></span>
      </div> -->

      <?php /*if (!empty($user_title)): ?>
        <div class="author-pane-line author-title"> <?php print $user_title; ?> </div>
      <?php endif;*/ ?>
      
      <?php /*if (!empty($user_badges)): ?>
        <div class="author-pane-line author-badges"> <?php print $user_badges;  ?> </div>
      <?php endif;*/ ?>

      <?php /*if (!empty($location)): ?>
        <div class="author-pane-line author-location"> <?php print $location;  ?> </div>
      <?php endif; */?>
    </div>
	
<!--    ***Særdeles uinteressant information, der ikke virker korrekt hvis man er anonym bruger :-) ****

    <div class="author-pane-stats author-pane-section">      
	  <?php if (isset($user_stats_posts)): ?>
        <div class="author-pane-line author-posts">
          <span class="author-pane-label"><?php print t('Posts'); ?>:</span> <?php print $user_stats_posts; ?>
        </div>
      <?php endif; ?>
    </div>
-->
    <div class="author-pane-admin author-pane-section">
      <?php if (!empty($user_stats_ip)): ?>
        <div class="author-pane-line author-ip">
          <span class="author-pane-label"><?php print t('IP'); ?>:</span> <?php print $user_stats_ip; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($fasttoggle_block_author)): ?>
        <div class="author-fasttoggle-block"><?php print $fasttoggle_block_author; ?></div>
      <?php endif; ?>

      <?php if (!empty($troll_ban_author)): ?>
        <div class="author-pane-line author-troll-ban"><?php print $troll_ban_author; ?></div>
      <?php endif; ?>        
    </div>

    <div class="author-pane-contact author-pane-section">
      <?php if (!empty($contact)): ?>
        <div class="author-pane-icon"><?php print $contact; ?></div>
      <?php endif; ?>

      <?php /*if (!empty($privatemsg)): ?>
        <div class="author-pane-icon"><?php print $privatemsg; ?></div>
      <?php endif; */?>

      <?php /*if (!empty($buddylist)): ?>
        <div class="author-pane-icon"><?php print $buddylist; ?></div>
      <?php endif; */?>

      <?php /*if (!empty($user_relationships_api)): ?>
        <div class="author-pane-icon"><?php print $user_relationships_api; ?></div>
      <?php endif;*/ ?>
      
      <?php /*if (!empty($flag_friend)): ?>
        <div class="author-pane-icon"><?php print $flag_friend; ?></div>
      <?php endif; */?>
    </div>
  </div>
</div>
