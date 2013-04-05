
$(document).ready(function(){
    $("#TraitSearch_trait").autocomplete({
        search  : function(){$(this).addClass('working');},
        open    : function(){$(this).removeClass('working');},
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/serverconnection/json/find/trait/"+request.term,
                dataType: "json",
                success: function( data ) {
                    if(data == ''){
                        //unvalorizeField()
                    }else{
                        response( $.map( data, function( item ) {
                            return {
                                label: item.LABEL,
                                value: item.GID
                            }
                        }));
                    }
                }
            });
        },
        minLength: 1
    });
    $("#BestFilterSearch_species").autocomplete({
        search  : function(){$(this).addClass('working');},
        open    : function(){$(this).removeClass('working');},
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/serverconnection/json/find/taxo/"+request.term+'/'+$("#BestFilterSearch_trait").val(),
                dataType: "json",
                success: function( data ) {
                    if(data == ''){
                        //unvalorizeField()
                    }else{
                        response( $.map( data, function( item ) {
                            return {
                                label: item.LABEL,
                                value: item.GID
                            }
                        }));
                    }
                }
            });
        },
        minLength: 1
    });
});