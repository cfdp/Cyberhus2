
/**
 *  @file
 *  Javascript to enhance the views slideshow cycle form options.
 */

/**
 * This will set our initial behavior, by starting up each individual slideshow.
 */
(function ($) {
  // Manage advanced options
  Drupal.behaviors.viewsSlideshowCycleOptions = function (context) {
    if ($(":input[name='style_options[views_slideshow_cycle][advanced_options]']").length) {
      $(":input[name='style_options[views_slideshow_cycle][advanced_options]']").parent().hide();

      $(":input[name='style_options[views_slideshow_cycle][advanced_options_entry]']").parent().after(
        '<div style="margin-left: 10px; padding: 10px 0;">' +
          '<a id="edit-style-options-views-slideshow-cycle-advanced-options-update-link" href="#">' + Drupal.t('Update Advanced Option') + '</a>' +
        '</div>'
      );

      $("#edit-style-options-views-slideshow-cycle-advanced-options-table").append('<tr><th colspan="2">' + Drupal.t('Applied Options') + '</th><tr>')

      var initialValue = $(":input[name='style_options[views_slideshow_cycle][advanced_options]']").val();
      var advancedOptions = JSON.parse(initialValue);
      for (var option in advancedOptions) {
        viewsSlideshowCycleAdvancedOptionsAddRow(option);
      }

      // Add the remove event to the advanced items.
      viewsSlideshowCycleAdvancedOptionsRemoveEvent();

      $(":input[name='style_options[views_slideshow_cycle][advanced_options_choices]']").change(function() {
        var selectedValue = $(":input[name='style_options[views_slideshow_cycle][advanced_options_choices]'] option:selected").val();
        if (typeof advancedOptions[selectedValue] !== 'undefined') {
          $(":input[name='style_options[views_slideshow_cycle][advanced_options_entry]']").val(advancedOptions[selectedValue]);
        }
        else {
          $(":input[name='style_options[views_slideshow_cycle][advanced_options_entry]']").val('');
        }
      });

      $('#edit-style-options-views-slideshow-cycle-advanced-options-update-link').click(function() {
        var option = $(":input[name='style_options[views_slideshow_cycle][advanced_options_choices]']").val();
        if (option) {
          var value = $(":input[name='style_options[views_slideshow_cycle][advanced_options_entry]']").val();

          if (typeof advancedOptions[option] == 'undefined') {
            viewsSlideshowCycleAdvancedOptionsAddRow(option);
            viewsSlideshowCycleAdvancedOptionsRemoveEvent()
          }
          advancedOptions[option] = value;
          viewsSlideshowCycleAdvancedOptionsSave();
        }

        return false;
      });
    }

    function viewsSlideshowCycleAdvancedOptionsAddRow(option) {
      $("#edit-style-options-views-slideshow-cycle-advanced-options-table").append(
        '<tr id="views-slideshow-cycle-advanced-options-table-row-' + option + '">' +
          '<td>' + option + '</td>' +
          '<td style="width: 20px;">' +
            '<a style="margin-top: 6px" title="Remove ' + option + '" alt="Remove ' + option + '" class="views-hidden views-button-remove views-slideshow-cycle-advanced-options-table-remove" id="views-slideshow-cycle-advanced-options-table-remove-' + option + '" href="#"><span>Remove</span></a>' +
          '</td>' +
        '</tr>'
      );
    }

    function viewsSlideshowCycleAdvancedOptionsRemoveEvent() {
      $('.views-slideshow-cycle-advanced-options-table-remove').unbind().click(function() {
        var itemID = $(this).attr('id');
        var uniqueID = itemID.replace('views-slideshow-cycle-advanced-options-table-remove-', '');
        delete advancedOptions[uniqueID];
        $('#views-slideshow-cycle-advanced-options-table-row-' + uniqueID).remove();
        viewsSlideshowCycleAdvancedOptionsSave();
        return false;
      });
    }

    function viewsSlideshowCycleAdvancedOptionsSave() {
      var advancedOptionsString = JSON.stringify(advancedOptions);
      $(":input[name='style_options[views_slideshow_cycle][advanced_options]']").val(advancedOptionsString);
    }
  }
})(jQuery);
