var kTAG_NID='_id';
var kTAG_LID='1';
var kTAG_GID='2';
var kTAG_UID='3';
var kTAG_PID='4';
var kTAG_SYNONYMS='5';
var kTAG_DOMAIN='6';
var kTAG_CATEGORY='7';
var kTAG_KIND='8';
var kTAG_TYPE='9';
var kTAG_CLASS='10';
var kTAG_NAMESPACE='11';
var kTAG_INPUT='12';
var kTAG_PATTERN='13';
var kTAG_LENGTH='14';
var kTAG_MIN_VAL='15';
var kTAG_MAX_VAL='16';
var kTAG_NAME='17';
var kTAG_LABEL='18';
var kTAG_DEFINITION='19';
var kTAG_DESCRIPTION='20';
var kTAG_NOTES='21';
var kTAG_EXAMPLES='22';
var kTAG_AUTHORS='23';
var kTAG_ACKNOWLEDGMENTS='24';
var kTAG_BIBLIOGRAPHY='25';
var kTAG_VERSION='26';
var kTAG_TERM='27';
var kTAG_NODE='28';
var kTAG_TAG='29';
var kTAG_SUBJECT='30';
var kTAG_OBJECT='31';
var kTAG_PREDICATE='32';
var kTAG_PATH='33';
var kTAG_NAMESPACE_REFS='34';
var kTAG_DATAPOINT_REFS='35';
var kTAG_NODES='36';
var kTAG_EDGES='37';
var kTAG_TAGS='38';
var kTAG_FEATURES='39';
var kTAG_METHODS='40';
var kTAG_SCALES='41';
var kTAG_USER_NAME='42';
var kTAG_USER_CODE='43';
var kTAG_USER_PASS='44';
var kTAG_USER_MAIL='45';
var kTAG_USER_ROLE='46';
var kTAG_USER_PROFILE='47';
var kTAG_USER_MANAGER='48';
var kTAG_USER_DOMAIN='49';
var kTAG_USER_INSTITUTE_CODE='50';
var kTAG_USER_INSTITUTE_NAME='51';
var kTAG_USER_INSTITUTE_ADDRESS='52';
var kTAG_USER_INSTITUTE_COUNTRY='53';
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
    bindNodeSave(saveRelation, term);
    bindNodeSelection(saveRelation);
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
    $('.'+$slider_destination_form_action+' a').click(function(){
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

/**
 *	Global plugin setup file for node creation.
 *
 *	This file set the global var for the plugin
 *	You can customize the slider changing the html class name of the single elment
 *
 *	@package	ontology slider
 *
 *	@author		Antonino Luca Carella <antonio.carella@gmail.com>
 *	@version	1.00
 */

var show_action= false;
var $slider_destination_form_action= 'action_form';
var ontology_selected_node_relation;
var ontology_selected_node_object;
var ontology_selected_node_subject;
var ontology_selected_node_predicate;

$(document).ready(function(){
    //hideAddNodeButton();
    //showFormAction();
    bindRootNode();
    bindFoundNode();
});
/**
 * Form action
 *
 */

function showFormAction(/*destination*/)
{
    $('.'+$slider_destination_form_action).fadeIn('slow');
    bindStartProcessButton();
}

function startProcess()
{
    $('.'+$slider_destination_form_action+' a').click(function(){
        disableSlider();
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

function saveRelation($selected_node)
{
    var params= buildUrl($selected_node);
        
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

function buildUrl(ontology_selected_node_nid)
{
    if(ontology_selected_node_relation == kTAG_SUBJECT)
        return ontology_selected_node_nid+'/'+ontology_selected_node_predicate+'/'+ontology_selected_node_id;
    else
        return ontology_selected_node_id+'/'+ontology_selected_node_predicate+'/'+ontology_selected_node_nid;
}
var actualForm;

function startAutocomplete(form)
{
    setActualForm(form);
    $("#"+form+"_"+kTAG_LID).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/serverconnection/json/find/lid/"+getUrlParams(request.term, getNamespace(form)),
                dataType: "json",
                success: function( data ) {
                    if(data == ''){
                        unvalorizeField()
                    }else{
                        response( $.map( data, function( item ) {
                            return {
                                label: item.GID,
                                value: item.LID
                            }
                        }));
                    }
                }
            });
        },
        minLength: 1,
        select: function( event, ui ) {
                    if(ui.item){
                        getTermDetail(ui.item.value, ui.item.label);
                    }
                },
    });
     
    $( "#"+form+"_"+kTAG_NAMESPACE ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/serverconnection/json/find/namespace/"+request.term,
                dataType: "json",
                success: function( data ) {
                    if(data == ''){
                        unvalorizeField()
                    }else{
                        response( $.map( data, function( item ) {
                            return {
                                label: item.GID,
                                value: item.GID
                            }
                        }));
                    }
                }
            });
        },
        minLength: 1,
        select: function( event, ui ) {
                    //if(ui.item)
                        //getTermDetail(ui.item.value, ui.item.label);
                },
    });
    
    $( "#"+form+"_"+kTAG_LABEL ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/serverconnection/json/find/label/"+request.term,
                dataType: "json",
                success: function( data ) {
                    if(data == ''){
                        unvalorizeField()
                    }else{
                        response( $.map( data, function( item ) {
                            subvalue= item.GID;
                            return {
                                label: item.LABEL,
                                value: item.GID,
                            }
                        }));
                    }
                }
            });
        },
        minLength: 1,
        select: function( event, ui ) {
                    if(ui.item){
                        getTermDetail(ui.item.value, ui.item.value);
                    }
                },
    });
    
    $( "#"+form+"_"+kTAG_GID ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/serverconnection/json/find/gid/"+request.term,
                dataType: "json",
                success: function( data ) {
                    if(data == ''){
                        unvalorizeField()
                    }else{
                        response( $.map( data, function( item ) {
                            return {
                                label: item.LABEL,
                                value: item.GID,
                            }
                        }));
                    }
                }
            });
        },
        minLength: 1,
        select: function( event, ui ) {
                    if(ui.item){
                        getTermDetail(ui.item.value, ui.item.value);
                    }
                },
    });
     
}

