<?php
// $Id: faq-category-questions-top-answers.tpl.php,v 1.1.2.5 2008/04/16 16:14:45 snpower Exp $

/**
 * Available variables:
 *
 * $display_answers
 *   Whether or not there should be any output.
 * $display_header
 *   Boolean value controlling whether a header should be displayed.
 * $header_title
 *   The category title.
 * $category_name
 *   The name of the category.
 * $answer_category_name
 *   Whether the category name should be displayed with the answers.
 * $group_questions_top
 *   Whether the questions and answers should be grouped together.
 * $category_depth
 *   The term or category depth.
 * $description
 *   The current page's description.
 * $term_image
 *   The HTML for the category image. This is empty if the taxonomy image module
 *   is not enabled or there is no image associated with the term.
 * $display_faq_count
 *   Boolean value controlling whether or not the number of faqs in a category
 *   should be displayed.
 * $question_count
 *   The number of questions in category.
 * $nodes
 *   An array of nodes to be displayed.
 *   Each node stored in the $nodes array has the following information:
 *     $node['question'] is the question text.
 *     $node['body'] is the answer text.
 *     $node['links'] represents the node links, e.g. "Read more".
 * $use_teaser
 *   Whether $node['body'] contains the full body or just the teaser text.
 * $container_class
 *   The class attribute of the element containing the sub-categories, either
 *   'faq_qa' or 'faq_qa_hide'. This is used by javascript to open/hide
 *   a category's faqs.
 * $subcat_body_list
 *   The sub-categories faqs, recursively themed (by this template).
 */


if ($category_depth > 0) {
  $hdr = 'h6';
}
else {
  $hdr = 'h5';
}

$depth = 0;

?><?php if ($display_answers): ?>
  <?php if ($answer_category_name): ?>
    <?php while ($depth < $category_depth): ?>
      <div class="faq_category_indent">
    <?php $depth++; endwhile; ?>
  <?php endif; ?>

  <div class="faq_category_menu">

  <?php if ($display_header): ?>
    <<?php print $hdr; ?> class="faq_header">
    <?php print $term_image; ?>
    <?php print $category_name; ?>
    </<?php print $hdr; ?>>
    <div class="clear-block"></div>
    <div class="faq_category_group">
    <div>
  <?php endif; ?>

  <?php if (!$answer_category_name || $display_header): ?>

    <!-- include subcategories -->
    <?php foreach ($subcat_body_list as $i => $subcat_html): ?>
      <?php print $subcat_html; ?>
    <?php endforeach; ?>

    <?php if (!$display_header): ?>
      <div class="faq_category_group">
      <div>
    <?php endif; ?>

    <!-- list questions (in title link) and answers (in body) -->
    <?php foreach ($nodes as $i => $node): ?>

      <div class="faq_question"><?php //strong question label here? ?>
      <?php print $node['question']; ?>
      </div> <!-- Close div: faq_question -->

      <div class="faq_answer">
      <strong><?php print $answer_label; ?></strong>
      <?php print $node['body']; ?>
      <?php print $node['links']; ?>
      </div> <!-- Close div: faq_answer -->

    <?php endforeach; ?>

  <?php endif; ?>

  </div> <!-- Close div -->
  </div> <!-- Close div: faq_category_group -->

  <?php if ($answer_category_name): ?>
    <?php while ($depth > 0): ?>
      </div> <!-- Close div: faq_category_indent -->
    <?php $depth--; endwhile; ?>
  <?php endif; ?>
<?php endif; //if display_answers ?>
