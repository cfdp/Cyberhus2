<?php
// $Id: template.php,v 1.17 2008/09/11 10:52:53 johnalbin Exp $

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to STARTERKIT_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: STARTERKIT_breadcrumb()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions, please visit the Theme
 *   Developer's Guide on Drupal.org: http://drupal.org/node/223430
 *   For more information on template suggestions, please visit the Theme
 *   Developer's Guide on Drupal.org: http://drupal.org/node/223440 and
 *   http://drupal.org/node/190815#template-suggestions
 */


/*
 * Add any conditional stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that ALWAYS need to be included, you should add them to
 * your .info file instead. Only use this section if you are including
 * stylesheets based on certain conditions.
 */
/* -- Delete this line if you want to use and modify this code
// Example: optionally add a fixed width CSS file.

// */
/** tilføj javascripts*/

drupal_add_js ('sites/all/themes/cyberhus2/feedback_btn.js', 'core');
drupal_add_js ('sites/all/themes/cyberhus2/cyberhus_lykke.js', 'core');
drupal_add_js ('sites/findhjaelp.dk/findhjaelp.js', 'core');

/*we dont want the chat embedded on the pages for adults*/
if (arg(0) != 'voksne') {
		drupal_add_js ('sites/all/themes/scripts/chatscript.js', 'core');
}


/**
* Override or insert PHPTemplate variables into the search_block_form template.
*
* @param $vars
*   A sequential array of variables to pass to the theme template.
* @param $hook
*   The name of the theme function being called (not used in this case.)
*/
function cyberhus2_preprocess_search_block_form(&$vars, $hook) {
  // Modify elements of the search form
   // Rebuild the rendered version (search form only, rest remains unchanged)

  unset($vars['form']['search_block_form']['#printed']);
  unset($vars['form']['search_block_form']['#title']);
  $vars['search']['search_block_form'] = drupal_render($vars['form']['search_block_form']);

  // Collect all form elements to make it easier to print the whole form.

  $vars['search_form'] = implode($vars['search']);

}


/* We would like to remove some elements from the enter-blog-form*/
/**
 * Custom theme function for FileField upload elements.
 *
 * This function allows us to put the "Upload" button immediately after the
 * file upload field by respecting the #field_suffix property.
 */
function cyberhus2_filefield_widget_file($element) {
	$path = drupal_get_path_alias($_GET['q']);
	
	$path = substr($path,9,18);
 	//drupal_set_message("Stien er ".$path);
  if ($path == "enter-blog"){
  	//print_r($element);
  	unset($element['#description']);
  } 
  $output = '';
  $output .= '<div class="filefield-upload clear-block">';
  
  if (isset($element['#field_prefix'])) {
    $output .= $element['#field_prefix'];
  }

  _form_set_class($element, array('form-file'));
  $output .= '<input type="file" name="'. $element['#name'] .'"'. ($element['#attributes'] ? ' '. drupal_attributes($element['#attributes']) : '') .' id="'. $element['#id'] .'" size="'. $element['#size'] ."\" />\n";

  if (isset($element['#field_suffix'])) {
    $output .= $element['#field_suffix'];
  }

  $output .= '</div>';

  return theme('form_element', $element, $output);
}


/**
 * Format a username - overrides for at fjerne de ekstra informationer om brugerstatus (anonym, ikke godkendt), 
 * der ellers printes.
 * @param $object
 *   The user object to format, usually returned from user_load().
 * @return
 *   A string containing an HTML link to the user's page if the passed object
 *   suggests that this is a site user. Otherwise, only the username is returned.
 */
