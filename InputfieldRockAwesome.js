(function() {
    var timers = {};

    // show list of icons from fontawesome API
    $(document).on('input change', '.RockAwesome input', function(e) {
            let $ra = $(e.target).closest('.RockAwesome');
            let $li = $ra.closest('.Inputfield');
            let id = $li.attr('id');

            clearTimeout(timers[id]);
            timers[id] = setTimeout(function() {

            let $input = $ra.find('input');
            let $icons = $ra.find('.icons');
            let str = $input.val()+'';
            str = str.toLocaleLowerCase();

            if (str.match(/fa[srltdb] fa-.*/)) { // Wenn bereits ein gültiger FA-String übergeben wurde
                $ra.find('.uk-form-icon i').attr('class', str);
                $icons.html('');
                return;
            }
            html = "";
            $.post( "https://api.fontawesome.com/", { query: 'query { search(version: "'+ProcessWire.config.RockAwesomeVersion+'", query: "'+str+'", first: 50) { id styles } }' }, function( data ) {
                $.each(data.data.search, function(i, icon) {
                    $.each(icon.styles, function(i,style) {
                        if (
                            style == "solid" && ProcessWire.config.RockAwesomeSolid
                            || style == "regular" && ProcessWire.config.RockAwesomeRegular
                            || style == "light" && ProcessWire.config.RockAwesomeLight
                            || style == "thin" && ProcessWire.config.RockAwesomeThin
                            || style == "duotone" && ProcessWire.config.RockAwesomeDuotone
                            || style == "brands" && ProcessWire.config.RockAwesomeBrands
                        ) {
                            html += "<div class='icon' style='cursor: pointer; text-align: center;'>"
                            +"<i class='fa" + style[0] + " fa-" + icon.id + " fa-2x' style='width: 35px; '></i>"
                            +'<br><small>'
                            +"fa" + style[0] + " fa-" +icon.id
                            +'</small>'
                            +"</div>";
                        }
                    });
                })
                $icons.html(html);
            }, "json");

        }, 300);
    });

    // handle clicks on icons
    $(document).on('click', '.RockAwesome .icon', function(e) {
        let $ra = $(e.target).closest('.RockAwesome');
        var icon = $(e.target).closest('.icon').text();
        $icons = $ra.find('.icons');
        $input = $ra.find('input');
        $input.val(icon);
        $ra.find('.uk-form-icon i').attr('class', icon);
        $icons.html('');
    });
}());
