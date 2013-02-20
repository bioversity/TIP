$(document).ready(function(){
    $('#create_namespace').attr('href', '#NamespaceModal');
    $('#create_namespace').attr('data-toggle', 'modal');
    $('#form_term').attr('action',dev_stage+'/ontology/json/term/new');
    startAutocomplete();
    bindFormButton();
    bindFormCheckbox();
    buildTree();
});

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

function bindFormButton()
{
    
    $('#OntologyTerm_save').click(function(event){
        event.preventDefault();
        var $form= $('form[id="form_term"]');
        $.ajax({
            type:       "POST",
            url:        $form.attr('action'),
            dataType:   "json",
            data:       $form.serializeArray(),
            success: function( data ) {
                if(data['term'] !== ''){
                    startNodeSelection(data['term'][':WS:RESPONSE']['_ids'][0]);
                }
            }
        });
    });
    $('#OntologyTerm_select').click(function(event){
        event.preventDefault();
        
        var $namespace= $('input[name="OntologyTerm['+kTAG_NAMESPACE+']"]').val();
        var $lid      = $('input[name="OntologyTerm['+kTAG_LID+']"]').val();
        startNodeSelection($namespace+':'+$lid);
    });
    
    $('#create_namespace').click(function(event){
        event.preventDefault();
        $('#NamespaceModal .modal-body div#embedded_content').html('');
        $('#NamespaceModal .modal-body div#embedded_content').html('<object height="400px" width="100%" data="'+dev_stage+'/ontology/modal/namespace/new'+'"><param value="aaa.pdf" name="src"/><param value="transparent" name="wmode"/></object>');
        $('#NamespaceModal .modal-body div#embedded_content').fadeIn('slow');
    });
        
    $('.slider_button').click(function(event){
        event.preventDefault();
        $('#SliderModal #loader').fadeIn('slow');
        $('#SliderModal .modal-body div#embedded_content').html('');
        $('#SliderModal .modal-body div#embedded_content').html('<object height="500px" width="700px" data="'+dev_stage+'/modal-slider/'+$(this).attr('value')+'"><param value="aaa.pdf" name="src"/><param value="transparent" name="wmode"/></object>');
        $('#SliderModal .modal-body div#embedded_content').fadeIn('slow');
        
        //$.ajax({
        //    type:       "POST",
        //    url:        dev_stage+'/modal-slider/'+$(this).attr('value'),
        //    dataType:   "html",
        //    success: function( data ) {
        //        $('#SliderModal .modal-body div#embedded_content').append(data);
        //    }
        //}).done( function(){
        //    $('#SliderModal #loader').fadeOut();
        //    $('#SliderModal .modal-body div#embedded_content').fadeIn('slow');
        //});
    });
}

function startNodeSelection(term)
{    
    $('#form_node_container div#loader').fadeIn();
    $('#form_node_container div#embedded_node_form').html('');
    $.ajax({
         url:        dev_stage+'/ontology/modal/node/new/'+term,
         dataType:   "html",
         success: function( data ) {
            $('#form_node_container div#embedded_node_form').html(data);
         }
     }).done( function(){
         $('#form_node_container #loader').fadeOut();
         $('#form_node_container div#embedded_node_form').fadeIn('slow');
     });
}

function startAutocomplete()
{
    $( "#OntologyTerm_"+kTAG_LID+", #OntologyNamespace_"+kTAG_LID ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/ontology/json/find/lid/"+getUrlParams(request.term),
                dataType: "json",
                success: function( data ) {
                    if(data == ''){
                        unvalorizeField()
                    }else{
                        response( $.map( data, function( item ) {
                            return {
                                label: item.GID,
                                value: item.LID
                            }
                        }));
                    }
                }
            });
        },
        minLength: 1,
        select: function( event, ui ) {
                    if(ui.item){
                        getTermDetail(ui.item.value, ui.item.label);
                    }
                },
    });
    
    $( "#OntologyTerm_"+kTAG_NAMESPACE+", #OntologyNamespace_"+kTAG_NAMESPACE ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/ontology/json/find/namespace/"+request.term,
                dataType: "json",
                success: function( data ) {
                    if(data == ''){
                        unvalorizeField()
                    }else{
                        response( $.map( data, function( item ) {
                            return {
                                label: item.GID,
                                value: item.GID
                            }
                        }));
                    }
                }
            });
        },
        minLength: 1,
        select: function( event, ui ) {
                    if(ui.item)
                        getTermDetail(ui.item.value, ui.item.label);
                },
    });
}

function getUrlParams(lid)
{
    var $namespace= $( "#OntologyTerm_"+kTAG_NAMESPACE ).val();
    if($namespace == '')
        params= lid;
    else
        params= lid+'/'+$namespace;
    
    return params;
}

function getTermDetail(term, gid)
{
    $.ajax({
        url: dev_stage+"/ontology/json/get/term/"+getUrlParams(term),
        dataType: "json",
        success: function( data ) {
            var response= data[':WS:RESPONSE'];
            if(response !== undefined){
                var entity= response['_term'][gid];
                for(var key in entity)
                    valorizeField(key, entity[key]);
            }
            else
                unvalorizeField();
            
        }
    });
}

function valorizeField(key, entity)
{
    var $input= $('#OntologyTerm_'+key);
    if(key !== kTAG_LID && key !== kTAG_NAMESPACE){
        if($input.length > 0){
            if($.isPlainObject(entity)){
                $input.val(entity['en']);
            }else{
                $input.val(entity);
            }
        }
    }
    lockField();
};

function unvalorizeField()
{
    $('form input[type="text"][readonly], textarea[readonly], select[readonly]').each(function(){
        $(this).val('');
    });
    unlockField();
};

function lockField()
{
    $('form input[type="text"], textarea, select').each(function(){
        var $id=$(this).attr('id');
        if( $id !== 'OntologyTerm_'+kTAG_LID && $id !== 'OntologyTerm_'+kTAG_NAMESPACE)
            $(this).attr('readonly', 'readonly');
    });
    $('#OntologyTerm_select').removeAttr('disabled');
    $('#OntologyTerm_save').attr('disabled','disabled');
}

function unlockField()
{
    $('form input, textarea, select').each(function(){
        $(this).removeAttr('readonly');
    });
    $('#OntologyTerm_save').removeAttr('disabled');
    $('#OntologyTerm_select').attr('disabled','disabled');
}