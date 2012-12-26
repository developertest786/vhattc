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

    $("#slider_partner").tinycarousel();
});