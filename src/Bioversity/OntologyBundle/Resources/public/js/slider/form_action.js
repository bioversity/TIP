/**
 * Form action
 *
 */

function showFormAction(/*destination*/)
{
    $(/*'#'+destination+*/' .'+$slider_destination_form_action).fadeIn('slow');
    startProcess();
}

function startProcess()
{
    $('.'+$slider_destination_form_action+' a').click(function(){
        disableSlider();
        var relation= ($(this).attr('id') == 'relation_left')? kTAG_OBJECT : kTAG_SUBJECT;
        
        createPredicate(relation);
    });
}

function disableSlider(){
    $('#disable_slider').css('height',$('#slider_content').height()+'px');
    $('#disable_slider').css('width',$('#slider_content').width()+'px');
    $('#disable_slider').fadeIn('slow');
}

function createPredicate(relation)
{
    $('#form_container').html('');
    $.ajax({
        url:        dev_stage+'/ontology/partial/predicate/new/'+selected_node_code+'/'+relation,
        dataType:   "html",
        success: function( data ) {
           $('#form_container').append(data);
        }
     }).done( function(){
        startnamespaceConfiguration();
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
        startnamespaceConfiguration();
        startAutocomplete('OntologyTerm');
        startTooltip();
        bindTermFormAction();
        goToByScroll('form_term');
        $('#disable_slider').css('height',($('#disable_slider').height()+$('#form_predicate').height())+'px');
     });
}

function createNode()
{
    $('#form_container').html('');
    $.ajax({
        url:        dev_stage+'/ontology/partial/term/new/'+selected_node_code+'/'+relation,
        dataType:   "html",
        success: function( data ) {
           $('#form_container').append(data);
        }
     }).done( function(){
        $('#create_namespace').attr('href', '#NamespaceModal');
        $('#create_namespace').attr('data-toggle', 'modal');
        $('#form_term').attr('action',dev_stage+'/ontology/json/term/new');
        startAutocomplete('OntologyNode');
        goToByScroll('form_node');
     });
}

function startnamespaceConfiguration()
{
    $('#create_namespace').attr('href', '#NamespaceModal');
    $('#create_namespace').attr('data-toggle', 'modal');
    $('#form_term').attr('action',dev_stage+'/ontology/json/term/new');
    bindnamespaceCreation();
}