function disableSlider(){
    $('#disable_slider').css('height',$('#slider_content').height()+'px');
    $('#disable_slider').css('width',$('#slider_content').width()+'px');
    $('#disable_slider').fadeIn('slow');
}

function disableForm(form)
{
    $('#disable_slider').css('height',($('#disable_slider').height()+$('#'+form).height())+'px');
}

function enableForm(form)
{
    $('#disable_slider').css('height',($('#disable_slider').height()-$('#'+form).height())+'px');
}