function setActualForm(form){
    actualForm= form;
}

function getNamespace(htmlNode)
{
    return $( "#"+htmlNode+"_"+kTAG_NAMESPACE ).val();
}

function getUrlParams(lid, namespace)
{
    if(namespace == undefined || namespace == null || namespace == '')
        params= lid;
    else
        params= lid+'/'+namespace;
    
    return params;
}

function getTermDetail(term, gid)
{
    $.ajax({
        url: dev_stage+"/serverconnection/json/get/term/"+getUrlParams(gid),
        dataType: "json",
        success: function( data ) {
            var response= data[':WS:RESPONSE'];
            if(response !== undefined){
                var entity= response['_term'][gid];
                for(var key in entity)
                    valorizeField(key, entity[key]);
            }
            else
                unvalorizeField();
            
        }
    });
}

function valorizeField(key, entity)
{
    var $input= $('#'+actualForm+'_'+key);
    //if(key !== kTAG_LID && key !== kTAG_NAMESPACE){
        if($input.length > 0){
            if($.isPlainObject(entity)){
                $input.val(entity['en']);
            }else{
                $input.val(entity);
            }
        }
    //}
    if(actualForm != 'SliderSearchNode')
        lockField();
};

function unvalorizeField()
{
    $('#'+actualForm+' :input[readonly]').each(function(){
        $(this).val('');
    });
    unlockField();
};

function unvalorizeAllField()
{
    $('#'+actualForm+' :input:not(input[type=button],input[type=submit])').each(function(){
        $(this).val('');
    });
    unlockField();
};

function lockField()
{
    $('#'+actualForm+' :input').each(function(){
        var $id=$(this).attr('id');
        if( $id !== actualForm+'_'+kTAG_LID && $id !== actualForm+'_'+kTAG_NAMESPACE)
            $(this).attr('readonly', 'readonly');
    });
    
    $('#'+actualForm+'_select').removeAttr('disabled');
    $('#'+actualForm+'_save').attr('disabled','disabled');
}

function unlockField()
{
    $('#'+actualForm+' :input[readonly]').each(function(){
        $(this).removeAttr('readonly');
    });
    $('#'+actualForm+'_save').removeAttr('disabled');
    $('#'+actualForm+'_select').attr('disabled','disabled');
}
/**
 *	Global plugin setup file.
 *
 *	This file set the global var for the plugin
 *	You can customize the slider changing the html class name of the single elment
 *
 *	@package	ontology slider
 *
 *	@author		Antonino Luca Carella <antonio.carella@gmail.com>
 *	@version	1.00
 */

var slider_destination_content= 'slider';
var slider_destination_root= 'entry_point ul';
var slider_destination_right= 'node_childrens';
var slider_destination_left= 'node_parents';
var slider_destination_center= 'node_details #node_details_container_body';
var slider_destination_center_header= 'node_details #node_details_container_header';
var slider_destination_pager= 'pager';
var slider_destination_breadcrumb= 'breadcrumb';
var slider_destination_breadcrumb_history= 'breadcrumb_history';
var slider_destination_breadcrumb_history_container= 'history_container';
var slider_destination_breadcrumb_history_container_button= 'history_button';
var slider_destination_breadcrumb_ul= 'root';
var slider_destination_search_point= 'search_point';
var slider_destination_search_node_point= 'node_found';
var slider_destination_search_node_list_point= 'node_found_list';
var slider_destination_search_node_pager_point='node_found_pager';

var show_pager=false;
var slider_partials_layout;
var slider_menu_layout;
var slider_container_layout;
var slider_breadcrumb_layout;
var slider_css;
var slider_breadcrumb_history_layout;

var top_menu_layout_id= 'nav_top_button';
var bottom_menu_layout_left_id= 'nav_bottom_button_left .node_record';
var bottom_menu_layout_right_id= 'nav_bottom_button_right .node_record';
var slider_right_layout_id= 'node_button_right';
var slider_left_layout_id= 'node_button_left';
var slider_center_layout_id= 'node_details_layout';
var slider_pager_layout_id= 'node_pager_layout';
var slider_search_node_list_layout_id= 'slider_node_search_list';

var urlForRootNodes= '/get-root-nodes';
var urlForNodeDetails= '/get-node-details';
var urlForNodeRelationIN= '/get-node-relation-in';
var urlForNodeRelationOUT= '/get-node-relation-out';
var urlForSearchNodeRelationIN= '/search-node-relation-in';
var urlForSearchNodeRelationOUT= '/search-node-relation-out';
var urlForNodeRelationPagerIN= '/get-node-relation-pager-in';
var urlForNodeRelationPagerOUT= '/get-node-relation-pager-out';
var urlForNodeRelations= '/get-node-relations';

$('document').ready(function(){
  //createCss();
  //createMenu();
  //createContainer();
  //createPartial();
  //createBreadcrumb();
  //createBreadcrumbHistory();
  loadTemplates();
  startHistoryBind();
});

/**
 * this method include on the slider container all html partial
 *
 */
function loadTemplates(){
  //$('#slider_content').append(slider_css);
  //$('#slider_content').append(slider_menu_layout);
  //$('#slider_content').append(slider_breadcrumb_layout);
  //$('#slider_content').append(slider_breadcrumb_history_layout);
  //$('#slider_content').append(slider_container_layout);
  //$('#slider_content').append(slider_partials_layout);
  initSlider();
}

function initSlider()
{
  //console.log('initSlider');
  getRootNodeList();
  createSearchPoint();
  hideSlider();
}


//--------ASYNC REQUEST


/**
 * this method make the server request and manage the response
 * @param string url
 * @param string callback
 *
 * @returns Array data
 */
