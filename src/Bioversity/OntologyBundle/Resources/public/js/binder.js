function bindRootNode()
{
  $(document).on("click", "#entry_point a", function(){ 
    if(show_action == false){
      showFormAction();
      show_action= true;
    }
  });
}

function bindFoundNode()
{
  $(document).on("click", "#node_found_list .node_result", function(){
    if(show_action == false){
      showFormAction();
      show_action= true;
    }
  });
}

function bindPredicateFormAction()
{
    bindPredicateSave(createTerm);
    bindPredicateSelection(createTerm);
    bindPredicateClear();
    bindPredicateCancel();
}

function bindNodeFormAction(term)
{
    var action = (form_action=='newroot')? saveRoot : saveRelation;
    bindNodeSave(action, term);
    bindNodeSelection(action);
    bindNodeClear();
    bindNodeCancel();
}

function bindTermFormAction()
{
    bindTermSave(createNode);
    bindTermSelection(createNode);
    bindTermClear();
    bindTermCancel();
}

//------------------------------------
//--------START BUTTON----------------
//------------------------------------
function bindStartProcessButton()
{
    $('.'+slider_destination_form_action+' a').click(function(){
        ontology_selected_node_id= selected_node_id; //this variable is defined in the node.class.js file in the SliderBundle
        ontology_selected_node_relation= ($(this).attr('id') == 'relation_left')? kTAG_OBJECT : kTAG_SUBJECT;
        disableSlider();
        createPredicate();
    });
}

//------------------------------------
//--------PREDICATE BUTTON------------
//------------------------------------
function bindPredicateCancel()
{
    $('#OntologyPredicate_cancel').click(function(event){
        deletePredicate();
    });
}

function bindPredicateClear()
{
    $('#OntologyPredicate_clear').click(function(event){
        setActualForm('OntologyPredicate');
        unvalorizeAllField();
    });
}

function bindPredicateSave(callback)
{
    $('#OntologyPredicate_save').click(function(event){
        event.preventDefault();
        var $form= $('form[id="form_predicate"]');
        $.ajax({
            type:       "POST",
            url:        dev_stage+'/ontology/json/predicate/new',
            dataType:   "json",
            data:       $form.serializeArray(),
            success: function( data ) {
                if(data['term'] !== ''){
                    //callback(data['term'][':WS:RESPONSE']['_ids'][0]);
                    var response= data['term'][':WS:RESPONSE'];
                    var term_id= response['_ids'];
                    var term_attr= data['term'][':WS:RESPONSE']['_term'];
                    ontology_selected_node_predicate= term_attr[term_id[0]][kTAG_GID];
                    callback();
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
        
        if($namespace)
            ontology_selected_node_predicate= $namespace+':'+$lid;
        else
            ontology_selected_node_predicate= $lid;
            
        callback();
    });    
}

//------------------------------------
//--------TERM BUTTON-----------------
//------------------------------------
function bindTermCancel()
{
    $('#OntologyTerm_cancel').click(function(event){
        deleteTerm();
    });
}

function bindTermClear()
{
    $('#OntologyTerm_clear').click(function(event){
        setActualForm('OntologyTerm');
        unvalorizeAllField();
    });
}

function bindTermSave(callback)
{
    $('#OntologyTerm_save').click(function(event){
        event.preventDefault();
        var $form= $('form[id="form_term"]');
        $.ajax({
            type:       "POST",
            url:        dev_stage+'/ontology/json/term/new',
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
        if($namespace)
            callback($namespace+':'+$lid);
        else
            callback($lid);
    });    
}

function bindnamespaceCreation(form)
{
    $('#'+form+' .create_namespace').click(function(event){
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
    });    
}

//------------------------------------
//--------NODE BUTTON-----------------
//------------------------------------
function bindNodeSave(callback, term)
{
    $('#OntologyNode_save').click(function(event){
        event.preventDefault();
        var $form= $('form[id="form_node"]');
        $.ajax({
            type:       "POST",
            url:        dev_stage+'/ontology/json/node/new/'+term,
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

function bindNodeSelection(callback)
{
    $('#OntologyNode_select').click(function(event){
        event.preventDefault();
        
        var $selected_node= $('#form_node #OntologyNodeList input[type="radio"]:checked').val();
        callback($selected_node);
    });    
}

function bindNodeCancel()
{
    $('#OntologyNode_cancel').click(function(event){
        deleteNode();
    });
}

function bindNodeClear()
{
    $('#OntologyNode_clear').click(function(event){
        setActualForm('OntologyNode');
        unvalorizeAllField();
    });
}


function bindExistingNode()
{
    $('#form_node #OntologyNodeList input[type="radio"]').click(function(){
        if($(this).is(':checked')){
            $('#OntologyNode_select').removeAttr('disabled');
            $('#OntologyNode_save').attr('disabled', 'disabled');
            $('#form_node input[type="text"], select, textarea').val('');
            $('#form_node .checkbox_option input').attr('checked',false);
            //$('#form_node input, select, textarea').attr('disabled', 'disabled');
        }
    });
}

function bindNodeFormField()
{
    $('#form_node input[type="text"],input[type="checkbox"], textarea, select').change(function(){
        if($(this).val() !== ''){
            $('#OntologyNode_save').removeAttr('disabled');
            $('#OntologyNode_select').attr('disabled', 'disabled');
            $('#form_node #OntologyNodeList input[type="radio"]:checked').attr('checked', false);
        }
    });
}
