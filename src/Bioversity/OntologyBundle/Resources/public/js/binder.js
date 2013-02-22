function bindTermFormAction(){
    bindTermSave();
    bindTermSelection();
}

function bindPredicateFormAction(){
    bindPredicateSave(createTerm);
    bindPredicateSelection(createTerm);
}

function bindTermSave(callback)
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
                    callback(data['term'][':WS:RESPONSE']['_ids'][0]);
                }
            }
        });
    });
}

function bindTermSelection(callback)
{
    $('#OntologyTerm_select').click(function(event){
        event.preventDefault();
        
        var $namespace= $('input[name="OntologyTerm['+kTAG_NAMESPACE+']"]').val();
        var $lid      = $('input[name="OntologyTerm['+kTAG_LID+']"]').val();
        callback($namespace+':'+$lid);
    });    
}

function bindPredicateSave(callback)
{
    $('#OntologyPredicate_save').click(function(event){
        event.preventDefault();
        var $form= $('form[id="form_term"]');
        $.ajax({
            type:       "POST",
            url:        $form.attr('action'),
            dataType:   "json",
            data:       $form.serializeArray(),
            success: function( data ) {
                if(data['term'] !== ''){
                    callback(data['term'][':WS:RESPONSE']['_ids'][0]);
                }
            }
        });
    });
}

function bindPredicateSelection(callback)
{
    $('#OntologyPredicate_select').click(function(event){
        event.preventDefault();
        
        var $namespace= $('input[name="OntologyPredicate['+kTAG_NAMESPACE+']"]').val();
        var $lid      = $('input[name="OntologyPredicate['+kTAG_LID+']"]').val();
        callback();
    });    
}

function bindnamespaceCreation()
{
    $('#create_namespace').click(function(event){
        event.preventDefault();
        $('#NamespaceModal .modal-body div#embedded_content').html('');
        $('#NamespaceModal .modal-body div#embedded_content').html('<object height="400px" width="100%" data="'+dev_stage+'/ontology/modal/namespace/new'+'"><param value="aaa.pdf" name="src"/><param value="transparent" name="wmode"/></object>');
        $('#NamespaceModal .modal-body div#embedded_content').fadeIn('slow');
    });
}

function bindSliderButton()
{ 
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