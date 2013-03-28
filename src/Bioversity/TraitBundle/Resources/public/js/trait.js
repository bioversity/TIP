
$(document).ready(function(){
    $("#TraitSearch_trait").autocomplete({
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
});