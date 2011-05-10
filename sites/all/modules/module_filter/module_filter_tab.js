// $Id: module_filter_tab.js,v 1.1.2.8 2009/01/19 18:59:35 greenskin Exp $

if (Drupal.jsEnabled) {
  var moduleFilterTimeOut;
  var moduleFilterTabsHeight;
  var moduleFilterTextFilter = '';
  var moduleFilterActiveTab = 'all-tab';

  $(document).ready(function() {
    moduleFilterTabsHeight = $("#module-filter-tabs").height();
    _moduleFilterSpacerHeight();
    $("#edit-module-filter").focus();
    $("#module-filter-left a.project-tab").each(function(i) {
      $(this).click(function() {
        if ($(this).attr('id') != moduleFilterActiveTab) {
          $('#' + moduleFilterActiveTab).parent().toggleClass('active');
          moduleFilterActiveTab = $(this).attr('id');
          $('#' + moduleFilterActiveTab).parent().toggleClass('active');

          // Filter rows depending on tab selected.
          moduleFilterTabLoad();

          if ($("#module-filter-squeeze table.sticky-header").css('visibility') == 'visible') {
            destination = $("#module-filter-left").offset().top;
            $("html:not(:animated),body:not(:animated)").scrollTop(destination - 15);
          }
        }
        return false;
      });
    });
    $("#edit-module-filter").keyup(function() {
      if (moduleFilterTextFilter != $(this).val()) {
        moduleFilterTextFilter = this.value;
        if (moduleFilterTimeOut) {
          clearTimeout(moduleFilterTimeOut);
        }
        moduleFilterTimeOut = setTimeout("moduleFilter('" + moduleFilterTextFilter + "')", 500);
      }
    });
  });
}

function moduleFilterTabLoad() {
  var flip = 'odd';

  $("#edit-module-filter").val('');

  if (moduleFilterActiveTab == 'all-tab') {
    $("#projects tbody tr").each(function(i) {
      $(this).removeClass('odd');
      $(this).removeClass('even');
      $(this).addClass(flip);
      flip = (flip == 'odd') ? 'even' : 'odd';
    });
    $("#projects tbody tr").show();
  }
  else {
    $("#projects tbody tr").hide();
    $("#projects tbody tr").each(function(i) {
      $(this).removeClass('odd');
      $(this).removeClass('even');
    });
    $("#projects tbody tr." + moduleFilterActiveTab + "-content").each(function(i) {
      $(this).addClass(flip);
      flip = (flip == 'odd') ? 'even' : 'odd';
    });
    $("#projects tbody tr." + moduleFilterActiveTab + "-content").show();
  }

  _moduleFilterSpacerHeight();
}

function moduleFilter(string) {
  var stringLowerCase = string.toLowerCase();
  var flipper = new _moduleFilterFlipper();

  if (moduleFilterActiveTab == 'all-tab') {
    $("#projects tbody tr td strong").each(function(i) {
      _moduleFilter(stringLowerCase, this, flipper);
    });
  }
  else {
    $("#projects tbody tr." + moduleFilterActiveTab + "-content td strong").each(function(i) {
      _moduleFilter(stringLowerCase, this, flipper);
    });
  }

  _moduleFilterSpacerHeight();
}

function _moduleFilter(stringLowerCase, item, flip) {
  var parent = $(item).parent().parent();
  var module = $(item).text();
  var moduleLowerCase = module.toLowerCase();
  if (moduleLowerCase.match(stringLowerCase)) {
    parent.removeClass('odd');
    parent.removeClass('even');
    parent.addClass(flip.flip);
    parent.show();
    flip.flip = (flip.flip == 'odd') ? 'even' : 'odd';
  }
  else {
    parent.hide();
  }
}

function _moduleFilterFlipper() {
  this.flip = 'odd';
}

function _moduleFilterSpacerHeight() {
  var rightHeight = $("#module-filter-squeeze").height();
  if (moduleFilterTabsHeight <= rightHeight) {
    $("#module-filter-spacer").height($("#module-filter-squeeze").height());
  }
  else {
    $("#module-filter-spacer").height($("#module-filter-tabs").height() - 1);
  }
}