function ask(url, callback){
  jQuery.ajax({
      url:url
  }).done(function(data) {
    if(data === null){
      console.log('error, the request is null');
      return false;
    }
    else{
      setBasicValue(url, data);
      if(callback){
        callback();
      }
      else{
        return selected_node_data;
      }
      return false;
    }
  }).fail(function() { 
    console.log('error, the request url was not found');
    return false;
  });
}

/**
 * this method set the basic value for pager and basic node data
 * @param string url
 * @param Array data *
 */
function setBasicValue(url, data){
  var pattIN=new RegExp(urlForNodeRelationIN);
  var pattOUT=new RegExp(urlForNodeRelationOUT);
  var pattSearchIN=new RegExp(urlForSearchNodeRelationIN);
  var pattSearchOUT=new RegExp(urlForSearchNodeRelationOUT);
  var pattPagerIN= new RegExp(urlForNodeRelationPagerIN);
  var pattPagerOUT= new RegExp(urlForNodeRelationPagerOUT);
  
  json_data= $.parseJSON(data);
  selected_node_data= json_data[':WS:RESPONSE'];
  pager_node_data_limit= json_data[':WS:PAGING'][':WS:PAGE-LIMIT'];
  pager_node_data_selected= parseInt(json_data[':WS:PAGING'][':WS:PAGE-START'])+1;
  
  pager_node_data_in_count= 0;
  pager_node_data_out_count= 0;
  show_search_filter=false;
  how_pager=false;
  
  //console.log(json_data[':WS:STATUS']);
  if(pattIN.test(url) || pattSearchIN.test(url) || pattPagerIN.test(url)){
    pager_node_data_in_count= json_data[':WS:STATUS'][':WS:AFFECTED-COUNT'];
  }
  if(pattOUT.test(url) || pattSearchOUT.test(url) || pattPagerOUT.test(url)){
    pager_node_data_out_count= json_data[':WS:STATUS'][':WS:AFFECTED-COUNT'];
  }
}
/*
 * Nav bottom slider
 *
 */

var append_direction;
var position_layout;
var nav_length;
var create_new_nav_row;
var selected_nav_element= null;
var selected_nav_node_active;
var elemnt_list;


/**
 *
 *
 */
function startHistoryBind()
{
  //console.log('startHistoryBind');
  var button= $('#'+slider_destination_breadcrumb_history_container_button);
  button.click(function(){
    if(button.attr('class')=='dontshow'){
      $('#'+slider_destination_breadcrumb_history).slideDown('slow');
      button.val('Hide History');
      button.attr('class','show');
      button.addClass('nav_open');
    }else{
      $('#'+slider_destination_breadcrumb_history).slideUp('slow');
      button.val('Show History');
      button.attr('class','dontshow');
      button.removeClass('nav_open');
    }
  });
}

/**
 * Start the process
 */
function buildNav()
{
  //console.log('buildNav');
  createNavButton();
}

/**
 * check if the node is in the history
 * @param int node_id
 */
function startNav(node_id)
{
  //console.log('startNav');
  resetNavActiveElement();
  cloneNavToHistory();
  $('#'+slider_destination_breadcrumb+' ul#'+'nav_story_'+slider_destination_breadcrumb_ul+' li').remove();
  startBind(node_id, '');
}

/**
 * set the append direction ex:left or right
 * @param string direction
 */
function setAppendDirection(direction)
{
  //console.log('setAppendDirection');
  append_direction= direction;
}

/**
 * set the partial layout. It use the css class name
 * @param string layout
 */
function setPositionLayout(layout)
{
  //console.log('setPositionLayout');
  position_layout= layout;
}

function createNavButton()
{
  //console.log('createNavButton');
  if(append_direction == 'left')
    setPositionLayout(bottom_menu_layout_left_id);
  else
    setPositionLayout(bottom_menu_layout_right_id);
  
  resetNavActiveElement();
  checkNavElement();
}

function resetNavActiveElement()
{
  //console.log('resetNavActiveElement');
  selected_nav_node_active= $('#'+slider_destination_breadcrumb+' ul li a.active').attr('id');
  $('#'+slider_destination_breadcrumb+' ul li a.active').removeClass('active');
}

function checkNavElement()
{
  //console.log('checkNavElement');
  elemnt_list= $('#'+slider_destination_breadcrumb+' ul.breadcrumb li').length;
  if(elemnt_list > 0){
    $('#'+slider_destination_breadcrumb+' ul.breadcrumb li a').each(function(){
      if($(this).attr('id') == selected_node_predicate.replace(' ', '')+selected_node_id){
        selected_nav_element= selected_node_predicate.replace(' ', '')+selected_node_id;
        return false;
      }else if($(this).attr('id') == 'root_'+selected_node_id){
        selected_nav_element= 'root_'+selected_node_id;
        return false;
      }else{
        selected_nav_element= null;
        return true;
      }
    });
  }
  
  valorizeNav();
}

function valorizeNav()
{
  //console.log('valorizeNav');
  if(selected_nav_element){
    $('#'+selected_nav_element).addClass('active');
  }else{
    createActiveNavButtonLink();
  }
}

function createNewNavRow()
{
  //console.log('createNewNavRow');
  $('#'+slider_destination_breadcrumb).append('<ul id="nav_story_'+selected_node_id+'" class="breadcrumb"></ul>');
  slider_destination_breadcrumb_ul= selected_node_id;
  createActiveNavButtonLink();
}

