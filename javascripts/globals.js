if (!Seasons) {
    var Seasons = {};
}


Modernizr.addTest("boxsizing", function() {
    return Modernizr.testAllProps("boxSizing") && (document.documentMode === undefined || document.documentMode > 7);
});

(function ($) {

    Seasons.mobileSelectNav = function () {
        // Create the dropdown base
        $("<select class=\"mobile\" />").appendTo("nav.top");
        
        // Create default option "Go to..."
        $("<option />", {
           "selected": "selected",
           "value"   : "",
           "text"    : "Go to..."
        }).appendTo("nav select");
        
        // Populate dropdown with menu items
        $("nav.top a").each(function() {
            var el = $(this);
            if (el.parents('ul ul').length) {
                var parentCount = el.parents("ul").length;
                var dashes = new Array(parentCount).join('- ');
                $("<option />", {
                    "value": el.attr("href"),
                    "text":  dashes + el.text()
                }).appendTo("nav select");
            } else {
                $("<option />", {
                    "value": el.attr("href"),
                    "text": el.text()
                }).appendTo("nav.top select");
            }
            $("nav.top select").change(function() {
              window.location = $(this).find("option:selected").val();
            });
        });
    }

    if( !($('html').hasClass('boxsizing')) ){
        $('.boxSized, .boxSized *').each(function(){
            var fullW = $(this).outerWidth(),
                actualW = $(this).width(),
                wDiff = fullW - actualW,
                newW = actualW - wDiff;
 
            $(this).css('width',newW);
        });
    }

})(jQuery);