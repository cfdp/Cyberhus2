<?php
// $Id: widget.tpl.php,v 1.1.2.18 2010/12/05 07:50:06 marvil07 Exp $
/**
 * @file
 * widget.tpl.php
 *
 * Alternate widget theme for Vote Up/Down
 */
?>
<div class="vud-widget vud-widget-cyberlike" id="<?php print $id; ?>">

    <?php if ($class_up) : ?>
    <div class="cyberlike-votes-display"><?php print $unsigned_points; ?>&nbsp;synes godt om</div>
      <?php endif; ?>
    <?php if ($show_links): ?>
      <?php if ($show_up_as_link): ?>
        <a href="<?php print $link_up; ?>" rel="nofollow" class="<?php print $link_class_up; ?>">
      <?php endif; ?>
          <div class="<?php print $class_up; ?>" title="<?php print t('Klik hvis du synes godt om'); ?>">
          <span>Cyberlike</span>
          </div>

      <?php if ($show_up_as_link): ?>
        </a>
      <?php endif; ?>
    <?php endif; ?>

</div>