function createActiveNavButtonLink()
{
  //console.log('createActiveNavButtonLink');
  var predicate= (selected_node_predicate !== undefined )? selected_node_predicate : 'root_';
  $('#'+position_layout+' a').addClass('active');
  $('#'+position_layout+' a').attr('onclick', 'javascript: startBind('+selected_node_id+',\''+selected_node_predicate+'\',\''+selected_node_direction+'\');');
  $('#'+position_layout+' a').attr('id', predicate.replace(' ', '')+selected_node_id);
  $('#'+position_layout+' a').html(selected_node_name);
  if(selected_node_predicate)
    $('#'+position_layout+' span.divider').html(selected_node_predicate);

  removeNode(append_direction);
  if(append_direction == 'right'){
    $('#'+slider_destination_breadcrumb+' ul#'+'nav_story_'+slider_destination_breadcrumb_ul).append($('#'+position_layout).html());
  }else{
    $('#'+slider_destination_breadcrumb+' ul#'+'nav_story_'+slider_destination_breadcrumb_ul).prepend($('#'+position_layout).html());
  }
  
  resetNavPartial();
}

function resetNavPartial()
{
  //console.log('resetNavPartial');
  $('#'+position_layout+' a').removeClass('active');
  $('#'+position_layout+' a').removeAttr('onclick');
  $('#'+position_layout+' a').removeAttr('id');
  $('#'+position_layout+' a').html('');
  $('#'+position_layout+' span.divider').html('');
}

function removeNode(append_direction)
{
  //console.log('removeNode');
  var selected_li      = $("li:has(a[id='"+selected_nav_node_active+"'])");
  var selected_li_span = $("li:has(a[id='"+selected_nav_node_active+"']) span");
  
  if(append_direction == 'right'){
    if(selected_li.next().length){
      cloneNavToHistory()
      selected_li_span.remove();
      selected_li.nextAll().each(function(){
        $(this).remove();
      });
    }
  }else{
    if(selected_li.prev().length){
      cloneNavToHistory();
      selected_li_span.remove();
      selected_li.prevAll().each(function(){
        $(this).remove();
      });
    }
  }
}

function cloneNavToHistory()
{
  //console.log('cloneNavToHistory');
  if($('#'+slider_destination_breadcrumb+' ul#'+'nav_story_'+slider_destination_breadcrumb_ul+' li').length > 0){
    var history_nav= $('#'+slider_destination_breadcrumb+' ul#'+'nav_story_'+slider_destination_breadcrumb_ul).clone();
    history_nav.removeAttr('id');
    $('#'+slider_destination_breadcrumb_history).prepend(history_nav);
    
    last_history= $('#'+slider_destination_breadcrumb_history+' ul').first();
    last_history.find('li').each(function(){
      $(this).addClass('child');
      var action= $(this).find('a').attr('onclick');
      var new_action= action.replace("startBind","startNav");
      $(this).find('a').attr('onclick', new_action);
    });
  }
}
/**
 * Node Class
 * 
 */

var selected_node_data;
var selected_node_name;
var selected_node_code;
var selected_node_id;
var selected_node_description;
var selected_node_predicate;
var selected_node_show_predicate= false;
var selected_node_code_local;
var selected_node_class;
var selected_node_direction;

function setNodeProperty(node_detail)
{
  //console.log('setNodeProperty');
  selected_node_name        = getNodeName(node_detail);
  selected_node_code        = getNodeCode(node_detail);
  selected_node_code_local  = getNodeLocalCode(node_detail);
  selected_node_description = getNodeDescription(node_detail);
  selected_node_class       = getNodeClass(node_detail);
  selected_node_kind        = getNodeKind(node_detail);
}

function getRootNodeList()
{
  //console.log('getRootNodeList');
  ask(dev_stage+urlForRootNodes, generateRootMenu);
}

function getNodeById()
{
  //console.log('getNodeById');
  ask(dev_stage+urlForNodeDetails+'/'+selected_node_id, initializeNode);
}

function getNodeRelationINById(page)
{
  //console.log('getNodeRelationINById');
  ask(dev_stage+urlForNodeRelationIN+'/'+selected_node_id+ (page ? '/'+page: ''), generateNodeRelationIN);
}

function getNodeRelationOUTById(page)
{
  //console.log('getNodeRelationOUTById');
  ask(dev_stage+urlForNodeRelationOUT+'/'+selected_node_id+ (page ? '/'+page: ''), generateNodeRelationOUT);
}

function searchNodeRelationINById(term)
{
  //console.log('searchNodeRelationINById');
  ask(dev_stage+urlForSearchNodeRelationIN+'/'+selected_node_id+ (term ? '/'+term: ''), generateNodeRelationIN);
}

function searchNodeRelationOUTById(term)
{
  //console.log('searchNodeRelationOUTById');
  ask(dev_stage+urlForSearchNodeRelationOUT+'/'+selected_node_id+ (term ? '/'+term: ''), generateNodeRelationOUT);
}

function getNodeName(node)
{
  //console.log('getNodeName');
  return getDefaultLanguage(node[kTAG_LABEL]);
}

function getNodeId(node)
{
  //console.log('getNodeId');
  return node['_id'];
}

function getNodeTerm(node)
{
  //console.log('getNodeTerm');
  return (node[kTAG_TERM] !== undefined)? node[kTAG_TERM]: '';
}

function getNodeCode(node)
{
  //console.log('getNodeCode');
  return (node[kTAG_GID] !== undefined)? node[kTAG_GID]: '';
}

function getNodeLocalCode(node)
{
  //console.log('getNodeLocalCode');
  return (node[kTAG_LID] !== undefined)? node[kTAG_LID]: '';
}

function getNodeClass(node)
{
  //console.log('getNodeClass');
  return (node[kTAG_CLASS] !== undefined)? node[kTAG_CLASS]: '';
}

function getNodeImage(node)
{
  //console.log('getNodeImage');
  return '/bundles/bioversityontology/images/slider/default.png';
}

function getNodeDescription(node)
{
  //console.log('getNodeDescription');
  return getDefaultLanguage(node[kTAG_DESCRIPTION]);
  //return (node[kTAG_DESCRIPTION] !== undefined)? node[kTAG_DESCRIPTION]['en']: '';
}

