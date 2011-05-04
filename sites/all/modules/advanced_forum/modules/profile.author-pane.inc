<?php
// $Id: profile.author-pane.inc,v 1.1.2.3 2008/12/12 03:41:06 michellec Exp $

/**
 * @file
 *   This file provides a preprocess function for the author pane used by
 *   Advanced Forum and Advanced Profile Kit.
 */


/**
 * Implementation of hook_preprocess_author_pane().
 */
function profile_preprocess_author_pane(&$variables) {
  $account_id = $variables['account']->uid;
  if ($account_id != 0) {
    // As of D6, this just loads the content array and doesn't return anything.
    profile_view_profile($variables['account']);

    $variables['profile'] = $variables['account']->content;
  }
}