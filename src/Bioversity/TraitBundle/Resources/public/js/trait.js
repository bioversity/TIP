
$(document).ready(function(){
    autocomplateForm();
    bindButtons();
});

function setPage(page)
{
    $('#form_fields_page').val(page);
    $('#form_fields').submit();
}

function bindButtons()
{
    $('#searchTrait').submit(function(event){
        event.preventDefault();
        getFieldsForm($("#TraitSearch_trait").val());
    });
    
    
    $('#form_fields').submit(function(event){
        event.preventDefault();
        
        $('#units_list').html('');
        $('#form_fields_search').addClass('working');
        disableButton('form_fields_search');
        $.ajax({
            type:       "POST",
            url:        dev_stage+'/trait/json/find/trait',
            dataType:   "html",
            data:       $(this).serializeArray(),
            success: function( data ) {
                $('#form_fields_search').removeClass('working');
                enableButton('form_fields_search');
                $('#units_list').append(data);
            }
        }).fail(function(){
            $('#form_fields_search').removeClass('working');
            enableButton('form_fields_search');
        });
    });
    
    
    $(document).on("click", "#units_list button", function(){
        var html_id= $(this).attr('id');
        var html_id_split= html_id.split('_');
        var id= html_id_split[1];
        var action= html_id_split[0];
        
        $(this).addClass('hidden');
        if(action == 'show'){
            $('#hide_'+id).removeClass('hidden');
            $('#detail_'+id).removeClass('hidden');
        }else{
            $('#show_'+id).removeClass('hidden');
            $('#detail_'+id).addClass('hidden');
        }
    });
}

function autocomplateForm()
{    
    $("#TraitSearch_trait").autocomplete({
        search  : function(){$(this).addClass('working'); disableButton('searchTrait_search');},
        open    : function(){$(this).removeClass('working'); enableButton('searchTrait_search');},
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/serverconnection/json/find/tag/label/"+request.term,
                dataType: "json",
                success: function( data ) {
                    if(data == ''){
                        //unvalorizeField()
                    }else{
                        response( $.map( data, function( item ) {
                            return {
                                label: item,
                                value: item
                            }
                        }));
                    }
                }
            }).fail(function(){
                $(this).removeClass('working');
                enableButton('searchTrait_search');
            });
        },
        minLength: 1,
        select: function( event, ui ) {
                    if(ui.item)
                        getFieldsForm(ui.item.value);
                },
    });
}

function disableButton(button)
{
    $('#'+button).attr('disabled','disabled');
}

function enableButton(button)
{
    $('#'+button).removeAttr('disabled');
}

function getFieldsForm(value)
{
    
    $('#searchTrait_search').addClass('working');
    disableButton('searchTrait_search');
    
    $.ajax({
        url: dev_stage+"/trait/json/get/tag/fields/"+value,
        dataType: "html",
        success: function( data ) {
            $('#searchTrait_search').removeClass('working');
            enableButton('searchTrait_search');
            $('#form_fields_container').append(data);
            $('#form_fields').fadeIn('slow');
        }
    }).fail(function(){
        $('#searchTrait_search').removeClass('working');
        enableButton('searchTrait_search');
    });
}

function enableField(checkbox, field_id)
{
    var $child= $(checkbox).parent().find(':input');
    
    if($(checkbox).is(':checked')){
        $child.each(function(){
            if($(this).attr('id') != $(checkbox).attr('id'))
                $(this).removeAttr('disabled');
        });
    }
    else{
        $child.each(function(){
            if($(this).attr('id') != $(checkbox).attr('id')){
                $(this).val('');
                $(this).attr('disabled','disabled');
            }
        });
    }
}

function deleteFields(button)
{
    $(button).parents('blockquote').remove();

    //console.log($('#form_fields :input').lenght);
    //if($('#form_fields :input').lenght == undefined)
    //    $('#form_fields .form-actions').remove();
}