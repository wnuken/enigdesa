/**
 * Funciones javaScript para el menu
 * @author oagarzond
 * @since 2016-07-12
 */
$(function () {
    $('.opacity').mouseover(function() {
        var temp = $(this).attr('id').split('-');
        if(temp[2] == undefined) {
            $(this).attr('src', base_url + 'images/ico_gmf_on_' + temp[1] + '.png');
        }
    });
    
    $('.opacity').mouseout(function() {
        var temp = $(this).attr('id').split('-');
        if(temp[2] == undefined) {
            $(this).attr('src', base_url + 'images/ico_gmf_' + temp[1] + '.png');
        }
    });
    
    $('.menuC3').click(function() {
        window.location.href = base_url + 'modgasmenfrehogar/' + $(this).attr('id');
        return false;
    });
});