function cyberhus2_username($object) {

  if ($object->uid && $object->name) {
    // Shorten the name when it is too long or it will break many tables.
    if (drupal_strlen($object->name) > 20) {
      $name = drupal_substr($object->name, 0, 15) .'...';
    }
    else {
      $name = $object->name;
    }

    if (user_access('access user profiles')) {
      $output = l($name, 'user/'. $object->uid, array('attributes' => array('title' => t('View user profile.'))));
    }
    else {
      $output = check_plain($name);
    }
  }
  else if ($object->name) {
    // Sometimes modules display content composed by people who are
    // not registered members of the site (e.g. mailing list or news
    // aggregator modules). This clause enables modules to display
    // the true author of the content.
    if (!empty($object->homepage)) {
      $output = l($object->name, $object->homepage, array('attributes' => array('rel' => 'nofollow')));
    }
    else {
      $output = check_plain($object->name);
    }

    $output .= "";//' ('. t('not verified') .')';
  }
  else {
    $output = variable_get('anonymous', t('Anonymous'));
  }
 //NUeH if object is Ung or Ung net make the user anonymous. This is needed for the forums
  $bruger=user_load($object->uid);
  if(in_array('NUeH Ung',$bruger->roles) || in_array('NUeH Ung Net',$bruger->roles)){
    $output = variable_get('anonymous', t('Anonymous'));
  }
  return $output;
}
/*aktivering af Page Title-modulets (SEO-optimering) funktionalitet*/
function _phptemplate_variables($hook, $vars) {
  $vars = array();
  if ($hook == 'page') {

    // These are the only important lines
    if (module_exists('page_title')) {
     $vars['head_title'] = page_title_page_get_title();
    }

  }
  return $vars;
}


/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function cyberhus2_preprocess_page(&$vars, $hook) {
    //drupal_set_message("Cyberhus.dk er under opdatering og sitet kan være nede i kortere perioder her til morgen!");
	/*Makes it possible to create page-templates pr node-type  */
	$node = node_load(arg(1));
	if (arg(0) == 'node' && is_numeric(arg(1))) {
    	$vars['template_files'][] = 'page-node-' . $node->type;
      $vars['template_files'][] = 'page-node-'. $vars['node']->nid;  
	}  	
	
	//we need a special menu for the adult section - cyberhus.dk/voksne
	$menu = menu_navigation_links("menu-adult-links");
    $vars['adult_links'] = theme('links', $menu);
    
    //if we are on a page we want to check if we have an image as background for the title (primarily in use in the adult section)
	$title_image = false;
	if (is_numeric(arg(1)) && ($node->type == "page")) {
		if ($node->field_billede[0]["filepath"] != null) {
			$title_image = $node->field_billede[0]["filepath"];
		}
	}
	$vars['title_image'] = $title_image;
	
	//if we are in the adult section, we need a different link on the topbanner and we don't want the title printed out via page.tpl.php
	$vars['topbanner_link'] = 'http://www.cyberhus.dk';
	if (arg(0)=='voksne') {
		$vars['topbanner_link'] = 'http://www.cyberhus.dk/voksne';
		$vars['adult_backlink_image'] = "sites/all/themes/cyberhus2/images/voksne/invisible.gif";
		unset($vars['title']);
	}
	
  // Add an optional title to the end of the breadcrumb.
  if (theme_get_setting('zen_breadcrumb_title') && $vars['breadcrumb']) {
    $vars['breadcrumb'] = substr($vars['breadcrumb'], 0, -6) . $vars['title'] . '</div>';
  }

  // Add conditional stylesheets.
  if (!module_exists('conditional_styles')) {
    $vars['styles'] .= $vars['conditional_styles'] = variable_get('conditional_styles_' . $GLOBALS['theme'], '');
  }

  // Classes for body element. Allows advanced theming based on context
  // (home page, node of certain type, etc.)
  $body_classes = array($vars['body_classes']);
  if (!$vars['is_front']) {
    // Add unique classes for each page and website section
    $path = drupal_get_path_alias($_GET['q']);
    list($section, ) = explode('/', $path, 2);
    $body_classes[] = zen_id_safe('page-' . $path);
    $body_classes[] = zen_id_safe('section-' . $section);
    if (arg(0) == 'node') {
      if (arg(1) == 'add') {
        if ($section == 'node') {
          array_pop($body_classes); // Remove 'section-node'
        }
        $body_classes[] = 'section-node-add'; // Add 'section-node-add'
      }
      elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
        if ($section == 'node') {
          array_pop($body_classes); // Remove 'section-node'
        }
        $body_classes[] = 'section-node-' . arg(2); // Add 'section-node-edit' or 'section-node-delete'
      }
    }
	$realaddress = drupal_lookup_path("source",$path);
        //$vars["ksh_debug"] = $realaddress . "path: " . $path;
        $realaddress = explode("/",$realaddress);
	$body_classes[] = ($realaddress[0] == "node")? "section-" . $realaddress[0] : "debug-" . $realaddress[0].$realaddress[1];
 	if ($node->type == 'cyberflash' && !$vars['node-type-cyberflash'] ){
  		$body_classes[] = 'node-type-cyberflash'; //add 'node-type-cyberflash' due to panels not printing 'node-type-cyberflash' class'
  	}
  	if(arg(0) == 'user' && is_numeric(arg(1))){
  	$userpage=user_load(arg(1));
   		if (in_array('NUeH Ung',$userpage->roles)||in_array('NueH Vejleder',$userpage->roles)||in_array('NUeH Ung Net',$userpage->roles)){
  			$body_classes[] = 'nueh-profile'; //add 'nueh-profile' class to nueh user pages
   		}
   	 }
   	if (arg(0) == 'voksne' && $node->type == 'page' && is_null($node->field_billede['0']) ){
  		$body_classes[] = 'page-without-picture'; //add 'page-without-picture' to seperate between two page layouts
  	}
  	if (arg(0) == 'voksne' && $node->type == 'blog'){
  		$body_classes[] = 'page-without-picture'; //add 'page-without-picture' to seperate between two page layouts
  	}
  }
  if (theme_get_setting('zen_wireframes')) {
    $body_classes[] = 'with-wireframes'; // Optionally add the wireframes style.
  }
  $vars['body_classes'] = implode(' ', $body_classes); // Concatenate with spaces
  
