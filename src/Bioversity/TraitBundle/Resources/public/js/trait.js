
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
        $.ajax({
            type:       "POST",
            url:        dev_stage+'/trait/json/find/trait',
            dataType:   "html",
            data:       $(this).serializeArray(),
            success: function( data ) {
                $('#form_fields_search').removeClass('working');
                $('#units_list').append(data);
            }
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
        search  : function(){$(this).addClass('working');},
        open    : function(){$(this).removeClass('working');},
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
            });
        },
        minLength: 1,
        select: function( event, ui ) {
                    if(ui.item)
                        getFieldsForm(ui.item.value);
                },
    });
}
function getFieldsForm(value)
{
    
    $('#searchTrait_search').addClass('working');
    $.ajax({
        url: dev_stage+"/trait/json/get/tag/fields/"+value,
        dataType: "html",
        success: function( data ) {
            $('#searchTrait_search').removeClass('working');
            $('#form_fields_container').append(data);
            $('#form_fields').fadeIn('slow');
        }
    });
}





//$("#BestFilterSearch_species").autocomplete({
//    search  : function(){$(this).addClass('working');},
//    open    : function(){$(this).removeClass('working');},
//    source: function( request, response ) {
//        $.ajax({
//            url: dev_stage+"/serverconnection/json/find/taxo/"+request.term+'/'+$("#BestFilterSearch_trait").val(),
//            dataType: "json",
//            success: function( data ) {
//                if(data == ''){
//                    //unvalorizeField()
//                }else{
//                    response( $.map( data, function( item ) {
//                        return {
//                            label: item.LABEL,
//                            value: item.GID
//                        }
//                    }));
//                }
//            }
//        });
//    },
//    minLength: 1
//});