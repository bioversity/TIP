function buildTree()
{    
    $('div.tree div.checkbox_option').each(function(){
        var labelText= $(this).text();
        var count = labelText.match(/___/g);
        var $inputId= $(this).find('input').attr('id');
        
        if(count){
            var $next= $(this).next().text().match(/___/g);
            if($next){
                if($next.length > count.length)
                    $(this).find('label').html('<span class="opener"> <strong> + </strong> </span>'+$(this).text());
                else
                    $(this).find('label').html('<span class="opener"> _</span>'+$(this).text());
            }
            $(this).attr('id', 'node'+$inputId+'_'+(count.length+1));
            $(this).addClass('children level_'+(count.length+1)+' closed');
            $(this).fadeOut('slow');
        }else{
            if($(this).next().text().match(/___/g))
                $(this).find('label').html('<span class="opener"> <strong> + </strong> </span>'+$(this).text());
            $(this).attr('id', 'node'+$inputId+'_'+'1');
            $(this).addClass('root level_1');
        }
    });    
}

function clearIndentation(label)
{
    return label.replace('___', '&nbsp;');
}

function bindFormCheckbox()
{
    $('div.tree div.checkbox_option input, .opener').click(function(){
        var $opener= $(this).parent().find('.opener');
        
        if($opener.html() == ' <strong> + </strong> '){
            $opener.html(' <strong> - </strong> '); 
        }else{
            $opener.html(' <strong> + </strong> '); 
        }
        
        var $inputId= $(this).parent().attr('id');
        var $exploded= $inputId.split('_');
        
        var level= parseInt($exploded[3], 10)+1;
        
        var open= false;
        var check= false;
        $('.tree .checkbox_option').each(function(){
            if($(this).attr('id') == $inputId){
                open= true;
            }
            if(check && ($(this).hasClass('root') || $(this).hasClass('level_'+(level-1)))){
                open= false;
            }
            if(open && $(this).hasClass('level_'+level)){
                if($(this).hasClass('closed')){
                    $(this).fadeIn();
                    $(this).removeClass('closed');
                    $(this).addClass('open');
                }else{
                    $(this).fadeOut();
                    $(this).removeClass('open');
                    $(this).addClass('closed');
                }
                check= true;
            }
        });
    });
}