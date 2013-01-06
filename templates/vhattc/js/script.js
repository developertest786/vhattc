/**
 * Created by JetBrains PhpStorm.
 * User: hoangnm
 * Date: 12/26/12
 * Time: 8:43 PM
 * To change this template use File | Settings | File Templates.
 */

$j = jQuery.noConflict();

$j(function () {
    /*--language--*/
    $("#sys-lst-language").on("click", "li", function () {
        var lang = $(this).data('lang');
        window.location = base_url +'/' +lang;
        //$("#sys_language_select").children(":eq(" + $(this).index() + ")").attr("selected","true");
        //$("#sys_choose_lang").submit();
    });

    if($("#all-news").find(".news-item").length>3) {
        $("#all-news").find(".news-item:nth-child(3n+1)").css("clear", "left");
    }

    if($("#datepicker_custom").length>0) {
        $("#datepicker_custom").datepicker({
            showOtherMonths: true,
            selectOtherMonths: true
        });
    }
    if($("#main-slider-code").length>0) {
        $("#main-slider-code").tinycarousel({
            pager:true,
            interval:true
        });
    }
    if($("#slider_partner").length>0) {
        $("#slider_partner").tinycarousel();
    }

    $(".my-calendar-click").live('click', function (event) {
        alert('ha ha ha'); return;
        event.preventDefault();
        //var parentElement = $K2(this).parent().parent().parent().parent();
        var url = $K2(this).attr('href');
        parentElement.empty().addClass('k2CalendarLoader');
        $.ajax({
            url: url,
            type: 'post',
            success: function(response){
                $("#datepicker_custom").html(response);
                parentElement.removeClass('k2CalendarLoader');
            }
        });
    });
});