function getNodePredicate(edge)
{
  //console.log('getNodePredicate');
  return (selected_node_data._term[edge[kTAG_PREDICATE]] !== undefined)?
            selected_node_data._term[edge[kTAG_PREDICATE]][kTAG_LABEL]['en']: '';
}

function getNodeDefinition(node)
{
  //console.log('getNodeDefinition');
  return (node[kTAG_DEFINITION] !== undefined)? node[kTAG_DEFINITION]['en']: '';
}

function getNodeKind(node)
{
  //console.log('getNodeKind');
  return (node[kTAG_KIND] !== undefined)? node[kTAG_KIND]: '';
}

function findNodePredicate(nodeId)
{
  //console.log('findNodePredicate');
  var predicate= null;
  //var pattReverter=new RegExp(" reverter");
  
  if(selected_node_data._edge[key][kTAG_VERTEX_OBJECT] == selected_node_id){
    setAppendDirection('right');
    predicate= getNodePredicate(value);
  }else if(selected_node_data._edge[key][kTAG_VERTEX_SUBJECT] == selected_node_id){
    setAppendDirection('left');
    predicate= getNodePredicate(value);
  }
  
  return predicate;
}

function setNodePredicate(predicate)
{
  //console.log('setNodePredicate');
  selected_node_predicate= predicate;
}

function setNodeId(node_id)
{
  //console.log('setNodeId');
  selected_node_id= node_id;
}

function getDefaultLanguage($language)
{
  if($language !== undefined){
    if($language['en'] !== undefined){
      return $language['en'];
    }else{
      if($language[0] !== undefined){
        return $language[0];
      }
      else{
        for (label in $language){
          return $language[label];
        }
      }
    }
  }else{
    return '';
  }
}

function isRoot(node)
{
  //console.log('isRoot');
  if(node[kTAG_DESCRIPTION][0] == ":ROOT")
    return true;
  else
    return false;
}
/**
 * Pager
 *
 */

var pager_node_data_limit;
var pager_node_data_in_count;
var pager_node_data_out_count;
var pager_node_data_selected;
var node_element_for_page= 10;

function createPager(request_result, destination)
{
  var pages= getPageNumber(request_result);
  
  if(pages > 0){
    $('#'+slider_pager_layout_id+' .node_record .total_page').html(pages);
    
    $('#'+slider_pager_layout_id+' .node_record input').attr('value', pager_node_data_selected);
    $('#'+slider_pager_layout_id+' .node_record input').attr('onChange', 'javascript: startPager(this.value,\''+destination+'\');');
    
    if((pager_node_data_selected) > 1){
      $('#'+slider_pager_layout_id+' .node_record .first_page').attr('onclick', 'javascript: startPager(1,\''+destination+'\');');
      $('#'+slider_pager_layout_id+' .node_record   .prev_page').attr('onclick', 'javascript: startPager('+(pager_node_data_selected-1)+',\''+destination+'\');');
    }
    if((pager_node_data_selected) < pages){
      $('#'+slider_pager_layout_id+' .node_record .last_page').attr('onclick', 'javascript: startPager('+(pages)+',\''+destination+'\');');
      $('#'+slider_pager_layout_id+' .node_record   .next_page').attr('onclick', 'javascript: startPager('+(pager_node_data_selected+1)+',\''+destination+'\');');
    }
    
    $('#'+destination+' .'+slider_destination_pager).append($('#'+slider_pager_layout_id+' .node_record').html());
  }
}

function startPager(page, destination)
{
  //console.log('startPager');
  resetPager();
  if(destination == slider_destination_left){
    resetLeft();
    getNodeRelationPagerINById(page-1);
  }
  else{
    resetRight();
    getNodeRelationPagerOUTById(page-1);
  }
}

function getPageNumber(request_result)
{
  //console.log('getPageNumber');
  return Math.ceil(request_result/pager_node_data_limit);
}

function resetPager()
{
  //console.log('resetPager');
  $('.'+slider_destination_pager).html(' ');
  $('#'+slider_pager_layout_id+' .node_record .first_page').removeAttr('onclick');
  $('#'+slider_pager_layout_id+' .node_record   .prev_page').removeAttr('onclick');
  $('#'+slider_pager_layout_id+' .node_record .last_page').removeAttr('onclick');
  $('#'+slider_pager_layout_id+' .node_record   .next_page').removeAttr('onclick');
}

function getNodeRelationPagerINById(page)
{
  //console.log('getRootNodeList');
  ask(dev_stage+urlForNodeRelationPagerIN+'/'+selected_node_id+ '/'+page, generateNodeRelationIN);
}

function getNodeRelationPagerOUTById(page)
{
  //console.log('getNodeRelationPagerOUTById');
  ask(dev_stage+urlForNodeRelationPagerOUT+'/'+selected_node_id+ '/'+page, generateNodeRelationOUT);
}

/**
 * Method for search tool
 *
 */

function setNodePager(node_list)
{
  var pages= Math.ceil(node_list[':WS:AFFECTED-COUNT']/node_element_for_page);
  createNodePager(pages);
}

function createNodePager(pages, slider_destination_search_node_pager_point)
{
  if(pages > 0){
    $('#'+slider_pager_layout_id+' .node_record .total_page').html(pages);
    
    $('#'+slider_pager_layout_id+' .node_record input').attr('value', pager_node_data_selected);
    $('#'+slider_pager_layout_id+' .node_record input').attr('onChange', 'javascript: startPager(this.value,\''+destination+'\');');
    
    if((pager_node_data_selected) > 1){
      $('#'+slider_pager_layout_id+' .node_record .first_page').attr('onclick', 'javascript: startPager(1,\''+destination+'\');');
      $('#'+slider_pager_layout_id+' .node_record   .prev_page').attr('onclick', 'javascript: startPager('+(pager_node_data_selected-1)+',\''+destination+'\');');
    }
    if((pager_node_data_selected) < pages){
      $('#'+slider_pager_layout_id+' .node_record .last_page').attr('onclick', 'javascript: startPager('+(pages)+',\''+destination+'\');');
      $('#'+slider_pager_layout_id+' .node_record   .next_page').attr('onclick', 'javascript: startPager('+(pager_node_data_selected+1)+',\''+destination+'\');');
    }
    
    $('#'+destination).append($('#'+slider_pager_layout_id+' .node_record').html());
  }
}
/**
 * Search
 *
 */

