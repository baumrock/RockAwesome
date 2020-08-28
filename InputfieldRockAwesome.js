(function() {
  var icons = ProcessWire.config.RockAwesome;
  var timers = {};

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
  $(document).on('input change', '.RockAwesome input', function(e) {
    let $ra = $(e.target).closest('.RockAwesome');
    let $li = $ra.closest('.Inputfield');
    let $input = $ra.find('input');
    let $icons = $ra.find('.icons');
    let str = $input.val()+'';
    str = str.toLocaleLowerCase();
    let id = $li.attr('id');

    // debounce changes for every rockawesome inputfield
    clearTimeout(timers[id]);
    timers[id] = setTimeout(function() {
      console.log('fired', id);
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
    }, 500);
  });

  // handle clicks on icons
  $(document).on('click', '.RockAwesome .icon', function(e) {
    var icon = $(e.target).closest('.icon').text();
    $input = $(e.target).closest('.RockAwesome').find('input');
    $input.val(icon);
  });
}());