/**Brødkrummer generereres i forhold til indholdstype for typerne:
 * link_artikel, anmeldelse_bog, cyber_link, anmeldelse_film, historie, anmeldelse_musik, programanmeldelse, anmeldelse_spil **/
    if ($vars['node']->type == 'link_artikel')
    {
    	$links = array();
    // creating a link to the home page
        $links[] = l(t('Home'), '<front>');
    // another link
        $links[] = l('Artikler', 'artikler');
          
    // lastly, overwrite the contents of the breadcrumbs variable in the page scope
        $vars['breadcrumb'] = theme('breadcrumb', $links);
    }
	   
	if ($vars['node']->type == 'anmeldelse_bog')
    {
    	$links = array();
        $links[] = l(t('Home'), '<front>');
        $links[] = l('Boganmeldelser', 'boganmeldelser');
        $vars['breadcrumb'] = theme('breadcrumb', $links);
    }
	if ($vars['node']->type == 'cyber_link')
    {
    	$links = array();
        $links[] = l(t('Home'), '<front>');
        $links[] = l('Cyberlinks', 'cyberlinks');
        $vars['breadcrumb'] = theme('breadcrumb', $links);
    }
	if ($vars['node']->type == 'anmeldelse_film')
    {
    	$links = array();
        $links[] = l(t('Home'), '<front>');
        $links[] = l('Filmanmeldelser', 'filmanmeldelser');
        $vars['breadcrumb'] = theme('breadcrumb', $links);
    }
	if ($vars['node']->type == 'historie')
    {
    	$links = array();
        $links[] = l(t('Home'), '<front>');
        $links[] = l('Historier', 'historier');
        $vars['breadcrumb'] = theme('breadcrumb', $links);
    }
	if ($vars['node']->type == 'anmeldelse_musik')
    {
    	$links = array();
        $links[] = l(t('Home'), '<front>');
        $links[] = l('Musikanmeldelser', 'musikanmeldelser');
        $vars['breadcrumb'] = theme('breadcrumb', $links);
    }
	if ($vars['node']->type == 'programanmeldelse')
    {
    	$links = array();
        $links[] = l(t('Home'), '<front>');
        $links[] = l('Programanmeldelser', 'programanmeldelser');
        $vars['breadcrumb'] = theme('breadcrumb', $links);
    }
	if ($vars['node']->type == 'anmeldelse_spil')
    {
    	$links = array();
        $links[] = l(t('Home'), '<front>');
        $links[] = l('Spilanmeldelser', 'spilanmeldelser');
        $vars['breadcrumb'] = theme('breadcrumb', $links);
    }
	if ($vars['node']->type == 'poll')
    {
    	$links = array();
        $links[] = l(t('Home'), '<front>');
        $links[] = l('Afstemninger', 'afstemninger');
        $vars['breadcrumb'] = theme('breadcrumb', $links);
    }	
