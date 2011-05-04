<?php
// $Id: faq.hide_answer.inc,v 1.1.2.1 2008/06/12 11:16:30 snpower Exp $

/**
 * @file
 * FAQ page callbacks for the "hide answer" layouts.
 */

/**
 * Create the structure of the FAQ page if set to show/hide the answers when
 * the question is clicked.
 *
 * @param &$variables
 *   Array reference of arguments given to the theme() function.
 */
function template_preprocess_faq_hide_answer(&$variables) {
  drupal_add_js(drupal_get_path('module', 'faq') .'/faq.js', 'module');

  $data = $variables['data'];
  $this_page = $_GET['q'];

  // Fetch configuration.
  $teaser = variable_get('faq_use_teaser', FALSE);
  $links = variable_get('faq_show_node_links', FALSE);
  $disable_node_links = variable_get('faq_disable_node_links', FALSE);

  $nodes = array();
  $count = 0;
  foreach ($data as $node) {
    faq_view_question($nodes[$count], $node, $this_page);
    faq_view_answer($nodes[$count], $node, array(), $teaser, $links);
    $count++;
  }
  $variables['use_teaser'] = $teaser;
  $variables['nodes'] = $nodes;
}

/**
 * Create the code of the FAQ page if set to show/hide the category-sorted
 * answers when the question is clicked.
 *
 * @param &$variables
 *   Array reference of arguments given to the theme() function.
 */
function template_preprocess_faq_category_hide_answer(&$variables) {
  drupal_add_js(drupal_get_path('module', 'faq') .'/faq.js', 'module');

  $data = $variables['data'];
  $category_display = $variables['category_display'];
  $term = $variables['term'];
  $class = $variables['class'];

  // Fetch configuration.
  $teaser = variable_get('faq_use_teaser', FALSE);
  $links = variable_get('faq_show_node_links', FALSE);
  $disable_node_links = variable_get('faq_disable_node_links', FALSE);
  $display_faq_count = variable_get('faq_count', FALSE);
  $hide_child_terms = variable_get('faq_hide_child_terms', FALSE);
  $show_term_page_children = variable_get('faq_show_term_page_children', FALSE);
  $default_sorting = variable_get('faq_default_sorting', 'DESC');

  // Initialise some variables.
  $default_weight = 0;
  if ($default_sorting != 'DESC') {
    $default_weight = 1000000;
  }
  $this_page = $_GET['q'];
  $get_child_terms = 0;
  if (arg(0) == 'faq' && is_numeric(arg(1))) {
    $get_child_terms = arg(1);
  }


  // Get number of questions, and account for hidden sub-categories.
  $count = 0;
  if ($display_faq_count && $hide_child_terms) {
    $count = taxonomy_term_count_nodes($term->tid, 'faq');
  }
  $variables['display_faq_count'] = $display_faq_count;

   // Get taxonomy image.
  $variables['term_image'] = '';
  if (module_exists('taxonomy_image')) {
    $variables['term_image'] = taxonomy_image_display($term->tid, array('class' => 'faq_tax_image'));
  }

  // Configure header.
  $variables['category_depth'] = $term->depth;
  $variables['category_name'] = check_plain($term->name);
  if ($category_display == 'hide_qa') {
    $variables['header_title'] = l($term->name, "faq/$term->tid");
  }
  else {
    $variables['header_title'] = check_plain($term->name);
  }

  // Configure category description.
  $variables['description'] = check_markup($term->description);

  // Get list of sub-categories if necessary.
  $child_categories = array();
  if (($show_term_page_children || $hide_child_terms) && $category_display == 'new_page') {
    $child_categories = faq_view_child_category_headers($term);
  }
  $variables['subcat_list'] = $child_categories;
  $variables['subcat_list_style'] = variable_get('faq_category_listing', 'ul');

  // Configure class (faq_qa or faq_qa_hide).
  if ($get_child_terms == $term->tid) {
    $variables['container_class'] = 'faq_qa';
  }
  else {
    $variables['container_class'] = $class;
  }

  // Configure sub-category bodies (theme recursively).
  $variables['subcat_body_list'] = array();
  if (($get_child_terms && $category_display == 'categories_inline') || ((($show_term_page_children && $this_page != 'faq') || $hide_child_terms) && $category_display == 'hide_qa')) {
    $variables['subcat_body_list'] = faq_get_child_categories_faqs($term, 'faq_category_hide_answer', $default_weight, $default_sorting, $category_display, $variables['class']);
  }

  if (!count($data)) {
    $variables['question_count'] = 0;
    return;
  }

  $nodes = array();
  foreach ($data as $node) {
    if (!$hide_child_terms) {
      $count++;
    }
    $node_var = array();
    faq_view_question($node_var, $node, $this_page);
    faq_view_answer($node_var, $node, array(), $teaser, $links);
    $nodes[] = $node_var;
  }
  $variables['nodes'] = $nodes;
  $variables['question_count'] = $count;
  $variables['use_teaser'] = $teaser;
}