var start_search_bind= true;
var show_search_filter= true;

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

function showSearchFilter(destination)
{
  //console.log('showSearchFilter');
  $('#'+destination+' .search_filter').fadeIn();
}

function startSearchBind()
{
  $('.search_filter').keyup(function (){
    var search_id= $(this).attr('id');
    var string= $(this).val();
    if(string.length >= 3){
      delay(function(){
        if(search_id === 'search_left'){
          resetLeft();
          resetPager();
          searchNodeRelationINById(string);
        }else{
          resetRight();
          resetPager();
          searchNodeRelationOUTById(string);
        }
      }, 1000 );
    }else if(string.length === 0){
      delay(function(){
        if(search_id === 'search_left'){
          resetLeft();
          resetPager();
          getNodeRelationINById(string);
        }else{
          resetRight();
          resetPager();
          getNodeRelationOUTById(string);
        }
      }, 1000 );
    }
  });
}

function createSearchPoint()
{
    $('#search_point').html('');
    $.ajax({
        url:        dev_stage+'/slider/partial/node/search',
        dataType:   "html",
        success: function( data ) {
           $('#search_point').append(data);
        }
     }).done( function(){
        buildTree();
        bindFormCheckbox();
        startAutocomplete('SliderSearchNode');
        startTooltip();
        bindSearchButton();
     });  
}

function bindSearchButton()
{
  $('#SliderSearchNode').submit(function(event){
      event.preventDefault();
      
      $.ajax({
          type:       "POST",
          url:        dev_stage+'/slider/partial/node/search',
          dataType:   "json",
          data:       $(this).serializeArray(),
          success: function( data ) {
            generateNodeList(data);
          }
      });
  });
}
/**
 *	Slider configurator file.
 *
 *	There you can find the primary bind method an relations request method
 *
 *	@package	ontology slider
 *
 *	@author		Antonino Luca Carella <antonio.carella@gmail.com>
 *	@version	1.00
 */
function generateRootMenu()
{
  //console.log('generateRootMenu');
  $.each(selected_node_data._ids, function(key, value){
    createNodeMenuButton(
      top_menu_layout_id,
      getNodeName(selected_node_data._node[value]),
      getNodeCode(selected_node_data._node[value]),
      value
    );
  });
  //bindRootButton();
}

function generateNodeList(node_list)
{
  //console.log('generateNodeList');
  resetNodeList();
  showNodes();
  goToByScroll(slider_destination_search_node_list_point);
  if(node_list['term'][':WS:PAGING'][':WS:PAGE-COUNT'] > 0){
    setNodePager(node_list['term']);
    $.each(node_list['term'][':WS:RESPONSE'], function(key, value){
      createNodeList(
        value[kTAG_CLASS],
        value[kTAG_NID],
        value[kTAG_GID],
        value[kTAG_LABEL],
        value[kTAG_KIND]
      );
    });
  }else{
    displayNoResult();
  }
}

function hideSearch()
{
  $('#'+slider_destination_search_point+' form').hide();
}

function showSearch()
{
  $('#'+slider_destination_search_point+' form').fadeIn('slow');
}

function showNodes()
{
  $('#'+slider_destination_search_node_point).fadeIn('slow');
}

function hideNodes()
{
  $('#'+slider_destination_search_node_point).fadeOut('slow');
}

function hideSlider()
{
  $('#breadcrumb').hide();
  $('#history_container').hide();
  $('#slider').hide();
  $('#node_legend').hide();
}

function showSlider()
{
  $('#breadcrumb').fadeIn('slow');
  $('#history_container').fadeIn('slow');
  $('#slider').fadeIn('slow');
  $('#node_legend').fadeIn('slow');
}

function startBind(button, predicate, direction)
{
  //console.log('startBind');
  showSlider();
  setAppendDirection(direction);
  startButtonAnimation(button,predicate);
  goToByScroll('slider');
}

//function bindRootButton()
//{
//  $('#entry_point a').click(function(){
//    startBind($(this).attr('class'));
//  });
//}

function startButtonAnimation(button, predicate)
{
  //console.log('startButtonAnimation');
  $('#row_'+button).effect("transfer", { to: $('#'+slider_destination_center_header+' .btn_node') }, 300);
  startDetailAnimation(button, predicate);
}

function startDetailAnimation(button, predicate)
{
  //console.log('startDetailAnimation');
  $('#'+slider_destination_center).fadeOut('slow');
  bindButton(button, predicate);
}

function bindButton(button, predicate)
{
  //console.log('bindButton');
  setNodeId(button);
  setNodePredicate(predicate);
  getNodeById();
}

function initializeNode()
{
  //console.log('initializeNode');
  $.each(selected_node_data._ids, function(key, value){
    if(value == selected_node_id){
      setNodeProperty(selected_node_data._node[value]);
      resetSlider();
      createNodeDetail();
      buildNav();
    }
  });
  initializeNodeRelations();
}

function initializeNodeRelations()
{
  //console.log('initializeNodeRelations');
  getNodeRelationINById();
  getNodeRelationOUTById();
}

function startButtonListAnimation()
{
  //console.log('startButtonListAnimation');
  $("ul.node_container li .btn_node_more").click(function() {
    var detail= $(this).parent();
    if(detail.attr('class')=='dontshow'){
      detail.find(".list_node_detail").slideDown('slow');
      detail.find(".btn_node_more").html(' - show less');
      detail.attr('class','show');
    }else{
      detail.find(".list_node_detail").slideUp('slow');
      detail.find(".btn_node_more").html(' + show more');
      detail.attr('class','dontshow');
    }
  });

}