/** Breadcrumbs for the adult section **/
    if (arg(0)== 'voksne') {
	    if  (is_numeric(arg(1))) {
	    	$links = array();
	    // creating a link to the home page
	        $links[] = l(t('Home'), 'voksne'); 
	        if ((substr($path,0,12) == "voksne/blogs") || ($node->type == 'blog')) {
		        $links[] = l('Blogs', 'voksne/blogs');    
	    	}
	    $vars['breadcrumb'] = theme('breadcrumb', $links);
	    }
    }
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function cyberhus2_preprocess_node(&$vars, $hook) {
  // Variables available to every node are defined here

  // Now define node type-specific variables by calling their own preprocess functions (if they exist)
  $function = 'cyberhus2_preprocess_node'.'_'. $vars['node']->type;
  if (function_exists($function)) {
   $function(&$vars);
  }
  
  /*We need a new region in the node template*/
  if (!$vars['teaser']){
         foreach (array('content_rightside') as $region) {
         $vars[$region] = theme('blocks', $region);
    } 
  }  
}

function cyberhus2_preprocess_node_page(&$vars, $hook) {
	/* is it a page with title image background? */
	$title_image = false;
	//we get the node id and load the node
	if (is_numeric(arg(1))) {
    	$node = node_load(arg(1));
		if ($node->field_billede[0]["filepath"] != null) {
			$title_image = $node->field_billede[0]["filepath"];
		}
	}
	else
	// Houston we have a problem - the node id can't be determined
	{
		drupal_set_message("Node id kunne ikke bestemmes. Kontakt evt. support med denne meddelelse p� support@cyberhus.dk", "status");
	}
	//var_dump($node->field_billede);
	$vars['title_image'] = $title_image;
}


function cyberhus2_preprocess_panels_pane($vars) {
  $content = $vars['output'];
  // basic classes
  $vars['classes'] = 'panel-pane';
  $vars['id'] = '';

  // Add some usable classes based on type/subtype
  ctools_include('cleanstring');
  $type_class = $content->type ? 'pane-'. ctools_cleanstring($content->type, array('lower case' => TRUE)) : '';
  $subtype_class = $content->subtype ? 'pane-'. ctools_cleanstring($content->subtype, array('lower case' => TRUE)) : '';

  // Sometimes type and subtype are the same. Avoid redudant classes.
  if ($type_class != $subtype_class) {
    $vars['classes'] .= " $type_class $subtype_class";
  }
  else {
    $vars['classes'] .= " $type_class";
  }

  // Add id and custom class if sent in.
  if (!empty($content->content)) {
    if (!empty($content->css_id)) {
      $vars['id'] = ' id="' . $content->css_id . '"';
    }
    if (!empty($content->css_class)) {
      $vars['classes'] .= ' ' . $content->css_class;
    }
  }

  // administrative links, only if there is permission.
  $vars['admin_links'] = '';
  if (user_access('view pane admin links') && !empty($content->admin_links)) {
    $vars['admin_links'] = theme('links', $content->admin_links);
  }

  $vars['title'] = !empty($content->title) ? $content->title : '';

  $vars['feeds'] = !empty($content->feeds) ? implode(' ', $content->feeds) : '';
  $vars['content'] = !empty($content->content) ? $content->content : '';

  $vars['links'] = !empty($content->links) ? theme('links', $content->links) : '';
  $vars['more'] = '';
  if (!empty($content->more)) {
    if (empty($content->more['title'])) {
      $content->more['title'] = t('more');
    }
    $vars['more'] = l($content->more['title'], $content->more['href'], $content->more);;
  }
  //we need to check if there is a background image for the title
  	$title_image = false;
	
	//we get the node id and load the node and we  don't want to print out the title of Views embedding pages
	if (is_numeric(arg(1))) {
    	$node = node_load(arg(1));
		if (($node->field_billede[0]["filepath"] != null) && ($node->type == 'page')) {
			$title_image = $node->field_billede[0]["filepath"];
		}
		if ( $node->type == 'views_embedding_page' && $content->type == 'node_content') {
			unset($vars['title']);

		}
	}
	else
	// Houston we have a problem - the node id can't be determined
	{
		drupal_set_message(t("Node ID kunne ikke bestemmes. Rapporter gerne fejl til administrator p� support@cyberhus.dk"), "warning");
	}
	$vars['title_image'] = $title_image;
}

/*Adds a span tag to menus on voksne-pages. This is used for tab styling. It has not yet been optimized  for the node content only, hence adding a <span> to the primary menu in header as well.*/
function cyberhus2_links($links, $attributes = array('class' => 'links')) {
  $output = '';

  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = $key;

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class .= ' first';
      }
      if ($i == $num_links) {
        $class .= ' last';
      }
      if (isset($link['href']) && $link['href'] == $_GET['q']) {
        $class .= ' active';
      }
      $output .= '<li class="'. $class .'">';
	  if(arg(0)=='voksne' && $menu != menu_navigation_links("menu-adult-links")){
      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $link['html'] = TRUE;
        $output .= l('<span>'. check_plain($link['title']) .'</span>', $link['href'], $link);
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
        }
	  }
	  else
	  {      
	  	if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $link['html'] = TRUE;
        $output .= l(check_plain($link['title']), $link['href'], $link);
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .=$link['title'];
        }}
      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}



