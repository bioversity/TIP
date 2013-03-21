/**
 * Pager
 *
 */

var pager_node_data_limit;
var pager_node_data_in_count;
var pager_node_data_out_count;
var pager_node_data_selected= 1;
var pager_search_node_data_selected= 1;
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
  pager_node_data_selected= page;
  if(destination == slider_destination_left){
    resetLeft();
    getNodeRelationPagerINById(page);
  }
  else{
    resetRight();
    getNodeRelationPagerOUTById(page);
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
  var pages= Math.ceil(node_list[':WS:STATUS'][':WS:AFFECTED-COUNT']/node_element_for_page);
  createNodePager(pages);
}

function createNodePager(pages)
{
  if(pages > 0){
    $('#'+slider_pager_node_list_layout_id+' .node_record .total_page').html(pages);
    
    $('#'+slider_pager_node_list_layout_id+' .node_record input').attr('value', (pager_search_node_data_selected == 0)? 1: pager_search_node_data_selected);
    $('#'+slider_pager_node_list_layout_id+' .node_record input').attr('onChange', 'javascript: searchNode(this.value);');
    
    if(pager_search_node_data_selected > 1){
      $('#'+slider_pager_node_list_layout_id+' .node_record .first_page').attr('onclick', 'javascript: searchNode(1);');
      $('#'+slider_pager_node_list_layout_id+' .node_record   .prev_page').attr('onclick', 'javascript: searchNode('+(pager_search_node_data_selected-1)+');');
    }
    if(pager_search_node_data_selected < pages && pager_search_node_data_selected != 0){
      $('#'+slider_pager_node_list_layout_id+' .node_record .last_page').attr('onclick', 'javascript: searchNode('+(pages)+');');
      $('#'+slider_pager_node_list_layout_id+' .node_record   .next_page').attr('onclick', 'javascript: searchNode('+(parseInt(pager_search_node_data_selected, 10)+1)+');');
    }
    
    $('#'+slider_destination_search_node_pager_point).append($('#'+slider_pager_node_list_layout_id+' .node_record').html());
  }
}

function resetSearchPager()
{
  $('#'+slider_destination_search_node_pager_point).html(' ');
}