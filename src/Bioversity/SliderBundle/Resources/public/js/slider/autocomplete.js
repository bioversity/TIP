var actualForm;

function startAutocomplete(form)
{
    setActualForm(form);
    $("#"+form+"_"+kTAG_LID).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/ontology/json/find/lid/"+getUrlParams(request.term, getNamespace(form)),
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
     
    $( "#"+form+"_"+kTAG_NAMESPACE ).autocomplete({
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
                    //if(ui.item)
                        //getTermDetail(ui.item.value, ui.item.label);
                },
    });
     
    var subvalue;
    $( "#"+form+"_"+kTAG_LABEL ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/ontology/json/find/label/"+request.term,
                dataType: "json",
                success: function( data ) {
                    if(data == ''){
                        unvalorizeField()
                    }else{
                        response( $.map( data, function( item ) {
                            subvalue= item.GID;
                            return {
                                label: item.LABEL,
                                value: item.LABEL,
                            }
                        }));
                    }
                }
            });
        },
        minLength: 1,
        select: function( event, ui ) {
                    if(ui.item){
                        getTermDetail(subvalue, subvalue);
                    }
                },
    });
     
}

function createAutocompleter(fieldBinded, form)
{
    setActualForm(form);
    var namespace=  getNamespace(form);
    
    fieldBinded.autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/ontology/json/find/lid/"+getUrlParams(request.term, namespace),
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
}

function setActualForm(form){
    actualForm= form;
}

function getNamespace(htmlNode)
{
    return $( "#"+htmlNode+"_"+kTAG_NAMESPACE ).val();
}

function getUrlParams(lid, namespace)
{
    if(namespace == undefined || namespace == null || namespace == '')
        params= lid;
    else
        params= lid+'/'+namespace;
    
    return params;
}

function getTermDetail(term, gid)
{
    $.ajax({
        url: dev_stage+"/ontology/json/get/term/"+getUrlParams(gid),
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
    var $input= $('#'+actualForm+'_'+key);
    //if(key !== kTAG_LID && key !== kTAG_NAMESPACE){
        if($input.length > 0){
            if($.isPlainObject(entity)){
                $input.val(entity['en']);
            }else{
                $input.val(entity);
            }
        }
    //}
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
        if( $id !== ''+actualForm+'_'+kTAG_LID && $id !== ''+actualForm+'_'+kTAG_NAMESPACE)
            $(this).attr('readonly', 'readonly');
    });
    
    $('#'+actualForm+'_select').removeAttr('disabled');
    $('#'+actualForm+'_save').attr('disabled','disabled');
}

function unlockField()
{
    $('form input, textarea, select').each(function(){
        $(this).removeAttr('readonly');
    });
    $('#'+actualForm+'_save').removeAttr('disabled');
    $('#'+actualForm+'_select').attr('disabled','disabled');
}