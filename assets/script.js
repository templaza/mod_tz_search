/*------------------------------------------------------------------------

 # script.js - TZ Search Module

 # ------------------------------------------------------------------------

 # author    TemPlaza

 # copyright Copyright (C) 2011 templaza.com. All Rights Reserved.

 # @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

 # Websites: http://www.templaza.com

 # Technical Support:  Forum - http://www.templaza.com/Forum/

 -------------------------------------------------------------------------*/
jQuery(function($){
    $('#mod-tz-search-searchword').click(function(e) {
        if ($(this).parent().hasClass('open')) {
            $(this).parent().removeClass('open');
            $(this).removeClass('tz_up').addClass('tz_down');
        } else {
            $(this).parent().addClass('open');
            $(this).removeClass('tz_down').addClass('tz_up');
        }
    });
    $('.mod_tz_search .tz-search-dropdown').mouseleave(function (e) {
        if ($(this).parent().hasClass('open')) {
            $(this).parent().removeClass('open');
            $('#mod-tz-search-searchword').removeClass('tz_up').addClass('tz_down');
        }
    });
});
