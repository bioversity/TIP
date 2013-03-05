$(document).ready(function(){
    if($('#home_menu').length > 0){
        $('#home_menu h3').hide();
        $('#home_menu hr').hide();
        $('.main_menu').css('border-bottom', 'none');
        $('.main_menu').css('margin-bottom', '5px');
        $('.main_menu').css('padding', 'none');
        $('.main_menu ul').css('margin-bottom', 'none');
        $('#main_menu_button').hide();
    }
});