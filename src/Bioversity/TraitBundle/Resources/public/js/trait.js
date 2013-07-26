
$(document).ready(function(){
    autocomplateForm();
    bindButtons();
    bindTrialButton();
    //bindTrialDetail();
    //loadMap('39.1667', '30.89136');
});

function bindTrialDetail() {
    $(document).on("click", ".trial_detail", function(){
        var jsonString = JSON.stringify($(this).attr('value'));
        var trials= 'no trails founds';
        
        $('#TrialModal #loader').fadeIn('slow');
        $('#TrialModal div#embedded_content_trial_detail').html('');
        
        $.ajax({
            type: "POST",
            url: dev_stage+'/modal-trial-detail',
            data: {unit : jsonString},
            dataType: "html",
            success: function( data ) {
                $('#TrialModal #loader').fadeOut();
                $('#TrialModal div#embedded_content_trial_detail').html(data);
                $('#TrialModal div#embedded_content_trial_detail').fadeIn('slow');
            }
        });
    });
}

function bindTrialButton()
{
    $(document).on("click", ".show_trial", function(){
        var jsonString = JSON.stringify($(this).attr('value'));
        var trials= 'no trails founds';
        
        $('#TrialModal .modal-body div#embedded_content_trial_list').html('');
        $('#TrialModal .modal-body div#embedded_content_trial_detail').html('');
        $('#TrialModal #loader').fadeIn('slow');
        
        $.ajax({
            type: "POST",
            url: dev_stage+'/modal-trial',
            data: {unit : jsonString},
            dataType: "html",
            success: function( data ) {
                $('#TrialModal #loader').fadeOut();
                $('#TrialModal .modal-body div#embedded_content_trial_list').html(data);
                $('#TrialModal .modal-body div#embedded_content_trial_list').fadeIn('slow');
            }
        });
    });    
}

function setPage(url)
{
    sendLink(url);
    //$('#form_fields_page').val(page);
    //$('#form_fields').submit();
}

//function setPage(page)
//{
//    $('#form_fields_page').val(page);
//    $('#form_fields').submit();
//}

function sendLink(link)
{
    if (link != '') {
        $('#units_list').html('');
        $.ajax({
            type:       "POST",
            url:        dev_stage+'/trait/json/find/trait',
            dataType:   "html",
            data:       {'url':link},
            success: function( data ) {
                $('#units_list').append(data);
            }
        });     
    }
}

function bindButtons()
{
    $('#searchTrait').submit(function(event){
        event.preventDefault();
        getFieldsForm($("#TraitSearch_trait").val());
    });
    
    
    $('#form_fields').submit(function(event){
        event.preventDefault();
        
        $('#summary').html('');
        $('#units_list').html('');
        $('#form_fields_search').addClass('working');
        disableButton('form_fields_search');
        $.ajax({
            type:       "POST",
            url:        dev_stage+'/trait/json/find/summary/trait',
            dataType:   "html",
            data:       $(this).serializeArray(),
            success: function( data ) {
                $('#form_fields_search').removeClass('working');
                enableButton('form_fields_search');
                $('#summary').append(data);
            }
        }).fail(function(){
            $('#form_fields_search').removeClass('working');
            enableButton('form_fields_search');
        });
    });
    
    
    $(document).on("click", "#summary a", function(event){
        event.preventDefault();
        
        sendLink($(this).attr('href'));
    });
    
    
    //$('#form_fields').submit(function(event){
    //    event.preventDefault();
    //    
    //    $('#units_list').html('');
    //    $('#form_fields_search').addClass('working');
    //    disableButton('form_fields_search');
    //    $.ajax({
    //        type:       "POST",
    //        url:        dev_stage+'/trait/json/find/trait',
    //        dataType:   "html",
    //        data:       $(this).serializeArray(),
    //        success: function( data ) {
    //            $('#form_fields_search').removeClass('working');
    //            enableButton('form_fields_search');
    //            $('#units_list').append(data);
    //        }
    //    }).fail(function(){
    //        $('#form_fields_search').removeClass('working');
    //        enableButton('form_fields_search');
    //    });
    //});
    
    
    $(document).on("click", "#units_list button", function(){        
        if ($(this).hasClass('opener')) {
            var html_id= $(this).attr('id');
            var html_id_split= html_id.split('_');
            var id= html_id_split[1];
            var action= html_id_split[0];
            
            $(this).addClass('hidden');
        
            if(action == 'show'){
                $('#hide_'+id).removeClass('hidden');
                $('#detail_'+id).height(0);
                $('#detail_'+id).removeClass('hidden');
                $('#detail_'+id).fadeIn('slow');
            }else{
                $('#show_'+id).removeClass('hidden');
                $('#detail_'+id).fadeOut('slow');
                $('#detail_'+id).addClass('hidden');
            }   
        }else if ($(this).hasClass('map_button')) {
            $('#MapModal #loader').fadeIn('slow');
            $('#MapModal .modal-body div#embedded_content').html('');
            $('#MapModal .modal-body div#embedded_content').html('<object height="400px" width="100%" data="'+dev_stage+'/modal-trial/get-map/'+$(this).attr('value')+'"><param value="aaa.pdf" name="src"/><param value="transparent" name="wmode"/></object>');
            $('#MapModal .modal-body div#embedded_content').fadeIn('slow');
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
                $("#TraitSearch_trait").removeClass('working');
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
    
    var jsonString = JSON.stringify(value);
    
    $.ajax({
        type: "POST",
        url: dev_stage+"/trait/json/get/tag/fields",
        data: {word : jsonString},
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