function generateNodeRelationIN()
{
  //console.log('generateNodeRelationIN');
  if(selected_node_data){
    generateNodeRelations(slider_left_layout_id,slider_destination_left);
  }
}

function generateNodeRelationOUT()
{
  //console.log('generateNodeRelationOUT');
  if(selected_node_data){
    generateNodeRelations(slider_right_layout_id,slider_destination_right);
  }
}

function generateNodeRelations(layout, destination)
{
  //console.log('generateNodeRelations');
  var pager_count;
  
  $.each(selected_node_data._edge, function(key, value){
    if(value[kTAG_OBJECT] == selected_node_id){
      var node_id= value[kTAG_SUBJECT];
      var node_value= selected_node_data._node[node_id];
      select_node_direction='left';
      show_pager=true;
      show_search_filter= true;
      pager_count= pager_node_data_in_count;
    }else if(value[kTAG_SUBJECT] == selected_node_id){
      var node_id= value[kTAG_OBJECT];
      var node_value= selected_node_data._node[node_id];
      select_node_direction='right';
      show_pager=true;
      show_search_filter= true;
      pager_count= pager_node_data_out_count;
    }
    
    createNodeButton(
      layout,
      destination,
      getNodePredicate(value),
      getNodeName(node_value),
      getNodeCode(node_value),
      node_id,
      getNodeDescription(node_value),
      getNodeDefinition(node_value),
      getNodeKind(node_value),
      select_node_direction
    );
  });
  
  startButtonListAnimation();
  
  if(show_pager===true){
    createPager(pager_count, destination);
  }
  
  if(show_search_filter===true){
    if(pager_count > 25){
      showSearchFilter(destination);
    
      if(start_search_bind===true){
        startSearchBind();
        start_search_bind=false;
      }
    }
  }
}

/**
 * This method group is used for reset the slider values
 *
 */
function resetSlider()
{
  //console.log('resetSlider');
  resetCenter();
  resetLeft();
  resetRight();
  resetPager();
  resetSearch();
}

function resetNodeList()
{
  //console.log('resetCenter');
  $('#'+slider_destination_search_node_list_point).html(' ');  
}

function resetCenter()
{
  //console.log('resetCenter');
  $('#'+slider_destination_center).html(' ');  
}

function resetLeft()
{
  //console.log('resetLeft');
  $('#'+slider_destination_left+' ul').html(' ');  
}

function resetRight()
{
  //console.log('resetRight');
  $('#'+slider_destination_right+' ul').html(' ');  
}

function resetSearch()
{
  $('.search_filter').fadeOut();
  $('.search_filter').val('');
}


/**
 * The following method are used to valorize the node data in the partials html slider
 *
 */
function createNodeMenuButton(layout, node_name, node_code, node_id)
{
  //console.log('createNodeMenuButton');
  $('#'+layout+' .node_record a').html(node_name);
  $('#'+layout+' .node_record a').attr('onclick', 'javascript: startNav('+node_id+');');
  //$('#'+layout+' .node_record a').attr('class', node_id);
  $('#'+slider_destination_root).append($('#nav_top_button .node_record').html());
}

function createNodeButton(layout, destination, predicate, node_name, node_code, node_id,node_description,node_definition, node_kind, direction)
{
  //console.log('createNodeButton');
  $('#'+layout+' .node_record .btn_node_predicate').html(predicate);
  $('#'+layout+' .node_record .btn_node_code').html(node_code);
  $('#'+layout+' .node_record .btn_node_name').html(node_name);
  $('#'+layout+' .node_record .btn_node_description').html(node_description);
  $('#'+layout+' .node_record .btn_node_definition').html(node_definition);
  $('#'+layout+' .node_record li').attr('id', 'row_'+node_id);
  $('#'+layout+' .node_record li').attr('style', 'display:none;');
  $('#'+layout+' .node_record .btn_node').attr('onclick', 'javascript: startBind('+node_id+',\''+predicate+'\',\''+direction+'\');');
  
  if(node_kind !== ''){
    var added_class= '';
    var divider=new RegExp(":");
    $.each(node_kind, function(key, value){
      if(divider.test(value))
        var html_class= value.replace(':', '');
      added_class += ' <span class="'+html_class+'" title=":'+html_class+'">■</span> ';
    });
    $('#'+layout+' .node_record .btn_node_code').html(node_code+added_class);
  }
    
  $('#'+destination+' ul.node_container').append($('#'+layout+' .node_record').html());
  $('#'+destination+' ul.node_container li').fadeIn('slow');
}

function displayNoResult()
{
  $('#'+slider_destination_search_node_list_point).append('<p>no node found</p>');
}

function createNodeList(node_class, node_nid, node_gid, node_label, node_kind)
{
  //console.log('createNodeMenuButton');
  $('#'+slider_search_node_list_layout_id+' .node_record li').addClass(node_class);
  $('#'+slider_search_node_list_layout_id+' .node_record li').attr('onclick', 'javascript: startNav('+node_nid+');');
  $('#'+slider_search_node_list_layout_id+' .node_record span.node_nid').html('NID '+node_nid);
  $('#'+slider_search_node_list_layout_id+' .node_record span.node_label').html('LABEL '+node_label['en']);
  $('#'+slider_search_node_list_layout_id+' .node_record span.node_gid').html('GID '+node_gid);
  
  if(node_kind !== undefined)
    $('#'+slider_search_node_list_layout_id+' .node_record span.node_kind').html('KIND <br/>'+String(node_kind).replace(',','<br/>'));
  else
    $('#'+slider_search_node_list_layout_id+' .node_record span.node_kind').html('');
  
  $('#'+slider_destination_search_node_list_point).append($('#'+slider_search_node_list_layout_id+' .node_record').html());
}

