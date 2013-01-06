/**
 * Created by JetBrains PhpStorm.
 * User: hoangnm
 * Date: 12/26/12
 * Time: 8:43 PM
 * To change this template use File | Settings | File Templates.
 */

var $j = jQuery.noConflict();

$j(function () {
    /*--language--*/
    $j("#sys-lst-language").on("click", "li", function () {
        var lang = $j(this).data('lang');
        window.location = base_url +'/' +lang;
        //$j("#sys_language_select").children(":eq(" + $j(this).index() + ")").attr("selected","true");
        //$j("#sys_choose_lang").submit();
    });

    if($j("#all-news").find(".news-item").length>3) {
        $j("#all-news").find(".news-item:nth-child(3n+1)").css("clear", "left");
    }

    /*if($j("#datepicker_custom").length>0) {
        $j("#datepicker_custom").datepicker({
            showOtherMonths: true,
            selectOtherMonths: true
        });
    }*/
    if($j("#main-slider-code").length>0) {
        $j("#main-slider-code").tinycarousel({
            pager:true,
            interval:true
        });
    }
    if($j("#slider_partner").length>0) {
        $j("#slider_partner").tinycarousel();
    }

    $j("a.my-calendar-click").live('click', function (event) {
        //alert('ha ha ha'); return;
        event.preventDefault();
        //var parentElement = $jK2(this).parent().parent().parent().parent();
        var url = $j(this).data('handler');
        //parentElement.empty().addClass('k2CalendarLoader');
        $j.ajax({
            url: url,
            type: 'post',
            success: function(response){
                $j("#datepicker_custom").html(response);
                //parentElement.removeClass('k2CalendarLoader');
            }
        });
    });
});