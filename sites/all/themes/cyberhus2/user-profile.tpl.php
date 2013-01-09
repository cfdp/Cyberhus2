<?php
// $Id: user-profile.tpl.php,v 1.2.2.1 2008/10/15 13:52:04 dries Exp $

/**
 * @file user-profile.tpl.php
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * By default, all user profile data is printed out with the $user_profile
 * variable. If there is a need to break it up you can use $profile instead.
 * It is keyed to the name of each category or other data attached to the
 * account. If it is a category it will contain all the profile items. By
 * default $profile['summary'] is provided which contains data on the user's
 * history. Other data can be included by modules. $profile['user_picture'] is
 * available by default showing the account picture.
 *
 * Also keep in mind that profile items and their categories can be defined by
 * site administrators. They are also available within $profile. For example,
 * if a site is configured with a category of "contact" with
 * fields for of addresses, phone numbers and other related info, then doing a
 * straight print of $profile['contact'] will output everything in the
 * category. This is useful for altering source order and adding custom
 * markup for the group.
 *
 * To check for all available data within $profile, use the code below.
 *
 * @code
 *   print '<pre>'. check_plain(print_r($profile, 1)) .'</pre>';
 * @endcode
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-field.tpl.php
 *   Where the html is handled for each item in the group.
 *
 * Available variables:
 *   - $user_profile: All user profile data. Ready for print.
 *   - $profile: Keyed array of profile categories and their items or other data
 *     provided by modules.
 *
 * @see template_preprocess_user_profile()
 */
?>
<link rel="stylesheet" type="text/css" href="<?php print base_path() . path_to_theme() ?>/profile.css" />

<div class="profile">
  <?php 
  function calculateAge($birthday){
    return floor((time() - strtotime($birthday))/31556926);
  }
  global $base_url;
  $birthday = $account->profile_birthday['day'].'-'.$account->profile_birthday['month'].'-'.$account->profile_birthday['year'];
  $age = calculateAge($birthday);
  /*we have different profile pages dependent on user roles - can be abstracted into the following (partially overlapping) categories */
  $loggedin_user_owns_profile = ($user->uid == arg(1));
  $authenticated_user = in_array('authenticated user',$user->roles);
  $cyberaktive = (in_array('Cyberaktiv',$user->roles) || in_array('Cyberaktiv +18',$user->roles));
  $moderator = (in_array('Koordinator',$user->roles) || in_array('Vejleder',$user->roles));
  $standard_cyberhus = $authenticated_user;
  /*now we know *who* the logged in user is - but we also need to know *which profile* he is looking at ! */
  $standard_cyberhus_profiles = (in_array('authenticated user',$account->roles));
  
  if ($standard_cyberhus){ 
  	//print "standard cyberhus user = true";
  }
  else {
  	//print "standard cyberhus user = false";
  }
  if ($standard_cyberhus_profiles){ 
  	//print "standard cyberhus profile = true";

  }
  else {
  	//print "standard cyberhus profile = false";

  }
  ?>
</div>
<!--  users with standard cyberhus access should see the standard cyberhus profiles in the 3 columns style layout -->
<?php if ($standard_cyberhus && $standard_cyberhus_profiles) : ?>
<!--  if-conditional: AA start --> 

<div id="profile-wrapper" class="clear-block">
  <div id="profile-left">
  	<div id="profile-left-high">
  	  <div id="profile-image" class="clear-block"><?php print $profile['user_picture']?></div>
	</div>
	<div id="profile-left-low">
	  <div id="profile-status" class="clear-block"><h3>Cyberstatus:</h3>
	    <div id="profile-name"><?php print t('Name').': '.$account->profile_fulde_navn?></div>
	    <div id="profile-age"><?php print t('Age').': '.$age?></div>
		<div id="profile-birthday"><?php print t('Birthday').': '.$birthday?></div>
	    <div id="profile-url"><?php print t('Homepage').': '.$account->profile_url?></div>
		<div id="profile-lastonline"><?php print t('Last online').': '.date('d-m-y',$account->access)?></div>
        <?php if (module_exists('userpoints')): ?>
          <div id="profile-url"><?php print t('Userpoints').': '.$account->content['userpoints']['points']['#value']?></div>
		<?php endif; ?>	
	  </div>
	</div>

  </div>
  <div id="profile-center" <?php if (!$loggedin_user_owns_profile){print 'class="wide"';} ?>>
	<div id="profile-center-high">
  	  <div id="profile-hobbies" class="clear-block"><h3><?php print t('Hobbies');?>:</h3>
	    <div id="profile-about"><?php print $account->profile_interesser?></div>
	  </div>
	</div>
	<div id="profile-center-low">
	  <div id="profile-blogs" class="clear-block"><h3><?php print t('Latest Cyberaktive posts');?>:</h3>
	    <div id="profile-blog">
	    <?php
          // load the context-node's 'metadata'
          global $current_view;
          $viewname = 'cyberaktiv_profil';
          // * define the context-profile's UID as the argument
          $current_view->args[0]=2;//$account->uid;
          //$view1 = views_get_view('blogs');	
          $viewresultat = views_embed_view($viewname, $display_id = 'block_4');
          print $viewresultat;		
        ?>
        </div>
		
		
	  </div>
	</div>  
  </div>
  
  <?php if ($loggedin_user_owns_profile) : ?>
  <!--  if-conditional: DD start -->  
  <div id="profile-right">

  	<div id="profile-activity">  		
  		<?php
		  print '<h3>'.t('Your latest activity').': </h3>';
          $viewname = 'mytracker';
          $viewresultat = views_embed_view($viewname, $display_id = 'page', $account->uid);
          print $viewresultat;
		?>  
  	</div>
	<div id="profile-online"><h3><?php print t('Latest online')?>: </h3>
	  <div id="profile-online-view">
 		<?php
          $viewname = 'onlineuserroles';
          $viewresultat = views_embed_view($viewname, $display_id = 'page_1', $account->uid);
          /*Cyberaktive users should only see other Cyberaktive-users*/
          if ($cyberaktive) {
          	$viewresultat = views_embed_view($viewname, $display_id = 'defaults', $account->uid);
          }
          print $viewresultat;
		?>
	  </div>	
	</div>
	
	<div id="profile-right-low">
		<?php if ($moderator): ?>
		<!--  if-conditional: EE start --> 
			<div id="profile-moderation">
			
			<?php /*only the koordinator should see this headline*/ 
			if (in_array('Koordinator',$account->roles)):?>
				<h3><?php print 'Hej Koordinator - moderationen af kommentarer mv er flyttet til "moderations"-tabben. Kig op ;) ';?></h3> 
			<?php endif; ?>  		

			<?php /*only the Vejleder should see this headline*/ 
			if (in_array('Vejleder',$account->roles)):?>
				<h3><?php print t('Unanswered questions: ');?></h3> 
			<?php endif; ?> 
			<?php
			$block = module_invoke('faq_ask', 'block', 'view', "0");
			print $block['subject'];
			print $block['content'];
			?>

			</div>
		<?php endif; ?> 
		<!--  if-conditional: EE slut --> 
	</div>  
  </div> 
  <?php endif; ?>
  <!-- if-conditional: DD end- --> 
</div> <!-- end of profile-wrapper --> 
<?php endif; ?>
<!-- ----NUeH---- if-conditional: AA ends --> 
