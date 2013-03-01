function disableSlider(){
    $('#disable_slider').css('width',$('#slider_content').width()+'px');
    $('#disable_slider').css('height','1px');
    $('#disable_slider').fadeIn('slow');
    $('#disable_slider').animate({'height':$('#slider_content').height()+'px'});
}

function enableSlider(){
    $('#disable_slider').animate({'height':'0px'});
    $('#disable_slider').fadeOut('slow');
}

function disableForm(form)
{
    $('#disable_slider').animate({'height':($('#disable_slider').height()+$('#'+form).height())+'px'});
}

function enableForm(form)
{
    $('#disable_slider').animate({'height':($('#disable_slider').height()-$('#'+form).height())+'px'});
}