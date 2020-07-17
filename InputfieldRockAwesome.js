(function() {
  var icons = ProcessWire.config.RockAwesome;

  var debounce = function(func, wait, immediate) {
    var wait = wait || 500; // 500ms default
    var timeout;
    return function() {
      var context = this, args = arguments;
      var later = function() {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  };

  // get icon by name (exact match)
  var getIcon = function(str) {
    if(icons.indexOf(str) < 0) return;
    return str;
  }

  // find icons
  // match both words only
  var findIcons = function(str) {
    var words = str.split(' ');
    words = words.filter(function (el) {
      if(el == '') return false;
      return el != null;
    });
    if(!words.length) return [];

    var set = [];
    $.each(icons, function(i, icon) {
      var match = true;
      $.each(words, function(i, word) {
        if(icon.indexOf(word) < 0) match = false;
      });
      if(match) set.push(icon);
    });
    return set;
  }

  // show list of icons
  $(document).on('input change', '.RockAwesome input', debounce(function(e) {
    $ra = $(e.target).closest('.RockAwesome');
    $input = $ra.find('input');
    $icons = $ra.find('.icons');
    var str = $input.val()+'';
    str = str.toLocaleLowerCase();

    // show icon in inputfield
    if(getIcon(str)) {
      $ra.find('.uk-form-icon i').attr('class', str);
      $icons.html('');
      return;
    }
    else {
      $ra.find('.uk-form-icon i').attr('class', '');
    }

    // find icons that match the input
    var set = findIcons(str);

    // setup string
    var html = '';
    $.each(set, function(i, icon) {
      html += "<div class='icon' style='cursor: pointer;'>"
        +"<i class='" + icon + "' style='width: 35px; text-align: center;'></i>"
        +icon
        +"</div>";
    });

    $icons.html(html);
  }));

  // handle clicks on icons
  $(document).on('click', '.RockAwesome .icon', function(e) {
    var icon = $(e.target).closest('.icon').text();
    $input = $(e.target).closest('.RockAwesome').find('input');
    $input.val(icon);
  });
}());
