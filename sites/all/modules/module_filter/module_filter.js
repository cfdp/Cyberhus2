// $Id: module_filter.js,v 1.2.2.3 2009/01/15 00:55:08 greenskin Exp $

if (Drupal.jsEnabled) {
  var moduleFilterTimeOut;
  var moduleFilterTextFilter = '';
  var moduleFilterClosedFieldsets = new Array();

  $(document).ready(function() {
    $("#module-filter-wrapper").show();
    $("#edit-module-filter").focus();
    $("#edit-module-filter").keyup(function() {
      if (moduleFilterTextFilter != $(this).val()) {
        moduleFilterTextFilter = this.value;
        if (moduleFilterTimeOut) {
          clearTimeout(moduleFilterTimeOut);
        }
        moduleFilterTimeOut = setTimeout("moduleFilter('" + moduleFilterTextFilter + "')", 500);
      }

      if (moduleFilterClosedFieldsets == '') {
        $("fieldset.collapsed").each(function(i) {
          $(this).removeClass('collapsed');
          moduleFilterClosedFieldsets.push($(this).children('legend').text());
        });
      }
    });
  });
}

function moduleFilter(string) {
  stringLowerCase = string.toLowerCase();

  $("table.package tbody tr td strong").each(function(i) {
    var parent = $(this).parent().parent();
    var module = $(this).text();
    var moduleLowerCase = module.toLowerCase();

    if (moduleLowerCase.match(stringLowerCase)) {
      if (parent.css('display') == 'none') {
        parent.show();
        if (parent.parent().parent().parent().parent().css('display') == 'none') {
          parent.parent().parent().parent().parent().show();
        }
      }
      if (string == '') {
        var fieldset = parent.parent().parent().parent().parent();
        for (var i in moduleFilterClosedFieldsets) {
          if (fieldset.children('legend').text() == moduleFilterClosedFieldsets[i]) {
            fieldset.addClass('collapsed');
            delete(moduleFilterClosedFieldsets[i]);
          }
        }
      }
    }
    else {
      if (parent.css('display') != 'none') {
        parent.hide();
        if (parent.siblings(":visible").html() == null) {
          if (parent.parent().parent().parent().parent().css('display') != 'none') {
            parent.parent().parent().parent().parent().hide();
          }
        }
      }
    }
  });
}
