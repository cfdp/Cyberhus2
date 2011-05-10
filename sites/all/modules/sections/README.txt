README.txt
==========
This module allows you to create sections. Each section has an installed theme, theme or style 
attached to it. Each section also contains a path setting similar to the new blocks admin. 
You can then assign themes to a list (regexp'ed) paths. 

For example, if you want another style for your "example" path, all you have to do, is create a section with:
name: Example Section
path: example*
and assign (a customade) theme like "example_theme" to that section.

Template suggestion
===================
This module provide page template suggestion based on section id and section name. You are 
able to create section based page templates. All characters not in [A-Za-z0-9] will be truncated
to a hyphen. The suggested page template names are:

sections-page-[section id].tpl.php
sections-page-[section name].tpl.php

Examples:
Section has the id 5 -> suggested page template is "sections-page-5.tpl.php".
Section is named "My blue forum" -> suggested page template is "sections-page-my-blue-forum.tpl.php".

Notes
=====
  This module is currently under development and I am still figuring out how to make it perform better.
  Also, the logic inside sections_in_section($section = NULL) is suboptimal. Anyone with good preg_match 
  knowledge is welcome to improve it, so that we can avoid to pull all sections out of the DB every call.
  
Ber Kessels [Drupal Services http://www.webschuur.com]

Feedback
======== 
Will be welcomed, but for support, please create an 'issue' of type 'support request' for the project -sections-.
