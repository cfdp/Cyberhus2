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

drupal_add_js ('sites/all/themes/scripts/cbfjs.js', 'core');

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

/*** test af node fixes, kristoffer
 * Skal bruges til at fixe styles på sider med alias,
***/
/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function cyberfrivillig_preprocess_page(&$vars, $hook) {
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
  }
  if (theme_get_setting('zen_wireframes')) {
    $body_classes[] = 'with-wireframes'; // Optionally add the wireframes style.
  }
  $vars['body_classes'] = implode(' ', $body_classes); // Concatenate with spaces
}
/**** slut test *****/




function cyberfrivillig_simplenews_subscription_manager_form($form) {
	print_r($form['#attributes']['simplenews-subscription-manager-form [subscriptions]']);
	//$form[][];
}
/**
 * Implementation of HOOK_theme().
 * Her registreres theme overrides
 */
function cyberfrivillig_theme(&$existing, $type, $theme, $path) {
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
 * Her overrides flexible.inc i panels for at sætte div-tags ind i toppen af kolonner i rummene
 * This function uses heredoc notation to make it easier to convert
 * to a template.
 */
function cyberfrivillig_panels_flexible($id, $content, $settings) {

  if (empty($settings)) {
    $settings = panels_flexible_default_panels();
  }

  // Special check for updating.
  if (empty($settings['width_type'])) {
    $settings['width_type'] = '%';
    $settings['percent_width'] = 100;
  }

  if ($id) {
    $idstr = " id='$id'";
    $idcss = "#$id";
  }
  else {
    $idstr = '';
    $idcss = "div.panel-flexible";
  }

  $css = '';
  $output = '';

  for ($row = 1; $row <= intval($settings['rows']); $row++) {
    $output .= "<div class=\"panel-row panel-row-$row clear-block\">\n";
    for ($col = 1; $col <= intval($settings["row_$row"]["columns"]); $col++) {
      // We do a width reduction formula to help IE out a little bit. If width is 100%, we take 1%
      // off the total; by dividing by the # of columns, that gets us the reduction overall.
      $reduce = 0;
      if ($settings['width_type'] == '%' && $settings['percent_width'] == 100) {
        $reduce = 1 / $settings["row_$row"]["columns"];
      }
      if ($col == 1) {
        if (intval($settings["row_$row"]["columns"]) == 1) {
          $class = 'panel-col-only';
        }
        else {
          $class = 'panel-col-first';
        }
      }
      elseif ($col == intval($settings["row_$row"]["columns"])) {
        $class = 'panel-col-last';
      }
      else {
        $class = 'panel-col-inside';
      }
      $output .= "<div class=\"panel-col panel-col-$col $class\"><div class=\"kol_top\">\n</div>\n";
      $output .= "<div class=\"inside\">" . $content["row_${row}_$col"] . "</div>\n";
      $output .= "</div>\n"; // panel-col-$col
      $css .= "$idcss div.panel-row-$row div.panel-col-$col { width: " . ((intval($settings["row_$row"]["width_$col"])) - $reduce) . $settings["width_type"] ."; }\n";
    }
    $output .= "</div>\n"; // panel-row-$row
  }

  // Add our potential sidebars
  if (!empty($settings['sidebars']['left']) || !empty($settings['sidebars']['right'])) {
    // provide a wrapper if we have a sidebar
    $output = "<div class=\"panel-sidebar-middle panel-sidebar\"><div class=\"kol_top\"></div>\n$output</div>\n";
    if ($settings['sidebars']['width_type'] == '%') {
      $css .= "$idcss div.panel-flexible-sidebars div.panel-sidebar-middle { width: " . (intval($settings['percent_width']) - intval($settings['sidebars']['left_width']) - intval($settings['sidebars']['right_width'])) . "; }\n";
    }
  }
  // Her tilføjes nogle div tags til toppen af blokkene
  if (!empty($settings['sidebars']['left'])) {
  	
    $size = intval($settings['sidebars']['left_width']) . $settings['sidebars']['width_type'];
    $output = "<div class=\"panel-sidebar panel-sidebar-left panel-col panel-col-first\"><div class=\"kol_top\">wakawaka</div><div class=\"inside\">\n" . $content["sidebar_left"] . "</div>\n</div>\n" . $output;
    $css .= "$idcss div.panel-flexible-sidebars div.panel-sidebar-left { width: $size; margin-left: -$size; }\n";
    $css .= "$idcss div.panel-flexible-sidebars { padding-left: $size; }\n";
    // IE hack
    $css .= "* html $idcss div.panel-flexible-sidebars div.panel-sidebar-left { left: $size; }\n";
  }

  if (!empty($settings['sidebars']['right'])) {
    $size = intval($settings['sidebars']['right_width']) . $settings['sidebars']['width_type'];
    $output .= "<div class=\"panel-sidebar panel-sidebar-right panel-col panel-col-last\"><div class=\"top\"></div><div class=\"inside\">\n" . $content["sidebar_right"] . "</div>\n</div>\n";
    $css .= "$idcss div.panel-flexible-sidebars div.panel-sidebar-right { width: $size; margin-right: -$size; }\n";
    $css .= "$idcss div.panel-flexible-sidebars { padding-right: $size; }\n";
  }

  // Wrap the whole thing up nice and snug
  $output = "<div class=\"panel-flexible clear-block\" $idstr>\n<div class=\"panel-flexible-sidebars\">\n" . $output . "</div>\n</div>\n";
  drupal_set_html_head("<style type=\"text/css\" media=\"all\">\n$css</style>\n");
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
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

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