function createNodeDetail()
{
  //console.log('createNodeDetail');
  $.each(selected_node_data._node[selected_node_id], function(arrayID,arrayValue) {
    if(arrayID !== '_id'){
      var label= selected_node_data._term[selected_node_data._tag[arrayID][kTAG_PATH][0]][kTAG_LABEL]['en'];
      if(arrayID == kTAG_LABEL){
        createNodeHeaderName(arrayValue['en']);
      }else if(arrayID == kTAG_GID){
        createNodeHeaderCode(checkArray(arrayValue));
      }else{
        $('#'+slider_center_layout_id+' .node_detail label' ).html(label);
        $('#'+slider_center_layout_id+' .node_detail span' ).html(checkArray(arrayValue));
        $('#'+slider_destination_center).append($('#'+slider_center_layout_id).html());
        $('#'+slider_center_layout_id+' .node_detail label' ).html('');
        $('#'+slider_center_layout_id+' .node_detail span' ).html('');
      }
    }
  });
  
  $('#'+slider_destination_center).fadeIn('slow');  
  $('#'+slider_destination_center_header).fadeIn('slow');
}

function createNodeHeaderName(node_name)
{
  //console.log('createNodeHeaderName');
  $('#'+slider_destination_center_header+' .btn_node_name').html(node_name);
}

function createNodeHeaderCode(node_code)
{
  //console.log('createNodeHeaderCode');
  $('#'+slider_destination_center_header+' .btn_node_code').html(node_code);
  
  if(selected_node_kind !== ''){
    var added_class= '';
    $.each(selected_node_kind, function(key, value){
      var html_class= value.replace(':', '');
      added_class += ' <span class="'+html_class+'" title=":'+html_class+'">■</span> ';
    });
    $('#'+slider_destination_center_header+' .btn_node_code').html(node_code+added_class);
  }
}

function checkArray(arrayValue)
{
  //console.log('checkArray');
  var node_partial='';
  
  if($.isArray(arrayValue)){
    $.each(arrayValue, function(key,value){
      node_partial +=checkArray(value)+'<br/>';
    });
    return (node_partial['en'])? node_partial['en']: node_partial;
  }
  
  if($.isPlainObject(arrayValue)){
    $.each(arrayValue, function(key,value){
      node_partial +='<strong>'+key+': </strong>'+checkArray(value)+'<br/>';
    });
    return (node_partial['en'])? node_partial['en']: node_partial;
  }
  
  return arrayValue;
}
function buildTree()
{
    $('div.tree div.checkbox_option').each(function(){
        var labelText= $(this).text();
        var count = labelText.match(/___/g);
        var $inputId= $(this).find('input').attr('id');
        
        if(count){
            var $next= $(this).next().text().match(/___/g);
            if($next){
                if($next.length > count.length)
                    $(this).find('label').html('<span class="opener"> <strong> + </strong> </span>'+$(this).text());
                else
                    $(this).find('label').html('<span class="opener"> _</span>'+$(this).text());
            }
            $(this).attr('id', 'node'+$inputId+'_'+(count.length+1));
            $(this).addClass('children level_'+(count.length+1)+' closed');
            $(this).fadeOut('slow');
        }else{
            if($(this).next().text().match(/___/g))
                $(this).find('label').html('<span class="opener"> <strong> + </strong> </span>'+$(this).text());
            $(this).attr('id', 'node'+$inputId+'_'+'1');
            $(this).addClass('root level_1');
        }
    });    
}

function clearIndentation(label)
{
    return label.replace('___', '&nbsp;');
}

function bindFormCheckbox()
{
    $('div.tree div.checkbox_option input, .opener').click(function(){
        var $field= $(this).parents().find('div.tree').attr('id');        
        var $inputId= $(this).parent().attr('id');        
        var $exploded= $inputId.split('_');
        
        var level= parseInt($exploded[3], 10)+1;
        
        var open= false;
        var check= false;
        
        $('#'+$field+' .checkbox_option').each(function(){
            if($(this).attr('id') == $inputId){
                open= true;
            }
            if(check && ($(this).hasClass('root') || $(this).hasClass('level_'+(level-1)))){
                open= false;
            }
            if(open && $(this).hasClass('level_'+level)){
                if($(this).hasClass('closed')){
                    $(this).fadeIn();
                    $(this).removeClass('closed');
                    $(this).addClass('open');
                }else{
                    $(this).fadeOut();
                    $(this).removeClass('open');
                    $(this).addClass('closed');
                }
                check= true;
            }
        });
    });
}
/**
 * this methos is used to scroll at the called element in the page
 */

function calculateScroll(element){
  var scrollTop     = $(window).scrollTop(),
      elementOffset = $('#'+element).offset().top,
      distance      = (elementOffset - scrollTop);
      
  return scrollTop;
}
    
function goToByScroll(id){
  $('html,body').animate({scrollTop: $("#"+id).offset().top - $('#menu_header').height() - 10 },'slow');
}
/**
 *	Slider configurator file for node creation.
 *
 *	There you can find the primary bind method an relations request method
 *
 *	@package	ontology slider
 *
 *	@author		Antonino Luca Carella <antonio.carella@gmail.com>
 *	@version	1.00
 */

function hideAddNodeButton()
{
  $('.'+$slider_destination_form_action).hide();
}
function disableSlider(){
    $('#disable_slider').css('width',$('#slider_content').width()+'px');
    $('#disable_slider').css('height','1px');
    $('#disable_slider').fadeIn('slow');
    $('#disable_slider').animate({'height':$('#slider_content').height()+'px'});
}

function enableSlider(){
    $('#disable_slider').animate({'height':'0px'});
    $('#disable_slider').fadeOut('slow');
}

function disableForm(form)
{
    $('#disable_slider').animate({'height':($('#disable_slider').height()+$('#'+form).height())+'px'});
}

function enableForm(form)
{
    $('#disable_slider').animate({'height':($('#disable_slider').height()-$('#'+form).height())+'px'});
}