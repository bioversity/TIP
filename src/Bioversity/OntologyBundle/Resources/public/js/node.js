$(document).ready(function(){
    $('#create_namespace').attr('href', '#NamespaceModal');
    $('#create_namespace').attr('data-toggle', 'modal');
    $('#form_term').attr('action',dev_stage+'/ontology/json/term/new');    
    startAutocomplete();
    bindFormButton();

});

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
                if(data['term'] !== '')
                    startNodeSelection(data['term']);
            }
        });
    });
    $('#OntologyTerm_select').click(function(event){
        event.preventDefault();
        var $form= $('form[id="form_term"]');
        startNodeSelection();
    });
}

function startNodeSelection(term)
{
    $('#form_term').append('<object id="node_form_container" data="'+dev_stage+'/ontology/node/new"></object>');
}

function startAutocomplete()
{
    $( "#OntologyTerm_"+kTAG_LID ).autocomplete({
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
    
    $( "#OntologyTerm_"+kTAG_NAMESPACE ).autocomplete({
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
    $namespace= $( "#OntologyTerm_"+kTAG_NAMESPACE ).val();
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