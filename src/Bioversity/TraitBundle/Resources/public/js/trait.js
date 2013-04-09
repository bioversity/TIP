
$(document).ready(function(){
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
    
    
    $('#searchTrait').submit(function(event){
        event.preventDefault();
        getFieldsForm($("#TraitSearch_trait").val());
    });

});
    
    
function getFieldsForm(value)
{
    $.ajax({
        url: dev_stage+"/trait/json/get/tag/fields/"+value,
        dataType: "html",
        success: function( data ) {
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