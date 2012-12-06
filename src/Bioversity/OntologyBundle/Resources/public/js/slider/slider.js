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

function initSlider()
{
  getRootNodeList();
}

function generateRootMenu(){
  $.each(selected_node_data._ids, function(key, value){
    createNodeMenuButton(
      top_menu_layout_id,
      getNodeName(selected_node_data._node[value]),
      getNodeCode(selected_node_data._node[value]),
      value
    );
  });
}

function startBind(button, predicate){
  startButtonAnimation(button,predicate);
}

function startButtonAnimation(button, predicate){
  $('#row_'+button).animate(
    {opacity: 0},'slow',startDetailAnimation(button, predicate)
  );
}

function startDetailAnimation(button, predicate){
  $('#'+slider_destination_center).fadeOut('slow');
  bindButton(button, predicate);
}

function bindButton(button, predicate){
  setNodeId(button);
  setNodePredicate(predicate);
  getNodeById();
}

function initializeNode(){
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

function initializeNodeRelations(){
  getNodeRelationINById();
  getNodeRelationOUTById();
}

function startButtonListAnimation(){
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

function generateNodeRelationIN(){
  if(selected_node_data){
    generateNodeRelations(slider_left_layout_id,slider_destination_left);
  }
}

function generateNodeRelationOUT(){
  if(selected_node_data){
    generateNodeRelations(slider_right_layout_id,slider_destination_right);
  }
}

function generateNodeRelations(layout, direction)
{
  var show_pager=false;
  var pager_count;
  
  $.each(selected_node_data._edge, function(key, value){
    if(value[kTAG_OBJECT] == selected_node_id){
      var node_id= value[kTAG_SUBJECT];
      var node_value= selected_node_data._node[node_id];
      setAppendDirection('left');
      show_pager=true;
      pager_count= pager_node_data_in_count;
    }else if(value[kTAG_SUBJECT] == selected_node_id){
      var node_id= value[kTAG_OBJECT];
      var node_value= selected_node_data._node[node_id];
      setAppendDirection('right');
      show_pager=true;
      pager_count= pager_node_data_out_count;
    }
    
    createNodeButton(
      layout,
      direction,
      getNodePredicate(value),
      getNodeName(node_value),
      getNodeCode(node_value),
      node_id,
      getNodeDescription(node_value),
      getNodeDefinition(node_value),
      getNodeKind(node_value)
    );
  });
  
  startButtonListAnimation();
  
  if(show_pager===true) createPager(pager_count, direction);
}

/**
 * This method group is used for reset the slider values
 *
 */
function resetSlider(){
  resetCenter();
  resetLeft();
  resetRight();
  resetPager();
}

function resetCenter(){
  $('#'+slider_destination_center).html(' ');  
}

function resetLeft(){
  $('#'+slider_destination_left+' ul').html(' ');  
}

function resetRight(){
  $('#'+slider_destination_right+' ul').html(' ');  
}


/**
 * The following method are used to valorize the node data in the partials html slider
 *
 */
function createNodeMenuButton(layout, node_name, node_code, node_id){
  $('#'+layout+' .node_record a').html(node_name+' ('+node_code+')');
  $('#'+layout+' .node_record a').attr('onclick', 'javascript: startBind('+node_id+');');
  $('#'+slider_destination_root).append($('#nav_top_button .node_record').html());
}

function createNodeButton(layout, destination, predicate, node_name, node_code, node_id,node_description,node_definition, node_kind){
  $('#'+layout+' .node_record .btn_node_predicate').html(predicate);
  $('#'+layout+' .node_record .btn_node_code').html(node_code);
  $('#'+layout+' .node_record .btn_node_name').html(node_name);
  $('#'+layout+' .node_record .btn_node_description').html(node_description);
  $('#'+layout+' .node_record .btn_node_definition').html(node_definition);
  $('#'+layout+' .node_record li').attr('id', 'row_'+node_id);
  $('#'+layout+' .node_record li').attr('style', 'display:none;');
  $('#'+layout+' .node_record .btn_node').attr('onclick', 'javascript: startBind('+node_id+',\''+predicate+'\');');
  
  if(node_kind !== ''){
    var added_class= '';
    $.each(node_kind, function(key, value){
      var html_class= value.replace(':', '');
      added_class += ' <span class="'+html_class+'" title=":'+html_class+'">■</span> ';
    });
    $('#'+layout+' .node_record .btn_node_code').html(node_code+added_class);
  }
    
  $('#'+destination+' ul.node_container').append($('#'+layout+' .node_record').html());
  $('#'+destination+' ul.node_container li').fadeIn('slow');
}

function createNodeDetail()
{
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

function createNodeHeaderName(node_name){
  $('#'+slider_destination_center_header+' .btn_node_name').html(node_name);
}

function createNodeHeaderCode(node_code){
  $('#'+slider_destination_center_header+' .btn_node_code').html(node_code);
}

function checkArray(arrayValue)
{
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