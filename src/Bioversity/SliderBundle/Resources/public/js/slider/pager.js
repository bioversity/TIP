/**
 * Pager
 *
 */

var $pager_node_data_limit;
var $pager_node_data_in_count;
var $pager_node_data_out_count;
var $pager_node_data_selected;

function createPager(request_result, destination)
{
  //console.log('createPager');
  var pages= getPageNumber(request_result);
  if(pages > 0){
    $('#'+slider_pager_layout_id+' .node_record .total_page').html(pages);
    
    $('#'+slider_pager_layout_id+' .node_record input').attr('value', $pager_node_data_selected);
    $('#'+slider_pager_layout_id+' .node_record input').attr('onChange', 'javascript: startPager(this.value,\''+destination+'\');');
    
    if(($pager_node_data_selected) > 1){
      $('#'+slider_pager_layout_id+' .node_record .first_page').attr('onclick', 'javascript: startPager(1,\''+destination+'\');');
      $('#'+slider_pager_layout_id+' .node_record   .prev_page').attr('onclick', 'javascript: startPager('+($pager_node_data_selected-1)+',\''+destination+'\');');
    }
    if(($pager_node_data_selected) < pages){
      $('#'+slider_pager_layout_id+' .node_record .last_page').attr('onclick', 'javascript: startPager('+(pages)+',\''+destination+'\');');
      $('#'+slider_pager_layout_id+' .node_record   .next_page').attr('onclick', 'javascript: startPager('+($pager_node_data_selected+1)+',\''+destination+'\');');
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
  return Math.ceil(request_result/$pager_node_data_limit);
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