function cyberhus2_simplenews_subscription_manager_form($form) {
	//print_r($form['#attributes']['simplenews-subscription-manager-form [subscriptions]']);
	//$form[][];
}
/**
 * Implementation of HOOK_theme().
 * Her registreres theme overrides
 * pas p� med at omd�be denne til cyberhus2_ - den crasher!!
 */
function STARTERKIT_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  //$hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  $hooks['simplenews_subscription_manager_form'] = array( 
    array(array('arguments' => array('form' => NULL))));
  return $hooks;
  //return array(
  //  'simplenews_subscription_manager_form' => array(
  //    'arguments' => array('form' => NULL),
      // and if I use a template file, ie: user-register.tpl.php
      //'template' => 'simplenews-subscription-manager-form',
  //  ),
  //  );
}
/**
* Implementation of hook_theme.
*
* Register custom theme functions.
*/
/*function cyberhus2_theme() {
  return array(
    // The form ID.
    'song_node_form' => array(
      // Forms always take the form argument.
      'arguments' => array('form' => NULL),
    ),
  );
}
*/
  /**
   * Theme override for song edit form.
   *
   * The function is named themename_formid.
   */
  /*function cyberhus2_song_node_form($form) {

      //$output = '';
	  // Print out the $form array to see all the elements we are working with.
	  // $output .= dsm($form);
	  // Once I know which part of the array I'm after we can change it.
	
	  // You can use the normal Form API structure to change things, like so:
	  //unset($form['body_field']['teaser_include']);
	
	  // Make sure you call a drupal_render() on the entire $form to make sure you
	  // still output all of the elements (particularly hidden ones needed
	  // for the form to function properly.)
	  //$output .= drupal_render($form);
	  //return $output;
  }
*/
/**
 * Draw the flexible layout.
 */
function cyberhus2_panels_flexible($id, $content, $settings, $display) {
  panels_flexible_convert_settings($settings);

  $renderer = new stdClass;
  $renderer->settings = $settings;
  $renderer->content = $content;
  $renderer->css_id = $id;
  $renderer->did = $display->did;
  $renderer->id_str = $id ? 'id="' . $id . '"' : '';
  $renderer->admin = FALSE;

  // CSS must be generated because it reports back left/middle/right
  // positions.
  $css = panels_flexible_render_css($renderer);

  if ($display->did && $display->did != 'new') {
    ctools_include('css');
    // Generate an id based upon rows + columns:
    $css_id = 'flexible:' . $display->did;
    $filename = ctools_css_retrieve($css_id);
    if (!$filename) {
      $filename = ctools_css_store($css_id, $css, FALSE);
    }
    drupal_add_css($filename, 'module', 'all', FALSE);
  }
  else {
    // If the id is 'new' we can't reliably cache the CSS in the filesystem
    // because the display does not truly exist, so we'll stick it in the
    // head tag.
    drupal_set_html_head("<style type=\"text/css\">\n$css</style>\n");
  }

  $output = "<div class=\"panel-flexible panel-flexible-$renderer->did clear-block\" $renderer->id_str>\n";
  $output .= "<div class=\"panel-flexible-inside panel-flexible-$renderer->did-inside\">\n";

  $output .= panels_flexible_render_items($renderer, $settings['items']['canvas']['children'], 'panel-flexible-' . $renderer->did);

  // Wrap the whole thing up nice and snug
  $output .= "</div>\n</div>\n";

  return $output;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_page(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */

function cyberhus2_preprocess_comment(&$vars, $hook) {
  $vars['roles'] = $vars;

  $comment = $vars['comment'] ;

  if (module_exists('vud_comment')) {
    $type = _vud_comment_get_node_type($comment->nid);
    if (user_access('use vote up/down on comments')) {
      $tag = variable_get('vud_tag', 'vote');
      $widget = variable_get('vud_comment_widget', 'plain');
      $vars['vud_comment'] = theme('vud_widget', $comment->cid, 'comment', $tag, $widget);
    } 
  }
}
// 

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */
