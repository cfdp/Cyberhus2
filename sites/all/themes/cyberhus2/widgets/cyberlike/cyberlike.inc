<?php
// $Id: cyberlike.inc,v 1.1.2.2 2010/05/01 08:18:23 marvil07 Exp $

/**
 * @file
 * Cyberlike VUD Widget.
 */

/**
 * Implementation of hook_vud_widgets(). (Specialized)
 */
function cyberhus2_cyberlike_vud_widgets() {
  return array(
    'title' => t('Cyberlike'),
    'widget template' => 'widget',
  );
}
