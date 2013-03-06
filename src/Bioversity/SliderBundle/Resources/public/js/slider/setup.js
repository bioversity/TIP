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
var slider_destination_root= 'entry_point ul.nav';
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
  
  json_data= $.parseJSON(data);
  selected_node_data= json_data[':WS:RESPONSE'];
  $pager_node_data_limit= json_data[':WS:PAGING'][':WS:PAGE-LIMIT'];
  $pager_node_data_selected= parseInt(json_data[':WS:PAGING'][':WS:PAGE-START'])+1;
  
  $pager_node_data_in_count= 0;
  $pager_node_data_out_count= 0;
  $show_search_filter=false;
  show_pager=false;
  
  if(pattIN.test(url) || pattSearchIN.test(url)){
    $pager_node_data_in_count= json_data[':WS:STATUS'][':WS:AFFECTED-COUNT'];
  }
  if(pattOUT.test(url) || pattSearchOUT.test(url)){
    $pager_node_data_out_count= json_data[':WS:STATUS'][':WS:AFFECTED-COUNT'];
  }
}