CONTENTS OF THIS FILE
----------------------

  * Introduction
  * Installation
  * Configuration


INTRODUCTION
------------
Maintainer: Stella Power (http://drupal.org/user/66894)

Documentation: http://drupal.org/node/129209

The Frequently Asked Questions (faq) module allows users with the 'administer
faq' permission to create question and answer pairs which they want displayed on
the 'faq' page.  The 'faq' page is automatically generated from the FAQ nodes
configured and the layout of this page can be modified on the settings page.
Users will need the 'view faq' permission to view the 'faq' page. 

There are 2 blocks included in this module, one shows a list of FAQ categories
while the other can show a configurable number of recent FAQs added.

Note the function theme_faq_highlights(), which shows the last X recently
created FAQs, used by one of the blocks, can also be called in a php-filtered 
node if desired.


INSTALLATION
------------
1. Copy faq folder to modules directory.
2. At admin/build/modules enable the faq module.
3. Enable permissions at admin/user/permissions.
4. Configure the module at admin/settings/faq.


CONFIGURATION
-------------
Once the module is activated, you can create your question and answer pairs by
creating FAQ nodes (Create content >> FAQ).  This allows you to edit the
question and answer text.  In addition, if the 'Taxonomy' module is enabled and
there are some terms configured for the FAQ node type, it will also be possible
to put the questions into different categories when editing.
