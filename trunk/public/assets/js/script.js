/**
 * Created by JetBrains PhpStorm.
 * User: hoangnm
 * Date: 12/26/12
 * Time: 8:43 PM
 * To change this template use File | Settings | File Templates.
 */

$(function () {
    /*--language--*/
    $("#sys-lst-language").on("click", "li", function () {
        $("#sys_language_select").children(":eq(" + $(this).index() + ")").attr("selected","true");
        $("#sys_choose_lang").submit();
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
    if($("#slider_partner").length>0) {
        $("#slider_partner").tinycarousel();
    }
});