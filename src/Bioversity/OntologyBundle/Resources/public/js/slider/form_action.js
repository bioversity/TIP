/**
 * Form action
 *
 */

function showFormAction(/*destination*/)
{
    $('.'+slider_destination_form_action).fadeIn('slow');
    bindStartProcessButton();
}

function startProcess()
{
    $('.'+slider_destination_form_action+' a').click(function(){
        disableSlider();
        
        setActualAction('newrelation');
        var relation= ($(this).attr('id') == 'relation_left')? kTAG_OBJECT : kTAG_SUBJECT;
        
        createPredicate(relation);
    });
}

function createPredicate(relation)
{
    $('#form_container').html('');
    $.ajax({
        url:        dev_stage+'/ontology/partial/predicate/new',
        dataType:   "html",
        success: function( data ) {
           $('#form_container').append(data);
        }
     }).done( function(){
        startnamespaceConfiguration('form_predicate');
        startAutocomplete('OntologyPredicate');
        startTooltip();
        bindPredicateFormAction(); 
        goToByScroll('form_predicate');
     });  
}

function createTerm()
{
    $.ajax({
        url:        dev_stage+'/ontology/partial/term/new',
        dataType:   "html",
        success: function( data ) {
           $('#form_container').append(data);
        }
     }).done( function(){
        startnamespaceConfiguration('form_term');
        startAutocomplete('OntologyTerm');
        startTooltip();
        bindTermFormAction();
        goToByScroll('form_term');
        disableForm('form_predicate');
     });
}

function createNode(term)
{
    $.ajax({
        url:        dev_stage+'/ontology/partial/node/new/'+term,
        dataType:   "html",
        success: function( data ) {
            $('#form_container').append(data);
        }
     }).done( function(){
        startTooltip();
        goToByScroll('form_node');
        disableForm('form_term');
        buildTree();
        bindFormCheckbox();
        bindSliderButton();
        bindExistingNode();
        bindNodeFormField();
        bindNodeFormAction(term);
     });
}

function deletePredicate()
{
    enableForm('disable_slider');
    $('#form_predicate').remove();
    //goToByScroll('slider_content');
    goToByScroll('slider');
}

function deleteTerm()
{
    enableForm('form_term');
    $('#form_term').remove();
    goToByScroll('form_predicate');
}

function deleteNode()
{
    enableForm('form_term');
    $('#form_node').remove();
    goToByScroll('form_term');
}

function startnamespaceConfiguration(form)
{
    $('#'+form+' .create_namespace').attr('href', '#NamespaceModal');
    $('#'+form+' .create_namespace').attr('data-toggle', 'modal');
    //$('#form_term').attr('action',dev_stage+'/ontology/json/term/new');
    bindnamespaceCreation(form);
}

function attachNode(data)
{
    enableSlider();
    startNav(ontology_selected_node_id);
    deleteNode();
    deleteTerm();
    deletePredicate();
    goToByScroll('slider');
}

function saveRelation(selected_node)
{
    var params= buildUrl(selected_node);
        
    $.ajax({
        type:       "POST",
        url:        dev_stage+'/ontology/json/relation/new/'+params,
        dataType:   "json",
        success: function( data ) {
            if(data['term'] !== ''){
                attachNode(data);
            }
        }
    });
}

function saveRoot(selected_node)
{
    deleteNode();
    deleteTerm();
    deletePredicate();
    goToByScroll('slider_content');
    getRootNodeList();
}

function buildUrl(ontology_selected_node_nid)
{
    if(ontology_selected_node_relation == kTAG_SUBJECT)
        return ontology_selected_node_nid+'/'+ontology_selected_node_predicate+'/'+ontology_selected_node_id;
    else
        return ontology_selected_node_id+'/'+ontology_selected_node_predicate+'/'+ontology_selected_node_nid;
}