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
  $nueh_ung = in_array('NUeH Ung',$user->roles);
  $nueh_ung_net = in_array('NUeH Ung Net',$user->roles);
  $nueh_vejleder = in_array('NueH Vejleder',$user->roles);
  $moderator = (in_array('Koordinator',$user->roles) || in_array('Vejleder',$user->roles));
  $standard_cyberhus = ($authenticated_user && (!($nueh_ung_net || $nueh_ung)));
  /*now we know *who* the logged in user is - but we also need to know *which profile* he is looking at ! */
  $standard_cyberhus_profiles = (in_array('authenticated user',$account->roles) && !(in_array('NUeH Ung Net',$account->roles) || in_array('NUeH Ung',$account->roles) || in_array('NueH Vejleder',$account->roles)));
  $nueh_profiles = (in_array('NUeH Ung',$account->roles) || in_array('NueH Vejleder',$account->roles) || in_array('NUeH Ung Net',$account->roles));
  
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

<?php 
/*---- NUeH ----
 *  * Deny access to other NUeH Ung or NUeH Ung Net profiles for NUeH Ung roles*/

global $user;
if ($nueh_ung && $nueh_profiles && !(arg(1)==$user->uid || in_array('NueH Vejleder',$account->roles))){
	$destination = "Location:".$base_url."/node/1898";
	header($destination);
}

?>
<?php 
/*---- NUeH ----
 *  * Deny access to NUeH Ung profiles for NUeH Ung Net roles*/

global $user;
if ($nueh_ung_net && $nueh_profiles && !(in_array('NUeH Ung Net',$account->roles) || in_array('NueH Vejleder',$account->roles))){
  $destination = "Location:".$base_url."/node/1898";
  header($destination);
}

?>


<?php 
/*---- NUeH ----
 * Deny access to Cyberhus profiles for NUeH Ung roles*/
if (($nueh_ung_net || $nueh_ung) && $standard_cyberhus_profiles ){
  $destination = "Location:".$base_url."/node/1898";
  header($destination);
}

?>



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
  

<!-- the following section is for the nueh profiles -->   
<?php elseif ($nueh_profiles): ?>
<!-- ----NUeH---- if-conditional: AA else if --> 
	<?php 
	/*---- NUeH ----
	 * 
	 * Is user pageowner & NUeH Ung - Redirect to private page.*/
	/* this functionality is maybe not needed - we comment it out as a test*/
	/*::Martin:: This functionality was created for the most private profile (NUeH Ung) who at some point in the project
   *  was not meant to have a public NUeH page. */
	/*
	if (($profile_uid==$user->uid)&&(in_array('NUeH Ung',$user->roles))){
		$destination = "Location:".$base_url.'/user/'.arg(1).'/privat';
		header($destination);
	}*/
	global $user;
	$profile_uid = arg(1);
	  ?>
	<div id="profile-wrapper-NUeH" class="clear-block">
    <div id="pageownerpic">
  	<?php				  
	  global $user;
	  print $profile['user_picture'];
	?>
	  </div>
	  <div id="statustextNUeH">
	  </div>
	<?php
		/*Defines the NUeH public page. Which blocks to use, and create relationship links.*/
	  $arg_bruger=user_load(arg(1));
	  print views_embed_view('facebook_recent_userbased', $display_id = 'block_2');
	  print views_embed_view('facebook_recent_userbased', $display_id = 'block_4');
	  /*Link til nyoprettede unge. Vejlederen klikker på link og bliver derved vejleder.
	   *Linket er kun tilstede hvis brugeren er vejleder og den unge endnu ikke har fået tilknyttet en vejleder*/
	  $alleredetilknyttet=user_relationships_load(array('user' => arg(1)), array('sort' => 'name'));
	  if($nueh_vejleder && array_key_exists('vejleder for',$alleredetilknyttet)==false && ($nueh_ung_net || $nueh_ung)){
	  print '<center><a href="'.base_path().'/relationship/'.arg(1).'/request/1?destination=user/'.arg(1).'">Bliv vejleder for denne bruger</a></center>';
	  }
	  /*Udskriver væggen til de enkelte profiler*/
	  $block = module_invoke('facebook_status' ,'block', 'view', facebook_status-block_1);
	  print $block['content'];
	  print views_embed_view('facebook_recent_userbased', $display_id = 'block_5');
	?>
	
	</div> <!-- end of profile-wrapper-NUeH -->

<!-- ----NUeH---- if-conditional: AA else --> 
<?php else: 
	/*---- NUeH ----
	 * Deny access to Cyberhus profiles for NUeH Ung roles*/
	global $user;
	if (($nueh_ung_net || $nueh_ung) && $standard_cyberhus_profiles){
		$destination = "Location:".$base_url."/node/1898";
		header($destination);
	}
	print $user_profile;?>
	<!-- ----NUeH----
	 Admin specific blok on the admins user profile.
	 Designed for the admin to create friendships between users. -->

	<?php if (($user->name == 'martin yde' && $account->name == 'martin yde') || ($user->name == 'lundse' && $account->name == 'lundse')) :?>
	<!-- ----NUeH---- if-conditional: BB starts-->
		<div id="nueh-admin">
		<div id="nueh-admin-overskrift">
		<?php print '<BR>Skab venskaber for NUeH unge';?>
		</div>
		<div id="nueh-admin-indhold"> 
	
		<?php if (is_numeric(arg(2))&& is_numeric(arg(3))):?>
		<!-- ----NUeH---- if-conditional: CC starts -->
			<?php $bruger1_navn=user_load(arg(2))->name;$bruger2_navn=user_load(arg(3))->name;?>
			<?php $bruger1_uid=arg(2);$bruger2_uid=arg(3);?>
			<INPUT TYPE="button" NAME="opretvenskab" VALUE="Opret venskab" onClick="clickFunction()">
			<script type="text/javascript">
			function clickFunction(){
				<?php user_relationships_request_relationship($bruger1_uid,$bruger2_uid,'7',TRUE);?>
				
				alert("<?php print $bruger1_navn.' og '.$bruger2_navn.' er nu venner.';?>");
				}
			</script>
		<?php else :?>
		<!-- ----NUeH---- if-conditional: CC else-->
			<p>Der mangler et eller to argumenter i urlen for at du kan oprette venskaber.</p>
		<?php endif?>
		<!-- ----NUeH---- if-conditional: CC ends-->
		</div>
		</div>	
	<?php endif; ?>
	<!-- ----NUeH---- if-conditional:BB ends -->
	<!-- ----NUeH---- Admin specific blok afsluttet -->
<?php endif; ?>
<!-- ----NUeH---- if-conditional: AA ends --> 
 