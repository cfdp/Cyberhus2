<?php
// $Id: faq-questions-top.tpl.php,v 1.1.2.6 2008/04/16 16:14:45 snpower Exp $

/**
 * Available variables:
 *
 * $questions_list
 *   Pre-formatted list of questions.
 * $questions
 *   An array of questions to use for producing the question list at the top.
 * $answers
 *   An array of answers to use for producing the main body of text.
 *     $answers[$key]['question'] is the question text.
 *     $answers[$key]['body'] is the answer text.
 *     $answers[$key]['links'] represents the node links, e.g. "Read more".
 * $use_teaser
 *   Is true if $answer['body'] is a teaser.
 * $list_style
 *   Represents the style of list, ul for unordered, ol for ordered.
 * $limit
 *   Represents the number of items.
 */
?>
<?php print $questions_list ?>
<br />
<?php $key = 0; ?>
<?php while ($key < $limit): ?>
  <?php // Cycle through all the answers and "more" links. $key will represent the applicable position in the arrays. ?>
  <div class="faq_question">
  <?php print $answers[$key]['question']; ?>
  </div> <!-- Close div: faq_question -->

  <div class="faq_answer">
  <?php print $answers[$key]['body']; ?>
  <?php print $answers[$key]['links']; ?>
  </div> <!-- Close div: faq_answer -->
  <?php // Increment $key to move on to the next position. ?>
  <?php $key++; ?>
<?php endwhile; ?>
