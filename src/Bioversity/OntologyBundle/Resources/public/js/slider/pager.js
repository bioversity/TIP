/**
 * Pager
 *
 */

var pager_node_data_limit;
var pager_node_data_in_count;
var pager_node_data_out_count;
var pager_node_data_selected;

function createPager(request_result, destination){
  var pages= getPageNumber(request_result);
  if(pages > 0){
    $('#'+slider_pager_layout_id+' .node_record .total_page').html(pages+1);
    $('#'+slider_pager_layout_id+' .node_record .first_page').attr('onclick', 'javascript: startPager(1,\''+destination+'\');');
    $('#'+slider_pager_layout_id+' .node_record .last_page').attr('onclick', 'javascript: startPager('+(pages + 1)+',\''+destination+'\');');
    
    $('#'+slider_pager_layout_id+' .node_record input').attr('value', pager_node_data_selected+1);
    $('#'+slider_pager_layout_id+' .node_record input').attr('onChange', 'javascript: startPager(this.value,\''+destination+'\');');
    
    if((pager_node_data_selected - 1) >= 0)
      $('#'+slider_pager_layout_id+' .node_record   .prev_page').attr('onclick', 'javascript: startPager('+(pager_node_data_selected - 2)+',\''+destination+'\');');
    if((pager_node_data_selected + 1) <= pages)
      $('#'+slider_pager_layout_id+' .node_record   .next_page').attr('onclick', 'javascript: startPager('+(pager_node_data_selected + 2)+',\''+destination+'\');');
    
    $('#'+destination+' .'+slider_destination_pager).append($('#'+slider_pager_layout_id+' .node_record').html());
  }
}

function startPager(page, destination){
  resetPager();
  if(destination == slider_destination_left){
    resetLeft();
    getNodeRelationPagerINById(page);
  }
  else{
    resetRight();
    getNodeRelationPagerOUTById(page);
  }
}

function getPageNumber(request_result){
  return parseInt(request_result/pager_node_data_limit);
}

function resetPager(){
  $('.'+slider_destination_pager).html(' ');
}

function getNodeRelationPagerINById(page)
{
  ask(dev_env+urlForNodeRelationPagerIN+'/'+selected_node_id+ (page ? '/'+page: ''), generateNodeRelationIN);
}

function getNodeRelationPagerOUTById(page)
{
  ask(dev_env+urlForNodeRelationPagerOUT+'/'+selected_node_id+ (page ? '/'+page: ''), generateNodeRelationOUT);
}