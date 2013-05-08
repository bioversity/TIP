var kTAG_NID= '_id';
var kTAG_LID= '1';
var kTAG_GID= '2';
var kTAG_UID= '3';
var kTAG_PID= '4';
var kTAG_SYNONYMS= '5';
var kTAG_DOMAIN= '6';
var kTAG_AUTHORITY= '7';
var kTAG_CATEGORY= '8';
var kTAG_KIND= '9';
var kTAG_TYPE= '10';
var kTAG_CLASS= '11';
var kTAG_NAMESPACE= '12';
var kTAG_INPUT= '13';
var kTAG_PATTERN= '14';
var kTAG_LENGTH= '15';
var kTAG_MIN_VAL= '16';
var kTAG_MAX_VAL= '17';
var kTAG_NAME= '18';
var kTAG_LABEL= '19';
var kTAG_DEFINITION= '20';
var kTAG_DESCRIPTION= '21';
var kTAG_NOTES= '22';
var kTAG_EXAMPLES= '23';
var kTAG_AUTHORS= '24';
var kTAG_ACKNOWLEDGMENTS= '25';
var kTAG_BIBLIOGRAPHY= '26';
var kTAG_VERSION= '27';
var kTAG_UNIT= '28';
var kTAG_TERM= '29';
var kTAG_NODE= '30';
var kTAG_TAG= '31';
var kTAG_SUBJECT= '32';
var kTAG_OBJECT= '33';
var kTAG_PREDICATE= '34';
var kTAG_PATH= '35';
var kTAG_NAMESPACE_REFS= '36';
var kTAG_DATAPOINT_REFS= '37';
var kTAG_NODES= '38';
var kTAG_EDGES= '39';
var kTAG_TAGS= '40';
var kTAG_OFFSETS= '41';
var kTAG_FEATURES= '42';
var kTAG_METHODS= '43';
var kTAG_SCALES= '44';
var kTAG_USER_NAME= '45';
var kTAG_USER_CODE= '46';
var kTAG_USER_PASS= '47';
var kTAG_USER_MAIL= '48';
var kTAG_USER_ROLE= '49';
var kTAG_USER_PROFILE= '50';
var kTAG_USER_MANAGER= '51';
var kTAG_USER_DOMAIN= '52';
var kTAG_USER_INSTITUTE_CODE= '53';
var kTAG_USER_INSTITUTE_NAME= '54';
var kTAG_USER_INSTITUTE_ADDRESS= '55';
var kTAG_USER_INSTITUTE_COUNTRY= '56';
var kTAG_USER_SOCIAL_NETWORK= '57';

$(document).ready(function(){
    autocomplateForm();
    bindButtons();
    bindTrailButton();
});

function bindTrailButton()
{
    console.log('start');
    $(document).on("click", ".show_trail", function(){
        console.log('click');
        $('#TrialModal #loader').fadeIn('slow');
        $('#TrialModal .modal-body div#embedded_content').html('');
        $('#TrialModal .modal-body div#embedded_content').html('<object height="500px" width="700px" data="'+dev_stage+'/modal-trail/'+$(this).attr('value')+'"><param value="aaa.pdf" name="src"/><param value="transparent" name="wmode"/></object>');
        $('#TrialModal .modal-body div#embedded_content').fadeIn('slow');
    });    
}

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