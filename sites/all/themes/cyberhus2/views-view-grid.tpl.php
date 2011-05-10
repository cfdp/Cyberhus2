<?php
// $Id: views-view-grid.tpl.php,v 1.3.4.1 2010/03/12 01:05:46 merlinofchaos Exp $
/**
 * @file views-view-grid.tpl.php
 * Default simple view template to display a rows in a grid.
 *
 * - $rows contains a nested array of rows. Each row contains an array of
 *   columns.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)) : ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<table class="views-view-grid">
  <tbody>
    <?php foreach ($rows as $row_number => $columns): ?>
      <?php
        $row_class = 'row-' . ($row_number + 1);
        if ($row_number == 0) {
          $row_class .= ' row-first';
        }
        if (count($rows) == ($row_number + 1)) {
          $row_class .= ' row-last';
        } 
		/* adding row-odd and row-even classes */
        if (($row_number%2) == (0)) {
          $row_class .= ' row-odd';
        }
        if (($row_number%2) != (0)) {
          $row_class .= ' row-even';
        }
      ?>
      <tr class="<?php print $row_class; ?>">
        <?php foreach ($columns as $column_number => $item): 
		/* adding col-first and col-last classes */
		$col_class = 'col-' . ($column_number + 1);
        if ($column_number == 0) {
          $col_class .= ' col-first';
        }
        if (count($columns) == ($column_number + 1)) {
          $col_class .= ' col-last';
        } 
		/* adding row-odd and row-even classes */
        if (($col_number%2) == (0)) {
          $col_class .= ' col-odd';
        }
        if (($col_number%2) != (0)) {
          $col_class .= ' col-even';
        }
		/* adding not-empty class */
        if (strlen($item) != (0)) {
          $col_class .= ' not-empty';
        }
		?>
          <td class="<?php print $col_class; ?>">
            <?php print $item; ?>
          </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
