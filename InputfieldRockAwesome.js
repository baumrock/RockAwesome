(function() {
   // var timers = {};
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


   // show list of icons from fontawesome API
   $(document).on('input change', '.RockAwesome input', debounce(function(e) {
      $ra = $(e.target).closest('.RockAwesome');
      $input = $ra.find('input');
      $icons = $ra.find('.icons');
      var str = $input.val() + '';

      $li = $ra.closest('.Inputfield');
      id = $li.attr('id');

      // clearTimeout(timers[id]);
      // timers[id] = setTimeout(function() {

      str = str.toLocaleLowerCase();

      if (!str) { // if no string
         $ra.find('.uk-form-icon i').attr('class', "");
         return;
      }
      // show spinner
      $ra.find('.uk-form-icon i').attr('class', 'fa fa-spinner fa-spin');

      if (str.match(/fa[srltdb] fa-.*/)) { // if a valid FA string is submitted
         $ra.find('.uk-form-icon i').attr('class', str);
         $icons.html('');
         return;
      }
      html = "";

      $.post( "https://api.fontawesome.com/", { query: 'query { search(version: "'+ProcessWire.config.RockAwesomeVersion+'", query: "'+str+'", first: 150) { id label membership {pro free} } }' }, function( data ) {
         $.each(data.data.search, function(i, icon) {
            console.log(ProcessWire.config.RockAwesomeMembership);
            console.log(ProcessWire.config.RockAwesomeDuotone);
            console.log(icon);
            if (ProcessWire.config.RockAwesomeMembership*1>1) {
               // Pro
               mystyles = icon.membership.pro;
            }
            else {
               mystyles = icon.membership.free;
            }

            $.each(mystyles, function(i,style) {
               if (
                  style == "solid" && ProcessWire.config.RockAwesomeSolid
                  || style == "regular" && ProcessWire.config.RockAwesomeRegular
                  || style == "light" && ProcessWire.config.RockAwesomeLight
                  || style == "thin" && ProcessWire.config.RockAwesomeThin
                  || style == "duotone" && ProcessWire.config.RockAwesomeDuotone
                  || style == "brands" && ProcessWire.config.RockAwesomeBrands
               ) {
                  html += "<div class='icon' style='cursor: pointer; text-align: center;' data-rock-icon='"+"fa" + style[0] + " fa-" +icon.id+"'>"
                  +"<i class='fa" + style[0] + " fa-" + icon.id + " fa-2x' style='width: 35px;'></i>"
                  +'<br><small>'
                  +icon.label
                  +'</small>'
                  +"</div>";
               }
            });
         })
         $icons.html(html);
         $ra.find('.uk-form-icon i').attr('class', "");

      }, "json");

      // }, 300);
   }));

   // handle clicks on icons
   $(document).on('click', '.RockAwesome .icon', function(e) {
      let $ra = $(e.target).closest('.RockAwesome');
      var icon = $(e.target).closest('.icon').data('rock-icon');
      $icons = $ra.find('.icons');
      $input = $ra.find('input');
      $input.val(icon);
      $ra.find('.uk-form-icon i').attr('class', icon);
      $icons.html('');
   });
}());
